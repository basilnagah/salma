<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('user/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/chechk.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/media.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <title>salma store</title>
</head>


<body>
    <nav class="navbar bg-body-tertiary fixed-top">
        <div class="container-fluid">
            <!-- <img src="images/salma store (1).png" alt=""> -->
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
                            <a class="nav-link" href="#all_products">All Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Dress</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">borkini</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Cart</a>
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


    <div class="container checkoutpg"> <br><br><br>
        <h1 class="check">CHECK OUT</h1>
        <br><br>
        <div class="row">
            <div class=" col-lg-6 col-md-7 col-sm-12 persnonal">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger"> {{ $error }} </div>
                    @endforeach
                @endif
                <h2>Personal information</h2>
                <hr>
                <form action="{{ url('order') }}" class="row g-3 needs-validation" novalidate>
                    @csrf
                    <div class="col-md-6">

                        <input type="text" name="firstName" class="form-control" id="validationCustom01"
                            placeholder="First Name" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="lastName" class="form-control" id="validationCustom02"
                            placeholder="Last Name" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group has-validation">
                            <input type="number" name="phoneNumber" class="form-control" id="validationCustomUsername"
                                placeholder="Phone Number" aria-describedby="inputGroupPrepend" required>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group has-validation">
                            <input type="number" name="secondPhoneNumber" class="form-control"
                                id="validationCustomUsername" placeholder="second Phone Number"
                                aria-describedby="inputGroupPrepend" required>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="country" class="form-control" id="validationCustom03"
                            placeholder="Country" required>
                        <div class="invalid-feedback">
                            Please provide a valid city.
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="city" id="validationCustom04" required>
                            <option selected disabled value="">city</option>
                            <option>Cairo</option>
                            <option>Giza</option>
                            <option>Fayoom</option>
                            <option>menofia</option>
                            <option>gharbeya</option>
                            <option>dakahleya</option>
                            <option>sharkeya</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid state.
                        </div>
                    </div>
                    <div class="input-group">

                        <textarea name="adress" class="form-control" aria-label="With textarea" placeholder="Detailed Address"></textarea>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck"
                                required>
                            <label class="form-check-label" for="invalidCheck">
                                Agree to terms and conditions
                            </label>
                            <div class="invalid-feedback">
                                You must agree before submitting.
                            </div>
                        </div>
                    </div>
                    <button class="orderButton btn btn-success">Place Order</button>
                </form>
            </div>
            <div class=" col-lg-6 col-md-7 col-sm-12 mb-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">
                                <h2>Products</h2>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td> <img src="{{ asset("storage/$product->image1") }}" alt=""
                                        class="item-img">
                                    <span id="Product-name"> {{ $product->name }} {{ 'x' }}
                                        {{ $product->quantity }}</span>
                                </td>
                                <td></td>
                                <td>{{ $product->price * $product->quantity }} </td>
                            </tr>
                        @endforeach


                        <tr>
                            <td>
                                <h5>Sub Total</h5>
                            </td>
                            <td></td>
                            <td><span>{{ $result->Result }}</span></td>

                        </tr>
                        <tr>
                            <td>
                                <h5>delivery</h5>
                            </td>
                            <td></td>
                            <td><span>50 L.E</span></td>

                        </tr>
                        <tr>
                            <td>
                                <h3>Total</h3>
                            </td>
                            <td></td>
                            <td><span>{{ $result->Result + 50 }}</span></td>

                        </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

    </div>

</body>
<script src="js/js.js"></script>
<script src="{{ asset('user/js/bootstrap.bundle.min.js') }}"></script>

</html>
