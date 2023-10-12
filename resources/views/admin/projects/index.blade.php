@extends('layouts.app')

@section('content')
<div>
  <div class="container">
    <div class="mb-5">
      <h1 class="text-center secondaryc-text mt-5">Your Projects</h1>
      <div class="mt-5 custom-style d-flex flex-wrap flex-column-reverse"> 
        @foreach($projects as $repo)
        <div class="card mb-3 card-index transp-bg" style="width:100%;">
          <div class="row g-0 transp-bg rounded">
            <div class="col-md-4">
              <img src="{{asset('storage/' . $repo->image)}}" class="img-fluid rounded-start repo-img" alt="...">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h4 class="card-title primaryc-text fw-bold">{{$repo['name']}}</h4>
                <p class="text-white"><span class="fw-bold primaryc-text">Type:</span > @if($repo->type) {{$repo->type->name}}@else Out of topic @endif</p>
                <p class="card-text mt-5"><small class="text-body-secondary">{{$repo['publication_time']->format("d/m/Y")}}</small></p>
                <div class="d-flex align-items-center">
                  <!--Show + delete + edit -->
                  <div class="d-flex mt-5">
                    <a href="{{ route('admin.projects.show', $repo['slug']) }}"><button class="btn primaryc-btn text-white me-2">Show more</button></a>
                    <a href="{{ route('admin.projects.edit', $repo->slug) }}" class="btn secondaryc-btn me-2 text-white"><i class="fa-regular fa-pen-to-square"></i></a>
                    <form action="{{ route('admin.projects.destroy', $repo->slug) }}" method="POST">
                      @csrf
                      @method("DELETE")
                      <button type="submit" class="btn thirdc-btn text-white"><i class="fa-regular fa-trash-can"></i></button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach 
        <div class="text-center mb-5 mt-5">
          <a class="nav-link" href="/admin/projects/create">
          <button class="add-btn fw-bold text-white btn secondaryc-btn" type="button">
            <i class="fa-solid fa-plus"></i>
          </button></a>
          <p class="secondaryc-text">Add a project</p>
        </div> 
      </div>
    </div>
  </div>
</div>

@endsection