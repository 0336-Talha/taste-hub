@extends('frontEnd.layout.site-master')

@section('content')
{{-- hi from Categories --}}
<section id="cart">
    <div class="contain sm">
        <h3 class="mb-4">Shopping cart</h3>
        <div class="cart_table">
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th> 
                    </tr>
                </thead>
                <tbody id="datatable">
                    @foreach ($cart as $item)
                    <tr class="dataRows">
                        <td><button type="button" class="x_btn" id="removeBtn" data-id="{{$item->id}}"></button></td>
                        <td>
                            <div class="ico_blk">
                               
                                <div class="ico fill round"><a href="product-detail.php"><img src=" {{ asset($item->product->firstPhoto->photo_path) }}" width="200" height="200" alt=""></a></div>
                                <div class="name"><a href="product-detail.php">{{$item->product->title}}</a></div>
                            </div>
                        </td>
                          @php
                            if($item->product->productOffer !== Null){
                                // echo "hello"; 
                                if($item->product->id == $item->product->productOffer->product_id){
                                    $pprice=$item->product->productOffer->offerPrice *$item->qty;
                                }else{
                                    $pprice=$item->product->price * $item->qty;
                                }
                            }else{
                                $pprice=$item->product->price * $item->qty;

                            }
                            @endphp
                        <td>
                            <input type="hidden" id="tqty"  value="{{$item->product->quantity}}">
                            <input type="hidden" id="productPrice" value="{{$pprice}}">

                            {{-- <div id="tqty">
                                {{$item->product->quantity}}
                            </div> --}}
                            <div class="qty_btn">
                                <a class="minus" id='min'></a>
                                <input type="text" name="qty" id="qty" data-id="{{$item->id}}" value="{{$item->qty}}" class="qty">
                                <a class="plus" id='plu'></a>
                            </div>
                        </td>
                        <td>
                          
  
                            <div id="pricing">${{$pprice}}</div>

                             {{-- @if($offer->isEmpty() )   


                             @endif --}}
  
                             
                            {{-- @foreach($offer as $off)
                            @if($off->product_id == $item->product->id) --}}
                                {{-- {{$off->offerPrice}} --}}
                            {{-- <div id="pricing">${{$off->offerPrice * $item->qty}}</div>
                            @else
                            <div id="pricing">${{$item->product->price * $item->qty}}</div> --}}

                            {{-- @endif --}}
{{-- 
                            @endforeach --}}
                          
                            
                        </td>
                    </tr>
                    @endforeach
               
                  
                
                    <tr>
                        <td colspan="3" class="text-lg-end text-center">Subtotal:</td>
                        <td>
                            <div class="price"></div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="btn_blk justify-content-end">
            <a href="/checkout" class="site_btn px w_100">Checkout</a>
        </div>
    </div>
</section>
<!-- cart -->

@endsection

@section('script')
<script>
    $(document).ready(function(){
       


        $(document).on('click','#min',function(){
    // console.log('hi');
    let valu=$(this).parent().children('#qty');
    let price=$(this).parent().parent().children('#productPrice').val();
    let total=$(this).parent().parent().parent().find('#pricing');

    // let va=$('#qty').val()-1;
    let va=valu.val()-1;
    if( va== 0 || va < 0){
        // $('#qty').val(1);
        valu.val(1);
        total.html('$'+1*price);
    }else{
    valu.val(va);
    total.html('$'+va*price);

    }
    console.log(valu.val());

    calculateTotal();

    valu.trigger("change");

    
})
  
$(document).on('click','#plu',function(){
    let valu=$(this).parent().children('#qty');
   let  valo = parseInt(valu.val(), 10);
    // let va=$('#qty').val()-1;
    let va=valo+1;
    let to=$(this).parent().parent().children('#tqty').val();
    let price=$(this).parent().parent().children('#productPrice').val();
    let total=$(this).parent().parent().parent().find('#pricing');

    // console.log(price)
    // console.log(total)


    // console.log(to)
    if( va > to){
        // $('#qty').val(1);
        valu.val(to);
        total.html('$'+to*price)
        
    }else{
    valu.val(va);
    total.html('$'+va*price)

    }
    // console.log(valu.val());
    calculateTotal();
    
    valu.trigger("change");
    

})
 

    $(document).on('change','#qty',function(){
        // console.log('hi from change')
        let a=$(this).parent().children('#qty');
        let id=$(this).parent().children('#qty').data("id")
        console.log(id);
        let va=parseInt(a.val(),10);
        let to=$(this).parent().parent().children('#tqty').val();
        let price=$(this).parent().parent().children('#productPrice').val();
        let total=$(this).parent().parent().parent().find('#pricing');
        // console.log(a.val());
        // console.log(va);
        // console.log(to)
          if(va > to){
        // $('#qty').val(to);
        a.val(to);
        total.html('$'+va*to)

        }else{
        // $('#qty').val(va);
        a.val(va);
        total.html('$'+va*price)
 
        }

         if(va < 0){
        // $('#qty').val(1);
        a.val(1)
        total.html('$'+1*price)

    }
    calculateTotal();
    a=a.val();
    console.log(a);
    // var csrfToken = $('meta[name="csrf-token"]').attr('content');
    // console.log("_token": "{{ csrf_token() }}",)
    $.ajax({
        url: "{{ route('user.cartToQty') }}", // Adjust this based on your actual route structure
        method: 'POST',
        data: { 
            qty: a, // Sending the quantity along with the product ID
            id:id,
            "_token": "{{ csrf_token() }}"
        },
        success: function(response) {
            // You can handle the response here, like updating the UI
            console.log(response); 
            location.reload(); 
            if (response.success) {
                alert("Item removed successfully");
            }
        },
        error: function(xhr, status, error) {
            // Handle error here
            console.log(error);
            alert("Error removing item");
        }
    });


})

function calculateTotal() {
    let totalPrice = 0;
    let val=0;
    // console.log('hi')

    if($('.dataRows').html() == undefined ) {
        // console.log('bye');
        totalPrice=0;
    }else{
    $('.dataRows').each(function(){
    
        let pri=$(this).find(pricing).html();
        // console.log(typeof(pri))
        pri=pri.toString().replace('$', '');
        val=parseInt(pri,10);
        totalPrice=totalPrice+val;
    })
}
    // console.log(totalPrice)
    // $(this).parent().parent().find('.price').html(totalPrice)
    // console.log($('.dataRows').parent().find('.price').html())

    if(totalPrice == undefined || totalPrice== 0){
   
        $('#datatable').find('.price').html('$0.00');
    }else{
        // console.log('hy ni')

    $('.dataRows').parent().find('.price').html('$'+totalPrice+'.00');
    }

}

calculateTotal();

$('.dataRows').on('click','#removeBtn',function(){
    let id=$(this).data("id");
    // console.log(id)
    let a=confirm("Are You Sure you want to Remove this Product")
    if(a){
        $(this).parent().parent().remove()
        calculateTotal();
        $.ajax({
            url: '/cart/remove/' +id,
            type: 'get',
            success: function(response) {
                alert("successfully Removed");
           
                // Optionally: Refresh the product list or redirect
            },
            error: function(error) {
                // alert(error.responseJSON.error);
            }
        });
    }
})

})




</script>
@endsection