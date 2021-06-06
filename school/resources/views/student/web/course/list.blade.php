@extends('student.layouts.master')

@section('title')
Tất cả khoá học
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
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
            Tất cả khoá học
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
                                Trạng thái
                            </th>
                            <th scope="col">
                                Đăng kí
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                            <tr>
                                <th scope="col">
                                    {{$loop->iteration}}
                                </th>
                                <th>
                                    <a href="">{{ $course->name }}</a>
                                </th>
                                <th>
                                    <ul class="custom-ul">
                                        <li>
                                            Môn học: {{ $course->Subject->name }}
                                        </li>
                                        <li>
                                            Giảng viên: {{ $course->Employee->name }}
                                        </li>
                                        <li>
                                            Bắt đầu: {{ $course->start }}
                                        </li>
                                        <li>
                                            Số lượng sinh viên: {{ $course->quantity }}
                                        </li>
                                        <li>
                                            Kết thúc: {{ $course->end }}
                                        </li>   
                                    </ul>
                                </th>
                                <th>
                                    @if($course->status == 1)
                                    <span class="badge badge-success">Processing</span>
                                    @else 
                                    <span class="badge badge-danger">Finish</span>
                                    @endif
                                </th>
                                <th>
                                    @if($student->checkRegisteredCourse($course->id))
                                    <button class="btn btn-primary" disabled="true">Đã đăng kí</button>
                                    @else
                                    <a href="{{ route('student.course.register', ['id' => $course->id]) }}">
                                        <button class="btn btn-danger" <?php if($course->Subject->checkStudent($student->department_id) == false) {?>disabled="true"<?php } ?>>Đăng kí</button>
                                    </a>
                                    @endif
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center">
                {{ $courses->links() }}
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
