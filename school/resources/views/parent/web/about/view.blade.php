@extends('artsyv.layouts.master')

@section('title')
@if($language == 'vietnamese')
Lời giới thiệu
@else
Introduction
@endif
@endsection

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">From {{ config('app.name') }} with <i class="fas fa-heart text-danger"></i></h6>
        </div>
        <div class="card-body">
            <form action="{{ route('artsyv.about.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="content">
                        @if($language == 'vietnamese')
                        Nội dung*
                        @else
                        Content*
                        @endif
                    </label>
                    <textarea name="content" id="contentt" cols="30" rows="10" class="form-control" required>
                        @if($about != null)
                        {{ $about->content }}
                        @endif
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="contentVi">
                        @if($language == 'vietnamese')
                        Nội dung tiếng Việt
                        @else
                        Content in Vietnamese
                        @endif
                    </label>
                    <textarea name="contentVi" id="contenttVi" cols="30" rows="10" class="form-control">
                        @if($about != null && $about->contentVi != null)
                        {{ $about->contentVi }}
                        @endif
                    </textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">
                        @if($language == 'vietnamese')
                        Lưu
                        @else
                        Save
                        @endif
                    </button>
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
    document.getElementById('aboutLi').classList.add('active');
</script>
@endsection
