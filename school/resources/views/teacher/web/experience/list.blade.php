@extends('artsyv.layouts.master')

@section('title')
@if($language == 'vietnamese')
Kinh nghiệm
@else
Experience List
@endif
@endsection

@section('content')
<div class="container">
    <a href="{{ Route('artsyv.experience.create') }}"><button class="btn btn-primary mb-3">
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
            Tất cả kinh nghiệm
            @else
            All experiences
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
                        Kinh nghiệm (En)
                        @else
                        Experience (En)
                        @endif
                        </th>
                        <th scope="col">
                        @if($language == 'vietnamese')
                        Kinh nghiệm (Vi)
                        @else
                        Experience (Vi)
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
                @if($experiences != null)
                    @foreach($experiences as $experience)
                    <tr>
                        <th scope="col">
                            {{$loop->iteration}}
                        </th>
                        <th scope="col">
                            {{ $experience->label }}
                        </th>
                        <th scope="col">
                            {{ $experience->labelVi }}
                        </th>
                        <th scope="col">
                            {!! $experience->content !!}
                        </th>
                        <th scope="col">
                            {!! $experience->contentVi !!}
                        </th>
                        <th scope="col">
                            {{date('m/Y', strtotime($experience->start))}}-{{date('m/Y', strtotime($experience->end))}}
                        </th>
                        <th>
                            @if($experience->active == 1)
                            <i class="fas fa-check-circle text-success"></i>
                            @else
                            <i class="fas fa-times-circle text-danger"></i>
                            @endif
                        </th>
                        <th>
                            <a href="{{ Route('artsyv.experience.update', ['id' => $experience->id]) }}">
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
                            <form method="post" action="../../experiences/{{$experience->id}}" onsubmit="return confirm('Bạn chắc muốn xoá chứ?')">
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
    document.getElementById('experienceLi').classList.add('active');
</script>
@endsection
