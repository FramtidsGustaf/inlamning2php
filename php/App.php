<?php

include_once "php/Validator.php";
include_once "php/Products.php";

/**
 * The spider in the web
 */
class App
{

  private static $errors = [];

  /**
   * The entrypoint to the app. Everything starts here.
   */
  public static function main()
  {
    $show = self::query('show');
    $category = self::query('category');

    //validating the show variable
    try {
      Validator::validate_show($show);
    } catch (Exception $e) {
      self::$errors[] = array("Show" => $e->getMessage());
    }

    //validating the category variable
    try {
      Validator::validate_category($category);
    } catch (Exception $e) {
      self::$errors[] = array("Category" => $e->getMessage());
    }

    //respondes to the user
    if (!self::$errors) {
      $products = new Products($show, $category);
      self::responde($products->get_products());
    } else self::responde(self::$errors);
  }

  /**
   * Takes a string and checks if the string is a key in the $_GET array. 
   * If so, a sanitized version of that keys value is returned.
   */
  private static function query($query)
  {
    return isset($_GET[$query]) ? filter_var($_GET[$query], FILTER_SANITIZE_STRING) : false;
  }

  /**
   * Takes something and converts it to json then sends it to the user.
   */
  private static function responde($content)
  {
    echo json_encode($content, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
  }
}
