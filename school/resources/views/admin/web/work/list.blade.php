@extends('artsyv.layouts.master')

@section('title')
@if($language == 'vietnamese')
Sản phẩm
@else
Products List
@endif
@endsection

@section('content')
<div class="container">
    <a href="{{ Route('artsyv.work.create') }}"><button class="btn btn-primary mb-3">
    @if($language == 'vietnamese')
    Tạo mới
    @else
    Create new
    @endif
    </button></a>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
            @if($language == 'vietnamese')
            Tất cả sản phẩm
            @else
            All products
            @endif
            </h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">
                        @if($language == 'vietnamese')
                        Sản phẩm (En)
                        @else
                        Product (En)
                        @endif
                        </th>
                        <th scope="col">
                        @if($language == 'vietnamese')
                        Sản phẩm (Vi)
                        @else
                        Product (Vi)
                        @endif
                        </th>
                        <th scope="col">
                        @if($language == 'vietnamese')
                        Mô tả (En)
                        @else
                        Description (En)
                        @endif
                        </th>
                        <th scope="col">
                        @if($language == 'vietnamese')
                        Mô tả (Vi)
                        @else
                        Description (Vi)
                        @endif
                        </th>
                        <th scope="col">
                        @if($language == 'vietnamese')
                        Ảnh
                        @else
                        Image
                        @endif
                        </th>
                        <th scope="col">
                        @if($language == 'vietnamese')
                        Đường dẫn
                        @else
                        Link
                        @endif
                        </th>
                        <th scope="col">
                        @if($language == 'vietnamese')
                        Thời gian
                        @else
                        Time
                        @endif
                        </th>
                        <th scope="col">
                        @if($language == 'vietnamese')
                        Hiển thị trên portfolio
                        @else
                        Display on portfolio
                        @endif
                        </th>
                        <th scope="col">
                        @if($language == 'vietnamese')
                        Chỉnh sửa
                        @else
                        Update
                        @endif
                        </th>
                        <th scope="col">
                        @if($language == 'vietnamese')
                        Xoá
                        @else
                        Delete
                        @endif
                        </th>
                      </tr>
                </thead>
                <tbody>
                @if($works != null)
                    @foreach($works as $work)
                    <tr>
                        <th scope="col">
                            {{$loop->iteration}}
                        </th>
                        <th scope="col">
                            {{ $work->label }}
                        </th>
                        <th scope="col">
                            {{ $work->labelVi }}
                        </th>
                        <th scope="col">
                            {!! $work->content !!}
                        </th>
                        <th scope="col">
                            {!! $work->contentVi !!}
                        </th>
                        <th scope="col">
                            <img src="{{ $work->img }}" alt="img-{{ $work->label }}"  width="200px">
                        </th>
                        <th>
                            <a href="{{ $work->link }}">
                                <i class="fas fa-link"></i>
                            </a>
                        </th>
                        <th>
                            {{date('m/Y', strtotime($work->start))}}-{{date('m/Y', strtotime($work->end))}}
                        </th>
                        <th>
                            @if($work->active == 1)
                            <i class="fas fa-check-circle text-success"></i>
                            @else
                            <i class="fas fa-times-circle text-danger"></i>
                            @endif
                        </th>
                        <th>
                            <a href="{{ Route('artsyv.work.update', ['id' => $work->id]) }}">
                                <button class="btn btn-info">
                                @if($language == 'vietnamese')
                                Chỉnh sửa
                                @else
                                Update
                                @endif
                                </button>
                            </a>
                        </th>
                        <th>
                            <form method="post" action="../../works/{{$work->id}}" onsubmit="return confirm('Bạn chắc muốn xoá chứ?')">
                                @csrf
                                @method('delete')
                                <input type="submit" name="" value="<?php if($language == 'vietnamese') { ?>Xoá<?php } else { ?>Delete<?php }?>" class="btn btn-danger">
                            </form>
                        </th>
                    </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
          </div>
        </div>
        
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('workLi').classList.add('active');
</script>
@endsection
