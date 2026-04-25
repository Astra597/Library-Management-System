<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BorrowingSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $customers = User::where('email', '!=', 'admin@example.com')->get();
        $books = Book::all();

        $borrowings = [
            [
                'user_id' => $customers[0]->id,
                'book_id' => $books[0]->id,
                'borrow_date' => now()->subDays(5),
                'due_date' => now()->addDays(9),
                'return_date' => now()->subDays(2),
                'status' => 'returned',
            ],
            [
                'user_id' => $customers[1]->id,
                'book_id' => $books[2]->id,
                'borrow_date' => now()->subDays(10),
                'due_date' => now()->subDays(1),
                'return_date' => null,
                'status' => 'borrowed',
            ],
            [
                'user_id' => $customers[2]->id,
                'book_id' => $books[3]->id,
                'borrow_date' => now()->subDays(15),
                'due_date' => now()->subDays(8),
                'return_date' => now()->subDays(7),
                'status' => 'returned',
            ],
            [
                'user_id' => $customers[3]->id,
                'book_id' => $books[5]->id,
                'borrow_date' => now()->subDays(20),
                'due_date' => now()->subDays(12),
                'return_date' => now()->subDays(10),
                'status' => 'returned',
            ],
            [
                'user_id' => $customers[4]->id,
                'book_id' => $books[6]->id,
                'borrow_date' => now()->subDays(3),
                'due_date' => now()->addDays(11),
                'return_date' => null,
                'status' => 'borrowed',
            ],
            [
                'user_id' => $customers[5]->id,
                'book_id' => $books[8]->id,
                'borrow_date' => now()->subDays(25),
                'due_date' => now()->subDays(18),
                'return_date' => now()->subDays(16),
                'status' => 'returned',
            ],
            [
                'user_id' => $customers[6]->id,
                'book_id' => $books[9]->id,
                'borrow_date' => now()->subDays(12),
                'due_date' => now()->subDays(3),
                'return_date' => null,
                'status' => 'borrowed',
            ],
            [
                'user_id' => $customers[7]->id,
                'book_id' => $books[10]->id,
                'borrow_date' => now()->subDays(30),
                'due_date' => now()->subDays(23),
                'return_date' => now()->subDays(22),
                'status' => 'returned',
            ],
            [
                'user_id' => $customers[8]->id,
                'book_id' => $books[1]->id,
                'borrow_date' => now()->subDays(8),
                'due_date' => now()->addDays(1),
                'return_date' => null,
                'status' => 'borrowed',
            ],
            [
                'user_id' => $customers[9]->id,
                'book_id' => $books[4]->id,
                'borrow_date' => now()->subDays(18),
                'due_date' => now()->subDays(11),
                'return_date' => now()->subDays(9),
                'status' => 'returned',
            ],
            [
                'user_id' => $customers[0]->id,
                'book_id' => $books[7]->id,
                'borrow_date' => now()->subDays(14),
                'due_date' => now()->subDays(5),
                'return_date' => null,
                'status' => 'borrowed',
            ],
            [
                'user_id' => $customers[1]->id,
                'book_id' => $books[11]->id,
                'borrow_date' => now()->subDays(7),
                'due_date' => now()->addDays(7),
                'return_date' => null,
                'status' => 'borrowed',
            ],
        ];

        foreach ($borrowings as $borrowing) {
            Borrowing::create($borrowing);
        }
    }
}