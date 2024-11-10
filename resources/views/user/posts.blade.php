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
    @foreach($posts as $post)
      <a href="/posts/{{ $post->id }}" class="list-group-item list-group-item-action">
        <img
            src="{{ $avatar }}" alt="avatar"
            style="width: 32px; height: 32px; border-radius: 16px" />
        <strong>{{ $post->title }}</strong> on {{ $post->created_at->format('d/m/Y H:i') }}
      </a>
    @endforeach
  </div>
</x-layout>
