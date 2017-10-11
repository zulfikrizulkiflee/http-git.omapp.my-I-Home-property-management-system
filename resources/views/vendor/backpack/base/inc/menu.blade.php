<div class="navbar-custom-menu pull-left">
    <ul class="nav navbar-nav">
        <!-- =================================================== -->
        <!-- ========== Top menu items (ordered left) ========== -->
        <!-- =================================================== -->

        <!-- <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> <span>Home</span></a></li> -->

        <!-- ========== End of top menu left items ========== -->
    </ul>
</div>


<div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- ========================================================= -->
      <!-- ========== Top menu right items (ordered left) ========== -->
      <!-- ========================================================= -->

      <!-- <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> <span>Home</span></a></li> -->

        @if (Auth::guest())
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/login') }}">{{ trans('backpack::base.login') }}</a></li>
            @if (config('backpack.base.registration_open'))
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/register') }}">{{ trans('backpack::base.register') }}</a></li>
            @endif
        @else
            <div class="form-group search-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-btn fa-search"></i></span>
                <input type="text" class="form-control search-input" placeholder="Search your property...">
              </div>
              <span class="glyphicon glyphicon-remove search-cancel" aria-hidden="true"></span>
            </div>
            <li><a class="search-icon" href="javascript:;"><i class="fa fa-btn fa-search"></i></a></li>
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/logout') }}"><i class="fa fa-btn fa-sign-out"></i> {{ trans('backpack::base.logout') }}</a></li>
        @endif

       <!-- ========== End of top menu right items ========== -->
    </ul>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $('.search-group').hide();
    $('.search-icon').click(function () {
        $('.search-group').show();
    });
    $('.search-cancel').click(function () {
        $('.search-group').hide();
        $('.search-input').val("");
    });
    $('.search-input').keypress(function (e) {
        if (e.which == 13) {
            if ($('.search-input').val() != null || $('.search-input').val() != "") {
                var search_str=$(this).val();
                window.open("{{ url(config('backpack.base.route_prefix', 'admin').'/properties/watch/search/search_str"+search_str+"') }}");
            }
        }
    });
</script>
