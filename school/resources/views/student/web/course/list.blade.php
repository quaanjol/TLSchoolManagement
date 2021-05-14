@extends('artsyv.layouts.master')

@section('title')
@if($language == 'vietnamese')
Chuyên môn
@else
Expertise List
@endif
@endsection

@section('content')
<div class="container">
    <a href="{{ Route('artsyv.expertise.create') }}"><button class="btn btn-primary mb-3">
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
            Tất cả chuyên môn
            @else
            All expertises
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
                        Chuyên môn (En)
                        @else
                        Expertise (En)
                        @endif
                        </th>
                        <th scope="col">
                        @if($language == 'vietnamese')
                        Chuyên môn (Vi)
                        @else
                        Expertise (Vi)
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
                        Icon
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
                @if($expertises != null)
                    @foreach($expertises as $expertise)
                    <tr>
                        <th scope="col">
                            {{$loop->iteration}}
                        </th>
                        <th scope="col">
                            {{ $expertise->label }}
                        </th>
                        <th scope="col">
                            {{ $expertise->labelVi }}
                        </th>
                        <th scope="col">
                            {!! $expertise->content !!}
                        </th>
                        <th scope="col">
                            {!! $expertise->contentVi !!}
                        </th>
                        <th scope="col">
                            <i class="{{ $expertise->icon }} fa-2x" style="color: {{ $expertise->color }}"></i>
                        </th>
                        <th>
                            @if($expertise->active == 1)
                            <i class="fas fa-check-circle text-success"></i>
                            @else
                            <i class="fas fa-times-circle text-danger"></i>
                            @endif
                        </th>
                        <th>
                            <a href="{{ Route('artsyv.expertise.update', ['id' => $expertise->id]) }}">
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
                            <form method="post" action="../../expertises/{{$expertise->id}}" onsubmit="return confirm('Bạn chắc muốn xoá chứ?')">
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
    document.getElementById('expertiseLi').classList.add('active');
</script>
@endsection
