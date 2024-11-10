<x-layout>
  @if(session()->has('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

  @if(session()->has('error'))
    <div class="alert alert-danger">
      {{ session('error') }}
    </div>
  @endif

  <x-profile-header
      :user="$user" :numPosts="$numPosts" :numFollowers="$numFollowers"
      :numFollowings="$numFollowings" />

  <div class="list-group px-4">
    @forelse($followers as $follower)
      <a
          href="/profile/{{ $follower->follower->username }}"
          class="list-group-item list-group-item-action">
        <img
            src="{{ $follower->follower->avatar }}" alt="avatar"
            style="width: 32px; height: 32px; border-radius: 16px" />
        {{ $follower->follower->username }}
      </a>
    @empty
      <p>No followers yet!</p>
    @endforelse
  </div>
</x-layout>
