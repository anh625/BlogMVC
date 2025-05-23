<?php

namespace Tests\Feature;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    protected User $testUser;
    protected function createUser(string $role)
    {
        return User::factory()->create([
            'email' => 'ngovietanh2003thtb@gmail.com',
            'password' => 'abc',
            'name' => 'Ngô Việt Anh',
            'is_admin' => $role,
            'user_image' => 'images/user/avatar/avatar_1746205288.png',
            'phone_number' => '0961361582',
        ]);
    }
    protected function createAvatar(): string
    {
        $imagePath1 = base_path('public\storage\images\user\avatar\avatar_1746205288.png');
        $imageData1 = base64_encode(file_get_contents($imagePath1));
        return 'data:image/jpeg;base64,' . $imageData1;
    }
    /**
     * A basic feature test example.
     */
    public function test_update_profile_success(): void
    {
        $user = $this->createUser('user');
        $response = $this->withHeaders([
            'referer' => route('user.edit') // route của trang chứa form liên hệ
        ])->withSession(['user' => $user])
        ->put(route('user.update'), [
            'name' => 'anh1',
            'avatar' => $this->createAvatar(),
            'phone_number' => '0961361582',
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('user.index'));

        $this->assertDatabaseHas('users', [
            'name' => 'anh1',
            'phone_number' => '0961361582',
        ]);
        $user = User::where('email', 'ngovietanh2003thtb@gmail.com')->latest()->first();
        $this->assertNotNull($user->user_image);
        $this->assertStringStartsWith('images/user/avatar/', $user->user_image);
    }

    public function test_update_without_avatar(): void
    {
        $user = $this->createUser('user');
        $response = $this->withHeaders([
            'referer' => route('user.edit') // route của trang chứa form liên hệ
        ])->withSession(['user' => $user])
            ->put(route('user.update'), [
                'name' => 'anh',
                'phone_number' => '0961361582',
            ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('user.index'));
        $this->assertDatabaseHas('users', [
            'name' => 'anh',
            'phone_number' => '0961361582',
        ]);
        $user = User::where('email', 'ngovietanh2003thtb@gmail.com')->latest()->first();
        if($user->user_image){
            $this->assertNotNull($user->user_image);
            $this->assertStringStartsWith('images/user/avatar/', $user->user_image);
        }
        else{
            $this->assertNull($user->user_image);
        }
    }

    public function test_update_defect_attribute_without_avatar(): void
    {
        $user = $this->createUser('user');
        $response = $this->withHeaders([
            'referer' => route('user.edit') // route của trang chứa form liên hệ
        ])->withSession(['user' => $user])
            ->put(route('user.update'), [
                'avatar' => $this->createAvatar(),
                'phone_number' => '1961361582',
            ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('user.edit'));
        $response->assertSessionHasErrors(['name' => 'Name required']);
        $this->assertEquals('1961361582', session()->getOldInput('phone_number'));
        $this->assertEquals($this->createAvatar(), session()->getOldInput('avatar'));

        $this->assertDatabaseMissing('users', [
            'phone_number' => '1961361582',
        ]);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
