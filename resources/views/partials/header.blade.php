<header class="header">
    <div class="sticky-wrapper">
        <div role="" class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" data-toggle="collapse" data-target=".navbar-collapse" class="navbar-btn btn-sm navbar-toggle">
                        <span class="icon-bar"></span><span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    @if (!Auth::guest())
                    <a href="#intro" class="navbar-brand scroll-to" style="margin-top: 5%">{{ Auth::User()->name }}'s
                        Photography</a>
                    @endif
                </div>
                <div  class="collapse navbar-collapse navbar-right">
                    <ul id="" class="nav navbar-nav">
                        @if (!Auth::guest())
                        <li class="active"><a href="#intro">Home</a></li>
                        <li><a href="{{URL::Asset('/profile/'.Auth::User()->name.'#about')}}">About </a></li>
                        <li><a href="{{URL::Asset('/profile/'.Auth::User()->name.'#portfolio')}}">Portfolio</a></li>
                        <li><a href="{{URL::Asset('/profile/'.Auth::User()->name.'#testimonials')}}">Testimonials</a></li>
                        <li><a href="{{URL::Asset('/profile/'.Auth::User()->name.'#text')}}">Blog</a></li>
                        <li><a href="{{URL::Asset('/profile/'.Auth::User()->name.'#contact')}}">Contact</a></li>
                         @endif
                    </ul>
                    <ul class="nav navbar-nav">
                        @if (Auth::guest())
                            <li><a href="{{ URL::Asset('login') }}">{!! trans('titles.login') !!}</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Administration <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{url('/albums/')}}">Albums</a></li>
                                    <li><a href="{{ url('/profile/'.Auth::User()->name.'/edit') }}">Edit
                                            Profile</a></li>
                                    <li><a>Sales Report</a></li>

                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>

                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
