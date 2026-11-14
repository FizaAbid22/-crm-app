<?php

namespace Tests\Feature;

use App\Models\Deal;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DealTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_emp_can_not_delete_deal(): void
    {
        //Aarrange

        $employee = User::factory()->create(['role' => 'team_member']);
         $deal = Deal::factory()->create();


        $response = $this->actingAs($employee)->delete('/deals/' . $deal->id);

         $response->assertStatus(403);
         $this->assertDatabaseHas('deals', ['id' => $deal->id]);
    }


    public function test_admin_can_delete_deal(): void
    {
        //Aarrange

        $admin = User::factory()->create(['role' => 'admin']);
         $deal = Deal::factory()->create();


        $response = $this->actingAs( $admin)->delete('/deals/' . $deal->id);

         $response->assertStatus(302);
$this->assertSoftDeleted('deals', ['id' => $deal->id]);
    }
}
