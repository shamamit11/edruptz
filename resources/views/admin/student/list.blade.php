@extends('admin.layout')
@section('content')
<div class="main-content d-flex flex-column"> @include('admin.includes.top-nav')
    <div class="breadcrumb-area">
        <h1>Student</h1>
        <ol class="breadcrumb">
            <li class="item"><a href="{{ route('admin-dashboard')}}"><i class='bx bx-home-alt'></i></a></li>
            <li class="item">Dashboard</li>
            <li class="item">Student</li>
        </ol>
    </div>
    <div class="card mb-10">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Student</h3>
            <nav class="navbar navbar-light">
                <form method="get" class="d-flex">
                    <div class="input-group"> @csrf
                        <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Search">
                        <button class="btn btn-success my-2 my-sm-0" type="submit"><i class="align-middle"
                                data-feather="search"></i></button>
                    </div>
                </form>
            </nav>
        </div>
        <div class="card-body"> @include('admin.includes.alert')
            @if($data->count() > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" width="50">#</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Address</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $row)
                    <tr id="tr{{ $row->id }}">
                        <td>{{ $count++ }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->address }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    Showing {{ $from_data }} to {{ $to_data }} of {{ $data->total() }} records.
                </div>
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <div class="float-end"> {{$data->links('pagination::bootstrap-4')}} </div>
                </div>
            </div>
            @else
            <div class="alert alert-info" role="alert"> No data found. </div>
            @endif
        </div>
    </div>
    @include('admin.includes.footer')
</div>
@endsection
@section('footer-scripts')

@endsection