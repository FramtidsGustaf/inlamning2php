<?php

//products
include_once "products.php";

//headers
include_once "headers.php";


//oop alternative
// include_once 'App.php';

// $app = new App($products);
// $app->main();

//checks for correct query strings
$show = isset($_GET['show']) ? htmlspecialchars($_GET['show']) : false;
$category = isset($_GET['category']) ? htmlspecialchars($_GET['category']) : false;

//arrays to be filled
$array = [];
$errors = [];

//sends content to user
function send($content)
{
  echo json_encode($content, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}

//validate show
if ($show && (!is_numeric($show) || $show < 1 || $show > 20)) {
  $errors[] = (array("Show" => "Show must be between 1 and 20"));
}

//validate category<
if (
  $category &&
  !(in_array($category, [
    'mens clothing',
    'jewelery',
    'electronics',
    'womens clothing'
  ]))
) {
  $errors[] = (array("Category" => "Category not found"));
}

//filter desired category
if ($category) {
  foreach ($products as $product) {
    if ($product['category'] === $category) {
      $array[] = $product;
    }
  }
}

//filter desired amount
if ($show) {
  if (!$array) $array = $products;
  shuffle($array);
  array_splice($array, $show);
}

//without query string
if (!$show && !$category) $array = $products;

//send errors or results
if ($errors) send($errors);
else send($array);
