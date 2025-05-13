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
        $response = $this->post(route('contact.store'), [
            'contact_name' => 'sup',
            'contact_phone' => '0123456789',
            'subject' => 'hi',
            'message' => 'Hello there!',
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('posts.show'));
    }

    public function test_store_defect_attribute()
    {
        $response = $this->withHeaders([
            'referer' => route('contact.index') // route của trang chứa form liên hệ
        ])->post(route('contact.store'), [
            'contact_phone' => '0123456789',
            'subject' => 'hi',
            'message' => 'Hello there!',
        ],['']);
        $response->assertStatus(302);
        $response->assertRedirect(route('contact.store'));
        $response->assertSessionHasErrors(['contact_name' => 'Name is required']);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
