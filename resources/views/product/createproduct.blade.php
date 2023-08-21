<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inserting Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <div class="card mb-4">
        <div class="card-header">
            <h4 class="card-title">Add Product</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data"
                class="needs-validation" novalidate>
                @csrf
                <div class="mb-3">
                    <label for="product_name" class="form-label">Product Name</label>
                    <input value="{{ old('product_name') }}" type="text" name="product_name" id="product_name"
                        class="form-control @error('product_name') is-invalid @enderror"
                        placeholder="Enter Product Name" required>
                    @error('product_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="product_price" class="form-label">Product Price</label>
                    <input value="{{ old('product_price') }}" type="number" name="product_price"
                        class="form-control @error('product_price') is-invalid @enderror"
                        placeholder="Enter Product Price" required>
                    @error('product_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="product_availability" class="form-label">Product Availability</label>
                    <select name="product_availability"
                        class="form-control @error('product_availability') is-invalid @enderror" required>
                        <option value="" disabled selected>Select Availability</option>
                        <option value="Available" {{ old('product_availability') == 'Available' ? 'selected' : '' }}>
                            Available</option>
                        <option value="Unavailable"
                            {{ old('product_availability') == 'Unavailable' ? 'selected' : '' }}>Unavailable</option>
                    </select>
                    @error('product_availability')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                        <option value="">----------------------</option>
                        @foreach ($data as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label">Product Photo</label>
                    <input type="file" name="photo" class="form-control-file @error('photo') is-invalid @enderror"
                        required>
                    @error('photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Insert</button>
                <a href="{{ route('product.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
            </form>
        </div>
    </div>
</body>

</html>
