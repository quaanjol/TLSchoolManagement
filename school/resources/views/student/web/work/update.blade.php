@extends('artsyv.layouts.master')

@section('title')
@if($language == 'vietnamese')
Chỉnh sửa sản phẩm
@else
Update product
@endif
@endsection

@section('content')
<div class="container">
    <a href="{{ Route('artsyv.work.all') }}">
        <button class="btn btn-primary mb-3" type="button">
            Quay lại danh sách
        </button>
    </a>
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">From {{ config('app.name') }} <i class="fas fa-heart text-danger"></i></h6>
        </div>
        <div class="card-body">
            <form action="{{ Route('artsyv.work.storeUpdate', ['id' => $work->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="label">
                            @if($language == 'vietnamese')
                            Sản phẩm (En)*
                            @else
                            Product (En)*
                            @endif
                            </label>
                            <br/>
                            <input type="text" name="label" id="label" class="form-control" value="{{ $work->label }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="labelVi">
                            @if($language == 'vietnamese')
                            Sản phẩm (Vi)
                            @else
                            Product (Vi)
                            @endif
                            </label>
                            <br/>
                            <input type="text" name="labelVi" id="labelVi" value="{{ $work->labelVi }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="img">
                            @if($language == 'vietnamese')
                            Ảnh (bỏ trồng nếu không muốn thay ảnh)
                            @else
                            Image (skip if you do not want to change image)
                            @endif
                            </label>
                            <br>
                            <input type="file" name="img" id="img" class="form-file-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="link">
                            @if($language == 'vietnamese')
                            Đường dẫn
                            @else
                            Link
                            @endif
                            </label>
                            <input type="text" name="link" id="link" class="form-control" value="{{ $work->link }}">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="contentt">
                                @if($language == 'vietnamese')
                                Nội dung (En)*
                                @else
                                Content (En)*
                                @endif
                            </label>
                            <textarea name="content" id="contentt" cols="30" rows="10" class="form-control" required>{{ $work->content }}</textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="contenttVi">
                                @if($language == 'vietnamese')
                                Nội dung (Vi)
                                @else
                                Content (Vi)
                                @endif
                            </label>
                            <textarea name="contentVi" id="contenttVi" cols="30" rows="10" class="form-control">{{ $work->contentVi }}</textarea>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="start">
                                @if($language == 'vietnamese')
                                Thời gian bắt đầu*
                                @else
                                Start date*
                                @endif
                            </label>
                            <input type="date" name="start" id="start" class="form-control" value="{{ $work->start }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="end">
                                @if($language == 'vietnamese')
                                Thời gian kết thúc*
                                @else
                                End date*
                                @endif
                            </label>
                            <input type="date" name="end" id="end" class="form-control" value="{{ $work->end }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="active">
                        @if($language == 'vietnamese')
                        Hiển thị trên portfolio
                        @else
                        Show on your portfolio
                        @endif
                        </label>
                        <br/>
                        <!-- Rounded switch -->
                        <label class="switch">
                            <input type="checkbox" name="active" id="active" <?php if($work->active == 1) {?>checked<?php } ?> >
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <button class="btn btn-success" type="submit" id="submitBtn">
                                Hoàn tất
                            </button>
                        </div>
                    </div>
                    <div class="col-12">
                        <small class="text-danger" id="error"></small>
                    </div>   
                </div>
            </form>
        </div>
      </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('contentt');
    CKEDITOR.replace('contenttVi');
</script>
<script>
    document.getElementById('workLi').classList.add('active');

    // validate date
    var language = "{!! $language!!}";

    document.getElementById('submitBtn').addEventListener('click', (e) => {
        if(document.getElementById('start').value > document.getElementById('end').value) {
            e.preventDefault();
            if(language == 'vietnamese') {
                document.getElementById('error').innerHTML = 'Ngày kết thúc phải lớn hơn ngày bắt đầu.';
            } else {
                document.getElementById('error').innerHTML = 'End date must be later than start date.';
            }
        }
    })
</script>
@endsection
