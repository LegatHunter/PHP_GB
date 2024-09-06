<?php

class Employee
{
  private $name;
  private $age;
  private $salary;

  public function __construct(string $name, int $age, float $salary)
  {
    $this->name = $name;
    $this->age = $age;
    $this->salary = $salary;
  }
  public function getName(): string
  {
    return $this->name;
  }
  public function setName(string $name): void
  {
    $this->name = $name;
  }
  public function getAge(): int
  {
    return $this->age;
  }
  public function setAge(int $age): void
  {
    $this->age = $age;
  }
  public function getSalary(): float
  {
    return $this->salary;
  }
  public function setSalary(float $salary): void
  {
    $this->salary = $salary;
  }
  public static function getSum(Employee $emp1, Employee $emp2)
  {
    return $emp1->salary + $emp2->salary;
  }
  public function sort(Employee $emp){
    return $this->age > $emp->age ? "{$this->getName()} старше": "{$emp->getName()} старше";
  }
}

$emp1 = new Employee('Олег', 25, 1000);
$emp2 = new Employee('Мария', 26, 2000);
echo Employee::getSum($emp1, $emp2);
echo $emp1->sort($emp2);