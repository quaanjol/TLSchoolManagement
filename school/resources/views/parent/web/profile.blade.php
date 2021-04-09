@extends('artsyv.layouts.master')

@section('title')
@if($language == 'vietnamese')
Trang cá nhân
@else
Profile
@endif
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
                    <div class="">
                        <img class="img-profile rounded-circle" id="avatar-box" width="100%" style="object-fit: cover;" src="{{ $user->avatar }}">
                    </div>
                    <!-- <div class="img-profile rounded-circle" id="avatar-box" style="background-image: url({{ $user->avatar }});"></div> -->
                </div>
                <div class="col-sm-9">
                    <form action="{{ route('artsyv.profile.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- name -->
                            <div class="form-group col-12">
                                <label for="name">
                                    @if($language == 'vietnamese')
                                    Tên*
                                    @else
                                    Name*
                                    @endif
                                </label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                            </div>

                            <!-- email -->
                            <div class="form-group col-12">
                                <label for="email">
                                    Email*
                                </label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                            </div>

                            <!-- avatar -->
                            <div class="form-group col-12">
                                <label for="avatar">
                                    Avatar
                                </label>
                                <br>
                                <input type="file" name="avatar" id="avatar" class="form-file-control">
                            </div>

                            <!-- password -->
                            <div class="form-group col-12">
                                <label for="password">
                                    @if($language == 'vietnamese')
                                    Mật khẩu*
                                    @else
                                    Password*
                                    @endif
                                </label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>

                            <div class="form-group col-12">
                                <label for="password2">
                                    @if($language == 'vietnamese')
                                    Xác nhận mật khẩu*
                                    @else
                                    Confirm password*
                                    @endif
                                </label>
                                <input type="password" name="password2" id="password2" class="form-control">
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
    document.getElementById('dashboardLi').classList.add('active');

    // square avatar
    document.getElementById('avatar-box').style.height = `${document.getElementById('avatar-box').offsetWidth}px`;
</script>
@endsection
