@extends('layouts.app')
@section("title", "Laravel - Add a Project")
@section('content')
<div class="container mt-5">
  <h2 class="secondaryc-text text-center">Add a project!</h2>
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
    <!--Project Tech-->
    <div class="mb-3">
      <label class="form-label fw-bold secondaryc-text">Tags</label>
      <div>
        @foreach ($techs as $tech)
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="techs[]" id="{{$tech->name}}" value="{{$tech->id}}">
          <label class="form-check-label secondaryc-text" for="{{$tech->name}}">{{$tech->name}}</label>
        </div>
        @endforeach
      </div>
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
      <div class="date-row">
        <label for="inputDate" class="form-label fw-bold secondaryc-text">Publication:</label>
        <input type="date" class="form-control @error('date') is-invalid @enderror" id="inputDate" name="publication_time">
        @error('date')
            <div class="invalid_feedback">{{ $message }}</div>
        @enderror
      </div>
    </div>

    <div class="text-center">
      <a class="btn primaryc-btn text-white" href="{{ route("admin.projects.index") }}">Cancel</a>
      <button class="btn secondaryc-btn text-white ms-2">Save</button>
    </div>
  </form>
</div>
@endsection