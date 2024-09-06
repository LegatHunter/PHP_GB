<?php

interface IProduct
{
  public function getPrice(): float;
}
abstract class Product implements IProduct
{
  protected string $name;
  protected float $price;

  public function __construct(string $name, float $price)
  {
    $this->name = $name;
    $this->price = $price;
  }
  public function getPrice(): float
  {
    return $this->price;
  }
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
  public function __construct(string $name, float $price, int $count, string $url)
  {
    parent::__construct($name, $price, $count);
    $this->url = $url;
  }
  protected string $url;
  function getFinalPrice(): float
  {
    return parent::getFinalPrice() * 0.5;
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

$apple = new WeightProduct('Яблоко', 140, 2.5);
echo $apple->getFinalPrice();