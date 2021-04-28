<?php
//TODO Comment!
include_once "Validator.php";
include_once "Products.php";
class App
{

  private static $errors = [];

  public static function main()
  {
    $show = self::query('show');
    $category = self::query('category');

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

    if (!self::$errors) {
      $products = new Products($show, $category);
      self::responde($products->get_products());
    } else self::responde(self::$errors);
  }

  private static function query($query)
  {
    return isset($_GET[$query]) ? filter_var($_GET[$query], FILTER_SANITIZE_STRING) : false;
  }

  private static function responde($content)
  {
    echo json_encode($content, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
  }
}
