<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Successfully Placed</title>
</head>
<body>
    {{-- Welcome in Out of Stock
    <br>
    <hr>
    {{-- @foreach ($products as $product) --}}
        {{-- <li>{{ $products->title }} - Quantity: {{ $products->quantity }}</li> --}}
    {{-- @endforeach  --}}

    <h1>Your  Order Successfully Placed</h1>
<p>{{ $msg }}</p>
<ul>
    @foreach ($products as $product)
        <li>{{ $product->title }}</li> <!-- Adjust based on your product model's properties -->
    @endforeach
</ul>
</body>
</html>