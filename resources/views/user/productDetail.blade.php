<?php
use App\Http\Controllers\AdminController;
$total=0;
if(Session::has('user')){

    $total = AdminController::cartItem();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('user') }}css/all.min.css">
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/product.css') }}">
    <link rel="stylesheet" href="{{ asset('user') }}css//media.css">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Lora:wght@500&display=swap" rel="stylesheet"> -->
    <!-- <link  href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet"> -->
    <script src="{{ asset('user/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('user/js/product.js') }}"></script>
    <title>salma store</title>
</head>

<body>
    <div class="container buying">
        <nav class="navbar bg-body-tertiary fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand text-center" href="{{url('userProducts')}}">Salma Store</a>
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
                                <a class="nav-link"  href="{{url('userProducts')}}">All Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('skirt')}}">skirt</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('dress')}}">dress</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('swimmingWear')}}">swimming wear</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link cartword" href="{{url('cartList')}}">Cart<span class="cartNumber">( {{$total}} )</span></a>

                            </li>

                        <li class="nav-item">
                            <form action="{{url("convertCurrnecyDet/$product->id")}}">
                                <select name="currnecy" id="currnecy">
                                    <option value="EGP"><a href="{{url('convertCurrnecy')}}">EGP</a></option>
                                    <option value="USD"><a href="{{url('convertCurrnecy')}}">USD</a></option>
                                    <option value="SAR"><a href="{{url('convertCurrnecy')}}">SAR</a></option>
                                  </select>
                                  <button class="btn">convert</button>
                            </form>
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
                        </ul>
                        <form class="d-flex mt-3" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="search  btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <div class="row">
            <div class="product_img col-md-5 text-center">
                <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset("storage/$product->image1") }}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset("storage/$product->image2") }}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset("storage/$product->image3") }}" class="d-block w-100" alt="...">
                        </div>
                        @if ($product->image4)
                        <div class="carousel-item">
                            <img src="{{ asset("storage/$product->image4") }}" class="d-block w-100" alt="...">
                        </div>
                        @endif

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

            </div>
            <div class="product_info col-md-6 ms-auto">
                <br>
                <p class="product_type">{{ $product->category }}</p>
                <h2 class="product_name">{{ $product->name }}</h2>
                <br>
                @if ($product->salePrice !=null)
                <span style="text-decoration: line-through" class="price1"> {{ $product->price }}</span><span class="currency"> L.E </span>
                <span class="price1 ms-4"> {{ $product->salePrice }}</span><span class="currency"> L.E </span>
                @else
                <span class="price1"> {{ $product->price }}</span><span class="currency"> L.E </span>
                @endif

                <p class="mt-3">category:{{ $product->category }}</p>

                <p class="product_desc mt-3">{{ $product->desc }}</p>
                <div class=" m-auto">
                    <form class="m-auto counter" action="{{url('addToCart')}}" method="post">
                            @csrf
                            <select class="" name="size" id="size">
                                <option value="small">medium</option>
                                <option value="medium">large</option>
                                <option value="large">XL</option>
                                <option value="Xlarge ">2XL</option>
                                <option value="Xlarge ">3XL</option>
                                <option value="Xlarge ">4XL</option>
                                <option value="Xlarge ">5XL</option>
                                <option value="Xlarge ">6XL</option>
                            </select>

                            <span class="down" onClick='decreaseCount(event, this)'>-</span>
                            <input class="count" name="quantity" type="text" value="1">
                            <span class="up" onClick='increaseCount(event, this)'>+</span>
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <input type="hidden" name="price" value="{{$product->price}}">
                            <input type="hidden" name="salePrice" value="{{$product->salePrice}}">
                            <input type="hidden" name="category" value="{{$product->category}}">
                            <input type="hidden" name="image1" value="{{$product->image1}}">
                            <input type="hidden" name="name" value="{{$product->name}}">
                            <input type="hidden" name="desc" value="{{$product->desc}}">
                            <button class="btn btn-secondary" type="submit"> To Cart</button>
                    </form>
                </div>


                <hr>
                <div class="d-flex flex-col">


                    <img src="{{asset('images/size23.jpg')}}"    width="300px" alt="">
                </div>
            </div>
        </div>

        <hr class="mt-5 mb-1">

        <h1 class="mb-5 text-center">RELATED PRODUCTS</h1>
        <div class="d-flex flex-wrap justify-content-center mb-4">
            @foreach ($allProducts->slice(0, 3) as $product)
                <div class="card">
                    <img src="{{ asset("storage/$product->image1") }}" alt="">
                    <img class="img2" src="{{ asset("storage/$product->image2") }}" alt="">
                    <p class="category">{{ $product->category }}</p>
                    <p class="product">{{ $product->name }}</p>
                    <span class="price">{{ $product->price }}</span><span
                        class="quantity">{{ $product->quantity }}</span>
                    <button class="btn"> <a class='buy' href="{{ url("productDetails/$product->id") }}"> Buy
                            Now </a></button>
                </div>
            @endforeach
        </div>
    </div>
    <div class="footer">
        <footer class="site-footer">
            <hr>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <p class="copyright-text">Copyright &copy; 2017 All Rights Reserved
                        </p>
                    </div>

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <ul class=" social-icons">
                            <a class="facebook" href="https://www.facebook.com/salmastore2023?mibextid=ZbWKwL"
                                target="_blank"><i class="fa-brands fa-facebook fa-beat-fade fa-lg ms-2 me-2"
                                    style="color: #1877F2;"></i></a>
                            <a class="instagram" href="https://instagram.com/salmastore7?igshid=MTI1ZDU5ODQ3Yw=="
                                target="_blank"><i class="fa-brands fa-instagram fa-beat-fade fa-lg ms-2 me-2"
                                    style="color: #E4405F;"></i></a>
                            <a class="telegram" href="https://t.me/salmastore81" target="_blank"><i
                                    class="fa-brands fa-telegram fa-beat-fade fa-lg ms-2 me-2"
                                    style="color: #0088cc;"></i></a>
                            <i class="fa-brands fa-whatsapp fa-beat-fade fa-lg ms-2 me-2 d-inline"
                                style="color: #49c173;">
                                <P class="d-inline">+201050883058</P>
                            </i>

                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>

</body>
