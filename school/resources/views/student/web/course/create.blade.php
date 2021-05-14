@extends('artsyv.layouts.master')

@section('title')
@if($language == 'vietnamese')
Tạo mới chuyên môn
@else
Create new expertise
@endif
@endsection

@section('style')
<style>
    input[type="color"] {
        -webkit-appearance: none;
        border: none;
        width: 32px;
        height: 32px;
    }

    input[type="color"]::-webkit-color-swatch-wrapper {
        padding: 0;
    }

    input[type="color"]::-webkit-color-swatch {
        border: none;
    }
</style>
@endsection

@section('content')
<div class="container">
    <a href="{{ Route('artsyv.expertise.all') }}">
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
            <form action="{{ Route('artsyv.expertise.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="label">
                            @if($language == 'vietnamese')
                            Chuyên môn (En)*
                            @else
                            Expertise (En)*
                            @endif
                            </label>
                            <br/>
                            <input type="text" name="label" id="label" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="labelVi">
                            @if($language == 'vietnamese')
                            Chuyên môn (Vi)
                            @else
                            Expertise (Vi)
                            @endif
                            </label>
                            <br/>
                            <input type="text" name="labelVi" id="labelVi" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="icon">
                                Icon* <span id="icon-preview"></span>
                            </label>
                            <select class="form-control text-capitalize" id="icon" name="icon" required>
                                <option value="" disabled selected>
                                @if($language == 'vietnamese')
                                Chọn icon
                                @else
                                Choose an icon
                                @endif
                                </option>
                                @foreach($icons as $icon)
                                <option value="{{ $icon->class }}">{{ $icon->name }}</option>
                                @endforeach
                            </select> 
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="color">
                            @if($language == 'vietnamese')
                            Màu
                            @else
                            Color
                            @endif
                            </label>
                            <br/>
                            <input type="color" name="color" id="color" value="#ff0000" required>
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
                            <textarea name="content" id="contentt" cols="30" rows="10" class="form-control" required></textarea>
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
                            <textarea name="contentVi" id="contenttVi" cols="30" rows="10" class="form-control"></textarea>
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
                            <input type="checkbox" name="active" id="active" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">
                                Hoàn tất
                            </button>
                        </div>
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
    document.getElementById('expertiseLi').classList.add('active');

    // pop up preview
    document.getElementById('icon').addEventListener('change', function(e) {
        document.getElementById('icon-preview').innerHTML = '';
        document.getElementById('icon-preview').innerHTML += `<i class="${e.target.value}"></i>`;
    })
</script>
@endsection
