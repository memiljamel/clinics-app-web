<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
            'remember' => true,
        ]);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect('dashboard');
        $response->assertStatus(302);

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function asserting_that_administrator_failed_to_authenticate_with_blank_data(): void
    {
        User::factory()->administrator()->create([
            'email' => 'email@domain.com',
            'password' => 'password',
        ]);

        $response = $this->from(route('login.index'))->post(route('login.authenticate'), [
            'email' => null,
            'password' => null,
            'remember' => true,
        ]);
        $response->assertRedirect(route('login.index'));
        $response->assertStatus(302);
        $response->assertSessionDoesntHaveErrors(['remember']);
        $response->assertSessionHasErrors([
            'email' => __('validation.required', ['attribute' => 'email']),
            'password' => __('validation.required', ['attribute' => 'password']),
        ]);

        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_failed_to_authenticate_with_invalid_email(): void
    {
        User::factory()->administrator()->create([
            'email' => 'email@domain.com',
            'password' => 'password',
        ]);

        $response = $this->from(route('login.index'))->post(route('login.authenticate'), [
            'email' => 'invalid_email',
            'password' => 'password',
            'remember' => true,
        ]);
        $response->assertRedirect(route('login.index'));
        $response->assertStatus(302);
        $response->assertSessionDoesntHaveErrors(['password', 'remember']);
        $response->assertSessionHasErrors([
            'email' => __('validation.email', ['attribute' => 'email']),
        ]);

        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_failed_to_authenticate_with_email_does_not_exists(): void
    {
        User::factory()->administrator()->create([
            'email' => 'email@domain.com',
            'password' => 'password',
        ]);

        $response = $this->from(route('login.index'))->post(route('login.authenticate'), [
            'email' => 'email@doesnot.exists',
            'password' => 'password',
            'remember' => true,
        ]);
        $response->assertRedirect(route('login.index'));
        $response->assertStatus(302);
        $response->assertSessionDoesntHaveErrors(['password', 'remember']);
        $response->assertSessionHasErrors([
            'email' => __('validation.exists', ['attribute' => 'email']),
        ]);

        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_failed_to_authenticate_with_invalid_password(): void
    {
        User::factory()->administrator()->create([
            'email' => 'email@domain.com',
            'password' => 'password',
        ]);

        $response = $this->from(route('login.index'))->post(route('login.authenticate'), [
            'email' => 'email@domain.com',
            'password' => 'invalid_password',
            'remember' => true,
        ]);
        $response->assertRedirect(route('login.index'));
        $response->assertStatus(302);
        $response->assertSessionDoesntHaveErrors(['password', 'remember']);
        $response->assertSessionHasErrors([
            'email' => __('auth.failed', ['attribute' => 'email']),
        ]);

        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_failed_to_authenticate_with_password_too_short(): void
    {
        User::factory()->administrator()->create([
            'email' => 'email@domain.com',
            'password' => 'password',
        ]);

        $response = $this->from(route('login.index'))->post(route('login.authenticate'), [
            'email' => 'email@domain.com',
            'password' => 'secret',
            'remember' => true,
        ]);
        $response->assertRedirect(route('login.index'));
        $response->assertStatus(302);
        $response->assertSessionDoesntHaveErrors(['email', 'remember']);
        $response->assertSessionHasErrors([
            'password' => __('validation.min.string', ['attribute' => 'password', 'min' => 8]),
        ]);

        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_failed_to_authenticate_with_password_too_long(): void
    {
        User::factory()->administrator()->create([
            'email' => 'email@domain.com',
            'password' => 'password',
        ]);

        $response = $this->from(route('login.index'))->post(route('login.authenticate'), [
            'email' => 'email@domain.com',
            'password' => str_repeat('secret', 71),
            'remember' => true,
        ]);
        $response->assertRedirect(route('login.index'));
        $response->assertStatus(302);
        $response->assertSessionDoesntHaveErrors(['email', 'remember']);
        $response->assertSessionHasErrors([
            'password' => __('validation.max.string', ['attribute' => 'password', 'max' => 70]),
        ]);

        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_failed_to_authenticate_with_remember_field_not_a_boolean_value(): void
    {
        User::factory()->administrator()->create([
            'email' => 'email@domain.com',
            'password' => 'password',
        ]);

        $response = $this->from(route('login.index'))->post(route('login.authenticate'), [
            'email' => 'email@domain.com',
            'password' => 'password',
            'remember' => 'not_a_boolean_value',
        ]);
        $response->assertRedirect(route('login.index'));
        $response->assertStatus(302);
        $response->assertSessionDoesntHaveErrors(['email', 'password']);
        $response->assertSessionHasErrors([
            'remember' => __('validation.boolean', ['attribute' => 'remember']),
        ]);

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
