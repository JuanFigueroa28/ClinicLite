<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // ===== Accounting =====
            ['name' => 'Iniciar sesión', 'slug' => 'login'],
            ['name' => 'Cerrar sesión', 'slug' => 'logout'],
            ['name' => 'Registrarse (paciente)', 'slug' => 'register-patient'],
            ['name' => 'Ver perfil', 'slug' => 'view-profile'],
            ['name' => 'Actualizar información', 'slug' => 'update-profile'],
            ['name' => 'Recuperar contraseña', 'slug' => 'recover-password'],

            // ===== Roles y permisos =====
            ['name' => 'Ver roles', 'slug' => 'view-roles'],
            ['name' => 'Crear rol', 'slug' => 'create-role'],
            ['name' => 'Actualizar rol', 'slug' => 'edit-role'],
            ['name' => 'Eliminar rol', 'slug' => 'delete-role'],

            // ===== Usuarios =====
            ['name' => 'Ver lista de usuarios', 'slug' => 'view-users'],
            ['name' => 'Crear usuario', 'slug' => 'create-user'],
            ['name' => 'Editar usuario', 'slug' => 'edit-user'],
            ['name' => 'Eliminar usuario', 'slug' => 'delete-user'],

            // ===== Médicos y especialidades =====
            ['name' => 'Ver especialidades y médicos', 'slug' => 'view-specialties'],
            ['name' => 'Crear especialidad', 'slug' => 'create-specialty'],
            ['name' => 'Editar especialidad', 'slug' => 'edit-specialty'],
            ['name' => 'Eliminar especialidad', 'slug' => 'delete-specialty'],

            // ===== Agenda / Horarios =====
            ['name' => 'Ver agendas por médico', 'slug' => 'view-agenda'],
            ['name' => 'Crear o editar horarios del médico', 'slug' => 'manage-schedule'],
            ['name' => 'Eliminar horario', 'slug' => 'delete-schedule'],
            ['name' => 'Ver mi agenda', 'slug' => 'view-my-agenda'],

            // ===== Citas =====
            ['name' => 'Ver lista de citas', 'slug' => 'view-appointments'],
            ['name' => 'Crear cita', 'slug' => 'create-appointment'],
            ['name' => 'Reprogramar o cancelar cita', 'slug' => 'reschedule-appointment'],
            ['name' => 'Ver mis citas', 'slug' => 'view-my-appointments'],
            ['name' => 'Marcar cita atendida o cerrada', 'slug' => 'close-appointment'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // ==== ASIGNACIÓN SEGÚN MATRIZ ====

        $admin = Role::where('name', 'Administrador')->first();
        $recepcionista = Role::where('name', 'Recepcionista')->first();
        $medico = Role::where('name', 'Médico')->first();
        $paciente = Role::where('name', 'Paciente')->first();

        // Admin → todos los permisos
        $admin->permissions()->sync(Permission::pluck('id'));

        // Recepcionista → módulos: usuarios, citas, médicos/especialidades, agenda
        $recepcionista->permissions()->sync(Permission::whereIn('slug', [
            'login', 'logout',
            'view-users', 'create-user', 'edit-user', 'delete-user',
            'view-specialties', 'create-specialty', 'edit-specialty', 'delete-specialty',
            'view-appointments', 'create-appointment', 'reschedule-appointment',
            'view-agenda', 'manage-schedule',
        ])->pluck('id'));

        // Médico → agenda propia, pacientes y citas asignadas
        $medico->permissions()->sync(Permission::whereIn('slug', [
            'logout',
            'view-my-agenda',
            'view-specialties',
            'view-appointments',
            'close-appointment',
            'view-my-appointments',
        ])->pluck('id'));

        // Paciente → perfil, registro y citas personales
        $paciente->permissions()->sync(Permission::whereIn('slug', [
            'login', 'logout', 'register-patient',
            'view-profile', 'update-profile',
            'view-my-appointments', 'create-appointment', 'reschedule-appointment',
        ])->pluck('id'));
    }
}
