@extends('admin.layouts.master')

@section('title')
Tất cả sinh viên
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
    <a href="{{ Route('admin.student.create') }}"><button class="btn btn-primary mb-3">
    Tạo mới
    </button></a>
    <a href="{{ Route('admin.student.import') }}"><button class="btn btn-success mb-3">
    Import file
    </button></a>
        
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
            Tất cả sinh viên
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
                            Ảnh
                        </th>
                        <th scope="col">
                            Thông tin
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
                    @foreach($students as $student)
                        <tr>
                            <th scope="col">
                                {{$loop->iteration}}
                            </th>
                            <th>
                                {{ $student->name }}
                            </th>
                            <th>
                                @if(strpos("http", $student->img) == false)
                                <img src="{{ URL::asset($student->img) }}" alt="" width="50px" height="50px" style="object-fit: cover; border-radius: 50%;">
                                @else
                                <img src="https://i.imgur.com/jJ4Iy9p.png" alt="" width="50px" style="border-radius: 50%;">
                                @endif
                            </th>
                            <th>
                                <ul class="custom-ul">
                                    <li>
                                        Khoa: {{ $student->Department->name }}
                                    </li>
                                    @if($student->ParentSchool != null)
                                    <li>
                                        Phụ huynh: {{ $student->ParentSchool->name }}
                                    </li>
                                    @endif
                                    <li>
                                        Địa chỉ: {{ $student->address }}
                                    </li>
                                    <li>
                                        SĐT: {{ $student->phone }}
                                    </li>
                                    <li>
                                        Email: {{ $student->email }}
                                    </li>
                                    <li>
                                        Giới tính: 
                                        @if($student->gender == 1)
                                        Nam
                                        @elseif($student->gender == 2)
                                        Nữ
                                        @else
                                        Khác
                                        @endif
                                    </li>
                                    <li>
                                        Ngày sinh: {{date('d/m/Y', strtotime($student->dob))}}
                                    </li>
                                    <li>
                                        Niên khóa: {{ $student->syear }}
                                    </li>
                                    <th scope="col">
                                        @if($student->status == 1)
                                        <i class="fas fa-check-circle text-success"></i>
                                        @else
                                        <i class="fas fa-times-circle text-danger"></i>
                                        @endif
                                    </th>
                                </ul>
                            </th>
                            <th>
                                <a href="{{ Route('admin.student.update', ['id' => $student->id]) }}">
                                    <button class="btn btn-info">
                                    Sửa
                                    </button>
                                </a>
                            </th>
                            <th>
                                <form method="post" action="../../students/{{$student->id}}" onsubmit="return confirm('Bạn chắc muốn xoá chứ?')">
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
    document.getElementById('studentLi').classList.add('active');
</script>
@endsection
