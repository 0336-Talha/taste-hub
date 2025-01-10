@extends('admin.layouts.layoutsHome.app')

@section('content')
<div class="main p-3">
        
    <h1 style="text-align: center;">Admin All Orders</h1>
    



    
    <div class="container mt-5">
        <h2>Orders Product Table</h2>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Orderer Image</th>
                    <th>Orderer Name</th>
                    <th>Product Name</th>
               
                    <th>Price</th>
                    <th>Date</th>
                 
                    <th>Operation</th>

                </tr>
            </thead>
            <tbody>
                @foreach($order as $ord)
                <tr>
                <td><img src="{{asset($ord->orderMaker->photo)}}" style="height: 50px; width:50px;" alt="img"></td>
                <td>{{$ord->orderMaker->accountUser->name}}</td>

                
                {{-- {{$item->product}} --}}

                <td>
                   
                        
                @foreach($ord->items as $id=>$item)
                <ol>
                {{$id+1}} : {{ optional($item->product)->title }}
                : {{ optional($item)->qty }}

            </ol>
                @endforeach
               
            </td>

            <td>
                   
                        
                @foreach($ord->items as $id=>$item)
                <ol>
                : {{ optional($item->product)->price  *  optional($item)->qty }}
               

            </ol>
                @endforeach
               
            </td>

            <td>{{ \Carbon\Carbon::parse($ord->created_at)->format('F d, Y')}}</td>
            <td><a href="/admin/orderinfo/{{$ord->id}}"><button class="btn btn-primary">View Order</button></a></td>


               
                </tr>
                @endforeach
                <!-- Example Row -->
                {{-- @foreach ($order as $key=>$item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td><img src="{{asset($item->product->firstPhoto->photo_path)}}" style="height: 50px; width:50px;" alt="img"></td>
                    <td>{{$item->product->title}}</td>
                    <td>{{$item->qty}}</td>
                    <td>${{$item->qty * $item->product->price}}</td>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y')}}</td>
                    <td>{{ $item->trackNo == Null ? 'Wating for tracking Address' : $item->trackNo }}</td>
                    {{-- <td>Wating for tracking Address</td> --}}
                    {{-- <th>
                        <a href="/admin/orderinfo/{{$item->id}}">
                        <button class="btn  {{ $item->trackNo == Null ? 'btn-primary' : 'btn-success' }}"> View Order</button>
                    </a>
                    </th> --}}


                {{-- </tr> --}} 
                {{-- @endforeach --}}
               
                <tr>
                    <td>2</td>
                    <td>Product B</td>
                    <td>1</td>
                    <td>$15</td>
                    <td>$15</td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table> 
        
    </div> 

  
    
</div>
@endsection


