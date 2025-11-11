<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class PermissionController extends Controller
{
    /**
     * Mostrar lista de permisos.
     */
    public function index()
    {
        $permissions = Permission::orderBy('name', 'asc')->get();

        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Mostrar formulario para crear un nuevo permiso.
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Guardar un nuevo permiso en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:permissions,name',
            'slug' => 'required|string|max:64|unique:permissions,slug',
        ]);

        Permission::create([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        return redirect()->route('permissions.index')
                         ->with('success', 'Permiso creado correctamente.');
    }

    /**
     * Mostrar el formulario de edición de un permiso.
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);

        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Actualizar los datos de un permiso.
     */
    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100|unique:permissions,name,' . $permission->id,
            'slug' => 'required|string|max:64|unique:permissions,slug,' . $permission->id,
        ]);

        $permission->update([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        return redirect()->route('permissions.index')
                         ->with('success', 'Permiso actualizado correctamente.');
    }

    /**
     * Eliminar un permiso.
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);

        try {
            // Desvincular el permiso de todos los roles antes de eliminarlo
            $permission->roles()->detach();

            $permission->delete();

            return redirect()->route('permissions.index')
                             ->with('success', 'Permiso eliminado correctamente.');

        } catch (QueryException $ex) {
            return redirect()->route('permissions.index')
                             ->with('error', 'No se pudo eliminar el permiso. Es posible que esté en uso.');
        }
    }
}
