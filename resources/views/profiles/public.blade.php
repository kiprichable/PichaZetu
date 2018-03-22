<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $user->name }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap and Font Awesome css-->
    <!-- we use cdn but you can also include local files located in css directory-->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- Google fonts - Montserrat for headings, Cardo for copy-->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Montserrat:400,700|Cardo:400,400italic,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{URL::Asset('css/style.css')}}" id="theme-stylesheet">
    <link rel="stylesheet" href="{{URL::Asset('css/ekko-lightbox.css')}}">
    <!-- ekko lightbox-->
    <!-- Custom stylesheet - for your changes-->
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{URL::Asset('img/logo.png')}}">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<body data-spy="scroll" data-target="#navigation" data-offset="120">
<!-- intro-->
<section id="intro" style="background-image: url('{{URL::Asset('img/photo.jpeg')}}');" class="intro">
    <div class="overlay"></div>
    <div class="content">
        <div class="container clearfix">
            @include('partials.form-status')
            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-sm-12">
                    <p class="italic">Hello, My name is {{ $user->first_name }}, nice to meet you!</p>
                    <h1>I am a professional photographer,</h1>
                    <p class="italic">With a vast experience in Capturing life's Greatest Moments.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- intro end-->
<!-- navbar-->
@include('partials.header')

<!-- /.navbar-->
<!-- about-->

{!! Form::model($user->profile, ['method' => 'PATCH', 'route' => ['profile.update', $user->name],  'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data'  ]) !!}
<section id="about" class="text">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>BIO</h2>
                @if(Auth::user())
                    <div class="form-group">
                        <a class="btn btn-primary btn-block" href="{!! URL::Asset('profile/'.$user->name.'/edit')
                        !!}">Edit Profile</a>
                    </div>
                    <div class="form-group col-lg-12">
                        {!! Form::label('My Bio', 'My Bio', ['class' => 'control-label']) !!}
                        {!! Form::textarea('bio', $user->profile->bio, ['class' => 'form-control', 'id' => 'bio']) !!}
                    </div>
                    <div class="form-group col-lg-12">
                        <input type="submit" name="name" value="Update Bio" class="btn btn-primary btn-block">
                    </div>
               @else
                    <p>{!! $user->profile->bio !!}</p>
                @endif
            </div>
            <div class="col-md-5 col-md-offset-1">
                <p><img src="{{URL::Asset('img/photography.jpeg')}}" alt="" class="img-responsive img-thumbnail"></p>
            </div>
        </div>
    </div>
</section>
<!-- about end-->

{{Form::close()}}

<!-- Portfolio / gallery-->
{{Form::open()}}
<section id="portfolio" class="gallery">
    <div class="container clearfix">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <h2 class="heading">Portfolio</h2>
                        <p class="lead">Gallery: <small>Recent projects</small></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="box"><a href="{{URL::Asset('img/1.jpg')}}" title="" data-toggle="lightbox" data-gallery="portfolio" data-title="Portfolio image 1" data-footer="Some footer information"><img src="{{URL::Asset('img/1.jpg')}}" alt="" class="img-responsive"></a></div>
                    </div>
                    <div class="col-sm-4">
                        <div class="box"><a href="{{URL::Asset('img/1.jpg')}}" title="" data-toggle="lightbox" data-gallery="portfolio" data-title="Portfolio image 2" data-footer="Some footer information"><img src="{{URL::Asset('img/1.jpg')}}" alt="" class="img-responsive"></a></div>
                    </div>
                    <div class="col-sm-4">
                        <div class="box"><a href="{{URL::Asset('img/1.jpg')}}" title="" data-toggle="lightbox" data-gallery="portfolio" data-title="Portfolio image 3" data-footer="Some footer information"><img src="{{URL::Asset('img/1.jpg')}}" alt="" class="img-responsive"></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Portfolio / gallery end-->
{{Form::close()}}
<!-- Services-->
<section id="testimonials" style="background-color: #eee">
    <div class="container">
        <div class="row services">
            <div class="col-md-12">
                <h3>Customer Review</h3>
                <hr/>

                <div class="row">
                    <div class="col-sm-4">
                        <div>
                            <h6 class="font-weight-bold">John</h6>
                            <p class="italic">Wonderful photographer.</p>
                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="box">
                            <h6 class="font-weight-light font-italic">Emily</h6>
                            <p class="italic">Wonderful photographer.</p>
                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="box">
                            <h6 class="font-weight-light font-italic">Jane</h6>
                            <p class="italic">Wonderful photographer.</p>
                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Services end-->
<!-- text page-->
{!! Form::open(['url' => 'blogs', 'method' => 'POST']) !!}
<section id="text" style="background-color: #333;" class="text-page section-inverse">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="heading">Blog</h2>
                @if(Auth::user())
                    <div class="form-group col-lg-12">
                        {!! Form::label('Blog Title', 'Title', ['class' => 'control-label']) !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group col-lg-12">
                        {!! Form::label('Blog', 'Blog', ['class' => 'control-label']) !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control', 'id' => 'editor']) !!}
                    </div>
                    <div class="form-group col-lg-12">
                        <input type="submit"  value="Save Blog" class="btn btn-primary btn-block">
                    </div>
                @endif

                @foreach($user->blogs($user->name) as $blog)
                <div class="col-sm-6">
                    <p class="lead">{!! $blog->name !!}</p>
                    <p>{!! $blog->description !!}</p>

                </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
</section>
{!! Form::close() !!}
<!-- text page end-->
<!-- contact-->
<section id="contact" style="background-color: #fff;" class="text-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="heading">Contact</h2>
                @if(Auth::user())
                    <div class="row">
                        <p class="lead">Customer Messages</p>
                        <table class="table table-resposive">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Message</th>
                                <th scope="col">Date</th>
                            </tr>
                            </thead>

                                @foreach($user->feedback($user->name) as $feedback)
                                <tbody>
                                <tr>
                                    <td>{!! $feedback->fname .' '.$feedback->lname !!}</td>
                                    <td>{!! $feedback->message !!}</td>
                                    <td>{!! $feedback->created_at !!}</td>
                                </tr>
                                </tbody>
                                @endforeach

                        </table>
                    </div>
                @else
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::open(['url' => 'contactus/'.$user->name, 'method' => 'POST', 'id' =>'contact-form', 'class'  =>'contact-form']) !!}                         <div class="controls">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name">Your firstname *</label>
                                            <input type="text" name="fname" placeholder="Enter your firstname"
                                                   required="required" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="surname">Your lastname *</label>
                                            <input type="text" name="lname" placeholder="Enter your  lastname"
                                                   required="required" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="surname">Your email *</label>
                                    <input type="email" name="email" placeholder="Enter your  email" required="required" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="surname">Your message for us *</label>
                                    <textarea rows="4" name="message" placeholder="Enter your message" required="required" class="form-control"></textarea>
                                </div>
                                <div class="text-center">
                                    <input type="submit"  value="Send message" class="btn btn-primary btn-block">
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="col-md-6">
                        <p>I’d love for you to connect with us on our social media pages. We want to make sure you have
                            the opportunity to connect with us, and most importantly, with each other. Whether it's
                            to share stories, or to talk about how you experience with {{$user->name}}'s photography was.</p>
                        <p class="social"><a href="#" title="" class="facebook"><i class="fa fa-facebook"></i></a><a href="#" title="" class="twitter"><i class="fa fa-twitter"></i></a><a href="#" title="" class="instagram"><i class="fa fa-instagram"></i></a></p>
                    </div>
                </div>
               @endif
            </div>
        </div>
    </div>
</section>
<footer style="background-color: #111;" class="section-inverse">
    <div class="container">
        <div class="row copyright">
            <div class="col-md-6">
                <p>&copy;{!! date('Y') !!} {!! $user->name !!}</p>
            </div>
            <div class="col-md-6">
                <p class="credit">Powered by picha sell - <a href="">Privacy Policy</a></p>
                <!-- Please do not remove the backlink to us. It is part of the licence conditions. Thanks for understanding :)
                -->
            </div>
        </div>
    </div>
</footer>
<!-- Javascript files-->
<!-- jQuery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/jquery-1.11.0.min.js"><\/script>')</script>
<!-- Bootstrap CDN-->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!-- jQuery Cookie - For Demo Purpose-->
<!-- Lightbox-->
<script src="{{URL::Asset('js/ekko-lightbox.js')}}"> </script>
<!-- Sticky + Scroll To scripts for navbar-->
<script src="{{URL::Asset('js/jquery.sticky.js')}}"></script>
<script src="{{URL::Asset('js/jquery.scrollTo.min.js')}}"></script>
<script src="{{URL::Asset('js/front.js')}}"></script>
<script src="{{URL::Asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
<script src="{{URL::Asset('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>

{{--@push('scripts')--}}
<script>
    var edit = CKEDITOR.instances.editor;
    if (!edit)
    {
        CKEDITOR.replace('editor');
        CKEDITOR.replace('bio');
    }
</script>
{{--@endpush--}}
</body>
</html>

{{--@stop--}}