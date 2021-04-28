<?php

class Products
{

  private $products = [
    array(
      "id" => 1,
      "title" => "Tight Jeans",
      "description" => "Jeans so tight your feet can say goodbye to blood.",
      "image" => "https:\/\/picsum.photos\/500?random=1",
      "price" => 1000,
      "category" => "mens clothing",
    ),
    array(
      "id" => 2,
      "title" => "Kinda Tight T-shirt",
      "description" => "For all the muscle dudes out there!",
      "image" => "https:\/\/picsum.photos\/500?random=2",
      "price" => 240,
      "category" => "mens clothing",
    ),
    array(
      "id" => 3,
      "title" => "Shoes",
      "description" => "Just ordinary shoes.",
      "image" => "https:\/\/picsum.photos\/500?random=3",
      "price" => 500,
      "category" => "mens clothing",
    ),
    array(
      "id" => 4,
      "title" => "Cap",
      "description" => "That five panel cap all hipsters had for a while.",
      "image" => "https:\/\/picsum.photos\/500?random=4",
      "price" => 400,
      "category" => "mens clothing",
    ),
    array(
      "id" => 5,
      "title" => "Shorts",
      "description" => "Shorts so short John McEnroe gets jealous.",
      "image" => "https:\/\/picsum.photos\/500?random=5",
      "price" => 250,
      "category" => "mens clothing",
    ),
    array(
      "id" => 6,
      "title" => "Wedding ring",
      "description" => "Cause if you liked it then you should have put a ring on it.",
      "image" => "https:\/\/picsum.photos\/500?random=6",
      "price" => 100000,
      "category" => "jewelery",
    ),
    array(
      "id" => 7,
      "title" => "Bracelet",
      "description" => "Not real silver but kinda convincing.",
      "image" => "https:\/\/picsum.photos\/500?random=7",
      "price" => 500,
      "category" => "jewelery",
    ),
    array(
      "id" => 8,
      "title" => "Necklace",
      "description" => "Nice and durable but remember to not to climb trees wearing it.",
      "image" => "https:\/\/picsum.photos\/500?random=8",
      "price" => 50,
      "category" => "jewelery",
    ),
    array(
      "id" => 9,
      "title" => "Scull Earrings",
      "description" => "Feel a bit crazy? This is the way to show it.",
      "image" => "https:\/\/picsum.photos\/500?random=9",
      "price" => 50,
      "category" => "jewelery",
    ),
    array(
      "id" => 10,
      "title" => "Tongue Piercing",
      "description" => "As if it's not hard enough to speak as it is.",
      "image" => "https:\/\/picsum.photos\/500?random=10",
      "price" => 700,
      "category" => "jewelery",
    ),
    array(
      "id" => 11,
      "title" => "Time Machine",
      "description" => "Meet a younger you!",
      "image" => "https:\/\/picsum.photos\/500?random=11",
      "price" => 1000000,
      "category" => "electronics",
    ),
    array(
      "id" => 12,
      "title" => "PlayStation 5",
      "description" => "Nah! Just kidding.",
      "image" => "https:\/\/picsum.photos\/500?random=12",
      "price" => 5990,
      "category" => "electronics",
    ),
    array(
      "id" => 13,
      "title" => "Microwave Oven",
      "description" => "Bored from all cold food? Not anymore.",
      "image" => "https:\/\/picsum.photos\/500?random=13",
      "price" => 3000,
      "category" => "electronics",
    ),
    array(
      "id" => 14,
      "title" => "TV",
      "description" => "Now with colors!",
      "image" => "https:\/\/picsum.photos\/500?random=14",
      "price" => 20000,
      "category" => "electronics",
    ),
    array(
      "id" => 15,
      "title" => "Portable Speaker",
      "description" => "Let everyone on the subway know your music preferences.",
      "image" => "https:\/\/picsum.photos\/500?random=15",
      "price" => 900,
      "category" => "electronics",
    ),
    array(
      "id" => 16,
      "title" => "Dress",
      "description" => "Is dots your thing? Then you'll love this dress.",
      "image" => "https:\/\/picsum.photos\/500?random=16",
      "price" => 500,
      "category" => "womens clothing",
    ),
    array(
      "id" => 17,
      "title" => "Jeans",
      "description" => "Some fabric and a ziper. Barely any pockets.",
      "image" => "https:\/\/picsum.photos\/500?random=17",
      "price" => 900,
      "category" => "womens clothing",
    ),
    array(
      "id" => 18,
      "title" => "Purse",
      "description" => "To compensate for the absence of pockets in womens pants.",
      "image" => "https:\/\/picsum.photos\/500?random=18",
      "price" => 3000,
      "category" => "womens clothing",
    ),
    array(
      "id" => 19,
      "title" => "Socks",
      "description" => "Super short socks. They're next to none existing.",
      "image" => "https:\/\/picsum.photos\/500?random=19",
      "price" => 100,
      "category" => "womens clothing",
    ),
    array(
      "id" => 20,
      "title" => "High Heels",
      "description" => "Sore toes and broken ankles.",
      "image" => "https:\/\/picsum.photos\/500?random=20",
      "price" => 2500,
      "category" => "womens clothing",
    ),
  ];

  private $show;
  private $category;
  private $array = [];

  public function __construct($show, $category)
  {
    $this->show = $show;
    $this->category = $category;
    if ($this->category) $this->get_desired_category();
    if ($this->show) $this->get_desired_amount();
  }

  private function get_desired_category()
  {
    foreach ($this->products as $product) {
      if ($product['category'] === $this->category) $this->array[] = $product;
    }
  }

  private function get_desired_amount()
  {
    if (!$this->array) $this->array = $this->products;
    shuffle($this->array);
    array_splice($this->array, $this->show);
  }

  public function get_products()
  {
    return $this->array ? $this->array : $this->products;
  }
}
