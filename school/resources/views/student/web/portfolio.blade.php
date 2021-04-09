@extends('artsyv.layouts.master')

@section('title')
Portfolio
@endsection

@section('style')
<style>
    /* HIDE RADIO */
    [type=radio] { 
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
    }

    /* IMAGE STYLES */
    [type=radio] + img {
    cursor: pointer;
    }

    /* CHECKED STYLES */
    [type=radio]:checked + img {
    outline: 2px solid #6583BA;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">From {{ config('app.name') }} with <i class="fas fa-heart text-danger"></i></h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-3">
                    <div class="mb-3">
                        <img class="img-profile rounded-circle" id="avatar-box" width="100%" style="object-fit: cover;" src="{{ $user->avatar }}">
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('user.artsyv.show', ['id' => $user->id, 'slug' => Str::slug($user->name)]) }}" target="_blank">
                            <button class="btn btn-success">
                                @if($language == 'vietnamese')
                                Xem trước portfolio
                                @else
                                Preview portfolio
                                @endif
                            </button>
                        </a>
                    </div>
                </div>
                <div class="col-sm-9">
                    <small class="mb-2 text-primary">
                        @if($language == 'vietnamese')
                        Bấm nút <i class="fas fa-toggle-on"></i> để hiển thị phần thông tin tương ứng trên portfolio.
                        @else
                        Toggle the button <i class="fas fa-toggle-on"></i> to show or hide the relavant information on your portfolio.
                        @endif
                    </small>
                    <hr>
                    <form action="{{ route('artsyv.portfolio.setup.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- title -->
                            <div class="form-group col-12">
                                <label for="title">
                                    @if($language == 'vietnamese')
                                    Vị trí (En) (ví dụ: developer,..)
                                    @else
                                    Position (En) (i.e: developer, etc.)
                                    @endif
                                </label>
                                <input type="text" name="title" id="title" placeholder="Developer" class="form-control" value="{{ $user->title }}">
                            </div>

                            <!-- title -->
                            <div class="form-group col-12">
                                <label for="titleVi">
                                    @if($language == 'vietnamese')
                                    Vị trí (Vi) (ví dụ: lập trình viên,..)
                                    @else
                                    Position (Vi) (i.e: lập trình viên, etc.)
                                    @endif
                                </label>
                                <input type="text" name="titleVi" id="titleVi" placeholder="Lập trình viên" class="form-control" value="{{ $user->titleVi }}">
                            </div>

                            <!-- cv theme -->
                            <div class="form-group col-12">
                                <label for="">
                                    @if($language == 'vietnamese')
                                    Theme cho portfolio
                                    @else
                                    Portfolio theme
                                    @endif
                                </label>
                                <br>
                                <div class="row">
                                    @foreach($cvThemes as $theme)
                                    <div class="col-md-3">
                                        <label>
                                            <input type="radio" name="cvtheme_id" value="{{ $theme->id }}" <?php if($theme->id == $user->c_v_theme_id) { ?>checked<?php } ?>>
                                            <img src="{{ $theme->img }}" width="100%">
                                            <p class="text-center text-capitalize mt-2">{{ $theme->name }}</p>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- show about -->
                            <div class="form-group col-12 col-md-6">
                                <label for="show_about">
                                @if($language == 'vietnamese')
                                Lời giới thiệu
                                @else
                                Introduction
                                @endif
                                </label>
                                <br/>
                                <!-- Rounded switch -->
                                <label class="switch">
                                    <input type="checkbox" name="show_about" id="show_about" <?php if($user->show_about == 1) {?>checked<?php } ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>

                            <!-- show contact -->
                            <div class="form-group col-12 col-md-6">
                                <label for="show_contact">
                                @if($language == 'vietnamese')
                                Thông tin liên hệ
                                @else
                                Contact information
                                @endif
                                </label>
                                <br/>
                                <!-- Rounded switch -->
                                <label class="switch">
                                    <input type="checkbox" name="show_contact" id="show_contact" <?php if($user->show_contact == 1) {?>checked<?php } ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>

                            <!-- show education -->
                            <div class="form-group col-12 col-md-6">
                                <label for="show_education">
                                @if($language == 'vietnamese')
                                Thông tin học vấn
                                @else
                                Education information
                                @endif
                                </label>
                                <br/>
                                <!-- Rounded switch -->
                                <label class="switch">
                                    <input type="checkbox" name="show_education" id="show_education" <?php if($user->show_education == 1) {?>checked<?php } ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>

                            <!-- show experience -->
                            <div class="form-group col-12 col-md-6">
                                <label for="show_experience">
                                @if($language == 'vietnamese')
                                Kinh nghiệm
                                @else
                                Experience information
                                @endif
                                </label>
                                <br/>
                                <!-- Rounded switch -->
                                <label class="switch">
                                    <input type="checkbox" name="show_experience" id="show_experience" <?php if($user->show_experience == 1) {?>checked<?php } ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>

                            <!-- show expertise -->
                            <div class="form-group col-12 col-md-6">
                                <label for="show_expertise">
                                @if($language == 'vietnamese')
                                Chuyên môn
                                @else
                                Expertise information
                                @endif
                                </label>
                                <br/>
                                <!-- Rounded switch -->
                                <label class="switch">
                                    <input type="checkbox" name="show_expertise" id="show_expertise" <?php if($user->show_expertise == 1) {?>checked<?php } ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>

                            <!-- show skill -->
                            <div class="form-group col-12 col-md-6">
                                <label for="show_skill">
                                @if($language == 'vietnamese')
                                Kỹ năng
                                @else
                                Skill information
                                @endif
                                </label>
                                <br/>
                                <!-- Rounded switch -->
                                <label class="switch">
                                    <input type="checkbox" name="show_skill" id="show_skill" <?php if($user->show_skill == 1) {?>checked<?php } ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>

                            <!-- show work -->
                            <div class="form-group col-12 col-md-6">
                                <label for="show_work">
                                @if($language == 'vietnamese')
                                Sản phẩm
                                @else
                                Product information
                                @endif
                                </label>
                                <br/>
                                <!-- Rounded switch -->
                                <label class="switch">
                                    <input type="checkbox" name="show_work" id="show_work" <?php if($user->show_work == 1) {?>checked<?php } ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            
                            <div class="form-group col-12">
                                <button class="btn btn-primary" type="submit">
                                    @if($language == 'vietnamese')
                                    Lưu
                                    @else
                                    Save
                                    @endif
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('portfolioLi').classList.add('active');
    console.log("hey?")
    // square avatar
    document.getElementById('avatar-box').style.height = `${document.getElementById('avatar-box').offsetWidth}px`;
</script>
@endsection
