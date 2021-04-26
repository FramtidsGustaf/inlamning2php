<?php

include_once "products.php";

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Referrer-Policy: no-referrer");
$show = isset($_GET['show']) ? htmlspecialchars($_GET['show']) : 20;
$category = isset($_GET['category']) ? htmlspecialchars($_GET['category']) : false;

function http_code_and_die()
{
  http_response_code(400);
  die('Nonono!');
}

if (!is_numeric($show) || $show < 1) {
  http_code_and_die();
}

if ($show < 20) {
  shuffle($products);
  for ($i = 0; $i < $show; $i++) {
    $array[] = $products[$i];
  }
}

if ($show > 20) {
  http_code_and_die();
}

if ($category) {
  if (
    !($category === 'mens clothing' ||
      $category === 'jewelery' ||
      $category === 'electronics' ||
      $category === 'womens clothing')
  ) {
    http_code_and_die();
  }
  foreach ($products as $product) {
    if ($product['category'] === $category) {
      $array[] = $product;
    }
  }
}

if ($show == 20 && !$category) {
  $array = $products;
}


echo json_encode($array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
