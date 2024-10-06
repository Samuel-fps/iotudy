<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'Admin']);
        $author = Role::create(['name' => 'Author']);

        Permission::create(['name' => 'admin.index',
                            'description' => 'View dashboard'])->syncRoles([$admin, $author]);
        
        // Categories
        Permission::create(['name' => 'categories.index',
                            'description' => 'View categories'])->syncRoles([$admin, $author]);
        
        Permission::create(['name' => 'categories.create',
                            'description' => 'Create category'])->assignRole($admin);

        Permission::create(['name' => 'categories.edit',
                            'description' => 'Edit category'])->assignRole($admin);

        Permission::create(['name' => 'categories.destroy',
                            'description' => 'Delete category'])->assignRole($admin);

        // Articles
        Permission::create(['name' => 'articles.index',
                            'description' => 'View article'])->syncRoles([$admin, $author]);
        
        Permission::create(['name' => 'articles.create',
                            'description' => 'Create article'])->syncRoles([$admin, $author]);
        
        Permission::create(['name' => 'articles.edit',
                            'description' => 'Edit article'])->syncRoles([$admin, $author]);

        Permission::create(['name' => 'articles.destroy',
                            'description' => 'Delete article'])->syncRoles([$admin, $author]);
        
        // Coments
        Permission::create(['name' => 'comments.index',
                            'description' => 'View comment'])->syncRoles([$admin, $author]);

        Permission::create(['name' => 'comments.destroy',
                            'description' => 'Delete comment'])->syncRoles([$admin, $author]);

    }
}
