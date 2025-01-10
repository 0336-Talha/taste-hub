@extends('frontEnd.layout.site-master')

@section('content')

<section id="notifications">
    <div class="contain sm">
        <h3 class="mb-4">Notifications</h3>
        <div class="table_blk_wrap">
            <div class="table_blk">
                <table>
                    <tbody>
                        @foreach($notification as $noti)
                        <tr>
                            <td>
                                <div class="noti_blk">
                                    <div class="ico fill round"><a href="?"><img src="{{asset($noti->photo)}}" alt=""></a></div>
                                    <div class="txt">
                                        <h5 class="bto" data-id="{{$noti->id}}" style=" {{$noti->is_read==0 ? 'color:black' : ' color:gray' }}">{{$noti->type}}</h5>
                                        
                                        <p class="bto" data-id="{{$noti->id}}" style=" {{ $noti->is_read==0 ? 'color:black' : ' color:gray' }}" >{{$noti->message}} 
                                           <button><a href="{{$noti->link}}">click here</a></button> .</p>
                                    </div>
                                </div>
                            </td>
                            <td class="time text-end">{{ \Carbon\Carbon::parse($noti->created_at)->diffForHumans() }}</td>
                        </tr>
                        @endforeach
   
                    </tbody>
                </table>
            </div>
            <div class="table_pagination">
                <p>Showing 1 to 9 of 200 entries</p>
                <div class="pagination">
                    {{-- <ul>
                        <li><button type="button" class="prev"></button></li>
                        <li class="active"><a href="?">1</a></li>
                        <li><a href="?">2</a></li>
                        <li><a href="?">3</a></li>
                        <li><a href="?">...</a></li>
                        <li><a href="?">50</a></li>
                        <li><button type="button" class="next"></button></li>
                    </ul> --}}
                    {{-- <div class="pagination"> --}}
                        {{ $notification->links('vendor.pagination.customPage') }} 
                       
                        {{-- {{ $product->links('vendor.pagination.bootstrap-4') }} --}}
                     
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
<script>
    $(document).ready(function(){
        // console.log('hello')
        $(document).on('click','.bto',function(){
            // console.log($(this).html());
            let id=$(this).attr("data-id");
            console.log(id)
 
            $.ajax({
            
    url: `/notificationread/${id}`,  // URL me dynamic ID ko insert kiya
    type: 'GET',
    success: function(response) {
        // Agar request successful ho jaye
        console.log('Response:', response);
        window.location.href = response;
    },
    error: function(xhr, status, error) {
        // Agar request me koi error ho
        console.error('Error:', error);
    }
}); 
        })
    })
</script>
@endsection