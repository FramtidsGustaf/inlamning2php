<?php

include_once "Validator.php";
include_once "Products.php";

class App
{

  private static $errors = [];

  public static function main()
  {
    $show = self::query('show');
    $category = self::query('category');
    $products = new Products($show, $category);

    try {
      Validator::validate_show($show);
    } catch (Exception $e) {
      self::$errors[] = array("Show" => $e->getMessage());
    }

    try {
      Validator::validate_category($category);
    } catch (Exception $e) {
      self::$errors[] = array("Category" => $e->getMessage());
    }

    if (self::$errors) self::responde(self::$errors);
    else self::responde($products->get_products());
  }

  private static function query($query)
  {
    return isset($_GET[$query]) ? htmlspecialchars($_GET[$query]) : false;
  }

  private static function responde($content)
  {
    echo json_encode($content, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
  }
}
