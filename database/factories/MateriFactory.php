<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Materi>
 */
class MateriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // user_id tidak perlu di sini karena akan di-override di Seeder
            'judul' => $this->faker->sentence(4),
            'deskripsi' => $this->faker->paragraph(3),
            'link_video' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', // Contoh link video
            'file_pendukung' => null, // Biarkan kosong untuk sekarang
        ];
    }
}