<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function asserting_that_administrator_can_display_the_login_page(): void
    {
        $response = $this->get(route('login.index'));
        $response->assertViewIs('auth.login');
        $response->assertStatus(200);

        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_can_authenticate(): void
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
            'password' => 'password',
        ]);

        $response = $this->from(route('login.index'))->post(route('login.authenticate'), [
            'email' => 'email@domain.com',
            'password' => 'password',
        ]);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect('dashboard');
        $response->assertStatus(302);

        $this->assertEquals('email@domain.com', $user->email);
        $this->assertTrue(Hash::check('password', $user->password));
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function asserting_that_administrator_failed_to_authenticate_without_a_valid_email(): void
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
            'password' => 'password',
        ]);

        $response = $this->from(route('login.index'))->post(route('login.authenticate'), [
            'email' => 'invalid_email',
            'password' => 'password',
        ]);
        $response->assertSessionHasErrors(['email']);

        $this->assertNotEquals('invalid_email', $user->email);
        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_failed_to_authenticate_without_a_valid_password(): void
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
            'password' => 'password',
        ]);

        $response = $this->from(route('login.index'))->post(route('login.authenticate'), [
            'email' => 'email@domain.com',
            'password' => 'invalid_password',
        ]);
        $response->assertSessionHasErrors(['email']);

        $this->assertNotEquals('invalid_password', $user->password);
        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_failed_to_authenticate_without_a_valid_email_and_password(): void
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
            'password' => 'password',
        ]);

        $response = $this->from(route('login.index'))->post(route('login.authenticate'), [
            'email' => 'invalid_email',
            'password' => 'invalid_password',
        ]);
        $response->assertSessionHasErrors(['email']);

        $this->assertNotEquals('invalid_email', $user->email);
        $this->assertNotEquals('invalid_password', $user->password);
        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_failed_to_authenticate_with_blank_data(): void
    {
        $response = $this->from(route('login.index'))->post(route('login.authenticate'), [
            'email' => null,
            'password' => null,
        ]);
        $response->assertSessionHasErrors(['email', 'password']);

        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_cannot_display_the_login_page_after_authenticated(): void
    {
        $user = User::factory()->administrator()->create();

        $response = $this->actingAs($user)->get(route('login.index'));
        $response->assertRedirect('home');
        $response->assertStatus(302);

        $this->assertAuthenticatedAs($user);
    }
}
