<form action="{{ route($route, $post->slug) }}" method="POST">
    @csrf
    @method($method)
    <div class="form-group mb-2">
        <label for="title">Title</label>
        <input required name="title" type="text" class="form-control" id="title" placeholder="Enter title"
            value="{{old('title', $post->title)}}">
        @error('title')
        <div class="alert alert-danger" role="alert">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group mb-2">
        <label for="post_content">Content</label>
        <textarea name="post_content" id="post_content" cols="30" rows="10"
            class="form-control">{{old('post_content', $post->post_content)}}</textarea>
        @error('post_content')
        <div class="alert alert-danger" role="alert">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group mb-2">
        <label for="post_image">Image Url</label>
        <input required name="post_image" type="text" class="form-control" id="post_image" placeholder="Enter image url"
            value="{{old('post_image', $post->post_image)}}">
        @error('post_image')
        <div class="alert alert-danger" role="alert">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="w-100 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>