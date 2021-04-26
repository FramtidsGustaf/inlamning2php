<?php

include_once "products.php";

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Referrer-Policy: no-referrer");
$show = isset($_GET['show']) ? htmlspecialchars($_GET['show']) : 20;
$category = isset($_GET['category']) ? htmlspecialchars($_GET['category']) : false;
$array = [];
$errors = [];

//validate show
if (!is_numeric($show) || $show < 1 || $show > 20) {
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

if ($category && $show <= 20) {
  foreach ($products as $product) {
    if ($product['category'] === $category) {
      $firstArray[] = $product;
    }
  }
  if ($show < 20) {
    shuffle($firstArray);
    for ($i = 0; $i < $show; $i++) {
      $array[] = $firstArray[$i];
    }
  } else {
    $array[] = $firstArray;
  }
}

if ($show < 20 && !$category) {
  shuffle($products);
  for ($i = 0; $i < $show; $i++) {
    $array[] = $products[$i];
  }
}

if ($show == 20 && !$category) {
  $array = $products;
}

if ($errors) echo json_encode($errors, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
else echo json_encode($array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
