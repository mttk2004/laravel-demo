<x-layout>
  @if(session()->has('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="container py-md-5 container--narrow">
    <div class="text-center">
      @if($feedPosts->isNotEmpty())
        <h2>Your feed</h2>
        <div class="row">
          @foreach($feedPosts as $post)
            <div class="col-md-6">
              <div class="card mb-4">
                <div class="card-header">
                  <a href="/profile/{{ $post->user->username }}">
                    <img
                        src="{{ $post->user->avatar }}" alt="{{ $post->user->username }}"
                        class="rounded-circle" width="24" height="24">
                    {{ $post->user->username }}
                  </a>
                </div>
                <div class="card-body">
                  <h5 class="card-title">{{ $post->title }}</h5>
                  <a href="/posts/{{ $post->id }}" class="btn btn-primary">Read more</a>
                </div>
              </div>
            </div>
          @endforeach
          {{ $feedPosts->links() }}
        </div>
      @else
        <h2>Hello <strong>{{ auth()->user()->username }}</strong>, your feed is empty.</h2>
        <p class="lead text-muted">Your feed displays the latest posts from the people you follow.
                                   If you don&rsquo;t have any friends to follow that&rsquo;s
                                   okay; you can use the &ldquo;Search&rdquo; feature in the
                                   top menu bar to find content written by people with similar
                                   interests and then follow them.</p>
      @endif
    </div>
  </div>
</x-layout>
