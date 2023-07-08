<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create('id_ID');

        $NonFiction = $faker->numerify('NF###');
        $Fiction = $faker->numerify('F###');
        $Romance = $faker->numerify('R###');
        $Horror = $faker->numerify('H###');
        $Thriller = $faker->numerify('T###');

        return [
            'kode_buku' => $faker->randomElement([$Fiction, $Horror, $NonFiction, $Romance, $Thriller]),
            'judul' => $faker->sentence(mt_rand(1,4)),
            'penulis' => $faker->name(),
            'penerbit' => $faker->randomElement(['Gramedia', 'Deepublish', 'Erlangga', 'Republika']),
            'tahun_terbit' => $faker->year(),
        ];
    }
}
