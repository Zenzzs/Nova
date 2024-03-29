<?php

namespace Database\Seeders;

use App\Models\Casa;
use App\Models\Category;
use Database\Factories\CasaFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(RolSeeder::class);
        $this->call(UserSeeder::class);
        if (Category::count()==0){
            $this->call(CategorySeeders::class);
        }
        // $this->call(CasaSeeder::class);


        // DB::table('users')->insert([
        //     'username' => 'admin',
        //     'firstname' => 'Admin',
        //     'lastname' => 'Admin',
        //     'email' => 'admin@argon.com',
        //     'password' => bcrypt('secret')
        // ]);
    }
}
