<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Helpers\RoleHelper;

class UserController extends Controller
{
    /**
     * Mostrar la lista de usuarios.
     */
    public function index()
    {
        if (!RoleHelper::isAuthorized('view-users')) {
            abort(403, 'No tienes permiso para ver la lista de usuarios.');
        }

        $users = User::with('role')
            ->orderBy('first_name')
            ->get();

        return view(' users.index', compact('users'));
    }

    /**
     * Mostrar el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        if (!RoleHelper::isAuthorized('create-user')) {
            abort(403, 'No tienes permiso para crear usuarios.');
        }

        $roles = Role::orderBy('name')->get();
        return view(' users.create', compact('roles'));
    }

    /**
     * Guardar un nuevo usuario en la base de datos.
     */
    public function store(Request $request)
    {
        if (!RoleHelper::isAuthorized('create-user')) {
            abort(403, 'No tienes permiso para crear usuarios.');
        }

        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'document' => 'required|string|max:20|unique:users,document',
            'email' => 'required|email|max:150|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:200',
            'role_id' => 'required|exists:roles,id',
            'status' => 'boolean',
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'document' => $request->document,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'role_id' => $request->role_id,
            'status' => $request->status ?? true,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Mostrar el formulario para editar un usuario existente.
     */
    public function edit($id)
    {
        if (!RoleHelper::isAuthorized('edit-user')) {
            abort(403, 'No tienes permiso para editar usuarios.');
        }

        $user = User::findOrFail($id);
        $roles = Role::orderBy('name')->get();

        return view(' users.edit', compact('user', 'roles'));
    }

    /**
     * Actualizar los datos de un usuario.
     */
    public function update(Request $request, $id)
    {
        if (!RoleHelper::isAuthorized('edit-user')) {
            abort(403, 'No tienes permiso para actualizar usuarios.');
        }

        $user = User::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'document' => 'required|string|max:20|unique:users,document,' . $user->id,
            'email' => 'required|email|max:150|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:200',
            'role_id' => 'required|exists:roles,id',
            'status' => 'boolean',
        ]);

        // Actualización de datos
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'document' => $request->document,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'role_id' => $request->role_id,
            'status' => $request->status ?? true,
        ]);

        // Si el usuario decidió cambiar la contraseña
        if (!empty($request->password)) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('users.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Eliminar un usuario.
     */
    public function destroy($id)
    {
        if (!RoleHelper::isAuthorized('delete-user')) {
            abort(403, 'No tienes permiso para eliminar usuarios.');
        }

        $user = User::findOrFail($id);

        try {
            // No permitir eliminar al usuario administrador principal
            if ($user->hasRole('Administrador')) {
                return redirect()->route('users.index')
                    ->with('error', 'No se puede eliminar al usuario administrador principal.');
            }

            $user->delete();

            return redirect()->route('users.index')
                ->with('success', 'Usuario eliminado correctamente.');

        } catch (QueryException $ex) {
            return redirect()->route('users.index')
                ->with('error', 'Ocurrió un error al eliminar el usuario.');
        }
    }
}
