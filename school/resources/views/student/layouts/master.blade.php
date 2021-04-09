<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ URL::asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ URL::asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/custom.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('images/logo-08.png') }}" rel="icon">
    @yield('style')
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-{{$user->theme}} sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ Route('artsyv.dashboard') }}">
            <div class="sidebar-brand-icon">
                <i class="fas fa-cat"></i>
                <!-- <img src="{{ URL::asset('images/logo-08.png') }}" width="50px" alt=""> -->
            </div>
          <div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item side-bar-item active" id="dashboardLi">
            <a class="nav-link" href="{{ Route('artsyv.dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                @if($language == 'vietnamese')
                Tổng quan
                @else
                Dashboard
                @endif
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Porfolio
        </div>

        <!-- Nav Item - Portfolio Menu -->
        <li class="nav-item side-bar-item" id="portfolioLi">
            <a class="nav-link" href="{{ route('artsyv.portfolio.setup') }}">
            <i class="fas fa-file-signature"></i>
                Porfolio
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            @if($language == 'vietnamese')
            Quản lí thông tin
            @else
            Account management
            @endif
        </div>

        <!-- Nav Item - About Menu -->
        <li class="nav-item side-bar-item" id="aboutLi">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAbout" aria-expanded="true" aria-controls="collapseAbout">
            <i class="far fa-user"></i>
                @if($language == 'vietnamese')
                Giới thiệu
                @else
                About
                @endif
            </a>
            <div id="collapseAbout" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">
                    @if($language == 'vietnamese')
                    Thao tác:
                    @else
                    Actions:
                    @endif
                    </h6>
                    <a class="collapse-item" href="{{ route('artsyv.about.all') }}">
                    @if($language == 'vietnamese')
                    Hiển thị
                    @else
                    View 
                    @endif
                    </a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Expertise Menu -->
        <li class="nav-item side-bar-item" id="expertiseLi">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseExpertise" aria-expanded="true" aria-controls="collapseExpertise">
            <i class="fas fa-dumbbell"></i>
                @if($language == 'vietnamese')
                Chuyên môn
                @else
                Expertises
                @endif
            </a>
            <div id="collapseExpertise" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">
                    @if($language == 'vietnamese')
                    Thao tác:
                    @else
                    Actions:
                    @endif
                    </h6>
                    <a class="collapse-item" href="{{ route('artsyv.expertise.all') }}">
                    @if($language == 'vietnamese')
                    Hiển thị tất cả
                    @else
                    View all
                    @endif
                    </a>
                    <a class="collapse-item" href="{{ route('artsyv.expertise.create') }}">
                    @if($language == 'vietnamese')
                    Tạo mới
                    @else
                    Add new
                    @endif
                    </a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Skill Menu -->
        <li class="nav-item side-bar-item" id="skillLi">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSkill" aria-expanded="true" aria-controls="collapseSkill">
            <i class="fas fa-code"></i>
                @if($language == 'vietnamese')
                Kỹ năng
                @else
                Skills
                @endif
            </a>
            <div id="collapseSkill" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">
                    @if($language == 'vietnamese')
                    Thao tác:
                    @else
                    Actions:
                    @endif
                    </h6>
                    <a class="collapse-item" href="{{ route('artsyv.skill.all') }}">
                    @if($language == 'vietnamese')
                    Hiển thị tất cả
                    @else
                    View all
                    @endif
                    </a>
                    <a class="collapse-item" href="{{ route('artsyv.skill.create') }}">
                    @if($language == 'vietnamese')
                    Tạo mới
                    @else
                    Add new
                    @endif
                    </a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Education Menu -->
        <li class="nav-item side-bar-item" id="educationLi">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEducation" aria-expanded="true" aria-controls="collapseEducation">
            <i class="fas fa-graduation-cap"></i>
                @if($language == 'vietnamese')
                Mốc học vấn
                @else
                Educations
                @endif
            </a>
            <div id="collapseEducation" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">
                    @if($language == 'vietnamese')
                    Thao tác:
                    @else
                    Actions:
                    @endif
                    </h6>
                    <a class="collapse-item" href="{{ route('artsyv.education.all') }}">
                    @if($language == 'vietnamese')
                    Hiển thị tất cả
                    @else
                    View all
                    @endif
                    </a>
                    <a class="collapse-item" href="{{ route('artsyv.education.create') }}">
                    @if($language == 'vietnamese')
                    Tạo mới
                    @else
                    Add new
                    @endif
                    </a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Experience Menu -->
        <li class="nav-item side-bar-item" id="experienceLi">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseExperience" aria-expanded="true" aria-controls="collapseExperience">
            <i class="fas fa-list-ul"></i>
                @if($language == 'vietnamese')
                Kinh nghiệm
                @else
                Experiences
                @endif
            </a>
            <div id="collapseExperience" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">
                    @if($language == 'vietnamese')
                    Thao tác:
                    @else
                    Actions:
                    @endif
                    </h6>
                    <a class="collapse-item" href="{{ route('artsyv.experience.all') }}">
                    @if($language == 'vietnamese')
                    Hiển thị tất cả
                    @else
                    View all
                    @endif
                    </a>
                    <a class="collapse-item" href="{{ route('artsyv.experience.create') }}">
                    @if($language == 'vietnamese')
                    Tạo mới
                    @else
                    Add new
                    @endif
                    </a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Work Menu -->
        <li class="nav-item side-bar-item" id="workLi">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseWork" aria-expanded="true" aria-controls="collapseWork">
            <i class="fas fa-code-branch"></i>
                @if($language == 'vietnamese')
                Sản phẩm
                @else
                Products
                @endif
            </a>
            <div id="collapseWork" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">
                    @if($language == 'vietnamese')
                    Thao tác:
                    @else
                    Actions:
                    @endif
                    </h6>
                    <a class="collapse-item" href="{{ route('artsyv.work.all') }}">
                    @if($language == 'vietnamese')
                    Hiển thị tất cả
                    @else
                    View all
                    @endif
                    </a>
                    <a class="collapse-item" href="{{ route('artsyv.work.create') }}">
                    @if($language == 'vietnamese')
                    Tạo mới
                    @else
                    Add new
                    @endif
                    </a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Contact Menu -->
        <li class="nav-item side-bar-item" id="contactLi">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseContact" aria-expanded="true" aria-controls="collapseContact">
            <i class="fas fa-info-circle"></i>
                @if($language == 'vietnamese')
                Thông tin liên hệ
                @else
                Contact
                @endif
            </a>
            <div id="collapseContact" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">
                    @if($language == 'vietnamese')
                    Thao tác:
                    @else
                    Actions:
                    @endif
                    </h6>
                    <a class="collapse-item" href="{{ route('artsyv.contact.all') }}">
                    @if($language == 'vietnamese')
                    Hiển thị tất cả
                    @else
                    View all
                    @endif
                    </a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Recruiters' Contact Menu -->
        <li class="nav-item side-bar-item" id="rcontactLi">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRContact" aria-expanded="true" aria-controls="collapseRContact">
            <i class="fas fa-comment-dollar"></i>
                @if($language == 'vietnamese')
                Lời nhắn
                @else
                Messages
                @endif
            </a>
            <div id="collapseRContact" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">
                    @if($language == 'vietnamese')
                    Thao tác:
                    @else
                    Actions:
                    @endif
                    </h6>
                    <a class="collapse-item" href="{{ route('artsyv.recruiterContact.all') }}">
                    @if($language == 'vietnamese')
                    Hiển thị tất cả
                    @else
                    View all
                    @endif
                    </a>
                </div>
            </div>
        </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
    @if($language == 'vietnamese')
    Tiện ích
    @else
    Add-ons
    @endif
    </div>

    <!-- Nav Item - Palette color Menu -->
    <li class="nav-item side-bar-item" id="changeThemeLi">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-palette"></i>
        @if($language == 'vietnamese')
        Đổi màu chủ đạo
        @else
        Change theme
        @endif
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">
            @if($language == 'vietnamese')
            7 sắc cầu vồng
            @else
            7 raibow shades
            @endif
            </h6>
            <a class="collapse-item text-artsyvv" href="{{route('artsyv.theme.change', ['color' => 'artsyvv'])}}">
            Artsyv
            </a>
            <a class="collapse-item text-artsyv" href="{{route('artsyv.theme.change', ['color' => 'artsyv'])}}">
            Artsyv 2
            </a>
            <a class="collapse-item text-artsyv2" href="{{route('artsyv.theme.change', ['color' => 'artsyv2'])}}">
            Artsyv 3
            </a>
            <a class="collapse-item text-danger" href="{{route('artsyv.theme.change', ['color' => 'danger'])}}">
            @if($language == 'vietnamese')
            Đỏ
            @else
            Red
            @endif
            </a>
            <a class="collapse-item text-success" href="{{route('artsyv.theme.change', ['color' => 'success'])}}">
            @if($language == 'vietnamese')
            Xanh lá
            @else
            Green
            @endif
            </a>
            <a class="collapse-item text-warning" href="{{route('artsyv.theme.change', ['color' => 'warning'])}}">
            @if($language == 'vietnamese')
            Vàng
            @else
            Yellow
            @endif
            </a>
            <a class="collapse-item text-primary" href="{{route('artsyv.theme.change', ['color' => 'primary'])}}">
            @if($language == 'vietnamese')
            Xanh biển
            @else
            Blue
            @endif
            </a>
            <a class="collapse-item text-info" href="{{route('artsyv.theme.change', ['color' => 'info'])}}">
            @if($language == 'vietnamese')
            Xanh ngọc
            @else
            Cyan
            @endif
            </a>
            <a class="collapse-item text-secondary" href="{{route('artsyv.theme.change', ['color' => 'secondary'])}}">
            @if($language == 'vietnamese')
            Xám
            @else
            Grey
            @endif
            </a>
            <a class="collapse-item text-dark" href="{{route('artsyv.theme.change', ['color' => 'dark'])}}">
            @if($language == 'vietnamese')
            Tối
            @else
            Dark
            @endif
            </a>
        </div>
    </div>
    </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" id="menu-nav">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
            <!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" 
                    placeholder="Tìm kiếm..." 
                    aria-label="Search" 
                    aria-describedby="basic-addon2">  
                <div class="input-group-append">
                    <button class="btn btn-{{$user->theme}}" type="button">
                    <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
                </div>
            </form> -->

            

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item no-arrow">
                    <a class="nav-link <?php if($language == 'english') { ?>text-gray-600<?php } ?>" href="{{route('artsyv.language.change', ['language' => 'english'])}}">
                    <i class="fas fa-flag text-primary"></i> &nbsp;
                    @if($language == 'vietnamese')
                    Tiếng Anh
                    @else
                    English
                    @endif
                    </a>
                </li>
                <li class="nav-item no-arrow">
                    <a class="nav-link <?php if($language == 'vietnamese') { ?>text-gray-600<?php } ?> " href="{{route('artsyv.language.change', ['language' => 'vietnamese'])}}">
                    <i class="fas fa-star text-warning"></i> &nbsp;
                    @if($language == 'vietnamese')
                    Tiếng Việt
                    @else
                    Vietnamese
                    @endif
                    </a>
                </li>

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ $user->name }}</span>
                    <img class="img-profile rounded-circle" src="{{ $user->avatar }}" style="object-fit: cover;">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('artsyv.profile') }}">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        @if($language == 'vietnamese')
                        Trang cá nhân
                        @else
                        Profile
                        @endif
                        </a>
                        {{-- <div class="dropdown-divider"></div> --}}
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> 
                        Đăng xuất
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Message -->
        @foreach(['danger', 'warning', 'success', 'info'] as $msg)
            @if(session($msg))
            <div class="my-container">
                <div class="alert alert-{{$msg}}">
                    {{session($msg)}}
                </div>
            </div>
            @endif
        @endforeach

        <!-- Begin Page Content -->
        <div class="container-fluid" id="main-content">

            <!-- Page Heading -->
            <div class="ml-2 mb-4">
                <h1 class="h3 mb-0 text-gray-800 text-center">
                    @if($language == 'vietnamese')
                    {{$heading["vietnamese"]}}
                    @else
                    {{$heading["english"]}}
                    @endif
                </h1>
                {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
            </div>

          <!-- Content Row -->
            <div class="row">

            @yield('content')

            </div>
        <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white" id="my-footer">
            <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <div class="mb-3">
                    <img src="{{ URL::asset('images/logo-07.png') }}" alt="" width="200px;">
                </div>
                <span>Copyright &copy; {{ config('app.name') }}<span id="current-year"></span></span>
                <script>
                    var present = new Date();
                    var thisYear = present.getFullYear();
                    document.getElementById('current-year').textContent = thisYear;
                </script>
            </div>
            <div class="copyright text-center mt-1">
              
            </div>
            </div>
        </footer>
        <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{URL::asset('admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{URL::asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{URL::asset('admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{URL::asset('admin/js/sb-admin-2.min.js')}}"></script>
    <script src="{{URL::asset('admin/js/active-link.js')}}"></script>
    @yield('scripts')
</body>

</html>
