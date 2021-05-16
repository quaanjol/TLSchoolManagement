@extends('teacher.layouts.master')

@section('title')
Quản lý khoá học
@endsection

@section('style')
<style>
    .custom-ul li {
        list-style-type: square;
        margin-left: -18px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <a href=""><button class="btn btn-primary mb-3">
    Tạo mới
    </button></a>
        
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
            {{ $course->name }}
            </h6>
        </div>
        <div class="card-body">
        <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">
                                Tên
                            </th>
                            <th scope="col">
                                Thông tin
                            </th>
                            <th scope="col">
                                Chuyên cần
                            </th>
                            <th scope="col">
                                Điểm
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <th scope="col">
                                    {{$loop->iteration}}
                                </th>
                                <th>
                                    {{ $student->name }}
                                </th>
                                <th>
                                    <ul class="custom-ul">
                                        <li>Email: {{ $student->email }}</li>
                                        <li>SĐTT: {{ $student->phone }}</li>
                                        <li>Địa chỉ: {{ $student->address }}</li>
                                        <li>Giới tính: 
                                        @if($student->gender == 1)
                                        Nam
                                        @elseif($student->gender == 2)
                                        Nữ
                                        @else
                                        Khác
                                        @endif
                                        </li>
                                        <li>Ngành: {{ $student->Department->name }}</li>
                                    </ul>
                                </th>
                                <th>
                                    
                                </th>
                                <th>
                                    
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('courseLi').classList.add('active');
</script>
@endsection
