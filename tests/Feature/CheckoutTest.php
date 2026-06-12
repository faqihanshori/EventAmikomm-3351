<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Category;
use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_view_checkout_form(): void
    {
        $category = Category::create([
            'name' => 'Seminar IT',
            'slug' => 'seminar-it',
        ]);

        $event = Event::create([
            'category_id' => $category->id,
            'title'       => 'Test Event',
            'description' => 'Test Description',
            'date'        => '2026-05-10 19:00:00',
            'location'    => 'Test Location',
            'price'       => 100000,
            'stock'       => 50,
        ]);

        $response = $this->get(route('checkout.create', $event->id));

        $response->assertStatus(200);
        $response->assertViewIs('checkout.create');
        $response->assertSee('Test Event');
    }

    public function test_guest_can_store_checkout_transaction(): void
    {
        $category = Category::create([
            'name' => 'Seminar IT',
            'slug' => 'seminar-it',
        ]);

        $event = Event::create([
            'category_id' => $category->id,
            'title'       => 'Test Event',
            'description' => 'Test Description',
            'date'        => '2026-05-10 19:00:00',
            'location'    => 'Test Location',
            'price'       => 100000,
            'stock'       => 50,
        ]);

        $response = $this->post(route('checkout.store', $event->id), [
            'customer_name'  => 'John Doe',
            'customer_email' => 'john@example.com',
            'customer_phone' => '081234567890',
        ]);

        // Asserts redirect to home as per store() method redirection
        $response->assertRedirect('/');

        // Asserts transaction was recorded in the database
        $this->assertDatabaseHas('transactions', [
            'event_id'       => $event->id,
            'customer_name'  => 'John Doe',
            'customer_email' => 'john@example.com',
            'customer_phone' => '081234567890',
            'total_price'    => 105000, // 100000 price + 5000 admin fee
            'status'         => 'Pending',
        ]);
    }

    public function test_guest_cannot_checkout_when_out_of_stock(): void
    {
        $category = Category::create([
            'name' => 'Seminar IT',
            'slug' => 'seminar-it',
        ]);

        $event = Event::create([
            'category_id' => $category->id,
            'title'       => 'Sold Out Event',
            'description' => 'Test Description',
            'date'        => '2026-05-10 19:00:00',
            'location'    => 'Test Location',
            'price'       => 100000,
            'stock'       => 0, // Out of stock
        ]);

        $response = $this->post(route('checkout.store', $event->id), [
            'customer_name'  => 'John Doe',
            'customer_email' => 'john@example.com',
            'customer_phone' => '081234567890',
        ]);

        $response->assertSessionHas('error', 'Mohon maaf, tiket untuk acara ini sudah habis.');
        $this->assertDatabaseCount('transactions', 0);
    }

    public function test_admin_can_access_transactions_list(): void
    {
        // Create admin
        $admin = User::create([
            'name' => 'Admin Amikom',
            'email' => 'admin@amikom.ac.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $category = Category::create([
            'name' => 'Seminar IT',
            'slug' => 'seminar-it',
        ]);

        $event = Event::create([
            'category_id' => $category->id,
            'title'       => 'Test Event',
            'description' => 'Test Description',
            'date'        => '2026-05-10 19:00:00',
            'location'    => 'Test Location',
            'price'       => 100000,
            'stock'       => 50,
        ]);

        // Create transaction
        $transaction = Transaction::create([
            'event_id'       => $event->id,
            'order_id'       => 'TRX-123456',
            'customer_name'  => 'Jane Doe',
            'customer_email' => 'jane@example.com',
            'customer_phone' => '081234567891',
            'total_price'    => 105000,
            'status'         => 'Pending',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.transactions.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.transactions.index');
        $response->assertSee('TRX-123456');
        $response->assertSee('Jane Doe');
    }
}
