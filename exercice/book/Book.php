<?php

// Class with design pattern Singleton
class Book
{
    private ?Book $uniqueBook = null; // To check if the class has already been instantiated
    private string $title;

    /*
     * Private constructor that can only be instantiated by the class itself
     * The getInstance method will be used instead
     */
    private function __construct()
    {
    }

    public function printTitle()
    {
        echo $this->title;
    }

    /**
     * Ensure that only one instance of the Book class is created.
     * @return Book The unique instance of the Book class
     */
    public static function getInstance()
    {
        if (self::$uniqueBook == null) {
            self::$uniqueBook = new Book();
        }
        return self::$uniqueBook;
    }

    // Getters

    public function getTitle()
    {
        return $this->title;
    }

    // Setters

    public function setTitle($title)
    {
        $this->title = $title;
    }
}

// Singleton tests
$book1 = Book::getInstance();
$book1->setTitle("Premier titre");
echo $book1->getTitle();

$book2 = Book::getInstance();
$book2->setTitle("Deuxième titre");
echo $book2->getTitle();

echo $book1->getTitle();
