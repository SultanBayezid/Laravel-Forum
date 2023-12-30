@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="card">
    <div class="card-header bg-danger text-white">{{ __('Your email is not verified !') }}</div>

    <div class="card-body">
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        {{ __('You need to verify your Email before proceeding, please check your email for a verification link.') }}
        {{ __('If you did not receive the email') }},
        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
        </form>
        
        <!-- Anchor tag for navigating back to home -->
    </div>

    <a href="{{ route('posts.index') }}" class="btn btn-link mt-3">{{ __('Back to Home') }}</a>

</div>

        </div>
    </div>
</div>
@endsection
