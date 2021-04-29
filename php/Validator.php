<?php

/**
 * A collection of validating methods.
 */
class Validator
{

  private static $categories = [
    'mens clothing',
    'jewelery',
    'electronics',
    'womens clothing'
  ];

  /**
   * Takes a string, if the string is nog valid an Exception is thrown.
   */
  public static function validate_category($category)
  {
    if ($category && !in_array($category, self::$categories))
      throw new Exception('Category not found.');
  }

  /**
   * Checks if the parameter is a valid number. If not an Exception is thrown.
   */
  public static function validate_show($show)
  {
    if (isset($show) && $show !== false && (!is_numeric($show) || $show < 1 || $show > 20))
      throw new Exception('Show must be a number between 1 and 20.');
  }
}
