<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Livewire\Livewire;
use App\Models\User;
use App\Models\Household as HouseholdModel;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Household;

class HouseholdTest extends TestCase
{

    #use RefreshDatabase;

    public $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create a user and log them in for tests
        $this->user = User::find(4);
        Auth::login($this->user);
    }

    #[Test]
    public function it_renders_the_correct_view()
    {
        $component = Livewire::test(Household::class);

        $component->assertViewIs('livewire.household');
    }

    // #[Test]
    // public function it_deletes_household_entry()
    // {

    //     $household = HouseholdModel::factory()->create(['user_id' => $this->user->id]);

    //     $component = Livewire::test(Household::class);

    //     $component->call('deleteEntry', $household->id);

    //     $this->assertDatabaseMissing('household', ['id' => $household->id]);

    // }

    // #[Test]
    // public function it_submits_carbon_footprint_data_successfully()
    // {
    //     // Step 1: Create and authenticate a user
    //     $user = User::factory()->create();
    //     $this->actingAs($user);

    //     // Step 2: Set up Livewire component
    //     $component = Livewire::test('App\Livewire\Household');

    //     // Step 3: Set the input data
    //     $component->set('electricity', 1000); // kWh
    //     $component->set('natural_gas', 500); // kWh
    //     $component->set('heating_oil', 300); // kWh
    //     $component->set('coal', 200); // kg
    //     $component->set('lpg', 100); // lpg
    //     $component->set('propane', 50); // litres
    //     $component->set('wood', 150); // kg
    //     $component->set('num_people_in_household', 4);

    //     // Step 4: Call the method
    //     $component->call('submitCarbonFootrpintData');

    //     // Step 5: Assertions
    //     $this->assertDatabaseHas('household', [
    //         'electricity' => 1000,
    //         'natural_gas' => 500,
    //         'heating_oil' => 300,
    //         'coal' => 200,
    //         'lpg' => 100,
    //         'propane' => 50,
    //         'wood' => 150,
    //         'user_id' => $user->id,
    //         'num_people_in_household' => 4,
    //     ]);

    //     // Calculate expected total CO2e
    //     $expected_total_co2e = (
    //         (1000 / 4) * 0.2 / 1000 + // electricity
    //         (500 / 4) * 0.2 / 1000 + // natural gas
    //         (300 / 4) * 2.53 / 1000 + // heating oil
    //         (200 / 4) * 0.3 / 1000 + // coal
    //         (100 / 4) * 0.2 / 1000 + // lpg
    //         (50 / 4) * 0.2 / 1000 + // propane
    //         (150 / 4) * 0.1 / 1000 // wood
    //     ) * 4; // multiply by number of people

    //     // Assert that the total CO2e is correct
    //     $this->assertDatabaseHas('household', [
    //         'total_co2e' => $expected_total_co2e,
    //     ]);

    //     // Assert the response message
    //     $this->assertEquals('Data inserted successfully!', $component->responseMessage);
    // }
}
