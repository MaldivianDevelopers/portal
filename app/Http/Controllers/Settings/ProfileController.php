<?php

namespace App\Http\Controllers\Settings;

use App\Http\Requests\Request;
use App\Models\Skill;
use Auth;
use App\Jobs\UpdateProfile;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Auth\Middleware\Authenticate;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(Authenticate::class);
    }

    public function edit()
    {
        return view('users.settings.profile');
    }

    public function update(UpdateProfileRequest $request)
    {
        $this->dispatchNow(UpdateProfile::fromRequest(Auth::user(), $request));

        $this->success('settings.updated');

        return redirect()->route('settings.profile');
    }


    public function skills()
    {
        $userSkills = (Auth::user()->skills->pluck('id'))->toArray();

        $skills = Skill::orderBy('type')->orderBy('name')->get(['id', 'name', 'type']);
        $skills = $skills->groupBy('type');

        return view('users.settings.skills', compact('userSkills', 'skills'));

    }

    public function skillsUpdate()
    {
        $skills = request('skills');

        if($skills) {
            Auth::user()->skills()->sync($skills);
        } else {
            Auth::user()->skills()->sync([]);
        }

        $this->success('settings.updated');

        return redirect()->route('settings.skills');
    }
}
