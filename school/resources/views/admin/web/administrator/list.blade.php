@extends('admin.layouts.master')

@section('title')
Tất cả quản trị viên
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
    @if($employee->User->role_id == 1)
    <a href="{{ Route('admin.administrator.create') }}"><button class="btn btn-primary mb-3">
    Tạo mới
    </button></a>
    @endif
        
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
            Tất cả quản trị viên
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
                                Trạng thái
                            </th>
                            @if($employee->User->role_id == 1)
                            <th scope="col">
                                Chỉnh sửa
                            </th>
                            <th scope="col">
                                Xoá
                            </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($administrators as $administrator)
                            <tr>
                                <th scope="col">
                                    {{$loop->iteration}}
                                </th>
                                <th>
                                    {{ $administrator->name }}
                                </th>
                                <th>
                                    @if(strpos("http", $administrator->img) == false)
                                    <img src="{{ URL::asset($administrator->img) }}" alt="" width="50px" height="50px" style="object-fit: cover; border-radius: 50%;">
                                    @else
                                    <img src="https://i.imgur.com/jJ4Iy9p.png" alt="" width="50px" style="border-radius: 50%;">
                                    @endif
                                </th>
                                <th>
                                    <ul class="custom-ul">
                                        <li>
                                            Vị trí: {{ $administrator->User->Role->name }}
                                        </li>
                                        @if($administrator->Department != null)
                                        <li>
                                            Phòng ban: {{ $administrator->Department->name }}
                                        </li>
                                        @endif
                                        <li>
                                            SĐT: {{ $administrator->phone }}
                                        </li>
                                        <li>
                                            Email: {{ $administrator->email }}
                                        </li>
                                        <li>
                                            Giới tính: 
                                            @if($administrator->gender == 1)
                                            Nam
                                            @elseif($administrator->gender == 2)
                                            Nữ
                                            @else
                                            Khác
                                            @endif
                                        </li>
                                        <li>
                                            Ngày sinh: {{date('d/m/Y', strtotime($administrator->dob))}}
                                        </li>
                                        <li>
                                            Ngày làm việc: {{date('d/m/Y', strtotime($administrator->doj))}}
                                        </li>
                                        <li>
                                            Địa chỉ: {{ $administrator->address }}
                                        </li>
                                    </ul>
                                </th>
                                <th scope="col">
                                    @if($administrator->status == 1)
                                    <i class="fas fa-check-circle text-success"></i>
                                    @else
                                    <i class="fas fa-times-circle text-danger"></i>
                                    @endif
                                </th>
                                @if($employee->User->role_id == 1)
                                <th>
                                    <a href="{{ Route('admin.administrator.update', ['id' => $administrator->id]) }}">
                                        <button class="btn btn-info">
                                        Sửa
                                        </button>
                                    </a>
                                </th>
                                <th>
                                    <form method="post" action="../../employees/{{$administrator->id}}" onsubmit="return confirm('Bạn chắc muốn xoá chứ?')">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" name="" value="Xoá" class="btn btn-danger">
                                    </form>
                                </th>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $administrators->links() }}
            </div>
        </div>
        
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('adminLi').classList.add('active');
</script>
@endsection
