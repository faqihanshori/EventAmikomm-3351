<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminEventTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_event_list(): void
    {
        // 1. Create an admin user
        $admin = User::create([
            'name' => 'Admin Amikom',
            'email' => 'admin@amikom.ac.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // 2. Create a category and event
        $category = Category::create([
            'name' => 'Seminar IT',
            'slug' => 'seminar-it',
        ]);

        $event = Event::create([
            'category_id' => $category->id,
            'title'       => 'Test Event',
            'description' => 'Test Event Description',
            'date'        => '2026-05-10 19:00:00',
            'location'    => 'Test Location',
            'price'       => 100000,
            'stock'       => 50,
            'poster_path' => null,
        ]);

        // 3. Try to access the event list as authenticated admin
        $response = $this->actingAs($admin)->get(route('admin.events.index'));
        
        $response->assertStatus(200);
        $response->assertViewIs('admin.events.index');
        $response->assertSee('Test Event');
    }
}
