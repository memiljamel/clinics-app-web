<?php

namespace Tests\Feature;

use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ForgotTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function asserting_that_administrator_can_display_the_forgot_page(): void
    {
        $response = $this->get(route('forgot.index'));
        $response->assertViewIs('auth.forgot');
        $response->assertStatus(200);

        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_can_send_password_reset_link(): void
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        Notification::fake();

        $response = $this->from(route('forgot.index'))->post(route('forgot.send'), [
            'email' => 'email@domain.com',
        ]);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('forgot.index'));
        $response->assertStatus(302);
        $response->assertSessionHas([
            'message' => __('passwords.sent'),
        ]);

        Notification::assertSentTo([$user], ResetPasswordNotification::class);
        Notification::assertCount(1);

        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_failed_to_send_password_reset_link_with_blank_data(): void
    {
        User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        Notification::fake();

        $response = $this->from(route('forgot.index'))->post(route('forgot.send'), [
            'email' => null,
        ]);
        $response->assertRedirect(route('forgot.index'));
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'email' => __('validation.required', ['attribute' => 'email']),
        ]);

        Notification::assertNothingSent();

        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_failed_to_send_password_reset_link_with_invalid_email(): void
    {
        User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        Notification::fake();

        $response = $this->from(route('forgot.index'))->post(route('forgot.send'), [
            'email' => 'invalid_email',
        ]);
        $response->assertRedirect(route('forgot.index'));
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'email' => __('validation.email', ['attribute' => 'email']),
        ]);

        Notification::assertNothingSent();

        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_failed_to_send_password_reset_link_with_email_does_not_exists(): void
    {
        User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        Notification::fake();

        $response = $this->from(route('forgot.index'))->post(route('forgot.send'), [
            'email' => 'email@doesnot.exists',
        ]);
        $response->assertRedirect(route('forgot.index'));
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'email' => __('validation.exists', ['attribute' => 'email']),
        ]);

        Notification::assertNothingSent();

        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_only_administrator_can_send_password_reset_link(): void
    {
        User::factory()->create([
            'email' => 'email@domain.com',
        ]);

        Notification::fake();

        $response = $this->from(route('forgot.index'))->post(route('forgot.send'), [
            'email' => 'email@domain.com',
        ]);
        $response->assertRedirect(route('forgot.index'));
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'email' => __('passwords.user', ['attribute' => 'email']),
        ]);

        Notification::assertNothingSent();

        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_cannot_display_the_forgot_page_after_authenticated(): void
    {
        $user = User::factory()->administrator()->create();

        $response = $this->actingAs($user)->get(route('forgot.index'));
        $response->assertRedirect('home');
        $response->assertStatus(302);

        $this->assertAuthenticatedAs($user);
    }
}
