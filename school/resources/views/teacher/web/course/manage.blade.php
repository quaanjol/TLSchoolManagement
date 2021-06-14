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

    .btn-pink {
        background-color: #c261ff !important;
        color: #ffffff !important;
    }

    .btn-pink:hover {
        opacity: 0.8;
    }

    .a-disabled {
        pointer-events: none;
        cursor: default;
        opacity: 0.6;
    }
</style>
@endsection

@section('content')
<div class="container">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#attendanceModal" <?php if($course->status == 0) { ?> disabled="true"<?php } ?> >
        Điểm danh
    </button>
    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#scoreModal" <?php if($course->status == 0) { ?> disabled="true"<?php } ?> >
        Thêm điểm
    </button>
    <button type="button" class="btn btn-warning mb-3" data-toggle="modal" data-target="#importScoreModal" <?php if($course->status == 0) { ?> disabled="true"<?php } ?> >
        Import điểm
    </button>
    <!-- <button type="button" class="btn btn-info mb-3" data-toggle="modal" data-target="#bonusModal">
        Bonus điểm
    </button> -->
    <button type="button" class="btn btn-pink mb-3" data-toggle="modal" data-target="#scoreModal">
        Export điểm
    </button>
    <a href="{{ route('teacher.course.endCourse', ['id' => $course->id]) }}" onclick="return confirm('Bạn chắc muốn kết thúc khoá học chứ? Sau khi kết thúc khoá học, mọi thông tin không thể cập nhật được nữa.')">
        <button type="button" class="btn btn-danger mb-3" <?php if($course->status == 0) { ?> disabled="true"<?php } ?> >
            Kết thúc khoá học
        </button>
    </a>

    <!-- attendance modal -->
    <!-- Modal -->
    <form action="{{ route('teacher.course.checkAttendance', ['id' => $course->id]) }}" method="post">
        @csrf
        <div class="modal fade bd-example-modal-lg" id="attendanceModal" tabindex="-1" role="dialog" aria-labelledby="attendanceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="attendanceModalLabel">Checkbox để điểm danh sinh viên</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Sinh viên</th>
                                <th>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" id="attendanceAll">Có mặt
                                            </label>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" id="absenceAll">Vắng mặt
                                            </label>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" id="lateAll">Muộn
                                            </label>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                            <tr>
                                <th>
                                    {{ $student->name }}
                                </th>
                                <th>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input attendance_input" id="attendance_{{ $student->id }}" name="attendance[]" checked value="{{ $student->id }}">
                                            </label>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input absence_input" id="absence_{{ $student->id }}" name="absence[]" value="{{ $student->id }}">
                                            </label>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input late_input" id="late_{{ $student->id }}" name="late[]" value="{{ $student->id }}">
                                            </label>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-primary">Xác nhận</button>
            </div>
            </div>
        </div>
        </div>
    </form>

    <!-- score modal -->
    <!-- Modal -->

    <form action="{{ route('teacher.course.addGrade', ['id' => $course->id]) }}" method="post">
        @csrf
        <div class="modal fade bd-example-modal-lg" id="scoreModal" tabindex="-1" role="dialog" aria-labelledby="scoreModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="scoreModalLabel">Chấm điểm</h5> -->
                <div class="form-group">
                    <select name="name" id="name" class="form-control" required>
                        <option value="" disabled selected>Chọn loại điểm</option>
                        <option value="Bonus">Bonus</option>
                        <option value="Giữa kì">Giữa kì</option>
                        <option value="Cuối kì">Cuối kì</option>
                    </select>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Sinh viên</th>
                                <th>Thêm điểm</th>
                                <th>
                                    Điểm
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                            <tr>
                                <th>
                                    {{ $student->name }}
                                </th>
                                <th>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" id="grade_{{ $student->id }}" name="grades[]" value="{{ $student->id }}">
                                            </label>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="form-group">
                                        <input type="number" step="0.01" class="form-control grade_input" id="" name="grade_{{ $student->id }}" min="0" max="10" required value="0">
                                    </div>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-primary">Hoàn tất</button>
            </div>
            </div>
        </div>
        </div>
    </form>

    <!-- bonus modal -->
    <!-- Modal -->
    <!-- <form action="{{ route('teacher.course.addBonus', ['id' => $course->id]) }}" method="post">
        @csrf
        <div class="modal fade bd-example-modal-lg" id="bonusModal" tabindex="-1" role="dialog" aria-labelledby="bonusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bonusModalLabel">Thêm điểm bonus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Sinh viên</th>
                                <th>
                                    Thêm điểm
                                </th>
                                <th>
                                    Điểm
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                            <tr>
                                <th>
                                    {{ $student->name }}
                                </th>
                                <th>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" id="bonus_{{ $student->id }}" name="bonus[]" value="{{ $student->id }}">
                                            </label>
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="form-group">
                                        <input type="number" class="form-control" min="0" max="10" name="bonus_{{ $student->id }}" id="" value="0">
                                    </div>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-primary">Xác nhận</button>
            </div>
            </div>
        </div>
        </div>
    </form> -->

    <!-- import grades file modal -->
    <!-- Modal -->

    <form action="{{ route('teacher.course.importGradesFile', ['id' => $course->id]) }}" method="post" enctype="multipart/form-data" id="mainForm">
        @csrf
        <div class="modal fade bd-example-modal-lg" id="importScoreModal" tabindex="-1" role="dialog" aria-labelledby="importScoreModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importScoreModalLabel">Import file điểm giữa kì cho sinh viên</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <a href="{{ route('teacher.course.exportGradesFile', ['id' => $course->id]) }}">
                    Tải file mẫu để nhập điểm ở đây                
                </a>
                <hr/>
                <div class="form-group">
                    <label for="file">Upload File (XLSX only)</label>
                    <br/>
                    <!-- teacher.course.exportGradesFile -->
                    <input type="file" class="form-file-control" required id="" name="file">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-primary">Hoàn tất</button>
            </div>
            </div>
        </div>
        </div>
    </form>
        
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
            {{ $course->name }} | Mã khoá học: {{ $course->id }}
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
                                Điểm danh
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
                                        <li>Mã sinh viên: {{ $student->id }}</li>
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
                                    <button type="button" class="btn btn-secondary mb-3" data-toggle="modal" data-target="#updateAttendanceModal_{{ $student->id }}" <?php if($course->status == 0) { ?> disabled="true"<?php } ?> >
                                        Chỉnh sửa
                                    </button>
                                    <form action="{{ route('teacher.course.updateAttendance', ['id' => $student->id, 'course_id' => $course->id]) }}" method="post">
                                        @csrf
                                        <div class="modal fade bd-example-modal-lg" id="updateAttendanceModal_{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="updateAttendanceModalLabel_{{ $student->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="updateAttendanceModalLabel_{{ $student->id }}">
                                                    Sinh viên: {{ $student->name }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <select name="date" id="" class="form-control" required>
                                                        <option value="" selected disabled>Chọn ngày</option>
                                                        @foreach($student->getCourseAttendances($course->id) as $att)
                                                        <option value="{{ $att->date }}">{{ $att->date }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <select name="absence" id="" class="form-control" required>
                                                        <option value="" selected disabled>Chọn trạng thái</option>
                                                        <option value="0">Có mặt</option>
                                                        <option value="1">Vắng mặt</option>
                                                        <option value="2">Muộn</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                <button type="submit" class="btn btn-primary">Hoàn tất</button>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </form>
                                    @if($student->getCourseAttendances($course->id)->count() == 0)
                                    Chưa có buổi điểm danh nào
                                    @else
                                        <ul class="custom-ul">
                                            <li>
                                                Có mặt: 
                                                @foreach($student->getCourseAttendancesNotAbsence($course->id) as $index => $attendance)
                                                    @if($index == ($student->getCourseAttendancesNotAbsence($course->id)->count() - 1))
                                                    {{date('d/m/Y', strtotime($attendance->date))}}
                                                    @else
                                                    {{date('d/m/Y', strtotime($attendance->date))}}, 
                                                    @endif
                                                @endforeach
                                            </li>
                                            <li>
                                                Vắng mặt: 
                                                @foreach($student->getCourseAttendancesAbsence($course->id) as $index => $attendance)
                                                    @if($index == ($student->getCourseAttendancesAbsence($course->id)->count() - 1))
                                                    {{date('d/m/Y', strtotime($attendance->date))}}
                                                    @else
                                                    {{date('d/m/Y', strtotime($attendance->date))}}, 
                                                    @endif
                                                @endforeach
                                            </li>
                                            <li>
                                                Muộn: 
                                                @foreach($student->getCourseAttendancesLate($course->id) as $index => $attendance)
                                                    @if($index == ($student->getCourseAttendancesLate($course->id)->count() - 1))
                                                    {{date('d/m/Y', strtotime($attendance->date))}}
                                                    @else
                                                    {{date('d/m/Y', strtotime($attendance->date))}}, 
                                                    @endif
                                                @endforeach
                                            </li>
                                        </ul>
                                        
                                    @endif
                                </th>
                                <th>
                                    <button type="button" class="btn btn-secondary mb-3" data-toggle="modal" data-target="#updateGradeModal_{{ $student->id }}" <?php if($course->status == 0) { ?> disabled="true"<?php } ?> >
                                        Chỉnh sửa
                                    </button>
                                    <form action="{{ route('teacher.course.updateGrade', ['id' => $student->id, 'course_id' => $course->id]) }}" method="post">
                                        @csrf
                                        <div class="modal fade bd-example-modal-lg" id="updateGradeModal_{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="updateGradeModalLabel_{{ $student->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="updateGradeModalLabel_{{ $student->id }}">
                                                    Sinh viên: {{ $student->name }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <select name="name" id="" class="form-control" required>
                                                        <option value="" disabled selected>Chọn loại điểm</option>
                                                        <option value="Bonus">Bonus</option>
                                                        <option value="Giữa kì">Giữa kì</option>
                                                        <option value="Cuối kì">Cuối kì</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Giá trị</label>
                                                    <input type="number" name="value" min="0" max="10" step="0.01" id="" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                <button type="submit" class="btn btn-primary">Hoàn tất</button>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </form>
                                    <ul class="custom-ul">
                                        <li>
                                        Điểm chuyên cần: 
                                        @if($student->getCourseAttendances($course->id)->count() == 0)
                                        Chưa có
                                        @else
                                        <ul class="custom-ul">
                                            <li>Có mặt: {{ $student->getCourseAttendancesNotAbsence($course->id)->count() }}</li>
                                            <li>Vắng mặt: {{ $student->getCourseAttendancesAbsence($course->id)->count() }}</li>
                                            <li>Muộn: {{ $student->getCourseAttendancesLate($course->id)->count() }}</li>
                                        </ul>
                                        @endif
                                        </li>
                                        <li>
                                        Điểm bonus: 
                                        @if($student->getBonusGrade($course->id, $student->id)->count() <= 0)
                                        Chưa có
                                        @else
                                            @foreach($student->getBonusGrade($course->id, $student->id) as $bonus)
                                            <ul class="custom-ul">
                                                <li>
                                                    <!-- <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#attendanceModal">
                                                        Điểm danh
                                                    </button> -->
                                                    <a href="" data-toggle="modal" data-target="#updateBonusModal_{{ $bonus->id }}" <?php if($course->status == 0) { ?>class="a-disabled"<?php } ?> >
                                                        {{ $bonus->grade }}
                                                    </a>
                                                    <!-- bonus modal -->
                                                    <!-- Modal -->
                                                    <form action="{{ route('teacher.course.updateBonus', ['id' => $student->id, 'course_id' => $course->id]) }}" method="post">
                                                        @csrf
                                                        <div class="modal fade bd-example-modal-lg" id="updateBonusModal_{{ $bonus->id }}" tabindex="-1" role="dialog" aria-labelledby="updateBonusModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="updateBonusModalLabel">Chỉnh sửa/xoá điểm bonus của sinh viên: {{ $student->name }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="checkbox" class="form-check-input" name="delete" value="1">Checkbox nếu muốn xoá điểm bonus
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="hidden" class="form-control" id="" name="origin" value="{{ $bonus->grade }}">
                                                                    <input type="number" class="form-control" id="" name="grade" value="{{ $bonus->grade }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                                <button type="submit" class="btn btn-primary">Xác nhận</button>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </form>
                                                </li>
                                            </ul>
                                            @endforeach
                                        @endif
                                        </li>
                                        <li>
                                        Điểm giữa kì: 
                                        @if(!isset($student->getMidTermGrade($course->id, $student->id)[0]))
                                        Chưa có
                                        @else
                                        {{ $student->getMidTermGrade($course->id, $student->id)[0]->grade }}
                                        @endif
                                        </li>
                                        <li>
                                        Điểm cuối kì: 
                                        @if(!isset($student->getLastTermGrade($course->id, $student->id)[0]))
                                        Chưa có
                                        @else
                                        {{ $student->getLastTermGrade($course->id, $student->id)[0]->grade }}
                                        @endif
                                        </li>
                                        @if($student->result != null)
                                        <li>
                                            Điểm tổng kết: {{ $student->resultBaseFour }} ({{ $student->rank }})
                                        </li>
                                        @endif
                                    </ul>
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

    var attendanceCheckBox = document.querySelectorAll('.attendance_input')
    var absenceCheckBox = document.querySelectorAll('.absence_input')
    var lateCheckBox = document.querySelectorAll('.late_input')

    Array.from(attendanceCheckBox).forEach(item => {
        var boxId = item.id.split("_")[1];
        var thisAbsence = document.getElementById(`absence_${boxId}`);
        var thisLate = document.getElementById(`late_${boxId}`);
        
        item.addEventListener('change', e => {
            if (e.target.checked == true) {
                thisAbsence.checked = false
                thisLate.checked = false
                document.getElementById('absenceAll').checked = false;
                document.getElementById('lateAll').checked = false;
            } else {
                thisAbsence.checked = true
            }
        })
    })

    Array.from(absenceCheckBox).forEach(item => {
        var boxId = item.id.split("_")[1];
        var thisAttendance = document.getElementById(`attendance_${boxId}`);
        var thisLate = document.getElementById(`late_${boxId}`);
        item.addEventListener('change', e => {
            if (e.target.checked == true) {
                thisAttendance.checked = false
                thisLate.checked = false
                document.getElementById('attendanceAll').checked = false;
                document.getElementById('lateAll').checked = false;
            } else {
                thisAttendance.checked = true
            }
        })
    })

    Array.from(lateCheckBox).forEach(item => {
        var boxId = item.id.split("_")[1];
        var thisAttendance = document.getElementById(`attendance_${boxId}`);
        var thisAbsence = document.getElementById(`absence_${boxId}`);
        item.addEventListener('change', e => {
            if (e.target.checked == true) {
                thisAttendance.checked = false
                thisAbsence.checked = false
                document.getElementById('attendanceAll').checked = false;
                document.getElementById('absenceAll').checked = false;
            } else {
                thisAttendance.checked = true
            }
        })
    })

    document.getElementById('attendanceAll').addEventListener('change', e => {
        if(e.target.checked == true) {
            document.getElementById('absenceAll').checked = false
            document.getElementById('lateAll').checked = false
        }

        Array.from(attendanceCheckBox).forEach(item => {
            if(e.target.checked == true) {
                item.checked = true
            } else {
                item.checked = false
            }
        })

        Array.from(absenceCheckBox).forEach(item => {
            if(e.target.checked == true) {
                item.checked = false
            }
        })

        Array.from(lateCheckBox).forEach(item => {
            if(e.target.checked == true) {
                item.checked = false
            } else {
                item.checked = true
            }
        })
    })

    document.getElementById('absenceAll').addEventListener('change', e => {
        if(e.target.checked == true) {
            document.getElementById('attendanceAll').checked = false
            document.getElementById('lateAll').checked = false
        }

        Array.from(absenceCheckBox).forEach(item => {
            if(e.target.checked == true) {
                item.checked = true
            } else {
                item.checked = false
            }
        })

        Array.from(attendanceCheckBox).forEach(item => {
            if(e.target.checked == true) {
                item.checked = false
            }
        })

        Array.from(lateCheckBox).forEach(item => {
            if(e.target.checked == true) {
                item.checked = false
            } else {
                item.checked = true
            }
        })
    })

    document.getElementById('lateAll').addEventListener('change', e => {
        if(e.target.checked == true) {
            document.getElementById('attendanceAll').checked = false
            document.getElementById('absenceAll').checked = false
        }

        Array.from(lateCheckBox).forEach(item => {
            if(e.target.checked == true) {
                item.checked = true
            } else {
                item.checked = false
            }
        })

        Array.from(attendanceCheckBox).forEach(item => {
            if(e.target.checked == true) {
                item.checked = false
            } else {
                item.checked = true
            }
        })

        Array.from(absenceCheckBox).forEach(item => {
            if(e.target.checked == true) {
                item.checked = false
            }
        })
    })
</script>
@endsection
