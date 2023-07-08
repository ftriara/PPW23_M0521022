<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
use App\Models\Book;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Borrower>
 */
class BorrowerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create('id_ID');
        
        $id = 0;
        $id += $id;

        $userIDs = User::pluck('id')->toArray();
        $userID = $faker->randomElement($userIDs);
        $userId = User::find($userID);

        $bookIDs = Book::pluck('id')->toArray();
        $bookID = $faker->randomElement($bookIDs);
        $bookId = Book::find($bookID);

        $tanggal_pinjam = $faker->dateTimeInInterval('-20 weeks', '-1 weeks');

        $status = $faker->randomElement(['dipinjam', 'diperpanjang', 'terlambat', 'kembali']);

        $kembali = $faker->dateTimeInInterval($tanggal_pinjam, '+7 days');
        
        if($status == 'kembali') {
            $tanggal_kembali = $kembali;
        } else if ($status == 'terlambat') {
            $tanggal_kembali = $faker->dateTimeInInterval($kembali, '+20 days');
        } else {
            $tanggal_kembali = null;
        }

        return [
            'user_id' => $userId,
            'book_id' => $bookId,
            'tanggal_pinjam' => $tanggal_pinjam,
            'tanggal_kembali' => $tanggal_kembali,
            'status' => $status
        ];
    }
}