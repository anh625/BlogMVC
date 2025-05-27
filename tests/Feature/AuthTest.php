<?php

namespace Tests\Feature;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class AuthTest extends TestCase
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
            'user_image' => null,
            'phone_number' => '0961361582',
        ]);
    }
    /**
     * A basic feature test example.
     */
    public function test_register_success(): void
    {
        $response = $this->withHeaders([
            'referer' => route('sign-up') // route của trang chứa form liên hệ
        ]) // nếu bạn dùng session('user') trong controller
        ->post(route('register'), [
            'email' => 'test@test.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'name' => 'Test User',
            'phone_number' => '0123456789',
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('sign-in'));
        $response->assertSessionHas(['success' => 'Registered successfully']);

        $this->assertDatabaseHas('users', [
            'email' => 'test@test.com',
            'password' => 'password',
            'name' => 'Test User',
            'phone_number' => '0123456789',
        ]);
    }

    public function test_register_error_password_confirmation(): void
    {
        $response = $this->withHeaders([
            'referer' => route('sign-up') // route của trang chứa form liên hệ
        ]) // nếu bạn dùng session('user') trong controller
        ->post(route('register'), [
            'email' => 'test@test.com',
            'password' => 'password',
            'password_confirmation' => 'password1',
            'name' => 'Test User',
            'phone_number' => '0123456789',
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('sign-up'));
        $response->assertSessionHasErrors(['password' => 'Confirmation password does not match']);

        $this->assertDatabaseMissing('users', [
            'email' => 'test@test.com',
            'password' => 'password',
            'name' => 'Test User',
            'phone_number' => '0123456789',
        ]);
    }

    public function test_register_defect_attribute(): void
    {
        $response = $this->withHeaders([
            'referer' => route('sign-up') // route của trang chứa form liên hệ
        ]) // nếu bạn dùng session('user') trong controller
        ->post(route('register'), [
            'email' => 'test@test.com',
            'password' => 'password',
            'password_confirmation' => 'password1',
            'phone_number' => '0123456789',
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('sign-up'));
        $response->assertSessionHasErrors(['name' => 'Name required']);

        $this->assertDatabaseMissing('users', [
            'email' => 'test@test.com',
            'password' => 'password',
            'phone_number' => '0123456789',
        ]);
    }

    public function test_register_invalid_format(): void
    {
        $response = $this->withHeaders([
            'referer' => route('sign-up') // route của trang chứa form liên hệ
        ]) // nếu bạn dùng session('user') trong controller
        ->post(route('register'), [
            'email' => 'test.test.com',
            'password' => 'password',
            'password_confirmation' => 'password1',
            'name' => 'Test User',
            'phone_number' => '0123456789',
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('sign-up'));
        $response->assertSessionHasErrors(['email' => 'Invalid email format']);

        $this->assertDatabaseMissing('users', [
            'email' => 'test.test.com',
            'password' => 'password',
            'name' => 'Test User',
            'phone_number' => '0123456789',
        ]);
    }

    public function test_login_success(): void
    {
        $user = $this->createUser('user');
        $response = $this->withHeaders(['referer' => route('sign-in')])
            ->post(route('login'), [
                'email' => 'ngovietanh2003thtb@gmail.com',
                'password' => 'abc',
            ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('auth.index'));
        $response->assertSessionHas(['user']);
        $this->assertEquals($user->user_id, session('user')->user_id);
        $this->assertEquals($user->email, session('user')->email);
        $this->assertEquals($user->password, session('user')->password);
    }

    public function test_login_defect_attribute(): void
    {
        $this->createUser('user');
        $response = $this->withHeaders(['referer' => route('sign-in')])
            ->post(route('login'), [
                'email' => 'ngovietanh2003thtb@gmail.com',
            ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('sign-in'));
        $response->assertSessionHasErrors(['password' => 'Password required']);
        $response->assertSessionMissing('user');
    }

    public function test_login_invalid_format():void
    {
        $this->createUser('user');
        $response = $this->withHeaders(['referer' => route('sign-in')])
            ->post(route('login'), [
                'email' => 'ngovietanh2003thtbgmail.com',
                'password' => 'abc',
            ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('sign-in'));
        $response->assertSessionHasErrors(['email' => 'The email field must be a valid email address.']);
        $response->assertSessionMissing('user');
    }

    public function test_login_invalid_password():void
    {
        $this->createUser('user');
        $response = $this->withHeaders(['referer' => route('sign-in')])
            ->post(route('login'), [
                'email' => 'ngovietanh2003thtb@gmail.com',
                'password' => 'abcd',
            ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('sign-in'));
        $response->assertSessionHasErrors(['error']);
        $response->assertSessionMissing('user');
    }

    public function test_admin_role_login()
    {
        $user = $this->createUser('admin');
        $response = $this->withSession(['user' => $user])->get(route('auth.index'));
        $response->assertStatus(302);
        $response->assertRedirect(route('admin.dashboard.index'));
        $response->assertSessionHas('user');
        $this->assertEquals('admin', session('user')->is_admin);
    }

    public function test_user_role_login()
    {
        $user = $this->createUser('user');
        $response = $this->withSession(['user' => $user])->get(route('auth.index'));
        $response->assertStatus(302);
        $response->assertRedirect(route('posts.show'));
        $response->assertSessionHas('user');
        $this->assertEquals('user', session('user')->is_admin);
    }

    public function test_user_role_access_admin_dashboard()
    {
        $user = $this->createUser('user');
        $response = $this->withSession(['user' => $user])->get(route('admin.dashboard.index'));
        $response->assertStatus(302);
        $response->assertRedirect(route('sign-in'));
        $response->assertSessionHasErrors(['error' => 'You need to log in with Admin privileges to continue!']);
    }

    public function test_admin_role_access_user_dashboard()
    {
        $user = $this->createUser('admin');
        $response = $this->withSession(['user' => $user])->get(route('user.index'));
        $response->assertStatus(200);
    }


    public function test_logout(){
        $user = $this->createUser('user');
        $response = $this->withSession(['user' => $user])->get(route('logout'));
        $response->assertStatus(302);
        $response->assertRedirect(route('sign-in'));
        $response->assertSessionMissing('user');
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
