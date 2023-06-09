<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{

    use RefreshDatabase;

    public function test_registered_user_login_and_redirect_successfully()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $user->password,
        ]);

        $response->assertStatus(302);
        
        $response->assertRedirect('/');
    }

    public function test_redirect_not_admin_user_from_admin_page_to_main_page()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin');

        $response->assertStatus(302);

        $response->assertRedirect('/');

    }
}
