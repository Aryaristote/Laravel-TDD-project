<?php

namespace Tests\Unit;

use App\Models\User;
use Database\Seeders\UsersTableSeeder;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_example() {
        $response = $this->get('/');
        $response->assertStatus(200);
        // $this->assertTrue(true);
    }

    public function test_user_duplicaton () {
        $user1 = User::make([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
        ]);
        $user2 = User::make([
            'name' => 'Erick Iglesiastical',
            'email' => 'erickiglez@example.com',
        ]);

        $this->assertTrue($user1 != $user2);
    }

    // -------- Code delete the whole database --------
    // public function test_delete_user() {
    //     $user = User::factory()->count(1)->make();
    //     $user = User::first();

    //     if($user) {
    //         $this->delete($user);
    //     }

    //     $this->assertTrue(true);
    // }

    // Database test
    // public function test_database() {
    //     $this->assertDatabaseHas('users', [
    //         'name' => 'John doe',
    //     ]);
    // }

    //HTTP Test
    public function test_login_form() {
        $res = $this->get('/login'); // The route or API to test,
        $res->assertStatus(200);// Expect status code 200
    }

    public function test_store_new_user() {
        $res = $this->post('/register', [
            'name' => 'Clark Aint',
            'email' => 'clarkaints@gmail.com',
            'passsword' => 'Kalume@21',
            'passsword_confirmattion' => 'Kalume@21'
        ]);

        $res->assertRedirect('/');
    }
}
