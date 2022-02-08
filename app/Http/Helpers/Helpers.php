<?php

function insertOneProduct($product) {

    $newProductId = Product::InsertGetId(
            [
                'name' => $product->name,
                'price' => $product->price,
                'description' => $product->description,
                'quantity' => $product->quantity,
                'image_url' => $product->image_url
        ]);
    return $newProductId;
}