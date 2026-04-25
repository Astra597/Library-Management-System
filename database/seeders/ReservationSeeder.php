<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $customers = User::where('email', '!=', 'admin@example.com')->get();
        $books = Book::all();

        $reservations = [
            [
                'user_id' => $customers[0]->id,
                'book_id' => $books[12]->id,
                'reserved_date' => now()->subDays(2),
                'status' => 'pending',
            ],
            [
                'user_id' => $customers[2]->id,
                'book_id' => $books[13]->id,
                'reserved_date' => now()->subDays(5),
                'status' => 'pending',
            ],
            [
                'user_id' => $customers[4]->id,
                'book_id' => $books[14]->id,
                'reserved_date' => now()->subDays(10),
                'status' => 'fulfilled',
            ],
            [
                'user_id' => $customers[6]->id,
                'book_id' => $books[0]->id,
                'reserved_date' => now()->subDays(7),
                'status' => 'cancelled',
            ],
            [
                'user_id' => $customers[8]->id,
                'book_id' => $books[3]->id,
                'reserved_date' => now()->subDays(1),
                'status' => 'pending',
            ],
            [
                'user_id' => $customers[1]->id,
                'book_id' => $books[9]->id,
                'reserved_date' => now()->subDays(12),
                'status' => 'fulfilled',
            ],
            [
                'user_id' => $customers[3]->id,
                'book_id' => $books[6]->id,
                'reserved_date' => now()->subDays(3),
                'status' => 'pending',
            ],
            [
                'user_id' => $customers[5]->id,
                'book_id' => $books[2]->id,
                'reserved_date' => now()->subDays(15),
                'status' => 'cancelled',
            ],
        ];

        foreach ($reservations as $reservation) {
            Reservation::create($reservation);
        }
    }
}