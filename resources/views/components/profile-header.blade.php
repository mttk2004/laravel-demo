<div class="container py-md-5 container--narrow">
  <h2>
    <img
        src="{{ $user->avatar }}" alt="avatar"
        style="width: 32px; height: 32px; border-radius: 16px" />
    {{ $user->username }}
    @can('update', $user)
      <a href="/profile/{{ auth()->user()->username }}/edit" class="btn btn-sm btn-secondary">
        Edit your avatar
      </a>
    @endcan

    @if(auth()->user()->id !== $user->id)
      <form
          class="ml-2 d-inline"
          action="{{ $user->followers->contains(fn($follower) => $follower->user_id === auth()->user()->id) ? '/unfollow/' . $user->username : '/follow/' . $user->username }}"
          method="POST">
        @csrf
        @if($user->followers->contains(fn($follower) => $follower->user_id === auth()->user()->id))
          @method('DELETE')
          <button class="btn btn-danger btn-sm">Unfollowing <i class="fas fa-user-times"></i>
          </button>
        @else
          <button class="btn btn-primary btn-sm">Follow <i class="fas fa-user-plus"></i></button>
        @endif
      </form>
    @endif
  </h2>

  <div class="profile-nav nav nav-tabs pt-2 mb-4">
    <a
        href="/profile/{{ $user->username }}/posts"
        class="profile-nav-link nav-item nav-link {{ url()->current() === url('/profile/' . $user->username . '/posts') ? 'active' : '' }}">Posts: {{ $numPosts }}</a>
    <a
        href="/profile/{{ $user->username }}/followers"
        class="profile-nav-link nav-item nav-link {{ url()->current() === url('/profile/' . $user->username . '/followers') ? 'active' : '' }}">Followers: {{ $numFollowers }}</a>
    <a
        href="/profile/{{ $user->username }}/following"
        class="profile-nav-link nav-item nav-link {{ url()->current() === url('/profile/' . $user->username . '/following') ? 'active' : '' }}">Following: {{ $numFollowings }}</a>
  </div>
</div>
