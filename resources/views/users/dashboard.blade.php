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
                <a href="{{ route('home.dashboard') }}">
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
            <li class="nav-item">
                <a href="{{ route('users.index') }}" class="active">
                    <i class="fas fa-user-group"></i>
                    <p>Users</p>
                </a>
            </li>
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

        <div style="margin-top: 30px" class="title-info">
            <p>Users</p>
            <i class="fas fa-table"></i>
        </div>

        {{-- <div class="search-bar">
            <form action="{{ route('order.index') }}" method="get">
                @csrf
                <input type="text" name="search" placeholder="Search Products">
                <button type="submit" class="search-button">Search</button>
            </form>
        </div> --}}

        {{-- <div class="filter-bar">
            <form style="display: inline" action="{{ route('order.index') }}" method="get">
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
        </div> --}}

        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }} </td>
                        <td>{{ $user->email }}</td>

                        @if ($user->admin == 1)
                            <td>Admin</td>
                        @else
                            <td>User</td>
                        @endif
                        <td>
                            <a style="width: 80%" class="action-button" role="button"
                                href="{{ route('user.admin', $user->id) }}">add Admin</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</body>

</html>
