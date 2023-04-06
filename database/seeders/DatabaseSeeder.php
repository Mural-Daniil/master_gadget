<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Service;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        Role::create([ 'name' => 'super-user']);
        $manager = Role::create([ 'name' => 'manager']);
        Role::create([ 'name' => 'client']);

        $users = User::factory(10)->create();

        foreach($users as $user) {
            $user -> assignRole('client');
        }        

        $user = User::factory()->create([
            'first_name' => 'Мастер',
            'last_name' => 'Гаджет',
            'patronymic' => 'Суперпользователь',
            'email' => 'admin@admin.com',
            'phone_number' => '+79493379748',
            'password' => Hash::make('password'), 
            'date_of_birth' => '2001-05-12',
            'remember_token' => Str::random(10),
        ]);
        $user -> assignRole('super-user');

        $user = User::factory()->create([
            'first_name' => 'Мастер',
            'last_name' => 'Гаджет',
            'patronymic' => 'Менеджер',
            'email' => 'manager@manager.com',
            'phone_number' => '+79493379748',
            'password' => Hash::make('password'), 
            'date_of_birth' => '2001-05-12',
            'remember_token' => Str::random(10),
        ]);
        $user -> assignRole('manager');
        
        Service::create([
            'title' => 'Не включается',
            'category' => 'Телефон',
            'about' => 'Причины, почему телефон не включается: стертое програмное обеспечение, "отвал" процессора, 
            выход из строя памяти или контроллера питания, механическое повреждение, попадание в устройства воды.
            Что делаем: диагностика, после перепрошивка / перекатка процессора и/или флеш-памяти / замена контроллера питания.
            Время ремонта: от 1 часа.',
            'min_price' => '1000',
            'price' => '1000',
        ]);

        Service::create([
            'title' => 'Чистка от пыли ПК и ноутбуков',
            'category' => 'Компьютеры',
            'about' => 'Чистка ноутбуков',
            'min_price' => '1000',
            'price' => '1000',
        ]);

        Permission::create([ 'name' => 'view user']);
        Permission::create([ 'name' => 'create user' ]);
        Permission::create([ 'name' => 'update user' ]);
        Permission::create([ 'name' => 'delete user' ]);
        Permission::create([ 'name' => 'view staff' ]);
        Permission::create([ 'name' => 'create staff' ]);
        Permission::create([ 'name' => 'update staff' ]);
        Permission::create([ 'name' => 'delete staff' ]);
        Permission::create([ 'name' => 'view role' ]);
        Permission::create([ 'name' => 'create role' ]);
        Permission::create([ 'name' => 'update role' ]);
        Permission::create([ 'name' => 'delete role' ]);
        Permission::create([ 'name' => 'view permission' ]);
        Permission::create([ 'name' => 'create permission' ]);
        Permission::create([ 'name' => 'update permission' ]);
        Permission::create([ 'name' => 'delete permission' ]);
        Permission::create([ 'name' => 'view service' ]);
        Permission::create([ 'name' => 'create service' ]);
        Permission::create([ 'name' => 'update service' ]);
        Permission::create([ 'name' => 'delete service' ]);

        $manager->givePermissionTo('view user', 'create user','update user', 'delete user');

    }
}
