<!doctype html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="description" content="ogani template">
    <meta name="keywords" content="ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Quản lí học phí sinh viên</title>

    <!-- google font -->
    {{-- <link href="https://fonts.googleapis.com/css2?family=cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet"> --}}

    <!-- css styles -->
    <link rel="stylesheet" href="{{ asset('site/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('site/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('site/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('site/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('site/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('site/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('site/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('site/css/style.css') }}" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.3/css/bootstrap.css" rel="stylesheet">  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.3/js/bootstrap.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.js"></script> 
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

    <link rel="stylesheet" href="{{ asset('ad/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    {{-- Back to top button --}}
    <style>
        #myBtn {
          display: none;
          position: fixed;
          bottom: 20px;
          right: 30px;
          z-index: 99;
          font-size: 18px;
          border: none;
          outline: none;
          background-color: red;
          color: white;
          cursor: pointer;
          padding: 15px;
          border-radius: 4px;
        }

        #myBtn:hover {
          background-color: #555;
        }
    </style>
    @yield('css')
</head>

<body>
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-arrow-up"></i></button>
    <!-- success noti -->

    @if(isset($success))
    <div class="alert alert-success" role="alert">
        {{$success;}}
    </div>
    @endif
    <!-- error -->
    @if(isset($error))
    <div class="alert alert-warning" role="alert">
        {{ $error}}
    </div>
    @endif
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="{{route('home')}}"><img src="{{ asset('site/img/logo_bkacad.png') }}" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
    </div>
    <!-- humberger end -->

    <!-- header section begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="{{route('home')}}"><img src="{{ asset('site/img/logo_bkacad.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-9 push-4">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="{{route('home')}}">Trang chủ</a></li>
                            <li><a href="{{route('history')}}">Lịch sử</a>
                            </li>
                            <li><a href="{{route('quydinhhocphi')}}">Quy định học phí</a>
                            </li>

                            <li><a href="{{ route('profile') }}">Thông tin sinh viên</a></li>
                            <li>
                                
                                <ul class="nav navbar-nav navbar-right">
                                    <a href="{{route('profile')}}">Hi {{ Session::get('student.lastname') }}</a>
                                    <li class="dropdown">                                        
                                        <a onClick="return confirm('Are you sure want to logout')" href="{{route('logout')}}">Logout</a>                                      
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- header section end -->

@yield('main')
<!-- footer section begin -->
<footer class="footer spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__about__logo">
                        <a href="#"><img src="{{ asset('site/img/logo_bkacad.png') }}" alt=""></a>
                    </div>
                    <ul>
                        
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                <div class="footer__widget">
                    <h6>useful links</h6>
                    <ul>
                        <li><a href="#">quy định học phí</a></li>
                        <li><a href="#">tin tức học viện</a></li>
                        <li><a href="#">thông tin sinh viên</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="footer__widget">
                    <h1>Right footer</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright">
                    <div class="footer__copyright__text"><p>Copyright TVD</p></div>
                        
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer section end -->
@yield('js')
<script>
//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>
    <!-- js plugins -->
    <script src="{{ asset('site/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('site/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('site/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('site/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('site/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('site/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('site/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('site/js/main.js') }}"></script>
<!-- jQuery -->
</body>

</html>