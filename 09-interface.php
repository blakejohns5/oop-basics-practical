<?php


// add interface libraryService
interface libraryService
{
  public function openConnection();
  public function verifyService();
  public function login($username, $password);
  public function logout();
}

const LIBRARY_SYSTEM = "Public Library System";

// add class that implements interface libraryService
class Connection implements libraryService
{
   // set variables for one of the implemented methods
   private $username;
   private $password;  
   private bool $conn = false;

   // implemented method
  public function openConnection()
  {
    $this->conn = true;
    return 'Opening connection to ' . LIBRARY_SYSTEM;
  }

  // implemented method
  public function verifyService()
  {
    if ($this->conn == true) {
      return 'Service verified'; 
    } else {
      return 'Unable to locate service';
    }
  }
// implemented method
  public function login($username, $password)
  {
    $this->username = $username;
    $this->password = $password;
    return "You are now logged in as $this->username.";
  }
// implemented method
  public function logout()
  {
    $this->username = null;
    $this->password = null;
    return "You are now logged out.";
  }

  public static function searchLibrary(string $isbn)
  {
    return "Searching local library service for $isbn.";
  }

  public function __construct() 
  {
    // construct to call openConnection() from inside class;
    echo self::openConnection();
  }
}



abstract class Books
{
  public string $title;
  public string $authorName;
  public string $genre;
  abstract public function getBookInfo();
  abstract protected function getISBN();  
}

class Book extends Books
{
  
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

  // add setter to make sure isbn is available to library service
  public function setISBN(string $isbn)
  {
    $this->isbn = $isbn;
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

class Collection extends Book
{
  public static int $noVolumes;
  private string $cost;  
  public int $noPages = 0;

  public static function createCollection() 
  {
    return "Collection has been created with " . SELF::$noVolumes . " volumes.\n";
  }
  
  public function getBookInfo ()
  {
    $this->genre = strtolower($this->genre);
    return "This $this->genre collection is a " . SELF::$noVolumes . "-volume edition of $this->title.";
  }

  public function __construct($genre, $authorName, $title, $isbn, $noVolumes)
  {    
    parent::__construct($genre, $authorName, $title);
    $this->isbn = $isbn;
    // override original value of $authorName
    $this->authorName = 'one or more authors';
    SELF::$noVolumes = $noVolumes;

    echo SELF::createCollection();
  }
  
  public function setVolumes ($noVolumes) 
  {
    $this->noVolumes = $noVolumes;
  }

  public function getVolumes () {
    return $this->noVolumes;
  }

  public function showCost() 
  {
    return $this->cost;
  }
}


// INSTANTIATE book obj
$book001 = new Book('Non-fiction', 'Bill Bryson', 'A Short History of Nearly Everything');

// set isbn to access for library service search
$book001->setISBN('076790818X');
print_r($book001);
echo $bookISBN = $book001->getISBN();

echo "\n";
// not in construct, openConnection is called, making connection ready for verifyService()
$newConnection = new Connection();
echo "\n";

// verify connection to service
echo $newConnection->verifyService();
echo "\n";

// login
echo $newConnection->login('user', 'user12345');
echo "\n";

// search for book isbn
echo $newConnection->searchLibrary($bookISBN);
echo "\n";

// log out
echo $newConnection->logout();
echo "\n";
