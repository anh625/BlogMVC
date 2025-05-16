<?php
namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class AdminTest extends TestCase
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

    public function test()
    {

    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
