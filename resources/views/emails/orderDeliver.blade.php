<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Delivered</title>
</head>
<body>
    <h3>Hello, {{ $ownerName }}</h3>
    <p>You have Recived the  following products:</p>

    <ul>
        @foreach($items as $item)
            <li>{{ $item->product->title }}</li>
        @endforeach
    </ul>

    <p>Please Add your feed Back Review. <a href="{{$url}}">Here .</a></p>
</body>
</html>
