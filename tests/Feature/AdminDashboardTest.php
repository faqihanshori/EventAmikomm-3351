<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_login_and_access_dashboard(): void
    {
        // 1. Create an admin user
        $admin = User::create([
            'name' => 'Admin Amikom',
            'email' => 'admin@amikom.ac.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // 2. Try to access the dashboard when not logged in (should redirect to login route name, which is admin.login or redirects to /login)
        $response = $this->get(route('admin.dashboard'));
        $response->assertRedirect(route('login'));

        // 3. Perform login post request
        $loginResponse = $this->post(route('admin.login.post'), [
            'email' => 'admin@amikom.ac.id',
            'password' => 'password',
        ]);

        // Should redirect to dashboard
        $loginResponse->assertRedirect(route('admin.dashboard'));

        // 4. Access the dashboard as the authenticated admin
        $dashboardResponse = $this->actingAs($admin)->get(route('admin.dashboard'));
        
        // Assert successful status (200) and dashboard content presence
        $dashboardResponse->assertStatus(200);
        $dashboardResponse->assertViewIs('admin.dashboard');
    }
}
