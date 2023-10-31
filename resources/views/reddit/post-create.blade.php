@extends('layouts.app')

@section('content')
    <h1>Create Reddit Post</h1>
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form method="POST" action="/create-reddit-post">
        @csrf
        <div class="form-group">
            <label for="title">Post Title</label>
            <input type="text" name="title" id="title" class="form-control">
        </div>
        <div class="form-group">
            <label for="content">Post Content</label>
            <textarea name="content" id="content" class="form-control" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
</div>
