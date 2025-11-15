<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\CommunityMember;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommunitySignupTest extends TestCase
{
    use RefreshDatabase;

    public function test_community_signup_page_loads(): void
    {
        $response = $this->get(route('community.signup'));

        $response->assertStatus(200);
        $response->assertSee('Join Our Community');
        $response->assertSee('Select a Book');
    }

    public function test_community_signup_page_displays_books(): void
    {
        $book = Book::factory()->create([
            'title' => 'Test Book',
            'author' => 'Test Author',
        ]);

        $response = $this->get(route('community.signup'));

        $response->assertStatus(200);
        $response->assertSee('Test Book');
        $response->assertSee('Test Author');
    }

    public function test_user_can_signup_to_community(): void
    {
        $book = Book::factory()->create();

        $response = $this->post(route('community.signup.store'), [
            'book_id' => $book->id,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '+1234567890',
            'interests' => ['Technology & Innovation', 'Self-improvement'],
        ]);

        $response->assertStatus(200);
        $response->assertSee('John Doe');

        $this->assertDatabaseHas('community_members', [
            'book_id' => $book->id,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '+1234567890',
        ]);

        $member = CommunityMember::where('email', 'john@example.com')->first();
        $this->assertNotNull($member);
        $this->assertEquals(['Technology & Innovation', 'Self-improvement'], $member->interests);
    }

    public function test_signup_requires_valid_book_id(): void
    {
        $response = $this->post(route('community.signup.store'), [
            'book_id' => 999,
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $response->assertSessionHasErrors('book_id');
    }

    public function test_signup_requires_name_and_email(): void
    {
        $book = Book::factory()->create();

        $response = $this->post(route('community.signup.store'), [
            'book_id' => $book->id,
        ]);

        $response->assertSessionHasErrors(['name', 'email']);
    }

    public function test_signup_requires_unique_email(): void
    {
        $book = Book::factory()->create();

        CommunityMember::factory()->create([
            'email' => 'existing@example.com',
        ]);

        $response = $this->post(route('community.signup.store'), [
            'book_id' => $book->id,
            'name' => 'John Doe',
            'email' => 'existing@example.com',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_phone_is_optional(): void
    {
        $book = Book::factory()->create();

        $response = $this->post(route('community.signup.store'), [
            'book_id' => $book->id,
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('community_members', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => null,
        ]);
    }
}
