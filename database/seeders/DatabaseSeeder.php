<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Verificar si ya existen usuarios
        if (User::count() > 0) {
            $this->command->info('⚠️  Los usuarios ya existen. Omitiendo seeder...');
            return;
        }

        // Crear usuario Administrador
        User::create([
            'full_name' => 'Administrador del Sistema',
            'username' => 'admin',
            'password' => Hash::make('123'),
            'role' => 'admin',
        ]);

        $this->command->info('✅ Usuario Admin creado: admin / 123');

        // Crear usuario Empleado de prueba
        User::create([
            'full_name' => 'Juan Pérez',
            'username' => 'juan',
            'password' => Hash::make('123'),
            'role' => 'employee',
        ]);

        $this->command->info('✅ Usuario Empleado creado: juan / 123');

        // Crear otro empleado
        User::create([
            'full_name' => 'María García',
            'username' => 'maria',
            'password' => Hash::make('123'),
            'role' => 'employee',
        ]);

        $this->command->info('✅ Usuario Empleado creado: maria / 123');

        $this->command->info('');
        $this->command->info('🎉 ¡Seeders ejecutados correctamente!');
        $this->command->info('');
        $this->command->info('Credenciales de acceso:');
        $this->command->info('━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->command->info('👤 Admin:    admin / 123');
        $this->command->info('👤 Empleado: juan / 123');
        $this->command->info('👤 Empleado: maria / 123');
        $this->command->info('━━━━━━━━━━━━━━━━━━━━━━━━━━');
    }
}
