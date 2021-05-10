@extends('admin.layouts.master')

@section('title')
Chỉnh sửa khoá học
@endsection

@section('content')
<div class="container">
    <a href="{{ Route('admin.course.all') }}">
        <button class="btn btn-primary mb-3" type="button">
            Quay lại danh sách
        </button>
    </a>
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">From {{ config('app.name') }} with <i class="fas fa-heart text-danger"></i></h6>
        </div>
        <div class="card-body">
            <form action="{{ Route('admin.course.update', ['id' => $course->id]) }}" method="post" id="mainForm">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="name">
                            Tên
                            </label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $course->name }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="subject_id">
                            Môn học
                            </label>
                            <select name="subject_id" id="subject_id" class="form-control" required>
                                <option value="" disabled selected>Chọn môn học</option>
                                @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" <?php if($course->subject_id == $subject->id) {?>selected<?php } ?>>{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="start">
                            Bắt đầu
                            </label>
                            <input type="date" id="start" name="start" class="form-control" value="{{ $course->start }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="end">
                            Kết thúc
                            </label>
                            <input type="date" id="end" name="end" class="form-control" value="{{ $course->end }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="quantity">
                            Sô lượng sinh viên
                            </label>
                            <input type="number" id="quantity" name="quantity" class="form-control" value="{{ $course->quantity }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="status">
                            Trạng thái
                            </label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="1" <?php if($course->status == 1) {?>selected<?php } ?>>Processing</option>
                                <option value="0" <?php if($course->status == 0) {?>selected<?php } ?>>Finish</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <small class="text-danger" id="error"></small>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <button class="btn btn-success" type="submit" id="submitBtn">
                                Hoàn tất
                            </button>
                        </div>
                    </div>    
                </div>
            </form>
        </div>
      </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('courseLi').classList.add('active');

    var startDate = document.getElementById('start')
    var endDate = document.getElementById('end')

    startDate.addEventListener('change', validateDate)
    endDate.addEventListener('change', validateDate)

    function validateDate() {
        var start = new Date(startDate.value)
        var end = new Date(endDate.value)

        if(start && end) {
            if(start.getTime() >= end.getTime()) {
                document.getElementById('submitBtn').disabled = true
                document.getElementById('error').text = 'Ngày bắt đầu phải nhỏ hơn ngày kết thúc.'
            } else {
                document.getElementById('submitBtn').disabled = false
                document.getElementById('error').text = ''
            }
        }
    }
</script>
@endsection
