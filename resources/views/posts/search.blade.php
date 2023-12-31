@extends('layouts.app')

@section('content')

<div class="box shadow-sm border rounded bg-white mb-3">
    <div class="box-title border-bottom p-3">
        <h6 class="m-0">SEARCH RESULTS</h6>
    </div>

    @if($posts->isEmpty())
        <p class="p-3">No results found.</p>
    @else
        @foreach($posts as $post)
            <div class="box-body p-3 border-bottom">
                <div class="d-flex align-items-top job-item-header pb-2">
                    <div class="mr-auto">
                        <h6 class="font-weight-bold text-dark mb-0"><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></h6>
                        <div class="text-truncate text-primary">{{ $post->user->name ?? '' }}</div>
                        <div class="small text-gray-500">
                            {{ date('d F Y h:i A', strtotime($post->created_at)) }}
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="small text-gray-500">
                            <span class="float-right">
                                Comments: <span class="badge badge-danger badge-counter">{{ $post->comments()->count() ?? '' }}</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

</div>

@endsection
