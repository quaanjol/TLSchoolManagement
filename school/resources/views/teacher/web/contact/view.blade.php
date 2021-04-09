@extends('artsyv.layouts.master')

@section('title')
@if($language == 'vietnamese')
Thông tin liên hệ
@else
Contact information
@endif
@endsection

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">From {{ config('app.name') }} with <i class="fas fa-heart text-danger"></i></h6>
        </div>
        <div class="card-body">
            <form action="{{ route('artsyv.contact.store') }}" method="POST">
                @csrf
                <div class="row">
                    <!-- email -->
                    <div class="form-group col-md-8">
                        <label for="email" class="text-email">
                            <i class="fas fa-at fa-2x"></i>
                        </label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email address" value="<?php if($contact != null && $contact->email != null) { ?>{{ $contact->email }}<?php } ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="active_email">
                        @if($language == 'vietnamese')
                        Hiển thị Email trên portofolio
                        @else
                        Show Email on your portfolio
                        @endif
                        </label>
                        <br/>
                        <!-- Rounded switch -->
                        <label class="switch">
                            <input type="checkbox" name="active_email" id="active_email" <?php if($contact != null && $contact->active_email == 1) { ?>checked<?php } ?> >
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <!-- phone -->
                    <div class="form-group col-md-8">
                        <label for="phone" class="text-success">
                            <i class="fas fa-mobile-alt fa-2x"></i>
                        </label>
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone number" value="<?php if($contact != null && $contact->phone != null) { ?>{{ $contact->phone }}<?php } ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="active_phone">
                        @if($language == 'vietnamese')
                        Hiển thị số điện thoại trên portofolio
                        @else
                        Show phone number on your portfolio
                        @endif
                        </label>
                        <br/>
                        <!-- Rounded switch -->
                        <label class="switch">
                            <input type="checkbox" name="active_phone" id="active_phone" <?php if($contact != null && $contact->active_phone == 1) { ?>checked<?php } ?> >
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <!-- facebook -->
                    <div class="form-group col-md-8">
                        <label for="facebook" class="text-facebook">
                            <i class="fab fa-facebook fa-2x"></i>
                        </label>
                        <input type="text" name="facebook" id="facebook" class="form-control" placeholder="Facebook URL" value="<?php if($contact != null && $contact->facebook != null) { ?>{{ $contact->facebook }}<?php } ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="active_facebook">
                        @if($language == 'vietnamese')
                        Hiển thị Facebook trên portofolio
                        @else
                        Show Facebook on your portfolio
                        @endif
                        </label>
                        <br/>
                        <!-- Rounded switch -->
                        <label class="switch">
                            <input type="checkbox" name="active_facebook" id="active_facebook" <?php if($contact != null && $contact->active_facebook == 1) { ?>checked<?php } ?> >
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <!-- instagram -->
                    <div class="form-group col-md-8">
                        <label for="instagram" class="text-instagram">
                            <i class="fab fa-instagram fa-2x"></i>
                        </label>
                        <input type="text" name="instagram" id="instagram" class="form-control" placeholder="Instagram URL" value="<?php if($contact != null && $contact->instagram != null) { ?>{{ $contact->instagram }}<?php } ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="active_instagram">
                        @if($language == 'vietnamese')
                        Hiển thị Instagram trên portofolio
                        @else
                        Show Instagram on your portfolio
                        @endif
                        </label>
                        <br/>
                        <!-- Rounded switch -->
                        <label class="switch">
                            <input type="checkbox" name="active_instagram" id="active_instagram" <?php if($contact != null && $contact->active_instagram == 1) { ?>checked<?php } ?> >
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <!-- pinterest -->
                    <div class="form-group col-md-8">
                        <label for="pinterest" class="text-pinterest">
                            <i class="fab fa-pinterest fa-2x"></i>
                        </label>
                        <input type="text" name="pinterest" id="pinterest" class="form-control" placeholder="Pinterest URL" value="<?php if($contact != null && $contact->pinterest != null) { ?>{{ $contact->pinterest }}<?php } ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="active_pinterest">
                        @if($language == 'vietnamese')
                        Hiển thị Pinterest trên portofolio
                        @else
                        Show Pinterest on your portfolio
                        @endif
                        </label>
                        <br/>
                        <!-- Rounded switch -->
                        <label class="switch">
                            <input type="checkbox" name="active_pinterest" id="active_pinterest" <?php if($contact != null && $contact->active_pinterest == 1) { ?>checked<?php } ?> >
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <!-- behance -->
                    <div class="form-group col-md-8">
                        <label for="behance" class="text-behance">
                            <i class="fab fa-behance fa-2x"></i>
                        </label>
                        <input type="text" name="behance" id="behance" class="form-control" placeholder="Behance URL" value="<?php if($contact != null && $contact->behance != null) { ?>{{ $contact->behance }}<?php } ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="active_behance">
                        @if($language == 'vietnamese')
                        Hiển thị Behance trên portofolio
                        @else
                        Show Behance on your portfolio
                        @endif
                        </label>
                        <br/>
                        <!-- Rounded switch -->
                        <label class="switch">
                            <input type="checkbox" name="active_behance" id="active_behance" <?php if($contact != null && $contact->active_behance == 1) { ?>checked<?php } ?> >
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <!-- dribbble -->
                    <div class="form-group col-md-8">
                        <label for="dribbble" class="text-dribbble">
                            <i class="fab fa-dribbble fa-2x"></i>
                        </label>
                        <input type="text" name="dribbble" id="dribbble" class="form-control" placeholder="Dribbble URL" value="<?php if($contact != null && $contact->dribbble != null) { ?>{{ $contact->dribbble }}<?php } ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="active_dribbble">
                        @if($language == 'vietnamese')
                        Hiển thị Dribbble trên portofolio
                        @else
                        Show Dribbble on your portfolio
                        @endif
                        </label>
                        <br/>
                        <!-- Rounded switch -->
                        <label class="switch">
                            <input type="checkbox" name="active_dribbble" id="active_dribbble" <?php if($contact != null && $contact->active_dribbble == 1) { ?>checked<?php } ?> >
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <!-- linkedIn -->
                    <div class="form-group col-md-8">
                        <label for="linkedIn" class="text-linkedIn">
                            <i class="fab fa-linkedin fa-2x"></i>
                        </label>
                        <input type="text" name="linkedIn" id="linkedIn" class="form-control" placeholder="LinkedIn URL" value="<?php if($contact != null && $contact->linkedIn != null) { ?>{{ $contact->linkedIn }}<?php } ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="active_linkedIn">
                        @if($language == 'vietnamese')
                        Hiển thị LinkedIn trên portofolio
                        @else
                        Show LinkedIn on your portfolio
                        @endif
                        </label>
                        <br/>
                        <!-- Rounded switch -->
                        <label class="switch">
                            <input type="checkbox" name="active_linkedIn" id="active_linkedIn" <?php if($contact != null && $contact->active_linkedIn == 1) { ?>checked<?php } ?> >
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <!-- twitter -->
                    <div class="form-group col-md-8">
                        <label for="twitter" class="text-twitter">
                            <i class="fab fa-twitter fa-2x"></i>
                        </label>
                        <input type="text" name="twitter" id="twitter" class="form-control" placeholder="Twitter URL" value="<?php if($contact != null && $contact->twitter != null) { ?>{{ $contact->twitter }}<?php } ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="active_twitter">
                        @if($language == 'vietnamese')
                        Hiển thị Twitter trên portofolio
                        @else
                        Show Twitter on your portfolio
                        @endif
                        </label>
                        <br/>
                        <!-- Rounded switch -->
                        <label class="switch">
                            <input type="checkbox" name="active_twitter" id="active_twitter" <?php if($contact != null && $contact->active_twitter == 1) { ?>checked<?php } ?> >
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <!-- git -->
                    <div class="form-group col-md-8">
                        <label for="git" class="text-git">
                            <i class="fab fa-github-square fa-2x"></i>
                        </label>
                        <input type="text" name="git" id="git" class="form-control" placeholder="GitHub URL" value="<?php if($contact != null && $contact->git != null) { ?>{{ $contact->git }}<?php } ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="active_git">
                        @if($language == 'vietnamese')
                        Hiển thị GitHub trên portofolio
                        @else
                        Show GitHub on your portfolio
                        @endif
                        </label>
                        <br/>
                        <!-- Rounded switch -->
                        <label class="switch">
                            <input type="checkbox" name="active_git" id="active_git" <?php if($contact != null && $contact->active_git == 1) { ?>checked<?php } ?> >
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
@endsection

@section('scripts')
<script>
    document.getElementById('contactLi').classList.add('active');
</script>
@endsection
