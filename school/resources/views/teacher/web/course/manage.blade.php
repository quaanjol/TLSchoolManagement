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
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#attendanceModal">
        Điểm danh
    </button>
    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#scoreModal">
        Thêm điểm
    </button>
    <a href="">
        <button type="button" class="btn btn-danger mb-3">
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
                <h5 class="modal-title" id="attendanceModalLabel">Checkbox nếu sinh viên vắng mặt</h5>
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
                        <option value="" disabled selected>Chọn điểm</option>
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
                                    @if($student->getCourseAttendances($course->id)->count() == 0)
                                    Chưa có buổi điểm danh nào
                                    @else
                                        <ul class="custom-ul">
                                            <li>
                                                Có mặt: 
                                                @foreach($student->getCourseAttendancesNotAbsence($course->id) as $index => $attendance)
                                                    @if($index == ($student->getCourseAttendancesNotAbsence($course->id)->count() - 1))
                                                    {{ $attendance->date }}
                                                    @else
                                                    {{ $attendance->date }}, 
                                                    @endif
                                                @endforeach
                                            </li>
                                            <li>
                                                Vắng mặt: 
                                                @foreach($student->getCourseAttendancesAbsence($course->id) as $index => $attendance)
                                                    @if($index == ($student->getCourseAttendancesAbsence($course->id)->count() - 1))
                                                    {{ $attendance->date }}
                                                    @else
                                                    {{ $attendance->date }}, 
                                                    @endif
                                                @endforeach
                                            </li>
                                        </ul>
                                        
                                    @endif
                                </th>
                                <th>
                                    <ul class="custom-ul">
                                        <li>
                                        Điểm chuyên cần: 
                                        @if($student->getCourseAttendances($course->id)->count() == 0)
                                        Chưa có
                                        @else
                                        {{ $student->getCourseAttendancesNotAbsence($course->id)->count() }}/{{ $classCount }}
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

    Array.from(attendanceCheckBox).forEach(item => {
        var boxId = item.id.split("_")[1];
        var thisAbsence = document.getElementById(`absence_${boxId}`);
        
        item.addEventListener('change', e => {
            if (e.target.checked == true) {
                thisAbsence.checked = false
                document.getElementById('absenceAll').checked = false;
            } else {
                thisAbsence.checked = true
            }
        })
    })

    Array.from(absenceCheckBox).forEach(item => {
        var boxId = item.id.split("_")[1];
        var thisAttendance = document.getElementById(`attendance_${boxId}`);
        item.addEventListener('change', e => {
            if (e.target.checked == true) {
                thisAttendance.checked = false
                document.getElementById('attendanceAll').checked = false;
            } else {
                thisAttendance.checked = true
            }
        })
    })

    document.getElementById('attendanceAll').addEventListener('change', e => {
        if(e.target.checked == true) {
            document.getElementById('absenceAll').checked = false
        } else {
            document.getElementById('absenceAll').checked = true
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
            } else {
                item.checked = true
            }
        })
    })

    document.getElementById('absenceAll').addEventListener('change', e => {
        if(e.target.checked == true) {
            document.getElementById('attendanceAll').checked = false
        } else {
            document.getElementById('attendanceAll').checked = true
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
            } else {
                item.checked = true
            }
        })
    })
</script>
@endsection
