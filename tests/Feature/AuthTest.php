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
    }

    public function test_login_success(): void
    {
        $this->createUser('user');
        $response = $this->withHeaders(['referer' => route('sign-in')])
            ->post(route('login'), [
                'email' => 'ngovietanh2003thtb@gmail.com',
                'password' => 'abc',
            ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('auth.index'));
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
        $response->assertSessionHasErrors(['error' => 'Email or password is incorrect']);
    }

    public function test_admin_role_login()
    {
        $user = $this->createUser('admin');
        $response = $this->withSession(['user' => $user])->get(route('auth.index'));
        $response->assertStatus(302);
        $response->assertRedirect(route('admin.dashboard.index'));
    }

    public function test_user_role_login()
    {
        $user = $this->createUser('user');
        $response = $this->withSession(['user' => $user])->get(route('auth.index'));
        $response->assertStatus(302);
        $response->assertRedirect(route('posts.show'));
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
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
