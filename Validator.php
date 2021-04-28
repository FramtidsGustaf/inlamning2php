<?php

class Validator
{

  private static $categories = [
    'mens clothing',
    'jewelery',
    'electronics',
    'womens clothing'
  ];

  public static function validate_category($category)
  {
    if ($category && !in_array($category, self::$categories))
      throw new Exception('Category not found.');
  }

  public static function validate_show($show)
  {
    if ($show && (!is_numeric($show) || $show < 1 || $show > 20))
      throw new Exception('Show must be between 1 and 20.');
  }
}
