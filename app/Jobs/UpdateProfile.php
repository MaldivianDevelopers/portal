<?php

namespace App\Jobs;

use App\User;
use App\Http\Requests\UpdateProfileRequest;

final class UpdateProfile
{
    /**
     * @var \App\User
     */
    private $user;

    /**
     * @var array
     */
    private $attributes;

    public function __construct(User $user, array $attributes = [])
    {
        $this->user = $user;
        $this->attributes = array_only($attributes, ['name', 'email', 'username', 'github_username', 'bio', 'company', 'job_title', 'list_on_public_directory', 'mobile', 'keep_mobile_private', 'twitter_username', 'profile_type']);
    }

    public static function fromRequest(User $user, UpdateProfileRequest $request): self
    {
        return new static($user, [
            'name' => $request->name(),
            'email' => $request->email(),
            'username' => strtolower($request->username()),
            'bio' => trim(strip_tags($request->bio())),
            'company' => trim(strip_tags($request->company())),
            'job_title' => trim(strip_tags($request->jobTitle())),
            'list_on_public_directory' => $request->listOnPublicDirectory(),
            'mobile' => trim(strip_tags($request->mobile())),
            'keep_mobile_private' => $request->mobileKepPrivately(),
            'twitter_username' => trim(strip_tags($request->twitterUsername())),
            'profile_type' => trim(strip_tags($request->profileType())),
        ]);
    }

    public function handle(): User
    {
        $this->user->update($this->attributes);

        return $this->user;
    }
}
