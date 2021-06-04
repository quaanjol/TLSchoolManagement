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
    <link href="{{ URL::asset('/logo-12.png') }}" rel="icon">
    @yield('style')
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-{{$employee->User->theme}} sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ Route('admin.dashboard') }}">
            <div class="sidebar-brand-icon">
                <i class="fas fa-school"></i>
                <!-- <img src="{{ URL::asset('images/logo-08.png') }}" width="50px" alt=""> -->
            </div>
          <div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item side-bar-item active" id="dashboardLi">
            <a class="nav-link" href="{{ Route('admin.dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                Tổng quan
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Quản trị
        </div>

        <!-- Nav Item - Portfolio Menu -->
        <li class="nav-item side-bar-item" id="roleLi">
            <a class="nav-link" href="{{ route('admin.role.all') }}">
            <i class="fas fa-sitemap"></i>
                Vai trò
            </a>
        </li>
        <li class="nav-item side-bar-item" id="adminLi">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdmin" aria-expanded="true" aria-controls="collapseAdmin">
            <i class="fas fa-users-cog"></i>
                Quản trị viên
            </a>
            <div id="collapseAdmin" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">
                    Thao tác:
                    </h6>
                    <a class="collapse-item" href="{{ route('admin.administrator.all') }}">
                    Hiển thị tất cả
                    </a>
                    <a class="collapse-item" href="{{ route('admin.administrator.create') }}">
                    Tạo mới
                    </a>
                </div>
            </div>
        </li>

        <li class="nav-item side-bar-item" id="teacherLi">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTeacher" aria-expanded="true" aria-controls="collapseTeacher">
            <i class="fas fa-chalkboard-teacher"></i>
                Giảng viên
            </a>
            <div id="collapseTeacher" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">
                    Thao tác:
                    </h6>
                    <a class="collapse-item" href="{{ route('admin.teacher.all') }}">
                    Hiển thị tất cả
                    </a>
                    <a class="collapse-item" href="{{ route('admin.teacher.create') }}">
                    Tạo mới
                    </a>
                </div>
            </div>
        </li>

        <li class="nav-item side-bar-item" id="parentLi">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseParent" aria-expanded="true" aria-controls="collapseParent">
            <i class="fas fa-user-tie"></i>
                Phụ huynh
            </a>
            <div id="collapseParent" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">
                    Thao tác:
                    </h6>
                    <a class="collapse-item" href="{{ route('admin.parent.all') }}">
                    Hiển thị tất cả
                    </a>
                    <a class="collapse-item" href="{{ route('admin.parent.create') }}">
                    Tạo mới
                    </a>
                </div>
            </div>
        </li>
        <li class="nav-item side-bar-item" id="studentLi">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStudent" aria-expanded="true" aria-controls="collapseStudent">
            <i class="fas fa-child"></i>
                Sinh viên
            </a>
            <div id="collapseStudent" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">
                    Thao tác:
                    </h6>
                    <a class="collapse-item" href="{{ route('admin.student.all') }}">
                    Hiển thị tất cả
                    </a>
                    <a class="collapse-item" href="{{ route('admin.student.create') }}">
                    Tạo mới
                    </a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Quản lí học tập
        </div>

        <!-- Nav Item - Department Menu -->
        <li class="nav-item side-bar-item" id="departmentLi">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDepartment" aria-expanded="true" aria-controls="collapseDepartment">
            <i class="fas fa-building"></i>
                Khoa
            </a>
            <div id="collapseDepartment" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">
                    Thao tác:
                    </h6>
                    <a class="collapse-item" href="{{ route('admin.department.all') }}">
                    Hiển thị tất cả
                    </a>
                    <a class="collapse-item" href="{{ route('admin.department.create') }}">
                    Tạo mới
                    </a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Subject Menu -->
        <li class="nav-item side-bar-item" id="subjectLi">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSubject" aria-expanded="true" aria-controls="collapseSubject">
            <i class="fas fa-book"></i>
                Môn học
            </a>
            <div id="collapseSubject" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">
                    Thao tác:
                    </h6>
                    <a class="collapse-item" href="{{ route('admin.subject.all') }}">
                    Hiển thị tất cả
                    </a>
                    <a class="collapse-item" href="{{ route('admin.subject.create') }}">
                    Tạo mới
                    </a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Course Menu -->
        <li class="nav-item side-bar-item" id="courseLi">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCourse" aria-expanded="true" aria-controls="collapseCourse">
            <i class="fas fa-tags"></i>
                Khoá học
            </a>
            <div id="collapseCourse" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">
                    Thao tác:
                    </h6>
                    <a class="collapse-item" href="{{ route('admin.course.all') }}">
                    Hiển thị tất cả
                    </a>
                    <a class="collapse-item" href="{{ route('admin.course.create') }}">
                    Tạo mới
                    </a>
                </div>
            </div>
        </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
        <div class="sidebar-heading">
            Tin tức
        </div>

        <!-- Nav Item - Post category Menu -->
        <li class="nav-item side-bar-item" id="postCategoryLi">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePostCategory" aria-expanded="true" aria-controls="collapsePostCategory">
            <i class="fas fa-clone"></i>
                Thể loại<i></i>
            </a>
            <div id="collapsePostCategory" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">
                    Thao tác:
                    </h6>
                    <a class="collapse-item" href="{{ route('admin.category.all') }}">
                    Hiển thị tất cả
                    </a>
                    <a class="collapse-item" href="{{ route('admin.category.create') }}">
                    Tạo mới
                    </a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Post Menu -->
        <li class="nav-item side-bar-item" id="postLi">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePost" aria-expanded="true" aria-controls="collapsePost">
            <i class="fas fa-blog"></i>
                Bài đăng<i></i>
            </a>
            <div id="collapsePost" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">
                    Thao tác:
                    </h6>
                    <a class="collapse-item" href="{{ route('admin.post.all') }}">
                    Hiển thị tất cả
                    </a>
                    <a class="collapse-item" href="{{ route('admin.post.create') }}">
                    Tạo mới
                    </a>
                </div>
            </div>
        </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
    Tiện ích
    </div>

    <!-- Nav Item - Palette color Menu -->
    <li class="nav-item side-bar-item" id="changeThemeLi">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-palette"></i>
        Đổi màu chủ đạo
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">
            7 sắc cầu vồng
            </h6>
            <a class="collapse-item text-danger" href="{{route('theme.change', ['color' => 'danger'])}}">
            Đỏ
            </a>
            <a class="collapse-item text-success" href="{{route('theme.change', ['color' => 'success'])}}">
            Xanh lá
            </a>
            <a class="collapse-item text-warning" href="{{route('theme.change', ['color' => 'warning'])}}">
            Vàng
            </a>
            <a class="collapse-item text-primary" href="{{route('theme.change', ['color' => 'primary'])}}">
            Xanh biển
            </a>
            <a class="collapse-item text-info" href="{{route('theme.change', ['color' => 'info'])}}">
            Xanh ngọc
            </a>
            <a class="collapse-item text-secondary" href="{{route('theme.change', ['color' => 'secondary'])}}">
            Xám
            </a>
            <a class="collapse-item text-dark" href="{{route('theme.change', ['color' => 'dark'])}}">
            Tối
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

            <ul class="navbar-nav ml-auto">

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ $employee->name }}</span>
                    @if(strpos("http", $employee->img) == false)
                    <img class="img-profile rounded-circle" src="{{ URL::asset($employee->img) }}" style="object-fit: cover;">
                    @else
                    <img src="https://i.imgur.com/jJ4Iy9p.png" alt="" width="50px" style="border-radius: 50%;">
                    @endif
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('admin.profile') }}">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Trang cá nhân
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
                    {{$heading["vietnamese"]}}
                </h1>
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
                <!-- <div class="mb-3">
                    <img src="{{ URL::asset('images/logo-07.png') }}" alt="" width="200px;">
                </div> -->
                <span>Copyright &copy; {{ config('app.name') }} <span id="current-year"></span></span>
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
