@extends('admin.layouts.master')

@section('title')
Tạo mới môn học
@endsection

@section('content')
<div class="container">
    <a href="{{ Route('admin.subject.all') }}">
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
            <form action="{{ Route('admin.subject.store') }}" method="post" id="mainForm">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="name">
                            Tên
                            </label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="credit">
                            Mã môn học
                            </label>
                            <input type="text" id="code" name="code" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="credit">
                            Số tín chỉ
                            </label>
                            <input type="text" id="credit" name="credit" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="departments">
                            Trực thuộc khoa
                            </label>
                            <input type="checkbox" class="" name="checkAllDepartments" id="checkAllDepartments" value="">
                            @foreach($departments as $department)
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input department_input" name="departments[]" value="{{ $department->id }}">{{ $department->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="description">
                            Mô tả
                            </label>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
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
    document.getElementById('parentLi').classList.add('active');

    document.getElementById('checkAllDepartments').addEventListener('change', (e) => {
        if(e.target.checked == true) {
            Array.from(document.querySelectorAll('.department_input')).forEach(item => {
                item.checked = true;
            })
        } else {
            Array.from(document.querySelectorAll('.department_input')).forEach(item => {
                item.checked = false;
            })
        }
    })
</script>
@endsection
