<?php

use App\Models\Sale;
use App\Models\Product;

test('create new sale', function () {
    $product1 = Product::factory()->create(['price' => 1800]);
    $product2 = Product::factory()->create(['price' => 3200]);

    $sale = Sale::factory()->create();

    $sale->products()->attach($product1, ['amount' => 1]);
    $sale->products()->attach($product2, ['amount' => 2]);

    $savedSale = Sale::with('products')->find($sale->id);

    /* Verifica se a venda foi encontrada no banco de dados */
    expect($savedSale)->not->toBeNull();

    /* Verifica se os produtos estão associados à venda */
    expect($savedSale->products)->toHaveCount(2);
    
    /* Verifica se o produto1 foi cadastro no relacionamento */
    expect($savedSale->products[0]->id)->toBe($product1->id);
    expect($savedSale->products[0]->price)->toBe($product1->price);
    expect($savedSale->products[0]->pivot->amount)->toBe(1);

    /* Verifica se o produto2 foi cadastro no relacionamento */
    expect($savedSale->products[1]->id)->toBe($product2->id);
    expect($savedSale->products[1]->price)->toBe($product2->price);
    expect($savedSale->products[1]->pivot->amount)->toBe(2);
});

test('calculate the total amount of the sale', function () {
    $product1 = Product::factory()->create(['price' => 1800]);
    $product2 = Product::factory()->create(['price' => 3200]);

    $sale = Sale::factory()->create();

    $sale->products()->attach($product1, ['amount' => 1]);
    $sale->products()->attach($product2, ['amount' => 2]);

    $savedSale = Sale::with('products')->find($sale->id);

    /* Verifica se o total da venda foi calculado corretamente */
    expect($savedSale->amount)->toBe(8200.0);
});

test('cancel a sale that does not exist', function () {
    $response = $this->getJson('/api/sales/1');

    $response->assertStatus(404)
        ->assertJson([
            'message' => 'Sale not found.'
        ]);
});

test('cancel a sale that is already canceled', function () {
    $sale = Sale::factory()->create(['status' => 'canceled']);

    $response = $this->deleteJson("/api/sales/{$sale->id}");

    $response->assertStatus(400)
        ->assertJson([
            'message' => 'Sale is already canceled.'
        ]);
});

test('cancel a sale', function () {
    $sale = Sale::factory()->create();

    $this->deleteJson("/api/sales/{$sale->id}");

    expect($sale->refresh()->status)->toBe('canceled');
});