<?php

namespace Tests\Feature\API;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class FrontStoreControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_should_get_all_products_to_populate_home_store(): void
    {

        Product::factory()->count(10)->create();

        $response = $this->get('/api/home');
        //        $response->dd();
        $response->assertStatus(200);

        $response->assertJson(fn(AssertableJson $json) =>
        $json->where('0.id', 10)
            ->where('9.id', 1)
            ->count(10)->etc());
    }
}
