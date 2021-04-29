@extends('admin.layouts.master')

@section('title')
Tất cả khoa
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
    <a href="{{ Route('admin.department.create') }}"><button class="btn btn-primary mb-3">
    Tạo mới
    </button></a>
        
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
            Tất cả khoa
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
                            Mô tả
                        </th>
                        <th scope="col">
                            Chỉnh sửa
                        </th>
                        <th scope="col">
                            Xoá
                        </th>
                      </tr>
                </thead>
                <tbody>
                    @foreach($departments as $department)
                        <tr>
                            <th scope="col">
                                {{$loop->iteration}}
                            </th>
                            <th>
                                {{ $department->name }}
                            </th>
                            <th>
                                {{ $department->description }}
                            </th>
                            <th>
                                <a href="{{ Route('admin.department.update', ['id' => $department->id]) }}">
                                    <button class="btn btn-info">
                                    Sửa
                                    </button>
                                </a>
                            </th>
                            <th>
                                <form method="post" action="../../departments/{{$department->id}}" onsubmit="return confirm('Bạn chắc muốn xoá chứ?')">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" name="" value="Xoá" class="btn btn-danger">
                                </form>
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
    document.getElementById('departmentLi').classList.add('active');
</script>
@endsection
