<?php

namespace Tests\Components\Jobs;

use App\Http\Requests\RegisterRequest;
use Tests\TestCase;
use App\Jobs\RegisterUser;
use App\Exceptions\CannotCreateUser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterUserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function we_can_create_a_user()
    {
        $request = new RegisterRequest(['name' => 'John Doe', 'username' => 'johndoe', 'email' => 'john@example.com','github_id' => '123','github_username' => 'johndoe','type' => 1, 'remember_token' => '']);
        $request->setContainer(app());

        $user = $this->dispatch(
            new RegisterUser($request)
        );

        $this->assertEquals('John Doe', $user->name());
    }

    /** @test */
    public function we_cannot_create_a_user_with_the_same_email_address()
    {
        $this->expectException(CannotCreateUser::class);

        $request = new RegisterRequest(['name' => 'John Doe', 'username' => 'johndoe', 'email' => 'john@example.com','github_id' => '123','github_username' => 'johndoe','type' => 1, 'remember_token' => '']);
        $request->setContainer(app());

        $this->dispatch(new RegisterUser($request));
        $request = $request->merge(['username' => 'john']);
        $this->dispatch(new RegisterUser($request));
    }

    /** @test */
    public function we_cannot_create_a_user_with_the_same_username()
    {
        $this->expectException(CannotCreateUser::class);

        $request = new RegisterRequest(['name' => 'John Doe', 'username' => 'johndoe', 'email' => 'john@example.com','github_id' => '123','github_username' => 'johndoe','type' => 1, 'remember_token' => '']);
        $request->setContainer(app());

        $this->dispatch(new RegisterUser($request));
        $request = $request->merge(['email' => 'doe@example.com']);
        $this->dispatch(new RegisterUser($request));
    }
}
