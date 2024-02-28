<?php

use App\Models\Company;

test('get list of companies', function () {
    $company = Company::factory()->create();

    $this->getJson('/api/companies')
        ->assertStatus(200)
        ->assertJson([
            'data' => [
                [
                    'id' => $company->id,
                    'name' => $company->name,
                ]
            ]
        ]);
});

test('get a company', function () {
    $company = Company::factory()->create();

    $this->getJson("/api/companies/{$company->id}")
        ->assertStatus(200)
        ->assertJson([
            'data' => [
                'id' => $company->id,
                'name' => $company->name,
            ]
        ]);
});

test('get a company that does not exist', function () {
    $this->getJson('/api/companies/1')
        ->assertStatus(404)
        ->assertJson([
            'message' => 'Company not found.'
        ]);
});