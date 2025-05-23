<?php

namespace Tests\Feature;

use App\Http\Controllers\PostController;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;
use App\Services\Contracts\IPostService;
use App\Session\UserSession;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Mockery;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_stored_success(): void
    {
        $user = new User([
            'user_id' => '5a5aaea3-3dea-414b-9246-80896cedcb90',
            'email' => 'user@gmail.com',
            'password' => '1',
            'name' => 'Ngô Việt Anh',
            'phone' => '0961361582',
        ]);

        // Tạo chuỗi base64 hợp lệ
        $imagePath = base_path('public\storage\images\posts\thumbnail\thumb_1747106893.png');
        $imageData = base64_encode(file_get_contents($imagePath));
        $tb = 'data:image/jpeg;base64,' . $imageData;

        $imagePath1 = base_path('public\storage\images\posts\banner\banner_1747106893.png');
        $imageData1 = base64_encode(file_get_contents($imagePath1));
        $bn = 'data:image/jpeg;base64,' . $imageData1;

        $response = $this->withSession(['user' => $user])
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
    }

    public function test_stored_without_login(): void
    {
        // Tạo chuỗi base64 hợp lệ
        $imagePath = base_path('public\storage\images\posts\thumbnail\thumb_1747106893.png'); // Tạo một ảnh nhỏ ở đây nếu muốn
        $imageData = base64_encode(file_get_contents($imagePath));
        $tb = 'data:image/jpeg;base64,' . $imageData;

        $imagePath1 = base_path('public\storage\images\posts\banner\banner_1747106893.png'); // Tạo một ảnh nhỏ ở đây nếu muốn
        $imageData1 = base64_encode(file_get_contents($imagePath1));
        $bn = 'data:image/jpeg;base64,' . $imageData1;

        $response = $this->post(route('posts.store'), [
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
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
