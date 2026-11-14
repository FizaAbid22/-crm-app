<?php

namespace Tests\Feature;

use App\Models\Leave;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LeaveTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_employee_cannot_edit_someone_elses_leave(): void
    {
         
      $owner = User::factory()->create(['role' =>'team_member']);
      $other = User::factory()->create(['role' => 'team_member']);

      $leave = Leave::create([
            'user_id'    => $owner->id,
            'start_date' => '2026-11-10',
            'end_date'   => '2026-11-12',
            'reason'     => 'Family event',
            'status'     => 'pending',
        ]);


        //Act
        $response = $this->actingAs($other)->put('/leave/' . $leave->id, [
            'start_date' => '2026-12-01',
            'end_date'   => '2026-12-03',
            'reason'     => 'Hacked reason',
        ]);

        //Assert

        $response->assertStatus(403);

        $this->assertDatabaseHas('leaves', [
            'id'     => $leave->id,
            'reason' => 'Family event',
        ]);
    }
    public function test_employee_cannot_edit_an_approved_leave(): void
    {
        //Arrange
        $owner = User:: factory()->create(['role'=>'team_memeber']);
        $leave = Leave::create([
            'user_id'    => $owner->id,
            'start_date' => '2026-11-10',
            'end_date'   => '2026-11-12',
            'reason'     => 'Family event',
            'status'     => 'approved',
        ]);

        //Act
            $response = $this->actingAs($owner)->put('/leave/' . $leave->id, [
            'start_date' => '2026-12-01',
            'end_date'   => '2026-12-03',
            'reason'     => 'Hacked reason',
        ]);
        //Assert

        $response->assertStatus(403);

        $this->assertDatabaseHas('leaves', [
            'id'     => $leave->id,
            'reason' => 'Family event',
        ]);
    } 

}
