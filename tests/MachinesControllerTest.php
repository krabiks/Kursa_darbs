<?php

namespace Tests\Feature;

use App\Models\Machine;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MachinesControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Pārbauda vai var izveidot mašīnu.
     */
    public function test_can_create_machine()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);

        $response = $this->post(route('machines.store'), [
            'chasis_nr' => 'CH12345',
            'model' => 'TX100',
            'firm' => 'John Deere',
            'motor_hours' => 1000,
        ]);

        $response->assertRedirect(route('machines.index'));
        $this->assertDatabaseHas('machines', [
            'chasis_nr' => 'CH12345',
            'model' => 'TX100',
            'firm' => 'John Deere',
            'motor_hours' => 1000,
        ]);
    }

    /**
     * Pārbauda vai var rediģēt mašīnu.
     */
    public function test_can_edit_machine()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);

        $machine = Machine::factory()->create([
            'chasis_nr' => 'CH12345',
            'model' => 'TX100',
            'firm' => 'John Deere',
            'motor_hours' => 1000,
        ]);

        $response = $this->put(route('machines.update', $machine->id), [
            'chasis_nr' => 'CH12345',
            'model' => 'TX200',
            'firm' => 'John Deere',
            'motor_hours' => 1500,
        ]);

        $response->assertRedirect(route('machines.index'));
        $this->assertDatabaseHas('machines', [
            'chasis_nr' => 'CH12345',
            'model' => 'TX200',
            'firm' => 'John Deere',
            'motor_hours' => 1500,
        ]);
    }

    /**
     * Pārbauda vai var izdzēst mašīnu.
     */
    public function test_can_delete_machine()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);

        $machine = Machine::factory()->create([
            'chasis_nr' => 'CH12345',
            'model' => 'TX100',
            'firm' => 'John Deere',
            'motor_hours' => 1000,
        ]);

        $response = $this->delete(route('machines.destroy', $machine->id));

        $response->assertRedirect(route('machines.index'));
        $this->assertDatabaseMissing('machines', [
            'id' => $machine->id,
        ]);
    }
}
