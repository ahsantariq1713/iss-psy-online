@extends('layouts.auth')
@section('content')
<style>
    body, .auth{
        background-color: white!important
    }
</style>
<div class="auth-form auth-form-reflow mt-5 text-center">
    @if($status == 'success')
    <h1 class="h3">Booking Successful</h1>
    <img src="{{ asset('assets/images/site/success.gif')}}" height="150">
    <p class="text-muted">Your appointment has been scheduled</p>
    <p>Your therapist will be available on {{$date->format('d M, Y h:i A')}} with respect to your time. we will send you email
        notification 24 hours before your appointment is going to be
        held.</p>
    <a class="lead" href="/dashboard"><span class="mdi mdi-arrow-left"></span> go back to
        Dashboard</a>
    @else
    <h1 class="h3 text-danger">Booking Failed!</h1>
    <span class="mdi mdi-close-cricle text-danger" height="150"></span>
    <p class=" text-muted">Your appointment booking was failed due to payment processing error. Please contact us if you need any help.</p>
    <div class="w-100 text-center">
        <a class="lead" href="/"><span class="mdi mdi-arrow-left"></span> go back to
            Home</a>
    </div>
    @endif
</div>
@endsection
