@extends('admin.layouts.master')

@section('title')
Chỉnh sửa quản trị viên
@endsection

@section('content')
<div class="container">
    <a href="{{ Route('admin.administrator.all') }}">
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
            <form action="{{ Route('admin.administrator.storeUpdate', ['id' => $thisAdmin->id]) }}" method="post" enctype="multipart/form-data" id="mainForm">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="name">
                            Tên
                            </label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $thisAdmin->name }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="department_id">
                            Khoa
                            </label>
                            <select name="department_id" id="department_id" class="form-control" required>
                                <option value="" selected disabled>Chọn khoa</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" <?php if($thisAdmin->department_id == $department->id) { ?>selected<?php } ?>>{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="phone">
                            Số điện thoại
                            </label>
                            <input type="text" id="phone" name="phone" class="form-control" value="{{ $thisAdmin->phone }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="email">
                            Email
                            </label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ $thisAdmin->email }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="address">
                                Địa chỉ
                            </label>
                            <input type="text" name="address" id="address" class="form-control" value="{{ $thisAdmin->address }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="gender">
                            Giới tính
                            </label>
                            <select name="gender" id="gender" class="form-control" required>
                                <option value="" selected disabled>Chọn giới tính</option>
                                <option value="1" <?php if($thisAdmin->gender == 1) { ?>selected<?php } ?>>Nam</option>
                                <option value="2" <?php if($thisAdmin->gender == 2) { ?>selected<?php } ?>>Nữ</option>
                                <option value="3" <?php if($thisAdmin->gender == 3) { ?>selected<?php } ?>>Khác</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="dob">
                                Ngày sinh
                            </label>
                            <input type="date" name="dob" id="dob" class="form-control" value="{{ $thisAdmin->dob }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="doj">
                                Ngày làm việc
                            </label>
                            <input type="date" name="doj" id="doj" class="form-control" value="{{ $thisAdmin->doj }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="img">
                                Ảnh
                            </label>
                            <br>
                            <input type="file" name="img" id="img" class="form-file-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="role_id">
                                Role
                            </label>
                            <select name="role_id" id="role_id" class="form-control" required>
                                <option value="2" <?php if($thisAdmin->role_id == 2) { ?>selected<?php } ?>>Quản trị viên</option>
                                <option value="1" <?php if($thisAdmin->role_id == 1) { ?>selected<?php } ?>>Quản lý</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="status">
                                Trạng thái
                            </label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="1">Hoạt động</option>
                                <option value="0">Khoá</option>
                            </select>
                        </div>
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
    document.getElementById('adminLi').classList.add('active');
</script>
@endsection
