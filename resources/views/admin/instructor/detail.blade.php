@extends('admin.layout')
@section('content')
<div class="main-content d-flex flex-column"> @include('admin.includes.top-nav')
    <div class="breadcrumb-area">
        <h1>Instructors</h1>
        <ol class="breadcrumb">
            <li class="item"><a href="{{ route('admin-instructor')}}">Instructors</a></li>
            <li class="item">{{ $title }}</li>
        </ol>
    </div>
    <div class="card mb-10">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>{{ $title }}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 col-sm-8 col-xs-8">
                <div class="mb-3">
                <label class="form-label">Name</label><br> {{  $row->name}}

            </div>
            <div class="mb-3">
                <label class="form-label">Email</label><br>
                {{  $row->email}}
            </div>
            <div class="mb-3">
                <label class="form-label">Profession</label> {{  $row->professional}}
            </div>
            <div class="mb-3">
                <label class="form-label">Location</label><br> {{  $row->address}}

            </div>
            <div class="row hide">
                <div class="mb-2 col-sm-4">
                    <div class="mb-3">
                        <label class="form-label">City</label><br> {{  $row->city}}
                    </div>
                </div>
                <div class="mb-3 col-sm-4">
                    <div class="mb-3">
                        <label class="form-label">State</label><br> {{  $row->state}}
                    </div>
                </div>
                <div class="mb-3 col-sm-4">
                    <div class="mb-3">
                        <label class="form-label">Zip</label> <br>{{  $row->zip}}
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">About Me</label> <br>
                {!! $row->about_me !!}
            </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                @if($row->image) <img src="{{asset('/storage/uploads/instructor/'.$row->image)}}"
                 /> @else <img src="{{asset('assets/images/no-image.jpg')}}"> @endif
        
                </div>

            </div>

           
         

        </div>
    </div>
    @include('admin.includes.footer')
</div>
@endsection
@section('footer-scripts')
@endsection