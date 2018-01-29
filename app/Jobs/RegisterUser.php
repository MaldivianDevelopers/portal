<?php

namespace App\Jobs;

use App\User;
use App\Exceptions\CannotCreateUser;
use App\Http\Requests\RegisterRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class RegisterUser
{

    protected $request;

    public function __construct(RegisterRequest $request)
    {
        $this->request = $request;
    }

    public static function fromRequest(RegisterRequest $request): self
    {
        return new static($request);
    }

    public function handle(): User
    {
        $this->assertEmailAddressIsUnique($this->request->get('email'));
        $this->assertUsernameIsUnique($this->request->get('username'));

        $user = new User($this->request->validated());
        $user->confirmation_code = str_random(60);
        $user->type = User::DEFAULT;
        $user->remember_token = '';
        $user->ip = $this->request->ip();
        $user->save();

        return $user;
    }

    private function assertEmailAddressIsUnique(string $emailAddress)
    {
        try {
            User::findByEmailAddress($emailAddress);
        } catch (ModelNotFoundException $exception) {
            return true;
        }

        throw CannotCreateUser::duplicateEmailAddress($emailAddress);
    }

    private function assertUsernameIsUnique(string $username)
    {
        try {
            User::findByUsername($username);
        } catch (ModelNotFoundException $exception) {
            return true;
        }

        throw CannotCreateUser::duplicateUsername($username);
    }
}
