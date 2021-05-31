@extends('admin.layouts.master')

@section('title')
Tất cả thể loại
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
    <a href="{{ Route('admin.category.create') }}"><button class="btn btn-primary mb-3">
    Tạo mới
    </button></a>
        
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
            Tất cả thể loại
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
                                Sửa
                            </th>
                            <th scope="col">
                                Xoá
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($postCategories as $category)
                            <tr>
                                <th scope="col">
                                    {{$loop->iteration}}
                                </th>
                                <th>
                                    {{ $category->name }}
                                </th>
                                <th>
                                    {{ $category->description }}
                                </th>
                                <th>
                                    <a href="{{ Route('admin.category.update', ['id' => $category->id]) }}">
                                        <button class="btn btn-info">
                                        Sửa
                                        </button>
                                    </a>
                                </th>
                                <th>
                                    <form method="post" action="../../postCategories/{{$category->id}}" onsubmit="return confirm('Bạn chắc muốn xoá chứ?')">
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
    document.getElementById('postCategoryLi').classList.add('active');
</script>
@endsection
