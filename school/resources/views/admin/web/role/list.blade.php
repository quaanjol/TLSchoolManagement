@extends('admin.layouts.master')

@section('title')
Tất cả vị trí
@endsection

@section('content')
<div class="container">
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
            Tất cả vị trí
            </h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">
                            Vị trí
                        </th>
                        <th scope="col">
                            Mô tả
                        </th>
                      </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <th scope="col">
                                {{$loop->iteration}}
                            </th>
                            <th scope="col">
                                {{ $role->name }}
                            </th>
                            <th scope="col" class="text-capitalize">
                                {{ $role->description }}
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
          </div>
        </div>
        
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('roleLi').classList.add('active');
</script>
@endsection
