<?php

include_once "products.php";

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Referrer-Policy: no-referrer");
$show = isset($_GET['show']) ? htmlspecialchars($_GET['show']) : false;
$category = isset($_GET['category']) ? htmlspecialchars($_GET['category']) : false;
$array = [];
$errors = [];

//validate show
if ($show && (!is_numeric($show) || $show < 1 || $show > 20)) {
  $errors[] = (array("Show" => "Show must be between 1 and 20"));
}

//validate category
if (
  $category &&
  !($category === 'mens clothing' ||
    $category === 'jewelery' ||
    $category === 'electronics' ||
    $category === 'womens clothing')
) {
  $errors[] = (array("Category" => "Category not found"));
}

if ($category) {
  foreach ($products as $product) {
    if ($product['category'] === $category) {
      $array[] = $product;
    }
  }
  if ($show) {
    shuffle($array);
    array_splice($array, $show);
  }
}

if ($show && !$category) {
  $array = $products;
  shuffle($array);
  array_splice($array, $show);
}

if (!$show && !$category) {
  $array = $products;
}

if ($errors) echo json_encode($errors, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
else echo json_encode($array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
