<?php

namespace Tests\Feature;

use App\Http\Controllers\ContactController;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Services\Contracts\IContactService;
use App\Session\UserSession;
use Illuminate\Support\Facades\Route;
use Mockery;
use Tests\TestCase;

class ContactControllerTest extends TestCase
{
    public function test_store_success()
    {
        // Giả lập request
        $request = ContactRequest::create('/contact', 'POST', [
            'contact_name' => 'John',
            'contact_phone' => '1234',
            'subject' => 'hi',
            'message' => 'Hello there!',
        ]);

        // Mock Contact object
        $mockContact = Mockery::mock(Contact::class);

        // Mock service
        $contactService = Mockery::mock(IContactService::class);
        $contactService->shouldReceive('add')
            ->once()
            ->andReturn($mockContact);

        // Mock UserSession
        $userSession = Mockery::mock(UserSession::class);
        $userSession->shouldReceive('flash')
            ->once()
            ->with('success', 'Send contact successfully!');

        // Inject mock
        $controller = new ContactController($contactService, $userSession);

        // Tạo route tạm để test redirect
        Route::get('/posts/show', function () {
            return 'Post Show';
        })->name('posts.show');

        // Gọi phương thức
        $response = $controller->store($request);

        // Kiểm tra redirect
        $this->assertEquals(302, $response->status());
        $this->assertEquals(route('posts.show'), $response->headers->get('Location'));
    }

    public function test_store_fail()
    {
        $request = ContactRequest::create('/contact', 'POST', [
            'contact_phone' => '1234',
            'subject' => 'hi',
            'message' => 'Hello there!',
        ], [], [], [
            'HTTP_REFERER' => route('contact.index'), // Giả lập trang trước
        ]);

        $contactService = Mockery::mock(IContactService::class);
        $contactService->shouldReceive('add')
            ->once()
            ->andReturn(null); // giả lập thêm thất bại

        $userSession = Mockery::mock(UserSession::class);
        $userSession->shouldNotReceive('flash');

        $controller = new ContactController($contactService, $userSession);

        $response = $controller->store($request);

        $this->assertEquals(302, $response->status());
        $response = $this->post('/contact', [
            'contact_phone' => '1234',
            'subject' => 'hi',
            'message' => 'Hello there!',
        ], ['HTTP_REFERER' => route('contact.index')]);

        $response->assertRedirect(route('contact.index'));
        $response->assertSessionHasInput([
            'contact_phone' => '1234',
            'subject' => 'hi',
            'message' => 'Hello there!',
        ]);
        $response->assertSessionHasErrors([
            'contact_name' => 'Name is required',
        ]);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
