<div class="profile-user-info">
    @can(App\Policies\UserPolicy::ADMIN, App\User::class)
        <a href="{{ route('admin.users.show', $user->username()) }}">
            <img class="img-circle" src="{{ $user->gravatarUrl($avatarSize ?? 150) }}">
        </a>
    @else
        <a href="{{ route('profile', $user->username()) }}">
            <img class="img-circle" src="{{ $user->gravatarUrl($avatarSize ?? 150) }}">
        </a>
    @endcan

    <h2>{{ $user->name() }} 
    @if($user->confirmed)
        <i class="fa fa-check-circle text-success" aria-hidden="true"></i>
    @endif
    </h2>


    @if($user->profile_type === 'professional')
        @if($company = $user->company)
            <div>
                <h6>{{ $user->job_title }}</h6>
                <h5>
                    <i class="fa fa-building-o" aria-hidden="true"></i>
                    <a href="{{ route('company.members', [$company]) }}">{{ $company }}</a>
                </h5>
            </div>
        @endif
    @endif

    @auth
        @if(!$user->keep_mobile_private && !empty($user->mobile))
            <div>
                <i class="fa fa-mobile" aria-hidden="true"></i>
                <a href="tel:{{ str_replace(' ', '', $user->mobile) }}">
                    {{ $user->mobile }}
                </a>
            </div>
        @endif
    @endauth


    @if ($bio = $user->bio())
        <p class="profile-user-bio">
            {{ $bio }}
        </p>
    @endif

    @auth
        @if ($user->isAdmin())
            <p><span class="label label-primary">Admin</span></p>
        @elseif ($user->isModerator())
            <p><span class="label label-primary">Moderator</span></p>
        @endif

    @endauth


    <div class="profile-social-icons">
        @if ($user->githubUsername())
            <a href="https://github.com/{{ $user->githubUsername() }}">
                <i class="fa fa-github"></i>
            </a>
        @endif

        @if ($user->twitterUsername())
            <a href="https://twitter.com/{{ $user->twitterUsername() }}">
                <i class="fa fa-twitter"></i>
            </a>
        @endif
    </div>


        @if($user->skills->count() > 0)
            <div class="user-skills">
                @foreach($user->skills as $skill)
                    <span class="label label-primary">{{ $skill->name }}</span>
                @endforeach
            </div>
        @elseif(Auth::check() && Auth::user()->id === $user->id)
            @auth
            <div>
                <a  class="btn btn-sm btn-warning" href="{{ route('settings.skills') }}">You have not updated your skills, pleaseclick here to update note.</a>
            </div>
            @endauth
        @endif

</div>
