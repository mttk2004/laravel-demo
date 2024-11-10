<x-layout>
  {{-- If there is a success message in the session, display it --}}
  @if(session()->has('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @elseif(session()->has('error'))
    <div class="alert alert-danger">
      {{ session('error') }}
    </div>
  @endif

  <div class="container py-md-5 container--narrow">
    <div class="d-flex justify-content-between">
      <h2>{{ $post->title }}</h2>
      <span class="pt-2">
      @can('update', $post)
          <a
              href="/posts/{{$post->id}}/edit" class="text-primary mr-2" data-toggle="tooltip"
              data-placement="top"
              title="Edit"><i class="fas fa-edit"></i></a>
        @endcan
        @can('delete', $post)
          <form class="delete-post-form d-inline" action="/posts/{{$post->id}}" method="POST">
            @csrf
            @method('DELETE')
            <button
                class="delete-post-button text-danger" data-toggle="tooltip" data-placement="top"
                title="Delete"><i class="fas fa-trash"></i></button>
          </form>
        @endcan
        </span>
    </div>

    <p class="text-muted small mb-4">
      <a href="/profile/{{ $post->user->username }}" class="mr-2"><img
            title="See {{$post->user->username}} profile" data-toggle="tooltip"
            data-placement="bottom"
            style="width: 32px; height: 32px; border-radius: 16px"
            src="{{$post->user->avatar}}"
            alt="avatar" /></a>
      Posted by <a href="/profile/{{$post->user->username}}">{{ $post->user->username }}</a> on {{
      $post->created_at->format
      ('d/m/y H:i') }}
    </p>

    <div class="body-content">
      {!! $post->body !!}
    </div>
  </div>
</x-layout>
