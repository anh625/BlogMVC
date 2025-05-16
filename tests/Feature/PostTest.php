<?php

namespace Tests\Feature;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    protected User $testUser;
    protected Category $testCategory;
    protected Post $testPost;
    protected function createUser(string $role)
    {
        return User::factory()->create([
            'user_id' => '51ab5d95-ad6d-4da5-8532-0193f8b2eed6',
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
    public function test_stored_success(): void
    {
        $user = $this->createUser('user');
        $this->createCategory();
        //dd($user);
        // Tạo chuỗi base64 hợp lệ
        $imagePath = base_path('public/storage/images/posts/thumbnail/thumb_1746187041.png'); // Tạo một ảnh nhỏ ở đây nếu muốn
        $imageData = base64_encode(file_get_contents($imagePath));
        $tb = 'data:image/jpeg;base64,' . $imageData;
        $imagePath1 = base_path('public/storage/images/posts/banner/banner_1747110165.png'); // Tạo một ảnh nhỏ ở đây nếu muốn
        $imageData1 = base64_encode(file_get_contents($imagePath1));
        $bn = 'data:image/jpeg;base64,' . $imageData1;

        $response = $this->withSession(['user' => $user])->withHeaders([
            'referer' => route('posts.create') // route của trang chứa form liên hệ
        ]) // nếu bạn dùng session('user') trong controller
        ->post(route('posts.store'), [
            'title' => 'test',
            'description' => 'test',
            'content' => 'test',
            'thumbnail' => $tb,
            'banner_image' => $bn,
            'category_id' => 1,
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('user.index'));

        $this->assertDatabaseHas('posts', [
            'title' => 'test',
            'description' => 'test',
            'content' => 'test',
            'category_id' => 1,
        ]);
        $post = $post = Post::where('title', 'test')->latest()->first();
        $this->assertNotNull($post->image);
        $this->assertNotNull($post->banner_image);
        $this->assertStringStartsWith('images/posts/thumbnail/', $post->image);
        $this->assertStringStartsWith('images/posts/banner/', $post->banner_image);
    }

    public function test_stored_without_login(): void
    {
        // Tạo chuỗi base64 hợp lệ
        $imagePath = base_path('public\storage\images\posts\thumbnail\thumb_1746187041.png'); // Tạo một ảnh nhỏ ở đây nếu muốn
        $imageData = base64_encode(file_get_contents($imagePath));
        $tb = 'data:image/jpeg;base64,' . $imageData;

        $imagePath1 = base_path('public\storage\images\posts\banner\banner_1747110165.png'); // Tạo một ảnh nhỏ ở đây nếu muốn
        $imageData1 = base64_encode(file_get_contents($imagePath1));
        $bn = 'data:image/jpeg;base64,' . $imageData1;

        $response = $this->withHeaders([
            'referer' => route('posts.create') // route của trang chứa form liên hệ
        ])->post(route('posts.store'), [
            'title' => 'test',
            'description' => 'test',
            'content' => 'test',
            'thumbnail' => $tb,
            'banner_image' => $bn,
            'category_id' => 1,
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('sign-in'));
        $response->assertSessionHasErrors([
            'error' => 'Vui lòng đăng nhập để tiếp tục!'
        ]);

        $this->assertDatabaseMissing('posts', [
            'title' => 'test',
            'description' => 'test',
            'content' => 'test',
            'category_id' => 1,
        ]);
    }

    public function test_stored_defect_attribute(): void
    {
        $user = $this->createUser('user');
        $this->createCategory();
        //dd($user);
        // Tạo chuỗi base64 hợp lệ
        $imagePath = base_path('public\storage\images\posts\thumbnail\thumb_1746187041.png'); // Tạo một ảnh nhỏ ở đây nếu muốn
        $imageData = base64_encode(file_get_contents($imagePath));
        $tb = 'data:image/jpeg;base64,' . $imageData;
        $imagePath1 = base_path('public\storage\images\posts\banner\banner_1747110165.png'); // Tạo một ảnh nhỏ ở đây nếu muốn
        $imageData1 = base64_encode(file_get_contents($imagePath1));
        $bn = 'data:image/jpeg;base64,' . $imageData1;

        $response = $this->withHeaders([
            'referer' => route('posts.create') // route của trang chứa form liên hệ
        ])->withSession(['user' => $user]) // nếu bạn dùng session('user') trong controller
        ->post(route('posts.store'), [
            'description' => 'test',
            'content' => 'test',
            'thumbnail' => $tb,
            'banner_image' => $bn,
            'category_id' => 1,
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('posts.create'));
        $response->assertSessionHasErrors(['title']);

        $errors = session('errors');
        $this->assertEquals('Title is required', $errors->first('title'));
        $this->assertDatabaseMissing('posts', [
            'description' => 'test',
            'content' => 'test',
            'category_id' => 1,
        ]);
    }

    public function test_updated_success(): void
    {
        $user = $this->createUser('user');
        $category = $this->createCategory();
        $this->createPost($user['user_id'], $category['category_id']);
        // Tạo chuỗi base64 hợp lệ
        $imagePath = base_path('public\storage\images\posts\thumbnail\thumb_1746187041.png'); // Tạo một ảnh nhỏ ở đây nếu muốn
        $imageData = base64_encode(file_get_contents($imagePath));
        $tb = 'data:image/jpeg;base64,' . $imageData;
        $imagePath1 = base_path('public\storage\images\posts\banner\banner_1747110165.png'); // Tạo một ảnh nhỏ ở đây nếu muốn
        $imageData1 = base64_encode(file_get_contents($imagePath1));
        $bn = 'data:image/jpeg;base64,' . $imageData1;

        $response = $this->withSession(['user' => $user]) // nếu bạn dùng session('user') trong controller
        ->put(route('posts.update', 1), [
            'title' => 'test',
            'description' => 'test',
            'content' => 'test',
            'thumbnail' => $tb,
            'banner_image' => $bn,
            'category_id' => 1,
            'post_status' => true,
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('user.index'));

        $this->assertDatabaseHas('posts', [
            'title' => 'test',
            'description' => 'test',
            'content' => 'test',
            'category_id' => 1,
            'post_status' => true,
        ]);
        $post = $post = Post::where('title', 'test')->latest()->first();
        $this->assertNotNull($post->image);
        $this->assertNotNull($post->banner_image);
        $this->assertStringStartsWith('images/posts/thumbnail/', $post->image);
        $this->assertStringStartsWith('images/posts/banner/', $post->banner_image);
    }

    public function test_updated_without_image(): void
    {
        $user = $this->createUser('user');
        $category = $this->createCategory();
        $this->createPost($user['user_id'], $category['category_id']);
        // Tạo chuỗi base64 hợp lệ
        $imagePath = base_path('public\storage\images\posts\thumbnail\thumb_1746187041.png'); // Tạo một ảnh nhỏ ở đây nếu muốn
        $imageData = base64_encode(file_get_contents($imagePath));
        $tb = 'data:image/jpeg;base64,' . $imageData;
        $imagePath1 = base_path('public\storage\images\posts\banner\banner_1747110165.png'); // Tạo một ảnh nhỏ ở đây nếu muốn
        $imageData1 = base64_encode(file_get_contents($imagePath1));
        $bn = 'data:image/jpeg;base64,' . $imageData1;

        $response = $this->withSession(['user' => $user]) // nếu bạn dùng session('user') trong controller
        ->put(route('posts.update', 1), [
            'title' => 'test',
            'description' => 'test',
            'content' => 'test',
            'category_id' => 1,
            'post_status' => true,
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('user.index'));

        $this->assertDatabaseHas('posts', [
            'title' => 'test',
            'description' => 'test',
            'content' => 'test',
            'category_id' => 1,
            'post_status' => true,
        ]);
        $post = Post::where('title', 'test')->latest()->first();
        $this->assertNotNull($post->image);
        $this->assertNotNull($post->banner_image);
        $this->assertStringStartsWith('images/posts/thumbnail/', $post->image);
        $this->assertStringStartsWith('images/posts/banner/', $post->banner_image);
    }

    public function test_updated_defect_attribute_without_image(): void
    {
        $user = $this->createUser('user');
        $category = $this->createCategory();
        $this->createPost($user['user_id'], $category['category_id']);
        // Tạo chuỗi base64 hợp lệ
        $imagePath = base_path('public\storage\images\posts\thumbnail\thumb_1746187041.png'); // Tạo một ảnh nhỏ ở đây nếu muốn
        $imageData = base64_encode(file_get_contents($imagePath));
        $tb = 'data:image/jpeg;base64,' . $imageData;
        $imagePath1 = base_path('public\storage\images\posts\banner\banner_1747110165.png'); // Tạo một ảnh nhỏ ở đây nếu muốn
        $imageData1 = base64_encode(file_get_contents($imagePath1));
        $bn = 'data:image/jpeg;base64,' . $imageData1;

        $response = $this->withSession(['user' => $user]) // nếu bạn dùng session('user') trong controller
        ->withHeaders(['referer' => route('posts.edit', 1)])
        ->put(route('posts.update', 1), [
            'title' => 'test',
            'description' => 'test',
            'category_id' => 1,
            'post_status' => true,
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('posts.edit',1));

        $this->assertDatabaseMissing('posts', [
            'title' => 'test',
            'description' => 'test',
            'category_id' => 1,
            'post_status' => true,
        ]);
    }

    public function test_deleted_success(): void
    {
        $user = $this->createUser('user');
        $category = $this->createCategory();
        $this->createPost($user['user_id'], $category['category_id']);
        // Tạo chuỗi base64 hợp lệ
        $imagePath = base_path('public\storage\images\posts\thumbnail\thumb_1746187041.png'); // Tạo một ảnh nhỏ ở đây nếu muốn
        $imageData = base64_encode(file_get_contents($imagePath));
        $tb = 'data:image/jpeg;base64,' . $imageData;
        $imagePath1 = base_path('public\storage\images\posts\banner\banner_1747110165.png'); // Tạo một ảnh nhỏ ở đây nếu muốn
        $imageData1 = base64_encode(file_get_contents($imagePath1));
        $bn = 'data:image/jpeg;base64,' . $imageData1;
        $this->assertDatabaseHas('posts', [
            'post_id' => 1
        ]);

        $response = $this->withSession(['user' => $user]) // nếu bạn dùng session('user') trong controller
        ->delete(route('posts.destroy', 1));
        $response->assertStatus(302);
        $response->assertRedirect(route('user.index'));

        $this->assertDatabaseMissing('posts', [
            'post_id' => 1
        ]);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
