@extends('admin.layouts.master')

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
    <a href="{{ Route('admin.course.create') }}"><button class="btn btn-primary mb-3">
    Tạo mới
    </button></a>
        
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
                                Sửa
                            </th>
                            <th scope="col">
                                Xoá
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
                                    <a href="{{ Route('admin.course.update', ['id' => $course->id]) }}">
                                        <button class="btn btn-info">
                                        Sửa
                                        </button>
                                    </a>
                                </th>
                                <th>
                                    <form method="post" action="../../courses/{{$course->id}}" onsubmit="return confirm('Bạn chắc muốn xoá chứ?')">
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
