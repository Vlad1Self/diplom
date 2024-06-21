<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ShopControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_posts_works(): void
    {
        $category = Category::factory()->create();
        $post = Post::factory()->create(['category_id' => $category->id]);

        $this->actingAs($this->getAdminUser());

        $this->get('user/posts')->assertSuccessful();

        $this->get('user/posts')->assertViewHas('posts', function($collection) use ($post) {
            return $collection->contains($post);
        });
    }

    public function test_create_post_works(): void
    {
        $category = Category::factory()->create();

        $this->actingAs($this->getAdminUser());

        $this->get('user/posts/create')->assertSuccessful();

        $this->post('user/posts', [
            'title' => 'test',
            'content' => 'test',
            'image' => UploadedFile::fake()->image('file1.jpeg', 700, 900),
            'price' => 100,
            'categories_id' => [$category->id],
        ])->assertRedirect('/shop');

        $this->assertDatabaseHas('posts', [
            'title' => 'test',
            'price' => 100,
            'category_id' => $category->id,
        ]);

        $this->assertDatabaseHas('category_post', [
            'category_id' => $category->id,
            'post_id' => Post::latest()->first()->id,
        ]);
    }

    public function test_edit_post_works(): void
    {
        $category = Category::factory()->create();
        $post = Post::factory()->create(['category_id' => $category->id]);

        $this->actingAs($this->getAdminUser());

        $this->get('user/posts/' . $post->id . '/edit')->assertSuccessful();

        $this->put('user/posts/' . $post->id, [
            'id' => $post->id,
            'title' => 'test1',
            'content' => 'test',
            'image' => UploadedFile::fake()->image('file1.jpeg', 700, 900),
            'price' => 100,
            'categories_id' => [$category->id],
        ])->assertRedirect('/shop');

        $this->assertDatabaseHas('posts', [
            'title' => 'test1',
            'price' => 100,
            'category_id' => $category->id,
        ]);

        $this->assertDatabaseHas('category_post', [
            'category_id' => $category->id,
            'post_id' => $post->id,
        ]);
    }

    public function test_delete_post_works()
    {
        $category = Category::factory()->create();
        $post = Post::factory()->create(['category_id' => $category->id]);

        $this->actingAs($this->getAdminUser());

        $response = $this->delete('user/posts/' . $post->id);

        $response->assertRedirect('/shop?' . $post->id);

        $this->assertDatabaseMissing('posts', [
            'id' => $post->id
        ]);
    }

    private function getAdminUser()
    {
        return User::factory()->create(['admin' => true]);
    }

}
