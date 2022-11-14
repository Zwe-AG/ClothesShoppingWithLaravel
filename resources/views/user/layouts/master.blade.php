<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Shop Homepage - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('user/assets/css/styles.css') }}" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">Start Bootstrap</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{ route('user#home') }}">Home</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{ route('user#contact') }}">Contact</a></li>
                    </ul>
                    <form class="d-flex ms-3" action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="btn btn-outline-danger" type="submit">
                            <i class="fa-solid fa-arrow-right-from-bracket me-2"></i>
                            Logout
                        </button>
                    </form>
                    <a href="{{ route('user#profile') }}">
                        <button class="btn btn-outline-dark ms-3" type="submit">
                            <i class="fa-solid fa-user"></i>
                            Profile
                        </button>
                    </a>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="py-5" style="background-image:url('https://cdn.pixabay.com/photo/2016/04/19/13/39/store-1338629__480.jpg');background-repeat:no-repeat;background-size:cover;height:500px;object-fit:cover">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-3 fw-bolder text-dark">Shop in style</h1>
                    <p class="lead fw-normal text-white-50 mb-0 ">With this shop hompeage template</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        @yield('content')
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('user/assets/js/scripts.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        {{-- Jquery  --}}
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function(){

                    // Product Quantity
                    $('.quantity button').on('click', function () {
                        var button = $(this);
                        var oldValue = button.parent().parent().find('input').val();
                        if (button.hasClass('btn-plus')) {
                            var newVal = parseFloat(oldValue) + 1;
                        } else {
                            if (oldValue > 0) {
                                var newVal = parseFloat(oldValue) - 1;
                            } else {
                                newVal = 0;
                            }
                        }
                        button.parent().parent().find('input').val(newVal);
                    });
            });
        </script>
    </body>
    @yield('scriptSource')
</html>

