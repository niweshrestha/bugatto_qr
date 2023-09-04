<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('landing/js/scripts.js')}}"></script>
<script src="{{asset('landing/js/jquery.countdown.min.js')}}"></script>
<script>
   ;(function($) {
     
    var MERCADO_JS = {
      init: function(){
         this.mercado_countdown();
          
      }, 
    mercado_countdown: function() {
         if($(".mercado-countdown").length > 0){
                $(".mercado-countdown").each( function(index, el){
                  var _this = $(this),
                  _expire = _this.data('expire');
               _this.countdown(_expire, function(event) {
                        $(this).html( event.strftime('<span><b>%D</b> Days</span> <span><b>%-H</b> Hrs</span> <span><b>%M</b> Mins</span> <span><b>%S</b> Secs</span>'));
                    });
                });
         }
      },
    
   }
    
      window.onload = function () {
         MERCADO_JS.init();
      }
    
      })(window.Zepto || window.jQuery, window, document);
</script>
<script>
    $(".alert").delay(5000).queue(function() {
        $(this).remove();
    });
</script>
<!-- Toastr -->
{{-- <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script> --}}

{{-- <script>
    $(document).ready(function() {
        toastr.options = {
            "positionClass": "toast-top-right",
            "progressBar": true,
            "closeButton":true,
        }

        @if (Session::has('success'))
            toastr.success("{{ session('success') }}")
        @endif

        @if (Session::has('error-message'))
            toastr.error("{{ session('error-message') }}")
        @endif
    });
</script> --}}
