<?php
namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    protected User $testUser;
    protected Category $testCategory;

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
           'category_name' => 'food',
           'category_slug' => 'food',
       ]);
    }

    public function test_stored_with_admin_success()
    {
        $user = $this->createUser('admin');
        $response = $this->withSession(['user' => $user])
            ->withHeaders(['referer' => route('admin.categories.create')])
            ->post(route('admin.categories.store'), [
               'category_name' => 'food',
            ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('admin.categories.index'));
        $response->assertSessionHas(['success' => 'Danh mục tạo thành công']);
        $this->assertDatabaseHas('categories', [
            'category_name' => 'food',
            'category_slug' => 'food',
        ]);
    }

    public function test_stored_with_admin_category_existed()
    {
        $user = $this->createUser('admin');
        $this->createCategory();
        $response = $this->withSession(['user' => $user])
            ->withHeaders(['referer' => route('admin.categories.create')])
            ->post(route('admin.categories.store'), [
                'category_name' => 'food',
            ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('admin.categories.create'));
        $response->assertSessionHas(['error' => 'Danh mục đã tồn tại']);
    }

    public function test_update_with_admin_success()
    {
        $user = $this->createUser('admin');
        $this->createCategory();
        $response = $this->withSession(['user' => $user])
            ->withHeaders(['referer' => route('admin.categories.edit',1)])
            ->put(route('admin.categories.update',1), [
                'category_name' => 'food1',
            ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('admin.categories.index'));
        $response->assertSessionHas(['success' => 'Cập nhật danh mục thành công']);
        $this->assertDatabaseHas('categories', [
            'category_name' => 'food1',
            'category_slug' => 'food1',
        ]);
    }

    public function test_update_with_admin_category_existed()
    {
        $user = $this->createUser('admin');
        $this->createCategory();
        $response = $this->withSession(['user' => $user])
            ->withHeaders(['referer' => route('admin.categories.edit',1)])
            ->put(route('admin.categories.update',1), [
                'category_name' => 'food',
            ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('admin.categories.edit',1));
        $response->assertSessionHas(['error' => 'Tên danh mục đã tồn tại']);
    }

    public function test_delete_with_admin_success()
    {
        $user = $this->createUser('admin');
        $this->createCategory();
        $this->assertDatabaseHas('categories', [
            'category_name' => 'food',
        ]);

        $response = $this->withSession(['user' => $user])
            ->withHeaders(['referer' => route('admin.categories.index',1)])
            ->delete(route('admin.categories.destroy',1));
        $response->assertStatus(302);
        $response->assertRedirect(route('admin.categories.index'));
        $response->assertSessionHas(['success' => 'Danh mục đã bị xóa']);
        $this->assertDatabaseMissing('categories', [
            'category_name' => 'food',
        ]);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
