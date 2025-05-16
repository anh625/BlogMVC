<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;
    protected function createUser(string $role)
    {
        return User::factory()->create([
            'email' => 'ngovietanh2003thtb@gmail.com',
            'password' => 'abc',
            'name' => 'Ngô Việt Anh',
            'is_admin' => $role,
            'user_image' => null,
            'phone_number' => '0961361582',
        ]);
    }
    protected function createCategory()
    {
        return Category::create([
            'category_id' => 1,
            'category_name' => 'Cầu lông',
            'category_slug' => 'cau-long',
        ]);
    }
    protected function createPost(string $user_id, string $category_id){
        return Post::create([
            'title' => 'Old title',
            'description' => 'Old desc',
            'content' => 'Old content',
            'image' => 'images/posts/thumbnail/thumb_1746187041.png',
            'banner_image' => 'images/posts/banner/banner_1747110165.png',
            'user_id' => $user_id,
            'post_status' => true,
            'category_id' => $category_id,
        ]);
    }
    /**
     * A basic feature test example.
     */
    public function test_stored_sucess(): void
    {
        $user = $this->createUser('user');
        $category = $this->createCategory();
        $post = $this->createPost($user->user_id, $category->category_id);
        $response = $this->withHeaders(['referer' => route('posts.showById', $post->post_id)])
            ->withSession(['user' => $user])
            ->post(route('comments.store', $post->post_id), [
                'cmt_content' => 'Old Content',
            ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('posts.showById', $post->post_id));
        $response->assertSessionHas(['success'=>'Tạo bình luận thành công!']);

        $this->assertDatabaseHas('comments',['cmt_content' => 'Old Content']);
        $cmt = Comment::where('cmt_content',  'Old Content')->first();
        $this->assertEquals($cmt->user_id, $user->user_id);
        $this->assertEquals($cmt->post_id, $post->post_id);
    }
}
