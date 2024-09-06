<?php
abstract class Product
{
  protected string $name;
  protected float $price;

  public function __construct(string $name, float $price)
  {
    $this->name = $name;
    $this->price = $price;
  }
  abstract function getFinalPrice(): float;
}

class RealProduct extends Product
{
  protected int $count;

  public function __construct(string $name, float $price, int $count)
  {
    $this->count = $count;
    parent::__construct($name, $price);
  }


  function getFinalPrice(): float
  {
    return $this->count * $this->price;
  }
}

class DigitalProduct extends RealProduct
{
  function getFinalPrice(): float
  {
    return $this->count * $this->price * 0.5;
  }
}

class WeightProduct extends Product
{
  protected float $weight;
  public function __construct(string $name, float $price, float $weight)
  {
    parent::__construct($name, $price);
    $this->weight = $weight;
  }
  function getFinalPrice(): float
  {
    return $this->weight * $this->price;
  }
}