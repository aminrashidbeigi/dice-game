<!doctype html>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <script>

            jQuery(document).ready(function ($) {

                $('#checkbox').change(function(){
                    setInterval(function () {
                        moveRight();
                    }, 3000);
                });

                var slideCount = $('#slider ul li').length;
                var slideWidth = $('#slider ul li').width();
                var slideHeight = $('#slider ul li').height();
                var sliderUlWidth = slideCount * slideWidth;

                $('#slider').css({ width: slideWidth, height: slideHeight });

                $('#slider ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });

                $('#slider ul li:last-child').prependTo('#slider ul');

                function moveLeft() {
                    $('#slider ul').animate({
                        left: + slideWidth
                    }, 200, function () {
                        $('#slider ul li:last-child').prependTo('#slider ul');
                        $('#slider ul').css('left', '');
                    });
                };

                function moveRight() {
                    $('#slider ul').animate({
                        left: - slideWidth
                    }, 200, function () {
                        $('#slider ul li:first-child').appendTo('#slider ul');
                        $('#slider ul').css('left', '');
                    });
                };

                $('a.control_prev').click(function () {
                    moveLeft();
                });

                $('a.control_next').click(function () {
                    moveRight();
                });

            });

        </script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            #slider {
                position: relative;
                overflow: hidden;
                margin: 20px auto 0 auto;
                border-radius: 4px;
            }

            #slider ul {
                position: relative;
                margin: 0;
                padding: 0;
                height: 200px;
                list-style: none;
            }

            #slider ul li {
                position: relative;
                display: block;
                float: left;
                margin: 0;
                padding: 0;
                width: 500px;
                height: 300px;
                background: #ccc;
                text-align: center;
                line-height: 300px;
            }

            a.control_prev, a.control_next {
                position: absolute;
                top: 40%;
                z-index: 999;
                display: block;
                padding: 4% 3%;
                width: auto;
                height: auto;
                background: #2a2a2a;
                color: #fff;
                text-decoration: none;
                font-weight: 600;
                font-size: 18px;
                opacity: 0.8;
                cursor: pointer;
            }

            a.control_prev:hover, a.control_next:hover {
                opacity: 1;
                -webkit-transition: all 0.2s ease;
            }

            a.control_prev {
                border-radius: 0 2px 2px 0;
            }

            a.control_next {
                right: 0;
                border-radius: 2px 0 0 2px;
            }

        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/admin') }}">Admin</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content" style="text-align: center">
                <div class="title m-b-md">
                    Dice Game
                </div>


                <div id="slider">
                    <a href="#" class="control_next">></a>
                    <a href="#" class="control_prev"><</a>
                    <ul>
                        <li>SLIDE 1</li>
                        <li style="background: #aaa;">SLIDE 2</li>
                        <li>SLIDE 3</li>
                        <li style="background: #aaa;">SLIDE 4</li>
                    </ul>
                </div>


                <table class="table table-striped table-hover table-responsive datatable" id="datatable">
                    <thead>
                    <tr>
                        <th>Maximum Score</th>
                        <th>User</th>
                        <th>Number Of Dice</th>

                        <th>Play</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($games as $row)
                        <tr>
                            <td>{{ $row->maximum_score }}</td>
                            <td>{{ $row->user->name }}</td>
                            <td>{{ $row->dice_number }}</td>
                            <td>
                                <a href="http://localhost:3000/game/{{ $row->id }}-{{$row->user_id}}">
                                    <input type="button" value="Play Now" class="btn btn-success">
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <hr>
                <div>
                    <h4>Online Users</h4>
                    {{--<ul>--}}
                        @foreach($onlineUsers as $u)
                            {{ $u->name }} is Online
                            {{--<li> </li>--}}
                        @endforeach
                    {{--</ul>--}}
                </div>
                </div>
        </div>


    </body>
</html>
