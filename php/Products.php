<?php

/**
 * Gets the products. Filter out what's undesired and returns what's desired.
 */
class Products
{

  private $products;
  private $show;
  private $category;
  private $desiredProducts = [];

  public function __construct($show, $category)
  {
    $this->products = json_decode(file_get_contents('products.json'), true);
    $this->show = $show;
    $this->category = $category;
    if ($this->category) $this->get_desired_category();
    if ($this->show) $this->get_desired_amount();
  }

  /**
   * Takes the category used when creating this object and filters out the rest
   */
  private function get_desired_category()
  {
    foreach ($this->products as $product) {
      if ($product['category'] === $this->category) $this->desiredProducts[] = $product;
    }
  }

  /**
   * Takes the amount used when creating this object and filters out the rest
   */
  private function get_desired_amount()
  {
    if (!$this->desiredProducts) $this->desiredProducts = $this->products;
    shuffle($this->desiredProducts);
    array_splice($this->desiredProducts, $this->show);
  }

  /**
   * Returns the desired products
   */
  public function get_products()
  {
    return $this->desiredProducts ? $this->desiredProducts : $this->products;
  }
}
