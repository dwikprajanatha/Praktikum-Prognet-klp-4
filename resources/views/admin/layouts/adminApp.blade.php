<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href= "{{ asset('adminAssets/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href= "{{ asset('adminAssets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href= "{{ asset('adminAssets/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href= "{{ asset('adminAssets/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">

    <!-- JQVMap -->
    <link href= "{{ asset('adminAssets/vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href= "{{ asset('adminAssets/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href= "{{ asset('adminAssets/build/css/custom.min.css') }}" rel="stylesheet">

    @yield('css')


  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2> {{Auth::guard('admin')->user()->name}} </h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-home"></i> Home </span></a>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Master Data <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('product.index')}}">Product</a></li>

                      <li><a href="{{route('category.index')}}">Categories</a></li>

                      <li><a href="{{route('courier.index')}}">Couriers</a></li>

                      <li><a href="{{route('discount.index')}}">Discount</a></li>
                      
                      <li><a href="{{route('index.transaksi')}}">Transaction</a></li>

                      <li><a href="{{route('show.reviews')}}">Reviews User</a></li>

                    </ul>
                  </li>

                  
                </ul>
              
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/img.jpg" alt="">{{Auth::guard('admin')->user()->name}}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li>
                    <!-- <a href="{{route('admin.logout')}}">Logout</a> -->
                        <a
                          onclick="event.preventDefault; document.getElementById('logout-form').submit();">
                          Logout
                        </a>

                        <form id="logout-form" action= " {{ route('admin.logout') }} " method="POST" style="display: one;">
                          {{ csrf_field() }}
                        </form>
                                                        
                    </li>
                  </ul>
                </li>

              @php
              
              $id = Auth::guard('admin')->user()->id;
              $jum = auth()->guard('admin')->user()->unreadNotifications->count();
              $notif = DB::table('admin_notifications')->where('read_at',NULL)->orderBy('created_at','desc')->get();

              @endphp

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">{{$jum}}</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                  @foreach($notif as $notif)
                    <li>
                      {!! $notif->data !!}
                    </li>
                  @endforeach
                  <li><a id="readnotif">Marks as Read</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        @yield('content')




                <!-- footer content -->
                <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('adminAssets/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src='{{ asset("adminAssets/vendors/bootstrap/dist/js/bootstrap.min.js") }}'></script>
    <!-- bootstrap-datetimepicker -->    
    <script src='{{ asset("adminAssets/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js") }}'></script>
   

    <!-- Custom Theme Scripts -->
    <script src="{{ asset('adminAssets/build/js/custom.min.js') }}"></script>

    <script type="text/javascript">
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#readnotif').click(function(){
            console.log("terklik");
            $.ajax({
                  url: '{{route('admin.read.notif')}}',  
                  type : 'post',
                  dataType: 'JSON',
                  data: {
                    "_token": "{{ csrf_token() }}",
                    
                    },
                  success:function(response){
                        location.reload();
                  },
                  error:function(err){
                    console.log(err)
                    alert("GAGAL");
                  }
              });
        });
    });

    </script>

    @stack('javascript')

    

  </body>
</html>