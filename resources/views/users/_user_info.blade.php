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

    <h2>{{ $user->name() }}</h2>



    @if($company = $user->company)
        <div>
            <h6>{{ $user->job_title }}</h6>
            <h5>
                <i class="fa fa-building-o" aria-hidden="true"></i>
                <a href="{{ route('company.members', [$company]) }}">{{ $company }}</a>
            </h5>
        </div>
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
</div>
