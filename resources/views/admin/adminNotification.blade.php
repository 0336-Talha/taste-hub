@extends('admin.layouts.layoutsHome.app')

@section('content')
<div class="main p-3">
    
    <h1 style="text-align: center;">Notifications</h1>

    
    <!-- Notification List -->
    <div class="list-group">

        <!-- Notification Item -->
        @foreach ($noti as $noti)
            
       
        <a href="#" style="{{ $noti->is_read==0 ? 'color:black' : ' color:gray' }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
            <div>
                {{-- <img src="{{asset($noti->photo)}}" style="" alt="hi"> --}}
                <img src="{{asset($noti->photo)}}" alt="User Image" class="rounded-circle mr-3" width="50" height="50">
                <strong>{{$noti->type}}</strong> – {{$noti->message}}
                <small class="d-block text-muted text-start" style="margin-left:50px;">
                    {{ \Carbon\Carbon::parse($noti->created_at)->diffForHumans() }}
                </small>
            </div>
            <span class="badge badge-primary badge-pill">New</span>
        </a>
        @endforeach

        <!-- Another Notification Item -->
        {{-- <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
            <div>
                <strong>Stock Alert</strong> – Product B is now out of stock.
                <small class="d-block text-muted">10 minutes ago</small>
            </div>
            <span class="badge badge-warning badge-pill">Alert</span>
        </a>

        <!-- Another Notification Item -->
        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
            <div>
                <strong>New Message</strong> – You have a message from Admin.
                <small class="d-block text-muted">30 minutes ago</small>
            </div>
            <span class="badge badge-info badge-pill">Message</span>
        </a> --}}

    </div>
</div>

</div>
<br>



@endsection


@section('script')
@endsection