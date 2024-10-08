<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Post;
use App\Models\User;
use App\Livewire\Posts;
use Livewire\Livewire;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Attributes\Test;

class PostTest extends TestCase
{

    public $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create a user and log them in for tests
        $this->user = User::find(4);
        Auth::login($this->user);
    }

    #[Test]
    public function it_retrieves_all_posts_on_mount()
    {
       // Post::factory()->count(0)->create();

        $component = Livewire::test(Posts::class);

        $component->assertViewIs('livewire.posts');
        $this->assertCount(5, $component->get('posts'));
    }

    #[Test]
    public function it_retrieves_all_posts_when_post_type_is_not_personal()
    {
        //Post::factory()->count(5)->create();

        $component = Livewire::test(Posts::class);

        $component->set('post_type', 'all');
        $component->call('togglePosts');

        $this->assertCount(5, $component->get('posts'));
    }

    #[Test]
    public function it_retrieves_all_posts_when_post_type_is_personal()
    {
        //Post::factory()->count(5)->create();

        $component = Livewire::test(Posts::class);

        $component->set('post_type', 'personal');
        $component->call('togglePosts');

        $this->assertCount(3, $component->get('posts'));
    }

    #[Test]
    public function it_initializes_with_correct_properties()
    {
        $component = Livewire::test(Posts::class); // initialize the Post class - allowing interaction with it's properties and methods

        $component->assertSet('user_id', $this->user->id);
        $component->assertSet('user_name', $this->user->name);
        //$component->assertSet('posts', Post::all());
    }

    #[Test]
    public function it_renders_the_correct_view()
    {
        $component = Livewire::test(Posts::class);

        $component->assertViewIs('livewire.posts');
    }

}
