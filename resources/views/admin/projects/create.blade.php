@extends('layouts.app')
@section("title", "Laravel - Add a Project")
@section('content')
<div class="container mt-5">
  <h2>Add a project!</h2>
  <form class="mt-5 transp-bg p-3 rounded" action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
    @csrf()

    <!--Project name-->
    <div class="mb-3">
      <label class="form-label fw-bold secondaryc-text">Name:</label>
      <input type="text" class="form-control @error('title') is-invalid @enderror" name="name">
      @error('name')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <!--Project Description-->
    <div class="mb-3">
      <label class="form-label fw-bold secondaryc-text">Description & Type:</label>
      <textarea class="form-control @error('description') is-invalid @enderror" name="description"></textarea>
      @error('description')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <!--Project type-->
    <div class="mb-3">
      <select class="form-select @error('type_id') is-invalid @enderror" aria-label="Choose a type" name="type_id">
        <option selected> Choose a Type </option>
        @foreach ($types as $type)
        <option value="{{$type->id}}">{{$type->name}}</option>
        @endforeach
      </select>
        @error('type_id')
        <div class="invalid_feedback">{{ $message }}.</div>
        @enderror
    </div>
    <!--Project image-->
    <div class="mb-3">
      <label class="form-label secondaryc-text fw-bold">Image:</label>
      <input type="file" accept="image/*" class="form-control @error('image') is-invalid @enderror" name="image">
      @error('image')
      <div class="invalid-feedback">{{$message}}</div>
      @enderror
    </div>
    <!--Project url-->
    <div class="mb-3">
      <label class="form-label fw-bold secondaryc-text">Link:</label>
      <input type="text" class="form-control @error('url') is-invalid @enderror" name="url">
      @error('url')
      <div class="invalid-feedback">You must link the project's repository.</div>
      @enderror
    </div>
    <!--Project publication date-->
    <div class="mb-3">
      <label class="form-label fw-bold secondaryc-text">Creation Date:</label>
      <input type="text" class="form-control @error('date') is-invalid @enderror" name="publication_time">
      @error('date')
            <div class="invalid_feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="text-center">
      <a class="btn thirdc-btn text-white" href="{{ route("admin.projects.index") }}">Cancel</a>
      <button class="btn btn-danger ms-2">Save</button>
    </div>
  </form>
</div>
@endsection