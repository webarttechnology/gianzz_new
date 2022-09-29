<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{ config('app.name') }}: Login</title>
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/icons.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/plugins/scroll-bar/jquery.mCustomScrollbar.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/plugins/toggle-menu/sidemenu.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/plugins/morris/morris.css') }}">
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script>
        function valid() {
            if ($("#email_id").val() == '') {
                $("#errmsg").html("Please enter a valid Email ID!!");
                $("#email_id").css("border-color", "red");
                return false;
            } else if ($("#password").val() == '') {
                $("#errmsg").html("Please enter your password!!");
                $("#password").css("border-color", "red");
                return false;
            }
        }
        </script>
    </head>
    <body class="bg-primary">
        <div id="app" class="page">
            <section class="section">
                <div class="container">
                    <div class="">
                        <div class="single-page">
                            <div>
                                <div class="wrapper wrapper2">
                                    <form id="login" class="card-body" tabindex="500" method="post"
                                        action="{{ URL::to('author/login') }}" class="form-horizontal"
                                        onsubmit="return valid();">
                                        @csrf
                                        <div class="">
                                            <img src="{{ asset('frontend/images/bannertext.png') }}" width="120px" alt="Logo" />
                                        </div>
                                        <h3 class="text-dark">Login to your account</h3>
                                        <div class="pull-left">
                                            @foreach($errors -> all() as $errvalue)
                                            <span style="color:red;">{{ $errvalue }}</span>
                                            <br />
                                            @endforeach
                                            <span style="color:green" id="successmsg">{{ Session::get('successmsg') }}</span>
                                            <span style="color:red" id="errmsg">{{ Session::get('errmsg') }}</span>

                                        </div>

                                        <div class="mail">
                                            <input type="text" name="email_id" id="email_id" class="form-control"
                                                placeholder="Email ID" autocomplete="off" value="{{old('email_id')}}" />
                                        </div>
                                        <div class="passwd">
                                            <input type="password" name="password" class="form-control" id="password"
                                                placeholder="Password" >
                                        </div>
                                        <p class="mb-3 text-right"><a href="{{ URL::to('author/forgot')  }}">Forgot Password</a></p>
                                        <div class="submit">
                                            <input class="btn btn-primary btn-block" type="submit" name="login"
                                                value="Sign In" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="login-footer">
                                <br>
                                <div class="text-center">
                                    &copy; {{ config('app.name') }} {{ date('Y', time()) }}
                                </div>
                            </div>
                        </div>
                        <!--single-page closed-->

                    </div>
                </div>
            </section>

            <script src="{{ asset('assets/js/toastr.min.js') }}" type=""></script>
            <script src="{{ asset('assets/js/popper.js') }}"></script>
            <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
            <script src="{{ asset('assets/js/tooltip.js') }}"></script>
            <script src="{{ asset('assets/plugins/rating/jquery.rating-stars.js') }}"></script>
            <script src="{{ asset('assets/plugins/toggle-menu/sidemenu.js') }}"></script>
            <script src="{{ asset('assets/plugins/othercharts/jquery.knob.js') }}"></script>
            <script src="{{ asset('assets/plugins/othercharts/jquery.sparkline.min.js') }}"></script>
            <script src="{{ asset('assets/plugins/Chart.js/dist/Chart.min.js') }}"></script>
            <script src="{{ asset('assets/plugins/Chart.js/dist/Chart.extension.js') }}"></script>
            <script src="{{ asset('assets/plugins/morris/morris.min.js') }}"></script>
            <script src="{{ asset('assets/plugins/morris/raphael.min.js') }}"></script>
            <script src="{{ asset('assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
            <script src="{{ asset('assets/js/dashboard2.js') }}"></script>
            <script src="{{ asset('assets/js/jquery.showmore.js') }}"></script>
            <script src="{{ asset('assets/js/sparkline.js') }}"></script>
            <script src="{{ asset('assets/js/barcharts.js') }}"></script>
            <script src="{{ asset('assets/js/othercharts.js') }}"></script>
            <script src="{{ asset('assets/js/scripts.js') }}"></script>

</html>