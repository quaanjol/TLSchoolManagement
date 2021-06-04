@extends('admin.layouts.master')

@section('title')
Tất cả bài đăng
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
    <a href="{{ Route('admin.post.create') }}"><button class="btn btn-primary mb-3">
    Tạo mới
    </button></a>
        
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
            Tất cả bài đăng
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">
                                Tiêu đề
                            </th>
                            <th scope="col">
                                Thông tin
                            </th>
                            <th scope="col">
                                Nội dung
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
                        @foreach($posts as $post)
                            <tr>
                                <th scope="col">
                                    {{$loop->iteration}}
                                </th>
                                <th>
                                    {{ $post->title }}
                                </th>
                                <th>
                                    <ul class="custom-ul">
                                        <li>
                                            <b>Thể loại: </b> {{ $post->PostCategory->name }}
                                        </li>
                                        @if($post->post_category_id == $event_post_category)
                                        <li>
                                            <b>Ngày sự kiện (nếu là sự kiện): </b> {{ $post->event_date }}
                                        </li>    
                                        @endif
                                    </ul>
                                </th>
                                <th>
                                    {!!Str::words($post->description, 15)!!}
                                </th>
                                <th>
                                    <a href="{{ Route('admin.post.update', ['id' => $post->id]) }}">
                                        <button class="btn btn-info">
                                        Sửa
                                        </button>
                                    </a>
                                </th>
                                <th>
                                    <form method="post" action="../../posts/{{$post->id}}" onsubmit="return confirm('Bạn chắc muốn xoá chứ?')">
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
    document.getElementById('postLi').classList.add('active');
</script>
@endsection
