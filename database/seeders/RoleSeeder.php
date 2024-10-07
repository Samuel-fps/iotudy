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
        
        // Comments
        Permission::create(['name' => 'comments.index',
                            'description' => 'View comment'])->syncRoles([$admin, $author]);

        Permission::create(['name' => 'comments.destroy',
                            'description' => 'Delete comment'])->syncRoles([$admin, $author]);

        // Users
        Permission::create(['name' => 'users.index',
                            'description' => 'View users'])->assignRole($admin);
        
        Permission::create(['name' => 'users.edit',
                            'description' => 'Edit user'])->assignRole($admin);

        Permission::create(['name' => 'users.destroy',
                            'description' => 'Delete user'])->assignRole($admin);

        // Roles
        Permission::create(['name' => 'roles.index',
                            'description' => 'View roles'])->assignRole($admin);
        
        Permission::create(['name' => 'roles.create',
                            'description' => 'Create roles'])->assignRole($admin);

        Permission::create(['name' => 'roles.edit',
                            'description' => 'Edit roles'])->assignRole($admin);

        Permission::create(['name' => 'roles.destroy',
                            'description' => 'Delete roles'])->assignRole($admin);
    }
}
