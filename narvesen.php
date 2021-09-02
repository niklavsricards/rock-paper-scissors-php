<?php

function createProduct(string $name, float $price, int $qty): stdClass {
    $product = new stdClass();
    $product->name = $name;
    $product->price = $price;
    $product->quantity = $qty;
    return $product;
}

$products = [
    1 => createProduct('Orange', 0.5, 5),
    createProduct('Banana', 0.3, 26),
    createProduct('Sandwich', 2, 10),
    createProduct('Hot dog', 2.5, 5),
    createProduct('Burger', 3, 3),
    createProduct('Water', 1, 54),
    createProduct('Coca Cola', 1.25, 30),
];

$customerMoney = (float) readline("Enter your money amount: ");

if (!$customerMoney > 0) {
    echo "You need money to buy something!";
    exit;
}

$customer = new stdClass();
$customer->money = $customerMoney;
$customer->shoppingBasket = [];

function displayAllProducts(array $products): void {
    echo "This is the list of available products and prices: " . PHP_EOL;
    foreach ($products as $key => $product) {
        if ($product->quantity > 0) {
            echo "{$key} | Product: {$product->name} | Price: {$product->price}" . PHP_EOL;
        }
        echo "-----------------" . PHP_EOL;
    }
}

$shopping = true;
$total = 0;

while ($shopping) {
    displayAllProducts($products);

    $selection = (int) readline("Enter which product (number) you want to add to basket: ");

    if (!isset($products[$selection])) {
        echo "Invalid product number";
        exit;
    }

    $quantity = (int) readline("Enter amount: ");

    if ($quantity > $products[$selection]->quantity) {
        echo "Selected too much";
        exit;
    }

    $selectedProduct = clone $products[$selection];
    $selectedProduct->quantity = $quantity;
    $customer->shoppingBasket[] = $selectedProduct;

    $products[$selection]->quantity -= $quantity;

    $input = (int) readline("Do you want to continue shopping (1) or pay (2)? ");
    if ($input === 1) {
        continue;
    } else {
        foreach ($customer->shoppingBasket as $item) {
            (float) $total += $item->price;
        }
        echo "Your total payment is {$total} $" . PHP_EOL;
        echo "Thank you for your purchase!" . PHP_EOL;
        $customer->money -= $total;
        $shopping = false;
    }
}

echo "Money left in your wallet: {$customer->money}";