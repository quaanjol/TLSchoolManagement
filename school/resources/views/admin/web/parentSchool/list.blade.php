@extends('admin.layouts.master')

@section('title')
Tất cả phụ huynh
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
    <a href="{{ Route('admin.parent.create') }}"><button class="btn btn-primary mb-3">
    Tạo mới
    </button></a>
        
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
            Tất cả phụ huynh
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
                        @foreach($parentSchools as $parent)
                            <tr>
                                <th scope="col">
                                    {{$loop->iteration}}
                                </th>
                                <th>
                                    {{ $parent->name }}
                                </th>
                                <th>
                                    @if(strpos("http", $parent->img) == false)
                                    <img src="{{ URL::asset($parent->img) }}" alt="" width="50px" height="50px" style="object-fit: cover; border-radius: 50%;">
                                    @else
                                    <img src="https://i.imgur.com/jJ4Iy9p.png" alt="" width="50px" style="border-radius: 50%;">
                                    @endif
                                </th>
                                <th>
                                    <ul class="custom-ul">
                                        <li>
                                            Địa chỉ: {{ $parent->address }}
                                        </li>
                                        <li>
                                            SĐT: {{ $parent->phone }}
                                        </li>
                                        <li>
                                            Email: {{ $parent->email }}
                                        </li>
                                        @if($parent->Students->count() > 0)
                                        <li>
                                            Sinh viên: 
                                            <ul class="custom-ul">
                                            @foreach($parent->Students as $student)
                                            <li>
                                                {{ $student->name }}
                                            </li>
                                            @endforeach
                                            </ul>
                                        </li>
                                        @endif
                                    </ul>
                                </th>
                                <th>
                                    <a href="{{ Route('admin.parent.update', ['id' => $parent->id]) }}">
                                        <button class="btn btn-info">
                                        Sửa
                                        </button>
                                    </a>
                                </th>
                                <th>
                                    <form method="post" action="../../parents/{{$parent->id}}" onsubmit="return confirm('Bạn chắc muốn xoá chứ?')">
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
                {{ $parentSchools->links() }}
            </div>
        </div>
        
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('parentLi').classList.add('active');
</script>
@endsection
