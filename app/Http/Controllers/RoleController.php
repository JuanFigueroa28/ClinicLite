<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Helpers\RoleHelper;

class RoleController extends Controller
{
    /**
     * Mostrar la lista de roles existentes.
     */
    public function index()
    {
        if (!RoleHelper::isAuthorized('view-roles')) {
            abort(403, 'No tienes permiso para ver la lista de roles.');
        }

        $roles = Role::withCount('users')->orderBy('name')->get();

        return view('roles.index', compact('roles'));
    }

    /**
     * Mostrar el formulario para crear un nuevo rol.
     */
    public function create()
    {
        if (!RoleHelper::isAuthorized('create-role')) {
            abort(403, 'No tienes permiso para crear roles.');
        }

        $permissions = Permission::orderBy('name')->get();
        return view('roles.create', compact('permissions'));
    }

    /**
     * Guardar un nuevo rol en la base de datos.
     */
    public function store(Request $request)
    {
        if (!RoleHelper::isAuthorized('create-role')) {
            abort(403, 'No tienes permiso para crear roles.');
        }

        $request->validate([
            'name' => 'required|string|max:100|unique:roles,name',
            'description' => 'nullable|string|max:255',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        try {
            $role = Role::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            if ($request->has('permissions')) {
                $role->permissions()->sync($request->permissions);
            }

            return redirect()->route('roles.index')
                ->with('success', 'Rol creado correctamente.');

        } catch (QueryException $e) {
            return back()->with('error', 'Ocurrió un error al guardar el rol.')->withInput();
        }
    }

    /**
     * Mostrar formulario para editar un rol existente.
     */
    public function edit($id)
    {
        if (!RoleHelper::isAuthorized('edit-role')) {
            abort(403, 'No tienes permiso para editar roles.');
        }

        $role = Role::with('permissions')->findOrFail($id);
        $permissions = Permission::orderBy('name')->get();

        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Actualizar un rol existente.
     */
    public function update(Request $request, $id)
    {
        if (!RoleHelper::isAuthorized('edit-role')) {
            abort(403, 'No tienes permiso para actualizar roles.');
        }

        $role = Role::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100|unique:roles,name,' . $role->id,
            'description' => 'nullable|string|max:255',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        try {
            $role->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            $role->permissions()->sync($request->permissions ?? []);

            return redirect()->route('roles.index')
                ->with('success', 'Rol actualizado correctamente.');

        } catch (QueryException $e) {
            return back()->with('error', 'Error al actualizar el rol.')->withInput();
        }
    }

    /**
     * Eliminar un rol del sistema.
     */
    public function destroy($id)
    {
        if (!RoleHelper::isAuthorized('delete-role')) {
            abort(403, 'No tienes permiso para eliminar roles.');
        }

        $role = Role::findOrFail($id);

        try {
            if ($role->users()->exists()) {
                return redirect()->route('roles.index')
                    ->with('error', 'No se puede eliminar un rol con usuarios asignados.');
            }

            $role->permissions()->detach();
            $role->delete();

            return redirect()->route('roles.index')
                ->with('success', 'Rol eliminado correctamente.');

        } catch (QueryException $e) {
            return redirect()->route('roles.index')
                ->with('error', 'Ocurrió un error al eliminar el rol.');
        }
    }
}
