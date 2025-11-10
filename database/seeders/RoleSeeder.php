<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'Administrador', 'description' => 'Acceso total al sistema. Gestiona usuarios, roles, horarios y citas.'],
            ['name' => 'Recepcionista', 'description' => 'Gestiona usuarios, agendas y citas.'],
            ['name' => 'Médico', 'description' => 'Consulta su agenda, atiende pacientes y marca citas como atendidas.'],
            ['name' => 'Paciente', 'description' => 'Gestiona su perfil y citas personales.'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
