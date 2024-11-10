<x-layout>
  @if (session()->has('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="container">
    <h2>Edit Avatar</h2>
    <form
        action="/profile/{{ auth()->user()->username }}" method="POST"
        enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="form-group">
        <input type="file" name="avatar" class="form-control-file" required>
        @error('avatar')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>
      <button type="submit" class="btn btn-primary">Upload</button>
    </form>
  </div>
</x-layout>
