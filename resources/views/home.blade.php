{{-- @if(Auth::user()->id != Null)
{{-- Redirect if user is authenticated --}}
{{-- @php
    return redirect()->back();
@endphp --}}

{{-- {{ Redirect::to('/account') }} --}}
{{-- @endif --}} --}}



@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card"> 
                helloooooo
                <div class="card-header">{{ __('Dashboard') }}</div> 

               <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                           </div>
                    @endif

                    {{ __('You are logged in!')}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
