<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<!DOCTYPE html><html class=''>
<head><script src='//production-assets.codepen.io/assets/editor/live/console_runner-079c09a0e3b9ff743e39ee2d5637b9216b3545af0de366d4b9aad9dc87e26bfd.js'></script><script src='//production-assets.codepen.io/assets/editor/live/events_runner-73716630c22bbc8cff4bd0f07b135f00a0bdc5d14629260c3ec49e5606f98fdd.js'></script><script src='//production-assets.codepen.io/assets/editor/live/css_live_reload_init-2c0dc5167d60a5af3ee189d570b1835129687ea2a61bee3513dee3a50c115a77.js'></script><meta charset='UTF-8'><meta name="robots" content="noindex"><link rel="shortcut icon" type="image/x-icon" href="//production-assets.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" /><link rel="mask-icon" type="" href="//production-assets.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" /><link rel="canonical" href="https://codepen.io/kkanyingi/pen/vLowwB?limit=all&page=2&q=page" />
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Playfair+Display:400italic,700italic' rel='stylesheet' type='text/css'>

    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'><link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'><link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Playfair+Display:400italic,700italic'>
    <style class="cp-pen-styles">html {
            font-size: 62.5%;
        }

        body {
            font-size: 1.4rem;
        }

        /* =14px */
        h1 {
            font-size: 2.4rem;
        }

        /* =24px */
        .container__item {
            margin: 0 auto 40px;
        }

        .landing-page-container {
            width: 100%;
            min-height: 100%;
            height: 90rem;
            background-image: url("https://s29.postimg.org/vho8xb2pj/landing_bg.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: bottom;
            overflow: hidden;
            font-family: 'Montserrat', sans-serif;
            color: #09383E;
        }

        .content__wrapper {
            max-width: 1200px;
            width: 90%;
            height: 100%;
            margin: 0 auto;
            position: relative;
        }

        .header {
            width: 100%;
            height: 2rem;
            padding: 4.5rem 0;
            display: block;
        }

        .menu-icon {
            width: 2.5rem;
            height: 1.5rem;
            display: inline-block;
            cursor: pointer;
        }

        .header__item {
            display: inline-block;
            float: left;
        }

        .menu-icon__line {
            width: 1.5rem;
            height: 0.2rem;
            background-color: #0C383E;
            display: block;
        }
        .menu-icon__line:before, .menu-icon__line:after {
            content: '';
            width: 1.5rem;
            height: 0.2rem;
            background-color: #0C383E;
            display: inline-block;
            position: relative;
        }
        .menu-icon__line:before {
            left: 0.5rem;
            top: -0.6rem;
        }
        .menu-icon__line:after {
            top: -1.8rem;
        }

        .heading {
            width: 90%;
            font-size: 2rem;
            font-weight: bold;
            margin: 0;
            line-height: 1.7rem;
            margin: 0 auto;
            text-align: center;
        }

        .social-container {
            width: 7.25rem;
            list-style: none;
            overflow: hidden;
            padding: 0;
            margin: 0;
            float: right;
        }
        .social-container .social__icon {
            width: 1.5rem;
            float: left;
            cursor: pointer;
        }
        .social-container .social__icon.social__icon--dr {
            margin-left: 1.25rem;
        }
        .social-container .social__icon.social__icon--in {
            margin-left: 1.5rem;
        }
        .social-container .social__icon.social__icon--fb img {
            margin: 0 0.25rem;
        }

        .coords {
            font-size: 1rem;
            display: inline-block;
            -webkit-transform: rotate(-90deg) translateY(50%);
            transform: rotate(-90deg) translateY(50%);
            float: left;
            position: relative;
            top: 40%;
            letter-spacing: 0.2rem;
            left: -11.5rem;
            margin: 0;
        }

        .ellipses-container {
            width: 50rem;
            height: 50rem;
            border-radius: 50%;
            margin: 0 auto;
            position: relative;
            top: 10.5rem;
        }
        .ellipses-container .greeting {
            position: absolute;
            top: 11.6rem;
            left: 13rem;
            right: 0;
            margin: 0 auto;
            text-transform: uppercase;
            letter-spacing: 4rem;
            font-size: 2.2rem;
            font-weight: 400;
            opacity: 0.5;
        }
        .ellipses-container .greeting:after {
            content: '';
            width: 0.3rem;
            height: 0.3rem;
            border-radius: 50%;
            display: inline-block;
            background-color: #0C383E;
            position: relative;
            top: -0.65rem;
            left: -5.05rem;
        }

        .ellipses {
            border-radius: 50%;
            position: absolute;
            top: 0;
            border-style: solid;
        }

        .ellipses__outer--thin {
            width: 100%;
            height: 100%;
            border-width: 1px;
            border-color: rgba(9, 56, 62, 0.1);
            -webkit-animation: ellipsesOrbit 15s ease-in-out infinite;
            animation: ellipsesOrbit 15s ease-in-out infinite;
        }
        .ellipses__outer--thin:after {
            content: "";
            background-image: url("https://s29.postimg.org/5h0r4ftkn/ellipses_dial.png");
            background-repeat: no-repeat;
            background-position: center;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            position: absolute;
            opacity: 0.15;
        }

        .ellipses__outer--thick {
            width: 99.5%;
            height: 99.5%;
            border-color: #09383E transparent;
            border-width: 2px;
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
            -webkit-animation: ellipsesRotate 15s ease-in-out infinite;
            animation: ellipsesRotate 15s ease-in-out infinite;
        }

        .ellipses__orbit {
            width: 2.5rem;
            height: 2.5rem;
            border-width: 2px;
            border-color: #09383E;
            top: 5rem;
            right: 6.75rem;
        }
        .ellipses__orbit:before {
            content: '';
            width: 0.7rem;
            height: 0.7rem;
            border-radius: 50%;
            display: inline-block;
            background-color: #09383E;
            margin: 0 auto;
            left: 0;
            right: 0;
            position: absolute;
            top: 50%;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
        }

        .scroller {
            width: 7.5rem;
            display: inline-block;
            float: right;
            position: relative;
            top: -15%;
            -webkit-transform: translateY(50%);
            transform: translateY(50%);
            overflow: hidden;
        }
        .scroller .page-title {
            font-family: 'Playfair Display', serif;
            letter-spacing: 0.5rem;
            display: inline-block;
            float: left;
            margin-top: 1rem;
        }
        .scroller .timeline {
            width: 1.5rem;
            height: 9rem;
            display: inline-block;
            float: right;
        }
        .scroller .timeline .timeline__unit {
            width: 100%;
            height: 0.1rem;
            display: block;
            background-color: #0C383E;
            margin: 0 0 2rem;
            opacity: 0.2;
        }
        .scroller .timeline .timeline__unit.timeline__unit--active {
            opacity: 1;
        }
        .scroller .timeline .timeline__unit.timeline__unit--active:after {
            opacity: 0.2;
        }
        .scroller .timeline .timeline__unit:after {
            content: '';
            width: 70%;
            height: 0.1rem;
            display: block;
            position: relative;
            float: right;
            background-color: #0C383E;
            top: 1rem;
        }

        @-webkit-keyframes ellipsesRotate {
            0% {
                -webkit-transform: rotate(-45deg);
                transform: rotate(-45deg);
            }
            100% {
                -webkit-transform: rotate(-405deg);
                transform: rotate(-405deg);
            }
        }

        @keyframes ellipsesRotate {
            0% {
                -webkit-transform: rotate(-45deg);
                transform: rotate(-45deg);
            }
            100% {
                -webkit-transform: rotate(-405deg);
                transform: rotate(-405deg);
            }
        }
        @-webkit-keyframes ellipsesOrbit {
            0% {
                -webkit-transform: rotate(0);
                transform: rotate(0);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @keyframes ellipsesOrbit {
            0% {
                -webkit-transform: rotate(0);
                transform: rotate(0);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
    </style></head><body>
<html>
<head>
    <meta charset="UTF-8"/>
</head>

<body>
<div class="container">
    <div class="container__item landing-page-container">
        <div class="content__wrapper">

            <header class="header">
                <div class="menu-icon header__item">
                    <span class="menu-icon__line"></span>
                </div>
                <ul class="social-container header__item">
                    <a class="page-title" href="{!! URL::Asset('/') !!}"> >> More info >></a>
                </ul>
                <h1 class="heading header__item">PICHA SELL</h1>



            </header>
            <h6 class="text-danger" align="center">{{$error}}</h6>
            <p class="coords">N 49° 16' 35.173"  /  W 0° 42' 11.30"</p>

            <div class="ellipses-container">

                <h2 class="greeting">Hello</h2>

                <div class="ellipses ellipses__outer--thin">

                    <div class="ellipses ellipses__orbit"></div>

                </div>

                <div class="ellipses ellipses__outer--thick"></div>
            </div>
        </div>

    </div>

</div>

</body>
</html>


</body></html>