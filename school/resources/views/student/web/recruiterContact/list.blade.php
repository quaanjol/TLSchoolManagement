@extends('artsyv.layouts.master')

@section('title')
@if($language == 'vietnamese')
Tin nhắn
@else
Messages
@endif
@endsection

@section('content')
<div class="container">
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
            @if($language == 'vietnamese')
            Tất cả tin nhắn trên portfolio
            @else
            All messages on portfolio
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
                        Tên
                        @else
                        Name
                        @endif
                        </th>
                        <th scope="col">
                        Email
                        </th>
                        <th scope="col">
                        @if($language == 'vietnamese')
                        Lời nhắn
                        @else
                        Message
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
                @if($recruiterContacts != null)
                    @foreach($recruiterContacts as $r)
                    <tr>
                        <th scope="col">
                            {{$loop->iteration}}
                        </th>
                        <th scope="col">
                            {{ $r->name }}
                        </th>
                        <th scope="col">
                            {{ $r->email }}
                        </th>
                        <th>
                            {{ $r->content }}
                        </th>
                        <th>
                            <form method="post" action="../../recruiterContacts/{{$r->id}}" onsubmit="return confirm('Bạn chắc muốn xoá chứ?')">
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
    document.getElementById('rcontactLi').classList.add('active');
</script>
@endsection
