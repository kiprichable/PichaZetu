<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/jquery-1.11.0.min.js"><\/script>')</script>
{{--<!-- Bootstrap CDN-->--}}
<!-- jQuery Cookie - For Demo Purpose-->
@if(Route::currentRouteName() == 'profile.edit')
<script src="{{ URL::Asset('js/app.js') }}"></script>
@else
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
@endif


<!-- Lightbox-->
<script src="{{URL::Asset('js/ekko-lightbox.js')}}"> </script>
<!-- Sticky + Scroll To scripts for navbar-->
<script src="{{URL::Asset('js/jquery.sticky.js')}}"></script>
<script src="{{URL::Asset('js/jquery.scrollTo.min.js')}}"></script>
<script src="{{URL::Asset('js/front.js')}}"></script>
<script src="{{URL::Asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
<script src="{{URL::Asset('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>

@yield('footer_scripts')
<script>
    $('img').bind('contextmenu', function(e) {
        return false;
    });
</script>
@if(Auth::User())
    <script>
        var edit = CKEDITOR.instances.bio;
        if (!edit)
        {
            CKEDITOR.replace('bio');
        }
    </script>
@endif