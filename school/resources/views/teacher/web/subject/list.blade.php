@extends('teacher.layouts.master')

@section('title')
Tất cả môn học
@endsection

@section('style')
<style>
    .custom-ul li {
        list-style-type: square;
        margin-left: -18px;
    }
</style>
@endsection

@section('content')
<div class="container">
        
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
            Tất cả môn học
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">
                                Tên
                            </th>
                            <th scope="col">
                                Thông tin
                            </th>
                            <th scope="col">
                                Mô tả
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subjects as $subject)
                            <tr>
                                <th scope="col">
                                    {{$loop->iteration}}
                                </th>
                                <th>
                                    {{ $subject->name }}
                                </th>
                                <th>
                                    <ul class="custom-ul">
                                        <li>
                                            Mã môn học: {{ $subject->code }}
                                        </li>
                                        <li>
                                            Số tín chỉ: {{ $subject->credit }}
                                        </li>
                                        <li>
                                            Trực thuộc khoa: 
                                            <ul class="custom-ul">
                                                @foreach($subject->departments as $department)
                                                <li>
                                                    {{ $department }}
                                                </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        
                                    </ul>
                                </th>
                                <th>
                                    {{ $subject->description }}
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center">
                {{ $subjects->links() }}
            </div>
        </div>
        
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('subjectLi').classList.add('active');
</script>
@endsection
