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

  public function __construct($genre, $authorName, $title) 
  {
    $this->genre = $genre;
    $this->authorName =$authorName;
    $this->title = $title;

    echo "CONSTRUCTOR created " . $this->title . " by " . $this->authorName . " in " . strtolower($this->genre) . " genre.\n";
  }

  function __destruct() 
  {
    echo "DESTRUCTOR destroyed object: $this->title.";
  }
}

//
// INHERITANCE
//

// extend Book class to Collection class
class Collection extends Book
{
}

echo "\n";
$encyclopedia = new Collection('Reference', 'Encyclopedia Britannica', 2014);
print_r($encyclopedia);

