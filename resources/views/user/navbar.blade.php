<nav class="navbar bg-body-tertiary fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand text-center" href="#">Salma Store</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Salma Store</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body"style=color>
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('userProducts') }}">All Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('skirt') }}">skirt</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('dress') }}">dress</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('swimmingWear') }}">swimming wear</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('blouses') }}">blouses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('sales') }}">sales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link cartword" href="{{ url('cartList') }}">Cart<span class="cartNumber">(
                                {{ $total }} )</span></a>

                    </li>


                    @auth

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('logout') }}">LogOut</a>
                        </li>
                    @endauth
                    @guest

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('register') }}">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('login') }}">Login</a>
                        </li>
                    @endguest
                    <li class="nav-item">
                        <form class="d-flex selectC" action="{{url('convertCurrnecy')}}">
                            <select class="form-select" name="currnecy" id="currnecy">
                                <option value="EGP"><a href="{{url('convertCurrnecy')}}">EGP</a></option>
                                <option value="USD"><a href="{{url('convertCurrnecy')}}">USD</a></option>
                                <option value="SAR"><a href="{{url('convertCurrnecy')}}">SAR</a></option>
                              </select>
                              <button class="btn">convert</button>
                        </form>
                    </li>

                </ul>
                <form class="d-flex mt-3" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="search  btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>
</nav>
