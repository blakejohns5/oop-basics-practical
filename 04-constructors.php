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

  public function getBookInfo ()
  {
    $this->genre = strtolower($this->genre);
    return "This $this->genre title, $this->title, was published by $this->authorName in $this->yearPublished.";
  }

  public function setRating(float $ratingOutOf5) 
  {
    $this->bookRating = $ratingOutOf5;
  }

  public function getRating()
  {
    return "GETTER retrieves Rating: $this->bookRating";
  }

  public function getISBN() 
  {
    return $this->isbn;
  }

  // runs when object is instantiated
  public function __construct($genre, $authorName, $title) 
  {
    $this->genre = $genre;
    $this->authorName =$authorName;
    $this->title = $title;

    echo "CONSTRUCTOR created " . $this->title . " by " . $this->authorName . " in " . strtolower($this->genre) . " genre.\n";
  }

  // runs when object is destroyed or script is stopped
  function __destruct() 
  {
    echo "DESTRUCTOR destroyed object: $this->title.";
  }
}

$book001 = new Book('Non-fiction', 'Bill Bryson', 'A Short History of Nearly Everything');

// View output for constructor and destructor
print_r($book001);