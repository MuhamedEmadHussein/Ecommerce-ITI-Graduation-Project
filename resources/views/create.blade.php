<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inserting Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}
    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input value="{{ old('product_name') }}" type="text" name="product_name" id="product_name"
            placeholder="Enter Product Name" class="@error('product_name') is-invalid @enderror"><br> <br>
        @error('product_name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input value="{{ old('product_price') }}" type="number" name="product_price" placeholder="Enter Product Price"
            class="@error('product_price') is-invalid @enderror"> <br> <br>
        @error('product_price')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input value="{{ old('product_availability') }}" type="text" name="product_availability"
            placeholder="Enter Product Availability" class="@error('product_availability') is-invalid @enderror"> <br>
        <br>
        @error('product_availability')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <select name="category_id" class="@error('category_id') is-invalid @enderror" style="width:160px;">
            <option value="">----------------------</option>
            @foreach ($data as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach

        </select>

        {{-- <input type="number" name="category_id" placeholder="Enter Category ID"
            class="@error('category_id') is-invalid @enderror"><br> <br> --}}
        @error('category_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>
        <br>
        <input type="file" name="photo"> <br><br>
        <button type="submit">Intsert</button>
    </form>
</body>

</html>
