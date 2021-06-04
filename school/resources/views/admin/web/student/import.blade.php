@extends('admin.layouts.master')

@section('title')
Import file
@endsection

@section('content')
<div class="container">
    <a href="{{ Route('admin.student.all') }}">
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
            <form action="{{ Route('admin.student.storeImport') }}" method="post" enctype="multipart/form-data" id="mainForm">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="file">
                            Import File (xlsx only)
                            </label>
                            <input type="file" name="file" id="excel" class="form-file-control" required>
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
            <hr>

            <div class="row">
                <div class="col-12">
                    <small class="text-secondary">
                        *File import mẫu có thể tải ở đây. Cột "Mã khoa" (bắt buộc) và "Mã phụ huynh" (không bắt buộc) có thể đối chiếu ở dưới hai bảng dưới đây.
                    </small>
                </div>
                <div class="col-12 mb-3">
                    <a href="{{ route('admin.student.download.import_file') }}">
                        <button class="btn btn-warning">
                            Tải file import mẫu
                        </button>
                    </a>
                </div>

                <div class="col-6">
                    <h4>Các khoa</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">Mã ngành</th>
                                    <th scope="col">
                                        Tên
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($departments as $department)
                                    <tr>
                                        <th scope="col">
                                            {{$department->id}}
                                        </th>
                                        <th>
                                            {{ $department->name }}
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-6">
                    <h4>Các phụ huynh</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">Mã phụ huynh</th>
                                    <th scope="col">
                                        Tên
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($parentSchools as $parentSchool)
                                    <tr>
                                        <th scope="col">
                                            {{$parentSchool->id}}
                                        </th>
                                        <th>
                                            {{ $parentSchool->name }}
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
      </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('studentLi').classList.add('active');

    $('mainForm').ready(function() {
        console.log('hey')
        $('#mainForm').submit(function() {
            validateExcelFile($('#excel').val());
        });

        function validateExcelFile(file) {
            var ext = file.split(".");
            ext = ext[ext.length-1].toLowerCase();      
            var arrayExtensions = ["xlsx"];

            if (arrayExtensions.lastIndexOf(ext) == -1) {
                alert("File định dạng sai. Chọn lại file. Chỉ import định dạng xlsx.");
            }
        }
    })
</script>
@endsection
