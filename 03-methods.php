<?php

class Book
{
  public string $title;
  public string $authorName;
  public string $genre;
  public int $yearPublished;
  public int $noPages;
  private float $bookRating;  
  protected string $isbn;

  // report basic info on book obj
  public function getBookInfo ()
  {
    $this->genre = strtolower($this->genre);
    return "This $this->genre title, $this->title, was published by $this->authorName in $this->yearPublished.";
  }

  // set rating as float out of 5
  public function setRating(float $ratingOutOf5) 
  {
    $this->bookRating = $ratingOutOf5;
  }

  // get private property $bookRating
  public function getRating()
  {
    return "GETTER retrieves Rating: $this->bookRating";
  }

  // get protected string $isbn
  public function getISBN() 
  {
    return $this->isbn;
  }
}


$book001 = new Book();
$book001->title = 'A Short History of Nearly Everything';
$book001->authorName = 'Bill Bryson';
$book001->genre = 'Non-fiction';
$book001->yearPublished = 2003;
$book001->noPages = 544;

// Set value for book rating and isbn
$book001->setRating(4.5);

// View output for METHODS
echo $book001->getBookInfo();
echo "\n";
echo $book001->getRating();


