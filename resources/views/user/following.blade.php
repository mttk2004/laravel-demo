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
    @forelse($following as $fl)
      <a
          href="/profile/{{ $fl->followedUser->username }}"
          class="list-group-item list-group-item-action">
        <img
            src="{{ $fl->followedUser->avatar }}" alt="avatar"
            style="width: 32px; height: 32px; border-radius: 16px" />
        {{ $fl->followedUser->username }}
      </a>
    @empty
      <div class="list-group-item">No following yet.</div>
    @endforelse
  </div>
</x-layout>
