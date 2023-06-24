<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>


<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/wow.min.js')}}"></script>
<script src="{{asset('js/slick.js')}}"></script>
<script src="{{asset('js/fancybox.min.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>

<script src="{{asset('dash/js/jquery.toast.js')}}"></script>
<script>

    var Loader = function () {
        return {
            show: function () {
                jQuery("#preloader").show();
            },
            hide: function () {
                jQuery("#preloader").hide();
            }
        };
    }();
</script>
@if(Auth::guard('admin'))
  <script src="{{asset('admin/js/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
  <script src="{{ asset('admin/js/content-management.js') }}"></script>
@endif