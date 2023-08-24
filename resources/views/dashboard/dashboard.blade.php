<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div class="menu">
        <ul>
            <li class="profile">
                <div class="image-box">
                    <img src="{{ Auth::user()->profile_photo_url }}" alt="No">
                </div>
                <h2>{{ Auth::user()->name }}</h2>
            </li>
            <li class="nav-item">
                <a href="{{ route('home.dashboard') }}" class="active">
                    <i class="fas fa-home"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('product.dashboard') }}">
                    <i class="fas fa-table"></i>
                    <p>Products</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('category.index') }}">
                    <i class="fas fa-chart-pie"></i>
                    <p>Categories</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('order.index') }}">
                    <i class="fas fa-money-check-dollar"></i>
                    <p>Orders</p>
                </a>
            </li>
            @if (Auth::user()->admin == 1)
                <li class="nav-item">
                    <a href="{{ route('admin.orders') }}">
                        <i class="fas fa-user-ninja"></i>
                        <p>Personal Orders</p>
                    </a>
                </li>
            @endif
            @if (Auth::user()->admin == 1)
                <li class="nav-item">
                    <a href="{{ route('users.index') }}">
                        <i class="fas fa-user-group"></i>
                        <p>Users</p>
                    </a>
                </li>
            @endif
            <li class="logout">
                <a href="{{ route('dashboard') }}">
                    <i class="fas fa-sign-out"></i>
                    <p>Back to Home</p>
                </a>
            </li>
        </ul>
    </div>

    <div class="content">
        <div class="title-info">
            <p>Dashboard</p>
            <i class="fas fa-chart-bar"></i>
        </div>
        <div class="data-info">
            <div class="box">
                <i class="fas fa-user"></i>
                <div class="data">
                    <p>Users</p>
                    <span>{{ $user_count }}</span>
                </div>
            </div>
            <div class="box">
                <i class="fas fa-chart-pie"></i>
                <div class="data">
                    <p>Categories</p>
                    <span>{{ $category_count }}</span>
                </div>
            </div>
            <div class="box">
                <i class="fas fa-table"></i>
                <div class="data">
                    <p>Products</p>
                    <span>{{ $product_count }}</span>
                </div>
            </div>
            <div class="box">
                <i class="fas fa-money-check-dollar"></i>
                <div class="data">
                    <p>Orders</p>
                    <span>{{ $order_count }}</span>
                </div>
            </div>


        </div>

    </div>

</body>

</html>
