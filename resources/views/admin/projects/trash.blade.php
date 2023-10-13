@extends('layouts.app')

@section('content')

<div class="container">
  <div class="secondaryc-text text-center mt-5">
    <h2>Deleted Projects</h2>
  </div>

  <div>
    <div class="d-flex flex-wrap custom-style">
      @foreach($projects as $repo)
      <div class="cardz-box position-relative mb-3 {{ request()->input("id") == $repo->slug ? 'border-success' : '' }}">
        <!--immagine-->
        <div>
          <img class="img-fluid rounded-start repo-img" style="width:300px" src="{{asset('storage/' . $repo->image)}}" alt="repoimg" />
        </div>
        <!--titolo-->
        <div>
          <!--Perchè mi da problema con il forceDelete riga 135 di  ProjectController?-->
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