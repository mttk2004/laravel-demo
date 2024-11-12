<x-layout>
  {{-- Display all posts from controller --}}
  <div class="container py-md-5 container--narrow">
    <h2>Posts</h2>
    @foreach($posts as $post)
      <div class="card mb-4">
        <div class="card-body">
          <h5 class="card-title">{{ $post->title }}</h5>
          <p class="text-muted mb-2">
            <a href="/profile/{{ $post->user->username }}" class="mr-2"><img
                  title="See {{$post->user->username}} profile" data-toggle="tooltip"
                  data-placement="bottom"
                  style="width: 32px; height: 32px; border-radius: 16px"
                  src="{{$post->user->avatar}}"
                  alt="avatar" /></a>
            Posted by <a href="/profile/{{ $post->user->username }}">{{ $post->user->username }}</a>
            on {{
            $post->created_at->format('d/m/Y H:i') }}
          </p>
          <p class="card-text">{{ $post->excerpt }}</p>
          <a href="/posts/{{ $post->id }}" class="btn btn-primary">Read more</a>
        </div>
      </div>
    @endforeach
    {{ $posts->links() }}
  </div>
</x-layout>
