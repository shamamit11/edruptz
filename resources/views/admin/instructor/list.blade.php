@php
use App\Models\Course;
use App\Models\CourseReview;
@endphp
@extends('admin.layout')
@section('content')
<div class="main-content d-flex flex-column"> @include('admin.includes.top-nav')
    <div class="breadcrumb-area">
        <h1>Instructor</h1>
        <ol class="breadcrumb">
            <li class="item"><a href="{{ route('admin-dashboard')}}"><i class='bx bx-home-alt'></i></a></li>
            <li class="item">Dashboard</li>
            <li class="item">Instructor</li>
        </ol>
    </div>
    <div class="card mb-10">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Instructor</h3>
            <nav class="navbar navbar-light">
                <form method="get" class="d-flex">
                    <div class="input-group"> @csrf
                        <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Search">
                        <button class="btn btn-success my-2 my-sm-0" type="submit"><i class="align-middle"
                                data-feather="search"></i></button>
                    </div>
                </form>
                <a href="{{ route('admin-instructor-export') }}" class="btn btn-primary my-2 my-sm-0 ms-1"> Export to Excel</a>
            </nav>
        </div>
        <div class="card-body"> @include('admin.includes.alert')
            @if($data->count() > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" width="50">#</th>
                        <th scope="col">Instructor Name</th>
                        <th scope="col">Profession </th>
                        <th scope="col">Email</th>
                        <th scope="col">Address</th>
                        <th scope="col" style="text-align: center">Courses</th>
                        <th scope="col">Last Update</th>
                        <th scope="col" style="text-align: center">Commission</th>
                        <th scope="col" style="text-align: center">Status</th>
                        <th scope="col" style="text-align: center">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $row)
                    @php $last_updated = Course::where('instructor_id', $row->id)->orderBy('updated_at',
                    'desc')->first();
                    @endphp
                    <tr id="tr{{ $row->id }}">
                        <td>{{ $count++ }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->professional }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->address }}</td>
                        <td style="text-align: center">
                            <a href="{{route('admin-instructor-courses', ['instructor_id='.$row->id])}}"
                                class="btn btn-sm btn-info rounded-pill">{{ count($row->courses) }}</a>
                        </td>
                        <td>@if(count($row->courses) > 0)
                            {{ date('d M Y', strtotime($last_updated->updated_at)) }}
                            @endif</td>
                        <td style="text-align: center">{{ $row->commission }}%</td>
                        <td style="text-align: center">{{ ($row->status == 1) ? "Active" : "Inactive" }}</td>
                        <td style="text-align: center"><a href="{{route('admin-instructor-detail', ['id='.$row->id])}}"
                                class="btn btn-sm btn-primary rounded-pill"><span class="icon"><i
                                        class='bx bxs-show'></i></span></a> <a href="{{route('admin-instructor-add', ['id='.$row->id])}}"
                                class="btn btn-sm btn-warning rounded-pill"><span class="icon"><i
                                        class='bx bxs-pencil'></i></span></a></td>
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