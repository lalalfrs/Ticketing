<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_shows_the_login_screen(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('WELCOME')
            ->assertSee('INTERNAL PORTAL')
            ->assertSee('Username atau Email')
            ->assertSee('images/mnc-logo.png', false)
            ->assertSee('role="switch"', false)
            ->assertSee('eagle-carrier', false)
            ->assertDontSee('Forgot password')
            ->assertDontSee('Sign in with Google')
            ->assertDontSee('Create an Account')
            ->assertDontSee('Register');
    }

    public function test_login_screen_can_be_rendered(): void
    {
        $this->get('/login')->assertOk();
    }

    public function test_users_can_authenticate_using_email(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'login' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    public function test_users_can_authenticate_using_username(): void
    {
        $user = User::factory()->create(['username' => 'johndoe']);

        $response = $this->post('/login', [
            'login' => 'johndoe',
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'login' => $user->email,
            'password' => 'wrong-password',
        ])->assertSessionHasErrors('login');

        $this->assertGuest();
    }

    public function test_login_requires_both_fields(): void
    {
        $this->post('/login', [])->assertSessionHasErrors(['login', 'password']);

        $this->assertGuest();
    }

    public function test_users_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }

    public function test_authenticated_users_visiting_index_are_sent_to_dashboard(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('/')->assertRedirect(route('dashboard', absolute: false));
    }

    public function test_guests_can_not_reach_internal_pages(): void
    {
        $this->get('/dashboard')->assertRedirect(route('login', absolute: false));
        $this->get('/profile')->assertRedirect(route('login', absolute: false));
        $this->getJson('/api/user')->assertUnauthorized();
    }

    public function test_public_sign_up_and_self_service_reset_are_disabled(): void
    {
        $this->get('/register')->assertNotFound();
        $this->post('/register')->assertNotFound();
        $this->get('/forgot-password')->assertNotFound();
    }

    public function test_api_user_endpoint_works_with_a_sanctum_token(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;

        $this->withToken($token)->getJson('/api/user')
            ->assertOk()
            ->assertJsonPath('id', $user->id)
            ->assertJsonMissingPath('password');
    }

    public function test_dashboard_renders_sidebar_and_personalized_landing_page(): void
    {
        $admin = User::factory()->create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@ticketing.test',
        ]);

        $this->actingAs($admin)->get('/dashboard')
            ->assertOk()
            ->assertSee('id="erp-sidebar"', false)
            ->assertSee('id="sidebar-burger-btn"', false)
            ->assertSee('Selamat Datang, Administrator!')
            ->assertSee('Administrator Sistem')
            ->assertSee('Jadwal Kuliah Hari Ini')
            ->assertSee('Presensi Mahasiswa')
            ->assertSee('Kegiatan Perkuliahan')
            ->assertSee('Generate Laporan BKD');

        $staff = User::factory()->create([
            'name' => 'Staff Ticketing',
            'username' => 'staff',
            'email' => 'staff@ticketing.test',
        ]);

        $this->actingAs($staff)->get('/dashboard')
            ->assertOk()
            ->assertSee('Selamat Datang, Staff Ticketing!')
            ->assertSee('Staf Ticketing & Akademik');
    }

    public function test_users_can_authenticate_directly_from_index_route(): void
    {
        $user = User::factory()->create(['username' => 'user']);

        $response = $this->post('/', [
            'login' => 'user',
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('dashboard', absolute: false));
    }
}
