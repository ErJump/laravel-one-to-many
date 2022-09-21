@extends('layouts.app')
@section('title', $post->title)

@section('content')
    <div class="container-lg">
        <div class="row">
            <div class="col-4">
                <img  class="img-fluid" src="{{$post->post_image}}" alt="{{$post->title}}">
            </div>
            <div class="col-8">
                <h2 class="mb-3">{{$post->title}}</h2>
                <p>{{$post->post_content}}</p>
                <div>
                    <span class="badge badge-secondary" style="background-color: {{$post->category->color}}">{{$post->category->name}}</span>
                </div>
                <p><strong>Author:</strong> {{$post->user->name}}</p>
                <p><strong>Post Date:</strong> {{$post->post_date}}</p>
            </div>
            <div class="col-12 text-center">
                <a href="{{route('admin.posts.edit', $post->slug)}}" class="d-inline">
                    <button type="button" class="btn btn-secondary">Edit</button>
                </a>
                <form action="{{ route('admin.posts.destroy', $post->slug)}}" method="post" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection