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
}


$book001 = new Book();

// Set property values
$book001->authorName = 'Bill Bryson';
$book001->genre = 'Non-fiction';
$book001->yearPublished = 2003;
$book001->title = 'A Short History of Nearly Everything';
$book001->noPages = 544;


// View output
print_r($book001);
echo "\n";
var_dump($book001);
echo "\n";

