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
    <a href="{{ Route('artsyv.skill.create') }}"><button class="btn btn-primary mb-3">
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
            Tất cả kỹ năng
            @else
            All skills
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
                        Kỹ năng (En)
                        @else
                        Skill (En)
                        @endif
                        </th>
                        <th scope="col">
                        @if($language == 'vietnamese')
                        Kỹ năng (Vi)
                        @else
                        Skill (Vi)
                        @endif
                        </th>
                        <th scope="col">
                        Level
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
                @if($skills != null)
                    @foreach($skills as $skill)
                    <tr>
                        <th scope="col">
                            {{$loop->iteration}}
                        </th>
                        <th scope="col">
                            {{ $skill->label }}
                        </th>
                        <th scope="col">
                            {{ $skill->labelVi }}
                        </th>
                        <th scope="col">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: {{ $skill->level }}%; background: {{ $skill->color }};" aria-valuenow="{!! $skill->level !!}" aria-valuemin="0" aria-valuemax="100">{{ $skill->level }}%</div></div>
                        </th>
                        <th>
                            @if($skill->active == 1)
                            <i class="fas fa-check-circle text-success"></i>
                            @else
                            <i class="fas fa-times-circle text-danger"></i>
                            @endif
                        </th>
                        <th>
                            <a href="{{ Route('artsyv.skill.update', ['id' => $skill->id]) }}">
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
                            <form method="post" action="../../skills/{{$skill->id}}" onsubmit="return confirm('Bạn chắc muốn xoá chứ?')">
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
    document.getElementById('skillLi').classList.add('active');
</script>
@endsection
