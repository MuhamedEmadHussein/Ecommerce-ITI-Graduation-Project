<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commerce Website</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

</head>

<body>

    <header>
        <h2><a href="#" class="logo">Ecommerce</a></h2>
        <ul>
            <li class="nav-item"><a href="#home" class="active">Home</a></li>

            @auth
                <li class="nav-item"><a href="{{ route('products.shop') }}">Shop</a></li>
                <li class="nav-item"><a href="{{ route('home.dashboard') }}">Dashboard</a></li>
                <li class="nav-item"><a href="#about">About</a></li>
                <li class="nav-item"><a href="#contact">Contact</a></li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                    </form>
                </li>
                <li class="nav-item">
                    <a class="" href="{{ route('profile.show') }}">
                        @if (Auth::user()->profile_photo_url)
                            <img style="width: 40px;height:40px;border-radius:50%;"
                                src="{{ Auth::user()->profile_photo_url }}" alt="Profile Photo"
                                class="rounded-full h-8 w-8">
                        @else
                            <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #ccc; text-align: center; line-height: 40px;"
                                class="rounded-full h-8 w-8">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        @endif
                        {{-- <img style="width: 40px;height:40px;border-radius:50%;" src="{{ Auth::user()->profile_photo_url }}"
                            alt="{{ asset('imgs/Users/user-200x300.webp') }}" class="rounded-full h-8 w-8"> --}}
                    </a>
                </li>
            @else
                <li class="nav-item"><a href="#about">About</a></li>
                <li class="nav-item"><a href="#contact">Contact</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
            @endauth
        </ul>
    </header>
    <section class="main">
        <img src="{{ asset('imgs/home/stars1.webp') }}" alt="No" id="stars">
        <img src="{{ asset('imgs/home/sell-products-online.svg') }}" alt="No" id="banner">

    </section>
    <div class="content" id="home-content">
        <h2>Welcome to Our Online Store
            Discover a World of Shopping Delights</h2>
        <p>
            At Our Ecommerce Brand, we believe that shopping should be an experience that is enjoyable, convenient, and
            memorable. Our online store offers a curated selection of high-quality products, ranging from fashion and
            accessories to electronics and home essentials.

            With a passion for excellence and a commitment to customer satisfaction, we strive to provide you with the
            best shopping experience possible. Our user-friendly interface makes browsing through our extensive catalog
            a breeze, while our secure checkout process ensures that your personal information remains safe and
            protected.

            Explore our latest arrivals, take advantage of exclusive offers, and shop with confidence knowing that every
            item you purchase is backed by our dedication to quality and authenticity. Join us on this exciting journey
            of discovering new trends, upgrading your lifestyle, and indulging in the joy of shopping.

            Thank you for choosing Our Brand. We look forward to serving you and making your shopping dreams a reality!
        </p>
    </div>
    <div class="content" id="about-content" style="display: none;">

        <h2>About Us</h2>
        <p>
            Our company is dedicated to providing high-quality products and exceptional customer service...
        </p>
    </div>
    <div class="content" id="contact-content" style="display: none;">
        <h2>Contact Us</h2>
        <p>
            If you have any questions or inquiries, feel free to contact us at mohamedemadhu01019@gmail.com...
        </p>
    </div>
    <script src="{{ asset('js/home.js') }}"></script>
</body>

</html>
