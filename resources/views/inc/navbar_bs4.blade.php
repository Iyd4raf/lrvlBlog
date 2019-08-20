<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <div class="navbar-header">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="/">
                {{ config('app.name', 'lrvlBlog') }}
            </a>
        </div>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <!-- Request::is -->
                    <a href="/" class="nav-link {{ (request()->is('/')) ? 'active' : '' }}">Home</a>
                </li>
                <li class="nav-item">
                    <a href="/about" class="nav-link {{ (request()->is('about')) ? 'active' : '' }}">About</a>
                </li>
                <li class="nav-item">
                    <a href="/services" class="nav-link {{ (request()->is('services')) ? 'active' : '' }}">Services</a>
                </li>
                <li class="nav-item">
                    <a href="/contact" class="nav-link {{ (request()->is('contact')) ? 'active' : '' }}">Contact</a>
                </li>
                <li class="nav-item">
                    <a href="/blog" class="nav-link {{ (request()->is('blog')) ? 'active' : '' }}">Blog</a>
                </li>
            </ul>

            <ul class="navbar-nav">
                @guest
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link {{ (request()->is('login')) ? 'active' : '' }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link {{ (request()->is('register')) ? 'active' : '' }}">Register</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link {{ (request()->is('dashboard')) ? 'active' : '' }}">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li class="nav-item">
                                <a href="/posts" class="nav-link {{ (request()->is('posts')) ? 'active' : '' }}">Posts</a>
                            </li>
                            <li class="nav-item">
                                <a href="/posts/create" class="nav-link {{ (request()->is('posts/create')) ? 'active' : '' }}">Create Post</a>
                            </li>
                            <li class="nav-item">
                                <a href="/categories" class="nav-link {{ (request()->is('categories')) ? 'active' : '' }}">Categories</a>
                            </li>
                            <li class="nav-item">
                                <a href="/tags" class="nav-link {{ (request()->is('tags')) ? 'active' : '' }}">Tags</a>
                            </li>
                            <div class="dropdown-divider"></div>
                            <li class="nav-item">
                                <a class="nav-link" 
                                href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>


