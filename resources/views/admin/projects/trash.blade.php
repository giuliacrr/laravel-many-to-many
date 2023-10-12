@extends('layouts.app')

@section('content')

<div class="container">
  <div class="text-danger text-center mt-5">
    <h2>Deleted Projects</h2>
  </div>

  <div>
    <div class="d-flex flex-wrap custom-style">
      @foreach($Projects as $repo)
      <div class="cardz-box position-relative mb-3 {{ request()->input("id") == $repo->slug ? 'border-success' : '' }}">
        <!--immagine-->
        <div>
          <img class="img-cardz" src="{{asset('storage/' . $repo->image)}}" alt="repoimg" />
        </div>
        <!--titolo-->
        <div>
          <div class="position-absolute hoverme justify-content-center align-items-center">
            <form action="{{ route('admin.projects.destroy', ["slug" => $repo->slug, "force" => true]) }}" method="POST" class="d-inline-block">
              @csrf
              @method("DELETE")
              <button type="submit" class="btn btn-danger">Delete permanently</button>
            </form>
            </a>
          </div>
        </div>
      </div>
      @endforeach  
    </div>
  </div>

</div>

@endsection