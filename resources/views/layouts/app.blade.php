<!DOCTYPE html>
<html lang="en">  
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>
    <!-- <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/export/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/export/buttons.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/cropper.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('sass/app.scss') }}" rel="stylesheet">
    <link href="{{asset('lightbox2/dist/css/lightbox.css')}}" rel="stylesheet" />
    

    @yield('third_party_stylesheets')

    @stack('page_css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper" style="background-color: #dfe6e9;">
    <!-- Main Header -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light"  style="background-color: #6c5ce7">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            @if(env('REMOTE_API_BASE_URL') == 'https://brbene.com/api')
            <li class="nav-item">
                <a class="nav-ilnk btn btn-info" href="{{route('syncData')}}">Data Synchronization</a>
            </li>
            @endif
            <li class="nav-item dropdown user-menu"  >
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" >
                    <img src="{{asset('images/avatar.jpg')}}"
                         class="user-image img-circle elevation-2" alt="User Image">
                    <span class="d-none d-md-inline" >{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right"  >
                    <!-- User image -->
                    <li class="user-header bg-primary"  style="background-color:#00b894">  
                        <img src="{{asset('images/avatar.jpg')}}"
                             class="img-circle elevation-2"
                             alt="User Image">
                        <p>
                            {{ Auth::user()->name }}
                            <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <a href="#" class="btn btn-default btn-flat float-right"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Sign out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Left side column. contains the logo and sidebar -->
@include('layouts.sidebar')

<!-- Content Wrapper. Contains page content -->
            @yield('content')
</div>
<script src="{{ asset('js/app.js') }}"></script>
<!-- <script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/dataTables.js') }}" defer></script> -->
<script src="{{ asset('js/export/jquery-3.5.1.js') }}"></script>
<script src="{{ asset('js/export/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/export/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/export/jszip.min.js') }}"></script>
<script src="{{ asset('js/export/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/export/vfs_fonts.js') }}"></script>
<script src="{{ asset('js/export/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/export/buttons.print.min.js') }}"></script>
<!-- <script src="{{ asset('js/jquery.min.js') }}"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script> -->
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/toastr.min.js') }}"></script>
<script src="{{asset('lightbox2/dist/js/lightbox.js')}}"></script>
<script src="{{asset('js/cropper.js')}}"></script>
<script>
    $(document).ready(function() {
        if($('#parent').val() != '')
        {
            var cat_id = $('#parent').val();
            $.ajax({
                url: "/sub-categories/"+cat_id,
                type:"GET",
                success:function(response){
                if(response.data != '') {
                    // $('.success').text(response.success);
                    $("#subcategory").html('');
                    $("#subcategory").html(response.data);
                }
                else{
                    // ajaxRequest(cat_id);
                }
                },
                error: function(error) {
                console.log(error);
                },
                complete: function(){
                    // $('#loading-image').hide();
                }
            });
        }
        $('#dataTable').DataTable({
            pageLength: 10,
            filter: true,
            ordering: true,
            searching: true,
            deferRender: true,
            "bLengthChange" : true, //thought this line could hide the LengthMenu
            "bInfo":false, 
        });
        $('#dataTable_export').DataTable({
            dom: 'Bfrtip',
        buttons: [
            // 'copyHtml5',
            'excelHtml5',
            // 'csvHtml5',
            // 'pdfHtml5'
        ],
            pageLength: 10,
            filter: true,
            ordering: true,
            searching: true,
            deferRender: true,
            "bLengthChange" : true, //thought this line could hide the LengthMenu
            "bInfo":false, 
        });
        $( "#tablecontents" ).sortable({
          items: "tr",
          cursor: 'move',
          cancel: ".group",
          opacity: 0.6,
          update: function() {
              sendOrderToServer();
          }
        });
        
    });
$('#parent').on('change', function(){
            $("#ajax-data").html('');
            $("#subcategory").html('<option value="">---Select one---</option>');
            var cat_id = $(this).val();
            $.ajax({
                url: "/sub-categories/"+cat_id,
                type:"GET",
                success:function(response){
                if(response.data != '') {
                    // $('.success').text(response.success);
                    $("#subcategory").html('');
                    $("#subcategory").html(response.data);
                }
                else{
                }
                },
                error: function(error) {
                console.log(error);
                },
                complete: function(){
                    // $('#loading-image').hide();
                }
            });
            
        })
</script>
@yield('ordering_script')
@yield('cropper_script')
@yield('third_party_scripts')

@stack('page_scripts')
@yield('slider_cropper_script')
</body>
</html>
