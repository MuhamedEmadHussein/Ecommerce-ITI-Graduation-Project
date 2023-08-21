<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Design</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body>
    <section class="products">
        <h2>Our Products</h2>
        <div class="search-bar">
            <form action="{{ route('shop.search') }}" method="POST">
                @csrf
                <input type="text" name="search" placeholder="Search Products">
                <button type="submit" class="search-button">Search</button>
            </form>
        </div>


        <div class="filter-bar">
            <form style="display: inline" action="{{ route('products.shop') }}" method="">

                <div class="centered-content">
                    <select name="category_id" class="category-select">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $category->id == $selectedCategory ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="filter-button">Filter</button>
                </div>
            </form>
        </div>
        <div class="all-products">

            @foreach ($products as $product)
                <div class="product">
                    <img src="{{ asset('imgs/' . $product->product_picture) }}">
                    <div class="product-info">
                        <h4 class="product-title">{{ $product->product_name }}
                        </h4>
                        <p class="product-price">{{ $product->product_price }}$</p>
                        <form action="{{ route('order.make', $product->id) }}" method="POST">
                            @csrf
                            <input type="number" name="quantity" class="product-quantity" min="1" value="1"
                                placeholder="Quantity" @error('quantity') is-invalid @enderror>

                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <button class="product-btn">Buy Now</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <div class="bottom-button">
        <a href="{{ route('dashboard') }}">Back To Home Page</a>
    </div>
</body>

</html>
