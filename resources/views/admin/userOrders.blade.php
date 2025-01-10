@extends('admin.layouts.layoutsHome.app')

@section('content')
<div class="main p-3">
        
    <h1 style="text-align: center;">Admin All Orders</h1>



    
    <div class="container mt-5">
        <h2>User Order Product Table</h2>
        <select id="filter" name="filter">
            <option value="All">All Orders</option>
          
            <option value="moreTime">More then 2 Days Not Complete Orders</option>
            </select>

            <div class="container">
                <div id="orders-container"></div>
            </div>


        {{-- <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Orderer Image</th>
                    <th>Orderer Name</th>
                    <th>Product Name</th>
               
                    <th>Price</th>
                    <th>Date</th>
                 
                    <th>Status</th>
                    {{-- <th>Missing TrackNumber</th> --}}
                    {{-- <th>Operation</th> --}}



                {{-- </tr>
            </thead>
            <tbody>
                @foreach($orders as $ord)
                <tr>
                <td><img src="{{asset($ord->orderMaker->photo)}}" style="height: 50px; width:50px;" alt="img"></td>
                <td>{{$ord->orderMaker->accountUser->name}}</td> --}}

                
                {{-- {{$item->product}} --}}
{{-- 
                <td>
                   
                        
                @foreach($ord->items as $id=>$item)
                <ol>
                {{$id+1}} : {{ optional($item->product)->title }}
                : {{ optional($item)->qty }}

            </ol>
                @endforeach
               
            </td> --}}
{{-- 
            <td>
                   
                @php $st=0; @endphp
                        
                @foreach($ord->items as $id=>$item)
                @php 
                    if($item->order_trackings_id == Null){
                        $st=1;
                    }
                
                @endphp
                <ol>
                : {{ optional($item->product)->price  *  optional($item)->qty }}
                --}}
{{-- 
            </ol>
                @endforeach
               
            </td>

            <td>{{ \Carbon\Carbon::parse($ord->created_at)->format('F d, Y')}}</td>
            <td>{{ $st==1 ? "Not Complete Yet": "completed"}}</td>


            <td><a href="/admin/orderinfo/{{$ord->id}}"><button class="btn btn-primary">View Order</button></a></td>


               
                </tr> --}}
                {{-- @endforeach --}}
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
               
                {{-- <tr>
                    <td>2</td>
                    <td>Product B</td>
                    <td>1</td>
                    <td>$15</td>
                    <td>$15</td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>  --}}
    </div>
    
</div>
@endsection
@section('script')
<script>

     var baseUrl = "{{ url('') }}"; 

     //time ago.
     function timeAgo(date) {
    const now = new Date();
    const seconds = Math.round((now - new Date(date)) / 1000);

    const intervals = [
        { label: 'year', seconds: 31536000 },
        { label: 'month', seconds: 2592000 },
        { label: 'week', seconds: 604800 },
        { label: 'day', seconds: 86400 },
        { label: 'hour', seconds: 3600 },
        { label: 'minute', seconds: 60 },
        { label: 'second', seconds: 1 },
    ];

    for (const interval of intervals) {
        const count = Math.floor(seconds / interval.seconds);
        if (count > 0) {
            return `${count} ${interval.label}${count !== 1 ? 's' : ''} ago`;
        }
    }

    return 'Just now';
}

    function getOrders(filter){
            // console.log(filter)
            let a="all";
        
            if(filter == undefined){
                a='all';
            }else{
                a=filter;
            }

            $.ajax({
            type:"GET",
        // url:"{{route('admin.Product', 'all')}}",
        url:`/admin/userOrdersManager/${a}`,
        success: function(orders) {
        // Select the container where the table will be appended
        console.log(orders);
    let ordersContainer = $('#orders-container');
    ordersContainer.empty();  // Clear any existing content
    let table = `
    <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Orderer Image</th>
                    <th>Orderer Name</th>
                    <th>Product Name</th>
               
                    <th>Price</th>
                    <th>Date</th>
                 
                    <th>Status</th>
                    {{-- <th>Missing TrackNumber</th> --}}
                    <th>Operation</th>



                </tr>
            </thead>
            <tbody>
    `;

    orders.forEach(function(ord, index) {

        let allItemsComplete = ord.items.every(item => item.order_trackings_id !== null);
        // let photoUrl = ord.order_maker.photo.replace('/admin/', '');
        // let photoUrl = `${baseUrl}${ord.order_maker.photo}`;
        let photoUrl = `${baseUrl}/${ord.order_maker.photo}`;
        const timeAgoText = timeAgo(ord.created_at);
        table +=`   <tr>
                    <td>
                         <img src="${photoUrl}" style="height: 50px; width:50px;" alt="img">
                    </td>
                    <td>${ord.order_maker.account_user.name}</td>
                    <td>
                        ${ord.items.map((item, id) => `
                            <ol>
                                ${id + 1}: ${item.product?.title || 'N/A'} : ${item.qty}
                            </ol>
                        `).join('')}
                    </td>
                    <td>
                        ${ord.items.map(item => `
                            <ol>
                                ${ (item.offerPrice ? item.offerPrice : item.product?.price) * item.qty || 0 }
                            </ol>
                        `).join('')}
                    </td>
                    <td>${timeAgoText}</td>
                    <td>${allItemsComplete ? "Completed" : "Not Complete Yet"}</td>
                    <td>
                        <a href="/admin/orderinfo/${ord.id}">
                            <button class="btn btn-primary">View Order</button>
                        </a>
                    </td>
                </tr>
            `;
    });
    // <td>${new Date(ord.created_at).toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' })}</td>

    table += `
                </tbody>
            </table>
        </div>
    `;

    // Append the complete table to the container
    ordersContainer.append(table);

        }
    

        // error:function(error){
        //     console.log(error);
        // }
    });

        }

        getOrders();

        $(document).on('change','#filter',function(){
        // console.log($(this).val());
        $filter=$(this).val();
        getOrders($filter);
    })

</script>
@endsection

