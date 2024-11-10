<x-layout>
  @if(session()->has('error'))
    <div class="alert alert-danger">
      {{ session('error') }}
    </div>
  @endif

  <div class="container py-md-3 container--narrow">
    <a href="/posts/{{$post->id}}" class="text-muted">Back to post</a>
  </div>

  <div class="container py-md-3 container--narrow">
    <h2 class="mb-md-5">Edit post</h2>

    <form action="/posts/{{$post->id}}" method="POST">
      @csrf
      @method('PUT')
      <div class="form-group">
        <label for="post-title" class="text-muted mb-1"><small>Title</small></label>
        <input
            name="title" id="post-title"
            class="form-control form-control-lg form-control-title" type="text"
            placeholder="" value="{{old('title') ?? $post->title}}" autocomplete="off" />
        @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group mb-4">
        <label for="post-body" class="text-muted mb-1"><small>Body Content</small></label>
        <textarea
            name="body" id="post-body"
            class="body-content tall-textarea form-control">{{old('body') ?? $post->body}}</textarea>
        @error('body')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>

      <button class="btn btn-primary">Save Post</button>
    </form>
  </div>
</x-layout>
