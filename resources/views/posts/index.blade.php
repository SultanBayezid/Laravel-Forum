@extends('layouts.app')

@section('content')
    @if(Auth::check())
        <div class="box shadow-sm border rounded bg-white mb-3 osahan-share-post">
            <ul class="nav  border-bottom osahan-line-tab" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                        <i class="feather-edit"></i> Create a new post
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="p-3 d-flex align-items-center w-100" href="#">
                        <div class="w-100">
                            <form action="{{route('posts.store')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Title">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <textarea placeholder="Text (Optional)" class="form-control" name="text" rows="5"></textarea>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-top p-3 d-flex">
                <button type="submit" class="btn btn-primary btn-sm">Create Post</button>
            </div>
            </form>
        </div>
    @endif

    <div class="box shadow-sm border rounded bg-white mb-3">
        <div class="box-title border-bottom p-3">
            <h6 class="m-0">Posts</h6>
        </div>
        @foreach($posts as $post)
            <div class="box-body p-3 border-bottom">
                <div class="d-flex align-items-top job-item-header pb-2">
                    <div class="mr-2">
                        <h6 class="font-weight-bold text-dark mb-0"><a href="{{route('posts.show', $post->id)}}">{{$post->title}}</a></h6>
                        <div class="text-truncate text-primary">{{$post->user->name ?? ''}}</div>
                        <div class="small text-gray-500">{{ date('d F Y h:i A', strtotime($post->created_at)) }}</div>
                    </div>
                </div>
                <p class="mb-2">{{ Str::limit($post->text, 280) }}</p>
                <div class="border-top p-3 d-flex align-items-center">
                    <div class="mr-auto">
                        <a href="{{ route('posts.destroy', $post->id) }}" class="btn-link btn">
                         Comments     <span class="badge badge-danger badge-counter">{{$post->comments()->count() ?? ''}}</span>
                        </a>
                    </div>
                    @if(auth()->check() && $post->user_id == auth()->user()->id)
                        <div class="flex-shrink-1">
                            <a href="#" class="btn-link btn edit-post" 
                                data-postid="{{ $post->id }}" 
                                data-title="{{ $post->title }}" 
                                data-text="{{ $post->text }}">
                                <i class="feather-edit"></i> Edit
                            </a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn-link btn" type="submit"  onclick="return confirm('Are you sure you want to delete this post?')">
                                    <i class="feather-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal -->
    <div class="modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form to edit the post -->
                    <form id="editPostForm" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <!-- Title Input -->
                        <div class="form-group">
                            <label for="editTitle">Title</label>
                            <input type="text" class="form-control" id="editTitle" name="title">
                            <div class="calert" id="titleError"></div>
                        </div>
                        <!-- Text Input -->
                        <div class="form-group">
                            <label for="editText">Text</label>
                            <textarea class="form-control" id="editText" name="text" rows="3"></textarea>
                           
                        </div>
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@push('scripts')
    <script src="{{ asset('design/js/forum-post.js') }}"></script>
@endpush

@endsection
