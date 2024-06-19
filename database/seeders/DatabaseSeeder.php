<?php

namespace Database\Seeders;

use App\Models\Profesor;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@a',
            'password' => bcrypt('123')
        ]);

        Profesor::create([
            'nombre' => 'Profesor Test',
            'cod' => 'TST',
            'email' => 'test@email',
            'especialidad' => 'PES',
            'departamento' => 'Informática'
        ]);

        $this->call([
            SubjectSeeder::class,
            CourseSeeder::class,
            PositionSeeder::class
        ]);
    }
}
