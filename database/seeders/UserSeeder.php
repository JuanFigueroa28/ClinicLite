<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::where('name', 'Administrador')->first();
        $recepcionista = Role::where('name', 'Recepcionista')->first();
        $medico = Role::where('name', 'Médico')->first();
        $paciente = Role::where('name', 'Paciente')->first();

        User::create([
            'first_name' => 'Juan',
            'last_name' => 'Administrador',
            'document' => '100000001',
            'email' => 'admin@cliniclite.com',
            'password' => Hash::make('admin123'),
            'role_id' => $admin->id,
        ]);

        User::create([
            'first_name' => 'Laura',
            'last_name' => 'Recepcionista',
            'document' => '100000002',
            'email' => 'recepcion@cliniclite.com',
            'password' => Hash::make('recepcion123'),
            'role_id' => $recepcionista->id,
        ]);

        User::create([
            'first_name' => 'Carlos',
            'last_name' => 'Médico',
            'document' => '100000003',
            'email' => 'medico@cliniclite.com',
            'password' => Hash::make('medico123'),
            'role_id' => $medico->id,
        ]);

        User::create([
            'first_name' => 'María',
            'last_name' => 'Paciente',
            'document' => '100000004',
            'email' => 'paciente@cliniclite.com',
            'password' => Hash::make('paciente123'),
            'role_id' => $paciente->id,
        ]);
    }
}
