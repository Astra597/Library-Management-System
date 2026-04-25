<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $fiction = Category::where('slug', 'fiction')->first();
        $mystery = Category::where('slug', 'mystery-crime')->first();
        $scifi = Category::where('slug', 'science-fiction')->first();
        $fantasy = Category::where('slug', 'fantasy')->first();
        $romance = Category::where('slug', 'romance')->first();
        $selfhelp = Category::where('slug', 'self-help')->first();
        $business = Category::where('slug', 'business-finance')->first();
        $history = Category::where('slug', 'history')->first();
        $science = Category::where('slug', 'science')->first();

        $books = [
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'isbn' => '978-0743273565',
                'publisher' => 'Scribner',
                'publish_year' => 1925,
                'category_id' => $fiction?->id,
                'quantity' => 5,
                'available_quantity' => 3,
                'description' => 'A story of decadence and excess.',
            ],
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'isbn' => '978-0061120084',
                'publisher' => 'Harper Perennial',
                'publish_year' => 1960,
                'category_id' => $fiction?->id,
                'quantity' => 4,
                'available_quantity' => 2,
                'description' => 'A gripping tale of racial injustice.',
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'isbn' => '978-0451524935',
                'publisher' => 'Signet Classic',
                'publish_year' => 1949,
                'category_id' => $scifi?->id,
                'quantity' => 6,
                'available_quantity' => 4,
                'description' => 'A dystopian social science fiction.',
            ],
            [
                'title' => 'The Hobbit',
                'author' => 'J.R.R. Tolkien',
                'isbn' => '978-0547928227',
                'publisher' => 'Mariner Books',
                'publish_year' => 1937,
                'category_id' => $fantasy?->id,
                'quantity' => 3,
                'available_quantity' => 1,
                'description' => 'A fantasy adventure novel.',
            ],
            [
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'isbn' => '978-0141439518',
                'publisher' => 'Penguin Classics',
                'publish_year' => 1813,
                'category_id' => $romance?->id,
                'quantity' => 4,
                'available_quantity' => 4,
                'description' => 'A romantic novel of manners.',
            ],
            [
                'title' => 'The Da Vinci Code',
                'author' => 'Dan Brown',
                'isbn' => '978-0307474278',
                'publisher' => 'Anchor',
                'publish_year' => 2003,
                'category_id' => $mystery?->id,
                'quantity' => 5,
                'available_quantity' => 2,
                'description' => 'A mystery thriller novel.',
            ],
            [
                'title' => 'Atomic Habits',
                'author' => 'James Clear',
                'isbn' => '978-0735211292',
                'publisher' => 'Avery Publishing',
                'publish_year' => 2018,
                'category_id' => $selfhelp?->id,
                'quantity' => 8,
                'available_quantity' => 6,
                'description' => 'An easy way to build good habits.',
            ],
            [
                'title' => 'The Lean Startup',
                'author' => 'Eric Ries',
                'isbn' => '978-0307887894',
                'publisher' => 'Crown Business',
                'publish_year' => 2011,
                'category_id' => $business?->id,
                'quantity' => 3,
                'available_quantity' => 3,
                'description' => 'How entrepreneurs use innovation.',
            ],
            [
                'title' => 'Sapiens',
                'author' => 'Yuval Noah Harari',
                'isbn' => '978-0062316097',
                'publisher' => 'Harper',
                'publish_year' => 2014,
                'category_id' => $history?->id,
                'quantity' => 4,
                'available_quantity' => 2,
                'description' => 'A brief history of humankind.',
            ],
            [
                'title' => 'A Brief History of Time',
                'author' => 'Stephen Hawking',
                'isbn' => '978-0553380163',
                'publisher' => 'Bantam',
                'publish_year' => 1988,
                'category_id' => $science?->id,
                'quantity' => 3,
                'available_quantity' => 3,
                'description' => 'From the Big Bang to black holes.',
            ],
            [
                'title' => 'Harry Potter and the Sorcerer\'s Stone',
                'author' => 'J.K. Rowling',
                'isbn' => '978-0590353427',
                'publisher' => 'Scholastic',
                'publish_year' => 1997,
                'category_id' => $fantasy?->id,
                'quantity' => 7,
                'available_quantity' => 3,
                'description' => 'The first book in the Harry Potter series.',
            ],
            [
                'title' => 'The Catcher in the Rye',
                'author' => 'J.D. Salinger',
                'isbn' => '978-0316769488',
                'publisher' => 'Little, Brown',
                'publish_year' => 1951,
                'category_id' => $fiction?->id,
                'quantity' => 4,
                'available_quantity' => 4,
                'description' => 'A story of teenage angst and alienation.',
            ],
            [
                'title' => 'Dune',
                'author' => 'Frank Herbert',
                'isbn' => '978-0441172719',
                'publisher' => 'Ace',
                'publish_year' => 1965,
                'category_id' => $scifi?->id,
                'quantity' => 3,
                'available_quantity' => 1,
                'description' => 'A science fiction masterpiece.',
            ],
            [
                'title' => 'Gone Girl',
                'author' => 'Gillian Flynn',
                'isbn' => '978-0307588371',
                'publisher' => 'Crown',
                'publish_year' => 2012,
                'category_id' => $mystery?->id,
                'quantity' => 5,
                'available_quantity' => 3,
                'description' => 'A thriller about a missing wife.',
            ],
            [
                'title' => 'Rich Dad Poor Dad',
                'author' => 'Robert Kiyosaki',
                'isbn' => '978-1612680178',
                'publisher' => 'Plata Publishing',
                'publish_year' => 1997,
                'category_id' => $business?->id,
                'quantity' => 6,
                'available_quantity' => 5,
                'description' => 'What the rich teach their kids.',
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}