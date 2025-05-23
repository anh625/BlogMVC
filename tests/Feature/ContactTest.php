<?php

namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;
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
        $response->assertSessionHas('success', 'Send contact successfully!');

        $this->assertDatabaseHas('contacts', [
            'contact_name' => 'sup',
            'contact_phone' => '0123456789',
            'subject' => 'hi',
            'message' => 'Hello there!',
        ]);
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
        $this->assertDatabaseMissing('contacts', [
            'contact_phone' => '0123456789',
            'subject' => 'hi',
            'message' => 'Hello there!',
        ]);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
