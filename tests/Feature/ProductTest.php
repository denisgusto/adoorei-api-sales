<?php

use App\Models\Product;

test('get list of prodcts', function () {
    $product = Product::factory()->create();

    $this->getJson('/api/products')
        ->assertStatus(200)
        ->assertJson([
            'data' => [
                [
                    'id' => $product->id,
                    'name' => $product->name,
                    'description' => $product->description,
                ]
            ]
        ]);
});

test('get a product', function () {
    $product = Product::factory()->create();

    $this->getJson("/api/products/{$product->id}")
        ->assertStatus(200)
        ->assertJson([
            'data' => [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
            ]
        ]);
});

test('get a product that does not exist', function () {
    $this->getJson('/api/products/1')
        ->assertStatus(404)
        ->assertJson([
            'message' => 'Product not found.'
        ]);
});