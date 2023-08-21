<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Updating Data</title>
</head>

<body>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.edit', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="text" name="product_name" id="product_name" value="{{ $product->product_name }}"
            placeholder="Enter Product Name" class="@error('product_name') is-invalid @enderror"><br> <br>
        @error('product_name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        {{-- <input type="text" name="product_name" value="{{ $product->product_name }}"
            placeholder="Enter Product Name"><br> <br> --}}

        <input type="number" value="{{ $product->product_price }}" name="product_price"
            placeholder="Enter Product Price" class="@error('product_price') is-invalid @enderror"> <br> <br>
        @error('product_price')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        {{-- <input type="number" name="product_price" value="{{ $product->product_price }}"
            placeholder="Enter Product Price"> <br> <br> --}}

        <input type="text" value="{{ $product->product_availability }}" name="product_availability"
            placeholder="Enter Product Availability" class="@error('product_availability') is-invalid @enderror"> <br>
        <br>
        @error('product_availability')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        {{-- <input type="text" name="product_availability" value="{{ $product->product_availability }}"
            placeholder="Enter Product Availability"> <br> <br> --}}

        {{-- <input type="number" name="category_id" value="{{ $product->category_id }}"
            placeholder="Enter Category ID"><br> <br> --}}

        <select name="category_id" class="@error('category_id') is-invalid @enderror" style="width:160px;">
            <option value="{{ $product->category_id }}">{{ $product->category->name }}</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach

        </select>
        @error('category_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>
        <br>
        <input type="file" name="photo">
        <br>
        <td>
            @if ($product->product_picture)
                <img width="100px" height="100px" src="{{ asset('imgs/' . $product->product_picture) }}"
                    alt="No">
            @endif
        </td>
        <br><br>
        <button type="submit">Update</button>
    </form>
</body>

</html>
