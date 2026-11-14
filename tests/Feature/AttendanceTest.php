<?php

namespace Tests\Feature;

use App\Models\Attendance;
use App\Models\Leave;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AttendanceTest extends TestCase
{
     use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_employee_cannot_check_in_twice(): void
    {
        //Arrange
         $employee = User::factory()->create(['role' => 'team_member']);
        Attendance::create([
            'user_id'  => $employee->id,
            'check_in' => now(),
            // check_out left out, so it is null: an open session
        ]);

        //Act 

        $response = $this->actingAs($employee )->post('/attendance/check-in');
        // Assert
         $response->assertStatus(302);
        $response->assertSessionHas('error');
        $this->assertDatabaseCount('attendances', 1);
    }
}
