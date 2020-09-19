<?php

use Database\Seeders\DepartmentSeeder;
use Database\Seeders\LecturerSeeder;
use Database\Seeders\StudentSeeder;
use Database\Seeders\UniversitySeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StudentSeeder::class);
        $this->call(LecturerSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(UniversitySeeder::class);
    }
}
