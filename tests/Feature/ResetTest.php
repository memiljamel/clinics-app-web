<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class ResetTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function asserting_that_administrator_can_display_the_reset_page(): void
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        $token = Password::createToken($user);

        $response = $this->get(route('reset.index', [
            'token' => $token,
            'email' => 'email@domain.com',
        ]));
        $response->assertViewIs('auth.reset');
        $response->assertViewHas('token', $token);
        $response->assertViewHas('email', 'email@domain.com');
        $response->assertStatus(200);

        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_failed_display_the_reset_page_without_send_token_and_email_in_params(): void
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        Password::createToken($user);

        $response = $this->get(route('reset.index'));
        $response->assertRedirect(route('forgot.index'));
        $response->assertStatus(302);
        $response->assertSessionHas([
            'message' => __('passwords.token'),
        ]);

        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_failed_display_the_reset_page_with_token_does_not_exists(): void
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        Password::createToken($user);

        $response = $this->get(route('reset.index', [
            'token' => 'token_does_not_exists',
            'email' => 'email@domain.com',
        ]));
        $response->assertRedirect(route('forgot.index'));
        $response->assertStatus(302);
        $response->assertSessionHas([
            'message' => __('passwords.token'),
        ]);

        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_failed_display_the_reset_page_with_token_has_expired(): void
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        config(['auth.passwords.users.expire' => 1]);

        $token = Password::createToken($user);

        sleep(61);

        $response = $this->get(route('reset.index', [
            'token' => $token,
            'email' => 'email@domain.com',
        ]));
        $response->assertRedirect(route('forgot.index'));
        $response->assertStatus(302);
        $response->assertSessionHas([
            'message' => __('passwords.token'),
        ]);

        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_failed_display_the_reset_page_with_invalid_email(): void
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        $token = Password::createToken($user);

        $response = $this->get(route('reset.index', [
            'token' => $token,
            'email' => 'invalid_email',
        ]));
        $response->assertRedirect(route('forgot.index'));
        $response->assertStatus(302);
        $response->assertSessionHas([
            'message' => __('passwords.token'),
        ]);

        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_failed_display_the_reset_page_with_email_does_not_exists(): void
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        $token = Password::createToken($user);

        $response = $this->get(route('reset.index', [
            'token' => $token,
            'email' => 'email@doesnot.exists',
        ]));
        $response->assertRedirect(route('forgot.index'));
        $response->assertStatus(302);
        $response->assertSessionHas([
            'message' => __('passwords.token'),
        ]);

        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_can_reset_password(): void
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        $token = Password::createToken($user);

        $response = $this->from(route('reset.index', [
            'token' => $token,
            'email' => 'email@domain.com',
        ]))->post(route('reset.recovery'), [
            'token' => $token,
            'email' => 'email@domain.com',
            'password' => 'new_password',
            'password_confirmation' => 'new_password',
        ]);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('login.index'));
        $response->assertStatus(302);
        $response->assertSessionHas([
            'message' => __('passwords.reset'),
        ]);

        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_failed_to_reset_password_with_blank_data(): void
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        $token = Password::createToken($user);

        $response = $this->from(route('reset.index', [
            'token' => $token,
            'email' => 'email@domain.com',
        ]))->post(route('reset.recovery'), [
            'token' => null,
            'email' => null,
            'password' => null,
            'password_confirmation' => null,
        ]);
        $response->assertRedirect(route('reset.index', [
            'token' => $token,
            'email' => 'email@domain.com',
        ]));
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'token' => __('validation.required', ['attribute' => 'token']),
            'email' => __('validation.required', ['attribute' => 'email']),
            'password' => __('validation.required', ['attribute' => 'password']),
        ]);

        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_failed_to_reset_password_with_token_does_not_exists(): void
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        $token = Password::createToken($user);

        $response = $this->from(route('reset.index', [
            'token' => $token,
            'email' => 'email@domain.com',
        ]))->post(route('reset.recovery'), [
            'token' => 'token_does_not_exists',
            'email' => 'email@domain.com',
            'password' => 'new_password',
            'password_confirmation' => 'new_password',
        ]);
        $response->assertRedirect(route('reset.index', [
            'token' => $token,
            'email' => 'email@domain.com',
        ]));
        $response->assertStatus(302);
        $response->assertSessionDoesntHaveErrors(['token', 'password']);
        $response->assertSessionHasErrors([
            'email' => __('passwords.token', ['attribute' => 'email']),
        ]);

        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_failed_to_reset_password_with_token_has_expired(): void
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        config(['auth.passwords.users.expire' => 1]);

        $token = Password::createToken($user);

        sleep(61);

        $response = $this->from(route('reset.index', [
            'token' => $token,
            'email' => 'email@domain.com',
        ]))->post(route('reset.recovery'), [
            'token' => $token,
            'email' => 'email@domain.com',
            'password' => 'new_password',
            'password_confirmation' => 'new_password',
        ]);
        $response->assertRedirect(route('reset.index', [
            'token' => $token,
            'email' => 'email@domain.com',
        ]));
        $response->assertStatus(302);
        $response->assertSessionDoesntHaveErrors(['token', 'password']);
        $response->assertSessionHasErrors([
            'email' => __('passwords.token', ['attribute' => 'email']),
        ]);

        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_failed_to_reset_password_with_invalid_email(): void
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        $token = Password::createToken($user);

        $response = $this->from(route('reset.index', [
            'token' => $token,
            'email' => 'email@domain.com',
        ]))->post(route('reset.recovery'), [
            'token' => $token,
            'email' => 'invalid_email',
            'password' => 'new_password',
            'password_confirmation' => 'new_password',
        ]);
        $response->assertRedirect(route('reset.index', [
            'token' => $token,
            'email' => 'email@domain.com',
        ]));
        $response->assertStatus(302);
        $response->assertSessionDoesntHaveErrors(['token', 'password']);
        $response->assertSessionHasErrors([
            'email' => __('validation.email', ['attribute' => 'email']),
        ]);

        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_failed_to_reset_password_with_email_does_not_exists(): void
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        $token = Password::createToken($user);

        $response = $this->from(route('reset.index', [
            'token' => $token,
            'email' => 'email@domain.com',
        ]))->post(route('reset.recovery'), [
            'token' => $token,
            'email' => 'email@doesnot.exists',
            'password' => 'new_password',
            'password_confirmation' => 'new_password',
        ]);
        $response->assertRedirect(route('reset.index', [
            'token' => $token,
            'email' => 'email@domain.com',
        ]));
        $response->assertStatus(302);
        $response->assertSessionDoesntHaveErrors(['token', 'password']);
        $response->assertSessionHasErrors([
            'email' => __('validation.exists', ['attribute' => 'email']),
        ]);

        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_failed_to_reset_password_with_password_too_short(): void
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        $token = Password::createToken($user);

        $response = $this->from(route('reset.index', [
            'token' => $token,
            'email' => 'email@domain.com',
        ]))->post(route('reset.recovery'), [
            'token' => $token,
            'email' => 'email@domain.com',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ]);
        $response->assertRedirect(route('reset.index', [
            'token' => $token,
            'email' => 'email@domain.com',
        ]));
        $response->assertStatus(302);
        $response->assertSessionDoesntHaveErrors(['token', 'email']);
        $response->assertSessionHasErrors([
            'password' => __('validation.min.string', ['attribute' => 'password', 'min' => 8]),
        ]);

        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_failed_to_reset_password_with_password_too_long(): void
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        $token = Password::createToken($user);

        $response = $this->from(route('reset.index', [
            'token' => $token,
            'email' => 'email@domain.com',
        ]))->post(route('reset.recovery'), [
            'token' => $token,
            'email' => 'email@domain.com',
            'password' => str_repeat('secret', 71),
            'password_confirmation' => str_repeat('secret', 71),
        ]);
        $response->assertRedirect(route('reset.index', [
            'token' => $token,
            'email' => 'email@domain.com',
        ]));
        $response->assertStatus(302);
        $response->assertSessionDoesntHaveErrors(['token', 'email']);
        $response->assertSessionHasErrors([
            'password' => __('validation.max.string', ['attribute' => 'password', 'max' => 70]),
        ]);

        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_failed_to_reset_password_with_password_mismatch(): void
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        $token = Password::createToken($user);

        $response = $this->from(route('reset.index', [
            'token' => $token,
            'email' => 'email@domain.com',
        ]))->post(route('reset.recovery'), [
            'token' => $token,
            'email' => 'email@domain.com',
            'password' => 'new_password',
            'password_confirmation' => 'mismatch_password',
        ]);
        $response->assertRedirect(route('reset.index', [
            'token' => $token,
            'email' => 'email@domain.com',
        ]));
        $response->assertStatus(302);
        $response->assertSessionDoesntHaveErrors(['token', 'email']);
        $response->assertSessionHasErrors([
            'password' => __('validation.confirmed', ['attribute' => 'password', 'max' => 70]),
        ]);

        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_cannot_display_the_reset_page_after_authenticated(): void
    {
        $user = User::factory()->administrator()->create();

        $response = $this->actingAs($user)->get(route('reset.index'));
        $response->assertRedirect('home');
        $response->assertStatus(302);

        $this->assertAuthenticatedAs($user);
    }
}
