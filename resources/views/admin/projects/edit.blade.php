@extends('layouts.app')
@section("title", "Laravel - Modify Project")
@section('content')
<div class="container mt-5 mb-5">
  <h2 class="secondaryc-text">You entered edit mode.</h2>
  <form class="mt-3 transp-bg p-3 rounded" action="{{ route('admin.projects.update', $project->slug) }}" method="POST" enctype="multipart/form-data">
    @csrf()
    @method('PUT')
    <!--Project name-->
    <div class="mb-3">
      <label class="form-label secondaryc-text fw-bold">Name:</label>
      <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('name', $project->name) }}" name="name" >
      @error('name')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <!--Project Description-->
    <div class="mb-3">
      <label class="form-label secondaryc-text fw-bold">Description & Type:</label>
      <textarea class="form-control @error('description') is-invalid @enderror" name="description">{{old('description', $project->description)}}</textarea>
      @error('description')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <!--Project type-->
    <div class="mb-3">
      <select class="form-select @error('type_id') is-invalid @enderror" aria-label="Choose a type" name="type_id">
        @foreach ($types as $type)
        <option value="{{$type->id}}" {{$project?->type_id === $type->id ? 'selected' : ''}}>{{$type->name}}</option>
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
          <input class="form-check-input" type="checkbox" name="techs[]" id="{{$tech->name}}" value="{{$tech->id}}" {{ $project->technologies?->contains($tech) ? 'checked' : '' }}>
          <label class="form-check-label secondaryc-text" for="{{$tech->name}}">{{$tech->name}}</label>
        </div>
        @endforeach
      </div>
    </div>
    <!--Project image-->
    <div class="mb-3">
        <div>
          <label class="form-label secondaryc-text fw-bold">Image</label>
          <img src="{{ asset('/storage/'. $project->image)}}" style="width: 250px" class="d-block mb-2">
          <input type="file" accept="image/*" class="form-control @error('image') is-invalid @enderror" name="image">
        </div>
      @error('image')
      <div class="invalid-feedback">{{$message}}</div>
      @enderror
    </div>
    <!--Project url-->
    <div class="mb-3">
      <label class="form-label secondaryc-text fw-bold">Link:</label>
      <input type="text" class="form-control @error('url') is-invalid @enderror" value="{{ old('url', $project->url) }}" name="url">
      @error('url')
      <div class="invalid-feedback">You must link the project's repository.</div>
      @enderror
    </div>
    <!--Project publication date-->
    <div class="mb-3">
      <div class="date-row">
        <label for="inputDate" class="form-label secondaryc-text fw-bold">Publication:</label>
        <input type="date" class="form-control @error('date') is-invalid @enderror" id="inputDate" name="publication_time" value="{{ old('publication_time', $project?->publication_time->format('Y-m-d')) }}">
        @error('date')
            <div class="invalid_feedback">{{ $message }}</div>
        @enderror
      </div>
    </div>

    <div class="text-center">
      <a class="btn primaryc-btn  btn-secondary" href="{{ route("admin.projects.index") }}">Cancel</a>
      <button class="btn secondaryc-btn text-white">Save Changes</button>
    </div>
  </form>
</div>
@endsection