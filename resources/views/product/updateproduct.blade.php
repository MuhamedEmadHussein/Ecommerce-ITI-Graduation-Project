<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <div class="card mb-4">
        <div class="card-header">
            <h4 class="card-title">Update Product</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('products.edit', $product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="product_name" class="form-label">Product Name</label>
                    <input type="text" name="product_name" id="product_name" value="{{ $product->product_name }}"
                        class="form-control @error('product_name') is-invalid @enderror"
                        placeholder="Enter Product Name">
                    @error('product_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="product_price" class="form-label">Product Price</label>
                    <input type="number" value="{{ $product->product_price }}" name="product_price"
                        class="form-control @error('product_price') is-invalid @enderror"
                        placeholder="Enter Product Price">
                    @error('product_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="product_availability" class="form-label">Product Availability</label>
                    <select name="product_availability"
                        class="form-select @error('product_availability') is-invalid @enderror">
                        <option value="Available"
                            {{ $product->product_availability === 'Available' ? 'selected' : '' }}>Available</option>
                        <option value="Unavailable"
                            {{ $product->product_availability === 'Unavailable' ? 'selected' : '' }}>Unavailable
                        </option>
                    </select>
                    @error('product_availability')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror"
                        style="width:160px;">
                        <option value="{{ $product->category_id }}">{{ $product->category->name }}</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Product Photo</label>
                    <input type="file" name="photo" class="form-control">
                    @if ($product->product_picture)
                        <img width="100px" height="100px" src="{{ asset('imgs/' . $product->product_picture) }}"
                            alt="No">
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('product.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
            </form>
        </div>
    </div>
</body>

</html>
