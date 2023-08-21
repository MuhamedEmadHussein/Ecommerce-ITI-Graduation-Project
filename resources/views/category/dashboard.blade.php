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
                <a href="{{ route('category.index') }}" class="active">
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

        <div style="margin-top: 30px" class="title-info">
            <p>Categories</p>
            <i class="fas fa-chart-pie"></i>
        </div>
        <div class="filter-bar">
            <form style="display: inline" action="{{ route('product.dashboard') }}" method="">
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
                    <button type="submit" class="filter-button">Show</button>
                </div>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th scope="col">Category ID</th>
                    <th scope="col">Category Name</th>
                    @if (Auth::user()->admin == 1)
                        <th scope="col">Actions</th>
                    @endif

                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        @if (Auth::user()->admin == 1)
                            <td>
                                <div class="buttons">
                                    <a class="action-button" role="button"
                                        href="{{ route('category.create') }}">Add</a>
                                    <form action="{{ route('category.destroy', $category->id) }}" method="POST"
                                        style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="action-button delete-button" type="submit">Delete</button>
                                    </form>
                                    <a class="action-button" role="button"
                                        href="{{ route('category.update', $category->id) }}">Update</a>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</body>

</html>
