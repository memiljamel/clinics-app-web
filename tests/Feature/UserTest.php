<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function asserting_that_administrator_can_display_the_index_users_page(): void
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        User::factory()->count(100)
            ->create();

        $response = $this->actingAs($user)->get(route('users.index'));
        $response->assertViewIs('users.index');
        $response->assertViewHas('users');
        $response->assertViewHas('search');
        $response->assertStatus(200);

        $this->assertCount(15, $response->original->users);

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function asserting_that_administrator_can_filter_the_users_data_by_keywords()
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        User::factory()->count(3)
            ->sequence(
                ['name' => 'First User'],
                ['name' => 'Second User'],
                ['name' => 'Third User'],
            )
            ->create();

        $response = $this->actingAs($user)->get(route('users.index', [
            'search' => 'First User',
        ]));
        $response->assertViewIs('users.index');
        $response->assertViewHas('users');
        $response->assertViewHas('search');
        $response->assertStatus(200);
        $response->assertSeeText('First User');

        $this->assertCount(1, $response->original->users);

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function asserting_that_administrator_failed_display_the_index_users_page_when_current_page_is_out_of_bound()
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        User::factory()->count(100)
            ->create();

        $response = $this->actingAs($user)->get(route('users.index', [
            'page' => 8,
        ]));
        $response->assertStatus(404);
        $response->assertSeeText('Not Found');

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function asserting_that_only_administrator_can_display_the_index_users_page(): void
    {
        $user = User::factory()->create([
            'email' => 'email@domain.com',
        ]);

        $response = $this->actingAs($user)->get(route('users.index'));
        $response->assertStatus(403);
        $response->assertSeeText('This action is unauthorized.');

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function asserting_that_administrator_failed_display_the_index_users_page_without_authentication(): void
    {
        $response = $this->get(route('users.index'));
        $response->assertRedirect(route('login.index'));
        $response->assertStatus(302);

        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_can_display_the_create_users_page(): void
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        $response = $this->actingAs($user)->get(route('users.create'));
        $response->assertViewIs('users.create');
        $response->assertStatus(200);

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function asserting_that_only_administrator_can_display_the_create_users_page(): void
    {
        $user = User::factory()->create([
            'email' => 'email@domain.com',
        ]);

        $response = $this->actingAs($user)->get(route('users.create'));
        $response->assertStatus(403);
        $response->assertSeeText('This action is unauthorized.');

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function asserting_that_administrator_failed_display_the_create_users_page_without_authentication(): void
    {
        $response = $this->get(route('users.create'));
        $response->assertRedirect(route('login.index'));
        $response->assertStatus(302);

        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_can_save_the_users_data_to_database(): void
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        $response = $this->actingAs($user)->from(route('users.create'))
            ->post(route('users.store'), [
                'name' => 'name',
                'email' => 'users@domain.com',
                'password' => 'password',
                'password_confirmation' => 'password',
                'role' => 'Patient',
            ]);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('users.index'));
        $response->assertStatus(302);
        $response->assertSessionHas([
            'message' => __('The User has been created.'),
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'name',
            'email' => 'users@domain.com',
            'role' => 'Patient',
        ]);

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function asserting_that_administrator_failed_save_the_users_data_to_database_with_blank_data(): void
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        $response = $this->actingAs($user)->from(route('users.create'))
            ->post(route('users.store'), [
                'name' => null,
                'email' => null,
                'password' => null,
                'password_confirmation' => null,
                'role' => null,
            ]);
        $response->assertRedirect(route('users.create'));
        $response->assertStatus(302);
        $response->assertSessionDoesntHaveErrors(['avatar', 'date_of_birth', 'status', 'address', 'gender']);
        $response->assertSessionHasErrors([
            'name' => __('validation.required', ['attribute' => 'name']),
            'email' => __('validation.required', ['attribute' => 'email']),
            'password' => __('validation.required', ['attribute' => 'password']),
            'role' => __('validation.required', ['attribute' => 'role']),
        ]);

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function asserting_that_administrator_can_display_the_show_users_page()
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        User::factory()->count(1)
            ->create([
                'id' => 'd67d3aa4-78fd-4e80-8d17-59331f83a740',
                'name' => 'name',
                'email' => 'users@domain.com',
                'role' => 'Patient',
            ]);

        $response = $this->actingAs($user)->get(route('users.show', 'd67d3aa4-78fd-4e80-8d17-59331f83a740'));
        $response->assertViewIs('users.show');
        $response->assertViewHas('user');
        $response->assertStatus(200);
        $response->assertSeeText('name');
        $response->assertSeeText('users@domain.com');
        $response->assertSeeText('Patient');

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function asserting_that_administrator_failed_display_the_show_users_page_with_invalid_id()
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        User::factory()->count(1)
            ->create([
                'id' => 'd67d3aa4-78fd-4e80-8d17-59331f83a740',
                'name' => 'name',
                'email' => 'users@domain.com',
                'role' => 'Patient',
            ]);

        $response = $this->actingAs($user)->get(route('users.show', 'invalid_id'));
        $response->assertStatus(404);
        $response->assertSeeText('Not Found');

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function asserting_that_only_administrator_can_display_the_show_users_page()
    {
        $user = User::factory()->create([
            'email' => 'email@domain.com',
        ]);

        User::factory()->count(1)
            ->create([
                'id' => 'd67d3aa4-78fd-4e80-8d17-59331f83a740',
                'name' => 'name',
                'email' => 'users@domain.com',
                'role' => 'Patient',
            ]);

        $response = $this->actingAs($user)->get(route('users.show', 'd67d3aa4-78fd-4e80-8d17-59331f83a740'));
        $response->assertStatus(403);
        $response->assertSeeText('This action is unauthorized.');

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function asserting_that_administrator_failed_display_the_show_users_page_without_authentication()
    {
        User::factory()->count(1)
            ->create([
                'id' => 'd67d3aa4-78fd-4e80-8d17-59331f83a740',
                'name' => 'name',
                'email' => 'users@domain.com',
                'role' => 'Patient',
            ]);

        $response = $this->get(route('users.show', 'd67d3aa4-78fd-4e80-8d17-59331f83a740'));
        $response->assertRedirect(route('login.index'));
        $response->assertStatus(302);

        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_can_display_the_edit_users_page(): void
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        User::factory()->count(1)
            ->create([
                'id' => 'd67d3aa4-78fd-4e80-8d17-59331f83a740',
                'name' => 'name',
                'email' => 'users@domain.com',
                'role' => 'Patient',
            ]);

        $response = $this->actingAs($user)->get(route('users.edit', 'd67d3aa4-78fd-4e80-8d17-59331f83a740'));
        $response->assertViewIs('users.edit');
        $response->assertViewHas('user');
        $response->assertStatus(200);
        $response->assertSee('name');
        $response->assertSee('users@domain.com');
        $response->assertSee('Patient');

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function asserting_that_administrator_failed_display_the_edit_users_page_with_invalid_id(): void
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        User::factory()->count(1)
            ->create([
                'id' => 'd67d3aa4-78fd-4e80-8d17-59331f83a740',
                'name' => 'name',
                'email' => 'users@domain.com',
                'role' => 'Patient',
            ]);

        $response = $this->actingAs($user)->get(route('users.edit', 'invalid_id'));
        $response->assertStatus(404);
        $response->assertSeeText('Not Found');

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function asserting_that_only_administrator_can_display_the_edit_users_page(): void
    {
        $user = User::factory()->create([
            'email' => 'email@domain.com',
        ]);

        User::factory()->count(1)
            ->create([
                'id' => 'd67d3aa4-78fd-4e80-8d17-59331f83a740',
                'name' => 'name',
                'email' => 'users@domain.com',
                'role' => 'Patient',
            ]);

        $response = $this->actingAs($user)->get(route('users.edit', 'd67d3aa4-78fd-4e80-8d17-59331f83a740'));
        $response->assertStatus(403);
        $response->assertSeeText('This action is unauthorized.');

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function asserting_that_administrator_failed_display_the_edit_users_page_without_authentication(): void
    {
        User::factory()->count(1)
            ->create([
                'id' => 'd67d3aa4-78fd-4e80-8d17-59331f83a740',
                'name' => 'name',
                'email' => 'users@domain.com',
                'role' => 'Patient',
            ]);

        $response = $this->get(route('users.edit', 'd67d3aa4-78fd-4e80-8d17-59331f83a740'));
        $response->assertRedirect(route('login.index'));
        $response->assertStatus(302);

        $this->assertGuest();
    }

    /** @test */
    public function asserting_that_administrator_can_update_the_users_data_from_database(): void
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        User::factory()->count(1)
            ->create([
                'id' => 'd67d3aa4-78fd-4e80-8d17-59331f83a740',
                'name' => 'name',
                'email' => 'users@domain.com',
                'role' => 'Patient',
            ]);

        $response = $this->actingAs($user)->from(route('users.edit', 'd67d3aa4-78fd-4e80-8d17-59331f83a740'))
            ->patch(route('users.update', 'd67d3aa4-78fd-4e80-8d17-59331f83a740'), [
                'name' => 'new_name',
                'password' => 'new_password',
                'password_confirmation' => 'new_password',
                'role' => 'Patient',
            ]);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('users.index'));
        $response->assertStatus(302);
        $response->assertSessionHas([
            'message' => __('The User has been updated.'),
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'new_name',
            'role' => 'Patient',
        ]);

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function asserting_that_administrator_failed_update_the_users_data_from_database_with_invalid_id(): void
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        User::factory()->count(1)
            ->create([
                'id' => 'd67d3aa4-78fd-4e80-8d17-59331f83a740',
                'name' => 'name',
                'email' => 'users@domain.com',
                'role' => 'Patient',
            ]);

        $response = $this->actingAs($user)->from(route('users.edit', 'd67d3aa4-78fd-4e80-8d17-59331f83a740'))
            ->patch(route('users.update', 'invalid_id'), [
                'name' => 'new_name',
                'role' => 'Patient',
            ]);
        $response->assertStatus(404);
        $response->assertSeeText('Not Found');

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function asserting_that_administrator_failed_update_the_users_data_from_database_with_blank_data(): void
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        User::factory()->count(1)
            ->create([
                'id' => 'd67d3aa4-78fd-4e80-8d17-59331f83a740',
                'name' => 'name',
                'email' => 'users@domain.com',
                'role' => 'Patient',
            ]);

        $response = $this->actingAs($user)->from(route('users.edit', 'd67d3aa4-78fd-4e80-8d17-59331f83a740'))
            ->patch(route('users.update', 'd67d3aa4-78fd-4e80-8d17-59331f83a740'), [
                'name' => null,
                'role' => null,
            ]);
        $response->assertRedirect(route('users.edit', 'd67d3aa4-78fd-4e80-8d17-59331f83a740'));
        $response->assertStatus(302);
        $response->assertSessionDoesntHaveErrors(['avatar', 'email', 'password', 'date_of_birth', 'status', 'address', 'gender']);
        $response->assertSessionHasErrors([
            'name' => __('validation.required', ['attribute' => 'name']),
            'role' => __('validation.required', ['attribute' => 'role']),
        ]);

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function asserting_that_administrator_can_delete_the_users_data_from_database(): void
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        User::factory()->count(1)
            ->create([
                'id' => 'd67d3aa4-78fd-4e80-8d17-59331f83a740',
                'name' => 'name',
                'email' => 'users@domain.com',
                'role' => 'Patient',
            ]);

        $response = $this->actingAs($user)->from(route('users.index'))
            ->delete(route('users.destroy', 'd67d3aa4-78fd-4e80-8d17-59331f83a740'));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('users.index'));
        $response->assertStatus(302);
        $response->assertSessionHas([
            'message' => __('The User has been deleted.'),
        ]);

        $this->assertDatabaseMissing('users', [
            'id' => 'd67d3aa4-78fd-4e80-8d17-59331f83a740',
            'name' => 'name',
            'email' => 'users@domain.com',
            'role' => 'Patient',
        ]);

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function asserting_that_administrator_failed_delete_the_users_data_from_database_with_invalid_id(): void
    {
        $user = User::factory()->administrator()->create([
            'email' => 'email@domain.com',
        ]);

        User::factory()->count(1)
            ->create([
                'id' => 'd67d3aa4-78fd-4e80-8d17-59331f83a740',
                'name' => 'name',
                'email' => 'users@domain.com',
                'role' => 'Patient',
            ]);

        $response = $this->actingAs($user)->from(route('users.index'))
            ->delete(route('users.destroy', 'invalid_id'));
        $response->assertStatus(404);
        $response->assertSeeText('Not Found');

        $this->assertAuthenticatedAs($user);
    }
}
