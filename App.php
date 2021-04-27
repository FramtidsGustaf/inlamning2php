<?php

class App
{
  private $products;
  private $show;
  private $category;
  private $array = [];
  private $errors = [];

  public function __construct($products)
  {
    $this->products = $products;
    $this->show = $this->query('show');
    $this->category = $this->query('category');
  }

  private function query($query)
  {
    return isset($_GET[$query]) ? htmlspecialchars($_GET[$query]) : false;
  }

  private function validate_show()
  {
    if ($this->show && (!is_numeric($this->show) || $this->show < 1 || $this->show > 20)) {
      $this->show = false;
      $this->errors[] = array('Show' => 'Show must be between 1 and 20');
    }
  }

  private function validate_category()
  {
    if (
      $this->category &&
      !(in_array($this->category, [
        'mens clothing',
        'jewelery',
        'electronics',
        'womens clothing'
      ]))
    ) {
      $this->category = false;
      $this->errors = array('Category' => 'Category not found');
    }
  }

  private function filter_desired_category()
  {
    if ($this->category) {
      foreach ($this->products as $product) {
        if ($product['category'] === $this->category) $this->array[] = $product;
      }
    }
  }

  private function filter_desired_amount()
  {
    if ($this->show) {
      if (!$this->array) $this->array = $this->products;
      shuffle($this->array);
      array_splice($this->array, $this->show);
    }
  }

  private function unfiltered()
  {
    if (!$this->show && !$this->category) $this->array = $this->products;
  }

  private function responde($content)
  {
    echo json_encode($content, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
  }

  public function main()
  {
    $this->validate_show();
    $this->validate_category();
    $this->filter_desired_category();
    $this->filter_desired_amount();
    $this->unfiltered();
    if ($this->errors) $this->responde($this->errors);
    else $this->responde($this->array);
  }
}
