@extends('admin.layouts.layoutsHome.app')

@section('content')


    <div class="main p-3">
        
        
                <h1>Home : {{Auth::guard('admin')->user()->name}}</h1>
         
      
    </div>


@endsection