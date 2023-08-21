<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <a style="display: inline" class="btn btn-primary" role="button" href="{{ route('products.create') }}">Create
        Product</a>
    <a class="btn btn-primary" role="button" href="{{ route('order.index') }}">Show Orders</a>
    <a class="btn btn-primary" role="button" href="{{ route('category.index') }}">Show Categories</a>
    <form style="display: inline" action="{{ route('product.search') }}" method="POST">
        @csrf
        <input type="text" name="search" placeholder="Search">
        <button type="submit" name="searchSubmit">Search</button>
    </form>

    <form style="display: inline" action="{{ route('products.index') }}" method="get">
        <select name="category_id" style="padding-left: 30px; margin-left: 80px; width: 300px;">
            <option value="">All Categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == $selectedCategory ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <button type="submit">Filter</button>
    </form>


    <table class="table">
        <thead>
            <tr>
                <th scope="col">Product Name</th>
                <th scope="col">Product Price</th>
                <th scope="col">Product Availability</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->product_price }}</td>
                    <td>{{ $product->product_availability }}</td>
                    <td>
                        <a class="btn btn-primary" role="button" style="display: inline"
                            href="{{ route('product', $product->id) }}">Show</a>
                        <form action="{{ route('products.delete', $product->id) }}" method="post"
                            style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                        <a class="btn btn-primary" role="button"
                            href="{{ route('products.update', $product->id) }}">Update</a>
                        <a class="btn btn-primary" role="button" href="{{ route('order.make', $product->id) }}">
                            Order</a>
                        <a class="btn btn-primary" role="button" href="{{ route('order.show', $product->id) }}">Show
                            Orders</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
