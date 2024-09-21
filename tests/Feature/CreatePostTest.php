<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Livewire\CreatePost;
use Livewire\Livewire;
use Tests\TestCase;

class CreatePostTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function it_can_render_the_component()
    // {
    //     Livewire::test(CreatePost::class)
    //         ->assertStatus(200);
    // }

    //   /** @test */
    //   public function it_can_update_a_property()
    //   {
    //       Livewire::test(CreatePost::class)
    //           ->set('user', 'Test name'); // Set a property
    //         //   ->call('createPost') // Call a method if applicable
    //         //  ->assertSet('user_name', 'Test name'); // Assert the property has been updated
    //   }

    public function test_basic_test(): void
    {
        $this->assertTrue(true);
    }
}
