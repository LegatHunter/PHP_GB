<?PHP

abstract class AbstractBook {
  public $title;
  public $author;
  public $genre;
  public $year;
  protected $readCount = 0;

  public function __construct(string $title, string $author, string $genre, int $year) {
      $this->title = $title;
      $this->author = $author;
      $this->genre = $genre;
      $this->year = $year;
  }

  public function getDescription() {
      return "{$this->title}, автор: {$this->author}, жанр: {$this->genre}, год выпуска: {$this->year}.";
  }

  public function addRead() {
      $this->readCount++;
  }

  public function getReadCount() {
      return "Эта книга прочитана {$this->readCount} раз(а).";
  }

  abstract public function getAccess();
}

class DigitalBook extends AbstractBook {
  public $downloadLink;

  public function __construct(string $title, string $author, string $genre, int $year, string $downloadLink) {
      parent::__construct($title, $author, $genre, $year);
      $this->downloadLink = $downloadLink;
  }

  public function getAccess() {
      return "Ссылка для скачивания: {$this->downloadLink}";
  }
}

class PhysicalBook extends AbstractBook {
  public $libraryAddress;

  public function __construct(string $title, string $author, string $genre, int $year, string $libraryAddress) {
      parent::__construct($title, $author, $genre, $year);
      $this->libraryAddress = $libraryAddress;
  }

  public function getAccess() {
      return "Эту книгу можно получить в библиотеке по адресу: {$this->libraryAddress}";
  }
}






// class A {
//   public function foo() {
//       static $x = 0;
//       echo ++$x;
//   }
// }

// $a1 = new A();
// $a2 = new A();
// $a1->foo(); // Выведет: 1
// $a2->foo(); // Выведет: 2
// $a1->foo(); // Выведет: 3
// $a2->foo(); // Выведет: 4
// Класс A один, переменная x будет общей для всех экземпляров этого класса


// class A {
//   public function foo() {
//       static $x = 0;
//       echo ++$x;
//   }
// }

// class B extends A {
// }

// $a1 = new A();
// $b1 = new B();
// $a1->foo(); // Выведет: 1
// $b1->foo(); // Выведет: 1
// $a1->foo(); // Выведет: 2
// $b1->foo(); // Выведет: 2
// У класса A и его наследника B будут свои независимые статические переменные x