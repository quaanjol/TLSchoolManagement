@extends('artsyv.layouts.master')

@section('title')
Dashboard
@endsection

@section('content')
<div class="container">
    
    <div class="row">
        <!-- expertises -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            @if($language == 'vietnamese')
                            Chuyên môn
                            @else
                            Expertises
                            @endif
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $expertises }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dumbbell fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- educations -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            @if($language == 'vietnamese')
                            Mốc học vấn
                            @else
                            Educations
                            @endif
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $educations }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- skills -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            @if($language == 'vietnamese')
                            Kỹ năng
                            @else
                            Skills
                            @endif
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $skills }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-code fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- works -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            @if($language == 'vietnamese')
                            Sản phẩm
                            @else
                            Products
                            @endif
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $works }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-code-branch fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-7 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Components Overview</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-5 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Components by percentage
                    </h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-danger"></i> Expertises
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-warning"></i> Educations
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Skills
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Products
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-4">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        {{ config('app.name') }}
                    </h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="{{ URL::asset('admin/img/undraw_posting_photo.svg') }}" alt="">
                    </div>
                    <p>
                        
                    </p>
                    <a target="_blank" rel="nofollow" href="" target="_blank">
                        
                    </a>
                </div>
            </div>

        </div>
        {{-- <div class="col-lg-6 mb-4">
            <!-- Approach -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Nhận xét
                    </h6>
                </div>
                <div class="card-body">
                    <p>
                        <small>
                            
                        </small>
                    </p>
                    <form action="" class="user">
                        
                    </form>
                </div>
            </div>
        </div> --}}
    </div>
</div>
@endsection

@section('scripts')
 <!-- Page level plugins -->
 <script src="{{URL::asset('admin/vendor/chart.js/Chart.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{URL::asset('admin/js/demo/chart-area-demo.js')}}"></script>
<script src="{{URL::asset('admin/js/demo/chart-pie-demo.js')}}"></script>
<script>
    document.getElementById('dashboardLi').classList.add('active');

    var expertises = "{{ $expertises }}";
    var educations = "{{ $educations }}";
    var skills = "{{ $skills }}";
    var products = "{{ $works }}";
    var data = [expertises, educations, skills, products];

    // area chart
    drawAreaChart(["Expertises", "Educations", "Skills", "Products"], data);

    // pie chart
    var backgroundColor = ['#e74a3b', '#f6c23e', '#4e73df', '#1cc88a'];
    var hoverBackgroundColor = ['#e74a3b', '#f6c23e', '#4e73df', '#1cc88a']
    drawPieChart(["Expertises", "Educations", "Skills", "Products"], data, backgroundColor, hoverBackgroundColor);
</script>
@endsection
