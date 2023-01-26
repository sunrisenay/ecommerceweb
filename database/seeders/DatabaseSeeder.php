<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Foreach_;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        User::create([
            'name'=>"Mg Mg",
            'email'=>"mgmg@a.com",
            'password'=>Hash::make('password'),
            'image'=>'user1.png',
        ]);

        User::create([
            'name'=>"Aye Aye",
            'email'=>"ayeaye@a.com",
            'password'=>Hash::make('password'),
            'image'=>'user2.png',
        ]);

        Supplier::create([
            'name'=>"Mg Mg",
            'phone'=>"09421143",
            'image'=> "supplier.png",
        ]);

        Admin::create([
            'email'=>"admin@gmail.com",
            'password'=>Hash::make('password'),
        ]);

        $category = [
            ['slug'=>'electronic', 'name'=>"Electronic", 'image'=> "category1.png"],
            ['slug'=>'t_shirt', 'name'=>"T-Shirt", 'image'=> "category2.png"],
            ['slug'=>'hat', 'name'=>"Hat", 'image'=> "category3.png"],
            ['slug'=>'mobile_phone', 'name'=>"Mobile Phone", 'image'=> "category4.png"],
        ];

        foreach ($category as $c)
        {
            Category::create([
                'slug'=>$c['slug'],
                'name'=>$c['name'],
                'image'=>$c['image'],
            ]);
        }

        $brand = [
            ['slug'=>"apple",'name'=>'Apple'],
            ['slug'=>"huawei",'name'=>'Huawei'],
            ['slug'=>"google",'name'=>'Google'],
            ['slug'=>"samsung",'name'=>'Samsung'],
        ];

        foreach($brand as $b)
        {
            Brand::create([
                'slug'=>$b['slug'],
                'name'=>$b['name'],
            ]);
        }



    }
}
