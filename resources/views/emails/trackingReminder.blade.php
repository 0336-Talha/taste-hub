<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reminder</title>
</head>
<body>
    <h3>Hello, {{ $ownerName }}</h3>
    <p>You have products in the order that have not been assigned tracking numbers yet. Please update the tracking numbers for the following products:</p>

    <ul>
        @foreach($items as $item)
            <li>{{ $item->product->title }} (Quantity: {{ $item->qty }})</li>
        @endforeach
    </ul>

    <p>Please assign tracking numbers to the products as soon as possible.</p>
</body>
</html>
