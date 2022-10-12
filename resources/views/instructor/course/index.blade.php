@extends('instructor.layout')
@section('content')
<div class="main-content d-flex flex-column"> @include('instructor.includes.top-nav')
    <div class="breadcrumb-area">
        <h1>My Courses</h1>
        <ol class="breadcrumb">
            <li class="item"><a href="{{ route('instructor-dashboard')}}"><i class='bx bx-home-alt'></i></a></li>
            <li class="item">Courses</li>
        </ol>
    </div>
    <div class="card mb-10">
        <div class="card-header d-flex justify-content-between align-items-center">
            <nav class="navbar navbar-light">
                <form method="get" class="d-flex">
                    <div class="input-group"> 
                      @csrf
                        <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Search" style="width:250px;">
                        <button class="btn btn-success my-2 my-sm-0" type="submit"><i class="align-middle"
                                data-feather="search"></i></button>
                    </div>
                </form>
            </nav>
            <div>
              <a href="{{ route('instructor-course-add') }}" class="btn btn-primary my-2 my-sm-0 ms-1"> Add Course</a>
            </div>
        </div>
        <div class="card-body"> 
            @include('instructor.includes.alert')
            @if($courses->count() > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" width="50">#</th>
                        <th scope="col">Course Name</th>
                        <th scope="col" width="200">Category </th>
                        <th scope="col" width="150">Price </th>
                        <th scope="col" width="150" class="text-center">Sales </th>
                        <th scope="col" width="150" class="text-center">Status </th>
                        <th scope="col" width="250" class="text-center">Lessons</th>
                        <th scope="col" width="80" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $row)
                    <tr id="tr{{ $row->id }}">
                        <td>{{ $count++ }}</td>
                        <td>
                          {{-- @if($row->image)
                          <img src="{{ asset('storage/uploads/course/'.$row->image)}}" class="avatar-img rounded" width="80"> 
                          @else
                          <img src="{{ asset('assets/images/no-course-image.png')}}" class="avatar-img rounded"  width="80">
                          @endif --}}
                          <span>{{ $row->name }}</span>
                          
                        </td>
                        <td>{{ $row->category->name }}</td>
                        <td>USD {{ $row->amount }}</td>
                        <td class="text-center">{{ count($row->sales) }}</td>
                        <td class="text-center">{{ ($row->status == 1) ? "Active" : "Inactive" }}</td>
                        <td class="text-center">
                          <a href="{{route('instructor-lesson', ['course_id='. Crypt::encryptString($row->id)])}}"
                            class="btn btn-sm btn-info rounded-pill">Add / Edit Lessons ({{ count($row->lessons) }})</a>
                          </td>
                          <td class="text-center">
                          <a href="{{route('instructor-course-add', ['id='. Crypt::encryptString($row->id)])}}"
                                class="btn btn-sm btn-warning rounded-pill"><span class="icon"><i
                                        class='bx bxs-pencil'></i></span></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    Showing {{ $from_data }} to {{ $to_data }} of {{ $courses->total() }} records.
                </div>
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <div class="float-end"> {{$courses->links('pagination::bootstrap-4')}} </div>
                </div>
            </div>
            @else
            <div class="alert alert-info" role="alert"> No data found. </div>
            @endif
        </div>
    </div>
    @include('instructor.includes.footer')
</div>
@endsection
@section('footer-scripts')

@endsection