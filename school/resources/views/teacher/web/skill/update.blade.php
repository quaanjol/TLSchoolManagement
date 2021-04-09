@extends('artsyv.layouts.master')

@section('title')
@if($language == 'vietnamese')
Chỉnh sửa kỹ năng
@else
Update skill
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
    <a href="{{ Route('artsyv.skill.all') }}">
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
            <form action="{{ Route('artsyv.skill.storeUpdate', ['id' => $skill->id]) }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="label">
                            @if($language == 'vietnamese')
                            Kỹ năng (En)*
                            @else
                            Skill (En)*
                            @endif
                            </label>
                            <br/>
                            <input type="text" name="label" id="label" class="form-control" value="{{ $skill->label }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="labelVi">
                            @if($language == 'vietnamese')
                            Kỹ năng (Vi)
                            @else
                            Skill (Vi)
                            @endif
                            </label>
                            <br/>
                            <input type="text" name="labelVi" id="labelVi" value="{{ $skill->labelVi }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="level">
                                Level*
                            </label>
                            <input type="number" name="level" id="level" class="form-control" value="{{ $skill->level }}" required>
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
                            <input type="color" name="color" id="color" value="{{ $skill->color }}" required>
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
                            <input type="checkbox" name="active" id="active" <?php if($skill->active == 1) {?>checked<?php } ?> >
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
<script>
    document.getElementById('skillLi').classList.add('active');
</script>
@endsection
