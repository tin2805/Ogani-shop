<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login</title>

    <!-- Fontfaces CSS-->
    <link href="{{asset('public/backend/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('public/backend/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('public/backend/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('public/backend/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{asset('public/backend/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    {{-- <link href="{{asset('public/backend/vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all"> --}}
    <link href="{{asset('public/backend/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('public/backend/vendor/wow/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('public/backend/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('public/backend/vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('public/backend/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('public/backend/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{asset('public/backend/css/theme.css')}}" rel="stylesheet" media="all">
</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="{{URL::to('/admin/show-login')}}">
                                <img src="{{asset('public/backend/img/icon/logo.png')}}" alt="CoolAdmin">
                            </a>
                        </div>
                        <?php 
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert" style="color:red;font-size:30px;text-align:center;width:100%">' . $message . '</span>';
                                Session::put('message',null);
                            }
					    ?>
                        <div class="login-form">
                            <form action="{{URL::to('/admin/register')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input class="au-input au-input--full" type="text" name="admin_name" placeholder="Full Name">
                                </div>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="admin_email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="admin_password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input class="au-input au-input--full" type="text" name="admin_phone" placeholder="Phone Number">
                                </div>
                                <div class="form-group">
                                    <label>Avatar</label>
                                    <input class="au-input au-input--full" type="file" name="admin_ava" >
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign up</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <!-- Jquery JS-->
    <script src="{{asset('public/backend/vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{asset('public/backend/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/backend/bootstrap-4.1/popper.min.js')}}"></script>
    <!-- Vendor JS       -->
    <script src="{{asset('public/backend/vendor/slick/slick.min.js')}}"></script>
    <script src="{{asset('public/backend/vendor/wow/wow.min.js')}}"></script>
    <script src="{{asset('public/backend/vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{asset('public/backend/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <script src="{{asset('public/backend/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('public/backend/vendor/counter-up/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('public/backend/vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{asset('public/backend/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('public/backend/vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('public/backend/vendor/select2/select2.min.js')}}"></script>

    <!-- Main JS-->
    <script src="{{asset('public/backend/js/main.js')}}"></script>

</body>

</html>
<!-- end document-->