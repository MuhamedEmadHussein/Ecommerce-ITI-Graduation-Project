<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Product ID</th>
                <th scope="col">Product Price</th>
                <th scope="col">Order ID</th>
                <th scope="col">Orer Price</th>
                <th scope="col">Order Quantity</th>
                <th scope="col">User Name</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product Availability</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($product->orders as $order)
                <tr>
                    <th scope="row">{{ $product->id }}</th>
                    <td>{{ $product->product_price }}$</td>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->price }}$</td>
                    <td>{{ DB::table('order_Product')->where('order_id', $order->id)->pluck('quantity') }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->product_availability }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
