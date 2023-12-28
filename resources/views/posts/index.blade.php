@extends('layouts.master')
 @section('content')
 
 <div class="box shadow-sm border rounded bg-white mb-3 osahan-share-post">
  <ul class="nav  border-bottom osahan-line-tab" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
        <i class="feather-edit"></i> Post </a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
      <div class="p-3 d-flex align-items-center w-100" href="#">
        <div class="w-100">
          <form action="{{route('posts.store')}}" method="post">
            @csrf
            <div class="form-group">
              <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Title"> @error('title') <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span> @enderror
            </div>
            <div class="form-group">
              <textarea placeholder="Text (Optional)" class="form-control border-0 p-0 shadow-none" name="text" rows="5"></textarea>
            </div>
        </div>
      </div>
    </div>
  </div>
  <div class="border-top p-3 d-flex">

      <button type="submit" class="btn btn-primary btn-sm">Post </button>
    
  </div>
  </form>
</div>


<div class="box shadow-sm border rounded bg-white mb-3">
  <div class="box-title border-bottom p-3">
    <h6 class="m-0">My Posts</h6>
  </div>
  @foreach($posts as $post)
  <div class="box-body p-3 border-bottom">
    <div class="d-flex align-items-top job-item-header pb-2">
      <div class="mr-2">
        <h6 class="font-weight-bold text-dark mb-0">{{$post->title}}</h6>
        <div class="text-truncate text-primary">Spotify Inc.</div>
        <div class="small text-gray-500">{{ date('d F Y h:i A', strtotime($post->created_at)) }}</div>
      </div>
      <img class="img-fluid ml-auto mb-auto" src="{{asset('template/img/l3.png')}}" alt>
    </div>
    <p class="mb-0">{{$post->text}}</p>

    <div class="border-top p-3 d-flex align-items-center">
<div class="mr-auto">
<a href="{{ route('posts.destroy', $post->id) }}" class="text-link small"><i class="feather-message-square"></i> Commnets</a>
</div>
<div class="flex-shrink-1">
<a href="{{ route('posts.edit', $post->id) }}" class="text-link small"><i class="feather-edit"></i> Edit</a>
    <a href="{{ route('posts.destroy', $post->id) }}" class="text-link small"><i class="feather-trash"></i> Delete</a>
</div>
</div>

  </div>
  @endforeach
</div>
@endsection