<?php

use Illuminate\Database\Seeder;

class SecurityTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Roles')->insert([
			'name'        => 'DL Desarrollo Aplicaciones Web',
			'description' => 'Super administrador'
        ]);

        DB::table('Permissions')->insert([
			'name'        => 'superadmin',
			'description' => 'Super administración'
        ]);

        DB::table('Permissions_Roles')->insert([
			'FK_IDPermissions' => 1,
			'FK_IDRoles'       => 1
        ]);

        /**
         * Creación de permisos por defecto de la aplicación
         */
        DB::table('Permissions')->insert([
            'name'        => 'support',
            'description' => 'Ver logs y verificar disponibilidad'
        ]);

        DB::table('Permissions')->insert([
            'name'        => 'manage_access',
            'description' => 'Crear roles y otorgar permisos'
        ]);

        DB::table('Permissions')->insert([
            'name'        => 'audit',
            'description' => 'Consultar módulo de auditoría'
        ]);

        DB::table('Permissions')->insert([
            'name'        => 'manage_settings',
            'description' => 'Crear y editar variables de configuración en el sistema'
        ]);

    }
}
