@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="blog-card padding-card box shadow-sm rounded bg-white mb-3 border-0">
                <div class="card-body">
                    <h4>{{$post->title}}</h4>
                    <p class="mb-3">
                    Posted by <span class="green small "><i class="feather-user"></i>  {{$post->user->name ?? ''}} </span>  <span class="small"> <i class="feather-calendar"></i> {{ date('d F Y h:i A', strtotime($post->created_at)) }} / {{$post->comments()->count() ?? ''}} Comments</span>
</p>
                    <p> {{$post->text}}</p>
                </div>

                <div class="padding-card reviews-card box shadow-sm rounded bg-white mb-3 border-0">
                    <div class="card-body">
                        <div class="padding-card box shadow-sm rounded bg-white mb-3 border-0">
                                <h5 class="card-title mb-4">Leave a Comment</h5>
                                @if(Auth::check())
                                <!-- Comment form for authenticated users -->
                                <form method="post" action="{{ route('comments.store') }}">
                                    @csrf
                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <label>Comment as <span class="text-danger">{{ Auth::user()->name }}</span></label>
                                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                                            <textarea rows="5" cols="100" name="comment" class="form-control @error('comment') is-invalid @enderror"></textarea>
                                            @error('comment')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Comment</button>
                                </form>
                                @else
                                <!-- Info text and Login/Register links for non-authenticated users -->
                                <div class="alert alert-info">
                                    Please <a href="{{ route('login') }}">login</a> or <a href="{{ route('register') }}">register</a> to make a comment.
                                </div>
                                @endif
                
                        </div>
                        @foreach($post->comments as $comment)
                        <div class="media mb-4">
                        <div class="rounded-circle d-flex mr-3" style="width: 50px; height: 50px; background-color: #e9ecef; justify-content: center; align-items: center;">
                            <span style="font-size: 20px; color: #495057;">{{ strtoupper(substr($comment->user->name, 0, 1)) }}</span>
                        </div>

                            <div class="media-body">
                                <h5 class="mt-0">{{ $comment->user->name }} <small>{{ date('d F Y h:i A', strtotime($comment->created_at)) }}</small>
                                
                                <div class="btn-group float-right">
                                    @if(auth()->check() && $comment->user_id === auth()->user()->id)
                                    <a href="#" class="btn btn-link edit-comment" data-commentid="{{ $comment->id }}" data-text="{{ $comment->comment }}">Edit</a>
                                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button  class="btn btn-link" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                    @endif
                                </div>
                                
                                </h5>
                                <p>{{ $comment->comment }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Structure -->
<div class="modal" id="editCommentModal" tabindex="-1" role="dialog" aria-labelledby="editCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCommentModalLabel">Edit Comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form to edit the comment -->
                <form id="editCommentForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="editCommentText">Comment</label>
                        <textarea class="form-control" id="editCommentText" name="comment" rows="3"></textarea>
                        <div class="calert"  id="commentError"></div>
                    </div>
                    <!-- Submit Button -->
                    <button type="button" class="btn btn-primary" id="submitCommentBtn">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>





@push('scripts')
    <script src="{{ asset('design/js/forum-comment.js') }}"></script>
@endpush

@endsection
