@extends('layouts.app')

@section('content')



<div class="border rounded bg-white mb-3">
  <div class="box-title border-bottom p-3">
    <h6 class="m-0">Edit Post</h6>

  </div>
  <div class="box-body p-3">
    <form  method="post" action="{{route('posts.update', $post->id)}}">
        @csrf
        @method('PUT')
      <div class="row">
        <div class="col-sm-12 mb-2">
          <div class="js-form-message">
            <label id="nameLabel" class="form-label"> Title <span class="text-danger">*</span>
            </label>
            <div class="form-group">
              <input type="text" class="form-control  @error('title') is-invalid @enderror" name="title" value="{{$post->title}}">
              @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
          
            </div>
          </div>
        </div>
        <div class="col-sm-12 mb-2">
          <div class="js-form-message">
            <label id="text" class="form-label"> Text (optional)</span>
            </label>
            <div class="form-group">
                <textarea class="form-control" name="text" id="" cols="30" rows="10">{{$post->text}}</textarea>
            </div>
          </div>
        </div>
      </div>


 
  </div>
</div>

<div class="mb-3 text-right">
<a class="font-weight-bold btn btn-link rounded p-3" href="#"> &nbsp;&nbsp;&nbsp;&nbsp; Cancel &nbsp;&nbsp;&nbsp;&nbsp; </a>
<button type="submit" class="font-weight-bold btn btn-primary rounded p-3"> &nbsp;&nbsp;&nbsp;&nbsp;Sava Chenges &nbsp;&nbsp;&nbsp;&nbsp;</button>

</div>
</form>

@push('scripts')
    <script src="{{ asset('design/js/forum-post.js') }}"></script>
@endpush

@endsection
