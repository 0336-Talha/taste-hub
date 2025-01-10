@extends('frontEnd.layout.site-master')

@section('content')

<section id="my-products">
    <div class="contain">
        <h3 class="mb-4">Offers</h3>
        <div class="flex view_offer_flex">
            
            <div style="display: none;" class="text-danger emptyTxt">Dnt Have Any Offer Right Now</div>

            <div class="colL">
                @if($prod->productAllOffer->isNotEmpty())
                @foreach($prod->productAllOffer as $offer)
                <div class="offers_flex">
                    <div class="col">
                        <div class="inner_flex">
                            <div class="image">  
                                <img src="{{asset($offer->useraccount->photo)}}" alt="User Photo">
                            </div>
                            <div class="title">
                                <p>{{$offer->useraccount->accountUser->name}}</p> 
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="dim_text">
                            <h6>Offer</h6>
                        </div>
                        <p><strong>${{$offer->offerPrice}}</strong></p>
                    </div>
                    <div class="col">
                        <div class="btn_blk">
                            <button type="button" class="site_btn accept offbtn"  data-id="{{$offer->id}}" data-check="acc">Accept</button>
                            <button  type="button" class="site_btn decline offbtn"  data-id="{{$offer->id}}" data-check="dec">Decline</button>
                        </div>
                    </div>
                </div>
                @endforeach
                @else 
                   <h6>No Item Found</h6>

                @endif
            
                
            </div> 
            <div class="colR">
                <div class="inner">
                    <a href="" class="inner_flex">
                        <div class="image">
                            <img src="{{asset($prod->firstPhoto->photo_path)}}" alt="Product Photo">
                        </div>
                        <div class="title">
                            <p>{{$prod->title}}</p>
                            <h5>${{$prod->price}}</h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        console.log('hello')  
        // Event listener for .offbtn buttons
        $(document).on('click', '.offbtn', function () {
            // console.log($(this)); 
            // console.log($(this).data()); 
            // console.log($(this).data('id')); 
            // console.log($(this).data('check')); 
            let b=$(this);
            let a=confirm('Are You Sure');
            if(a){
                let id=$(this).data('id');
                let check=$(this).data('check');
 
 
                $.ajax({
        url: '/acceptorrefectoffers',  // Update the endpoint as per your route
        type: 'GET',
        data: { id: id, check: check },
        success: function (response) { 
            // Show notification or handle response
            console.log(response);
            alert(response.message); // Example of showing a message
            $(b).parent().parent().parent().remove(); 
            if ($('.colL').html().trim() == "") {
        // console.log('helloing');
        $('.colL').html(
            ' <div id="showing"><h6>No Item Found</h6></div>'

        )
       
    }
 


   
        },
        error: function (xhr) {
            console.error(xhr);
            alert('An error occurred!');
        }
    });
                



                
                // if($('.colL').html().trim() == ""){
                //     // console.log('empty');
                //     $('.emptyTxt').fadeIn(); 
                // }

            }
        });
    });

</script>


@endsection