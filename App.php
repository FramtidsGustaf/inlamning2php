<?php

include_once "Validator.php";
include_once "Products.php";

class App
{

  private static $show;
  private static $category;
  private static $products;
  private static $errors = [];

  public static function main()
  {
    self::$show = self::query('show');
    self::$category = self::query('category');
    self::$products = new Products(self::$show, self::$category);

    try {
      Validator::validate_show(self::$show);
    } catch (Exception $e) {
      self::$show = false;
      self::$errors[] = array("Show" => $e->getMessage());
    }

    try {
      Validator::validate_category(self::$category);
    } catch (Exception $e) {
      self::$category = false;
      self::$errors[] = array("Category" => $e->getMessage());
    }

    if (self::$errors) {
      self::responde(self::$errors);
    } else self::responde(self::$products->get_products());
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
