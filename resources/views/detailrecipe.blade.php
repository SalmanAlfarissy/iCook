<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>iCook : Resep Makanan</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('recipe/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('recipe/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('recipe/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('recipe/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('recipe/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('recipe/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('recipe/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('recipe/css/gijgo.css') }}">
    <link rel="stylesheet" href="{{ asset('recipe/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('recipe/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('recipe/css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ asset('recipe/css/style.css') }}">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area ">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-2">
                            <div class="logo">
                                <a href="index.html">
                                    <img src="img/logo.png" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-7">
                            <div class="main-menu   d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a href="/">home</a></li>
                                        <li><a href="#">about</a></li>
                                        <li><a href="#">Recipes<i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="/">All</a></li>
                                                @foreach ($category as $item)
                                                <li><a href="javascript:category({{ $item->id }})">{{ $item->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>

                                        <li><a href="{{ !empty(Auth::user()) ? '/dashboard' : '/login' }}">{{ !empty(Auth::user()) ? 'Dashboard' : 'Login' }}</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                            <div class="search_icon">
                                <a href="#">
                                    <i class="ti-search"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->

    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>Recipe Details</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /bradcam_area  -->

    <div class="recepie_details_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-md-6">
                    <div class="recepies_thumb">
                        <img src="{{ asset('image/content/'.$data->gambar) }}" alt="">
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="recepies_info">
                        <div class="resepies_details">
                            <ul>
                                <li><p><strong>Rating</strong> : <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> </p></li>
                                <li><p><strong>Category</strong> : {{ $data->category['name'] }} </p></li>
                                <li><p><strong>Tags</strong> :  Dinner, Main, Chicken, Dragon, Phoenix </p></li>
                            </ul>
                        </div>
                        <div class="links">
                            <a href="#"> <i class="fa fa-facebook"></i> </a>
                            <a href="#"> <i class="fa fa-twitter"></i> </a>
                            <a href="#"> <i class="fa fa-linkedin"></i> </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="recepies_text">
                        <p>{!! $data->content !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- footer  -->
        <footer class="footer">
            {{-- <div class="footer_top">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-2 col-md-6 col-lg-2">
                            <div class="footer_widget">
                                <h3 class="footer_title">
                                    Top Products
                                </h3>
                                <ul>
                                    <li><a href="#">Managed Website</a></li>
                                    <li><a href="#"> Manage Reputation</a></li>
                                    <li><a href="#">Power Tools</a></li>
                                    <li><a href="#">Marketing Service</a></li>
                                </ul>

                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 col-lg-2">
                            <div class="footer_widget">
                                <h3 class="footer_title">
                                    Quick Links
                                </h3>
                                <ul>
                                    <li><a href="#">Jobs</a></li>
                                    <li><a href="#">Brand Assets</a></li>
                                    <li><a href="#">Investor Relations</a></li>
                                    <li><a href="#">Terms of Service</a></li>
                                </ul>

                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 col-lg-2">
                            <div class="footer_widget">
                                <h3 class="footer_title">
                                    Features
                                </h3>
                                <ul>
                                    <li><a href="#">Jobs</a></li>
                                    <li><a href="#">Brand Assets</a></li>
                                    <li><a href="#">Investor Relations</a></li>
                                    <li><a href="#">Terms of Service</a></li>
                                </ul>

                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 col-lg-2">
                            <div class="footer_widget">
                                <h3 class="footer_title">
                                    Resources
                                </h3>
                                <ul>
                                    <li><a href="#">Guides</a></li>
                                    <li><a href="#">Research</a></li>
                                    <li><a href="#">Experts</a></li>
                                    <li><a href="#">Agencies</a></li>
                                </ul>

                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 col-lg-4">
                                <div class="footer_widget">
                                        <h3 class="footer_title">
                                                Subscribe
                                        </h3>
                                        <p class="newsletter_text">You can trust us. we only send promo offers,</p>
                                        <form action="#" class="newsletter_form">
                                            <input type="text" placeholder="Enter your mail">
                                            <button type="submit"> <i class="ti-arrow-right"></i> </button>
                                        </form>

                                    </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="copy-right_text">
                <div class="container">
                    <div class="footer_border"></div>
                    <div class="row align-items-center">
                        <div class="col-xl-8 col-md-8">
                            <p class="copy_right">
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved <i class="fa fa-heart-o" aria-hidden="true"></i> Zona Kreatif</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </p>
                        </div>
                        {{-- <div class="col-xl-4 col-md-4">
                            <div class="socail_links">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="ti-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="ti-twitter-alt"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-dribbble"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-behance"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </footer>
    <!--/ footer  -->

    <script>
        function category(id) {
            $.ajax({
                type: "Get",
                url: "/",
                data: {},
                success: function (result) {
                    window.location.href = '/?category_id='+id
                }
            });
         }

    </script>

    <!-- JS here -->
    <script src="{{ asset('recipe/js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <script src="{{ asset('recipe/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('recipe/js/popper.min.js') }}"></script>
    <script src="{{ asset('recipe/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('recipe/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('recipe/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('recipe/js/ajax-form.js') }}"></script>
    <script src="{{ asset('recipe/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('recipe/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('recipe/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('recipe/js/scrollIt.js') }}"></script>
    <script src="{{ asset('recipe/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('recipe/js/wow.min.js') }}"></script>
    <script src="{{ asset('recipe/js/nice-select.min.js') }}"></script>
    <script src="{{ asset('recipe/js/jquery.slicknav.min.js') }}"></script>
    <script src="{{ asset('recipe/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('recipe/js/plugins.js') }}"></script>
    <script src="{{ asset('recipe/js/gijgo.min.js') }}"></script>

    <!--contact js-->
    <script src="{{ asset('recipe/js/contact.js') }}"></script>
    <script src="{{ asset('recipe/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('recipe/js/jquery.form.js') }}"></script>
    <script src="{{ asset('recipe/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('recipe/js/mail-script.js') }}"></script>

    <script src="{{ asset('recipe/js/main.js') }}"></script>
</body>

</html>
