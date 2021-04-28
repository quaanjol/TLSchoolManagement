@extends('admin.layouts.master')

@section('title')
Chỉnh sửa phụ huynh
@endsection

@section('content')
<div class="container">
    <a href="{{ Route('admin.parent.all') }}">
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
            <form action="{{ Route('admin.parent.storeUpdate', ['id' => $thisParent->id ]) }}" method="post" enctype="multipart/form-data" id="mainForm">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="name">
                            Tên
                            </label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $thisParent->name }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="phone">
                            Số điện thoại
                            </label>
                            <input type="text" id="phone" name="phone" value="{{ $thisParent->phone }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="email">
                            Email
                            </label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ $thisParent->email }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="address">
                                Địa chỉ
                            </label>
                            <input type="text" name="address" id="address" class="form-control" value="{{ $thisParent->address }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="gender">
                            Giới tính
                            </label>
                            <select name="gender" id="gender" class="form-control" required>
                                <option value="" selected disabled>Chọn giới tính</option>
                                <option value="1" <?php if($thisParent->gender == 1) { ?>selected<?php } ?>>Nam</option>
                                <option value="2" <?php if($thisParent->gender == 2) { ?>selected<?php } ?>>Nữ</option>
                                <option value="3" <?php if($thisParent->gender == 3) { ?>selected<?php } ?>>Khác</option>
                            </select>
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
    document.getElementById('teacherLi').classList.add('active');
</script>
@endsection
