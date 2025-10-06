<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roles;

class RolesController extends Controller
{
    /**
     * Muestra la lista de roles disponibles.
     */
    public function index()
    {
        // Obtener todos los roles existentes
        $roles = Roles::all();

        // Enviar los roles a la vista
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Muestra el formulario para crear un nuevo rol.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Guarda un nuevo rol en la base de datos.
     */
    public function store(Request $request)
    {
        // Validación de campos
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:100'
        ]);

        // Crear el nuevo rol
        Roles::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Redirigir al listado con mensaje de éxito
        return redirect()->route('roles.index')->with('success', 'Rol creado correctamente.');
    }

    /**
     * Muestra el formulario de edición para un rol específico.
     */
    public function edit($id)
    {
        $rol = Roles::findOrFail($id);
        return view('admin.roles.edit', compact('rol'));
    }

    /**
     * Actualiza los datos del rol seleccionado.
     */
    public function update(Request $request, $id)
    {
        $rol = Roles::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        $rol->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('roles.index')->with('success', 'Rol actualizado correctamente.');
    }

    /**
     * Elimina un rol de la base de datos.
     */
    public function destroy($id)
    {
        $rol = Roles::findOrFail($id);
        $rol->delete();

        return redirect()->route('roles.index')->with('success', 'Rol eliminado correctamente.');
    }
}
