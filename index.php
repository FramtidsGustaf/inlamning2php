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

function validate_category($category)
{
  return $category === 'mens clothing' ||
    $category === 'jewelery' ||
    $category === 'electronics' ||
    $category === 'womens clothing';
}

if (!is_numeric($show) || $show < 1) {
  http_response_code(400);
  die('Nonono!');
}

if ($show < 20) {
  shuffle($products);
  for ($i = 0; $i < $show; $i++) {
    $array[] = $products[$i];
  }
}

if ($category) {
  if (!validate_category($category)) {
    http_response_code(400);
    die('Nonono!');
  }
  foreach ($products as $product) {
    if ($product['category'] === $category) {
      $array[] = $product;
    }
  }
}

if ($show === 20 && !$category) {
  $array = $products;
}


echo json_encode($array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
