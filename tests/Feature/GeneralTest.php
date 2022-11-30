<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GeneralTest extends TestCase
{
    
    // Testing Read data
    public function test_list_all_residues()
    {
        $response = $this->get('/api/residues');
        $response->assertStatus(200);
    }


    public function testPUT()
    {
        $this->json('PUT', 'api/edit-residue/1', ['Accept' => 'application/json'])
            ->assertStatus(404)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "common_name" => ["The name field is required."],
                ]
            ]);
    }


    // Testing editing data
    public function testDELETE()
    {
        $this->json('DELETE', 'api/delete-residue/1', ['Accept' => 'application/json'])
            ->assertStatus(404)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => "No residue found"
            ]);

    }

}
