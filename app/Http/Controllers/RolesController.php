<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class RoleController extends Controller
{
    /**
     * Mostrar la lista de roles existentes.
     */
    public function index()
    {
        $roles = Role::withCount('users')->get();

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Mostrar formulario de creación de un nuevo rol.
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Guardar un nuevo rol en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:roles,name',
            'description' => 'nullable|string|max:255',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        // Crear rol
        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Asignar permisos si los seleccionó
        if ($request->has('permissions')) {
            $role->permissions()->sync($request->permissions);
        }

        return redirect()->route('roles.index')
                         ->with('success', 'Rol creado correctamente.');
    }

    /**
     * Mostrar formulario de edición de un rol.
     */
    public function edit($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        $permissions = Permission::all();

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Actualizar los datos de un rol.
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100|unique:roles,name,' . $role->id,
            'description' => 'nullable|string|max:255',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        // Actualiza la información del rol
        $role->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Sincronizar permisos
        $role->permissions()->sync($request->permissions ?? []);

        return redirect()->route('roles.index')
                         ->with('success', 'Rol actualizado correctamente.');
    }

    /**
     * Eliminar un rol de la base de datos.
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        try {
            // Evitar eliminar rol si tiene usuarios asociados
            if ($role->users()->exists()) {
                return redirect()->route('roles.index')
                    ->with('error', 'No se puede eliminar el rol porque está asignado a usuarios.');
            }

            // Desvincular permisos antes de eliminar
            $role->permissions()->detach();
            $role->delete();

            return redirect()->route('roles.index')
                             ->with('success', 'Rol eliminado correctamente.');

        } catch (QueryException $ex) {
            return redirect()->route('roles.index')
                ->with('error', 'Ocurrió un error al eliminar el rol.');
        }
    }
}
