<x-layout>
  @if(session()->has('error'))
    <div class="alert alert-danger">
      {{ session('error') }}
    </div>
  @endif

  <div class="container py-md-3 container--narrow">
    <h2 class="mb-md-5">Create new post</h2>

    <form action="/posts/create" method="POST">
      @csrf
      <div class="form-group">
        <label for="post-title" class="text-muted mb-1"><small>Title</small></label>
        <input
            name="title" id="post-title"
            class="form-control form-control-lg form-control-title" type="text"
            placeholder="" value="{{old('title')}}" autocomplete="off" />
        @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="post-body" class="text-muted mb-1"><small>Body Content</small></label>
        <textarea
            name="body" id="post-body"
            class="body-content tall-textarea form-control">
          {{old('body')}}
        </textarea>
        @error('body')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>

      <button class="btn btn-primary">Save New Post</button>
    </form>
  </div>
</x-layout>
