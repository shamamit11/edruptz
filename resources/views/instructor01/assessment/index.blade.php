@extends('instructor.layout')
@section('content')
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header"> @include('instructor.includes.header')
  <div class="app-main"> @include('instructor.includes.nav')
    <div class="app-main__outer">
      <div class="app-main__inner">
        <ol class="nobg breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('instructor-dashboard')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{route('instructor-course')}}">Courses</a></li>
          <li class="breadcrumb-item active">Assessment</li>
        </ol>
        <div class="app-page-title">
          <div class="page-title-wrapper">
            <div class="page-title-heading">
              <div>Assessment
                <div class="page-title-subheading">Student Assessment</div>
              </div>
            </div>
            <div class="page-title-actions">
            
            </div>
          </div>
        </div>
        @if($assessments->count() > 0)
        <div class="card-shadowNone">
          <div class="card mt-4">
            <div class="card-header"><i class="fa fa-file-text icon-gradient bg-love-kiss mr-2" aria-hidden="true"></i> Student Assessment</div>
            <div class="card-body">
              <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" width="50">#</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Lesson</th>
                        <th scope="col"  width="300">Assessment</th>
                        <th scope="col" style="text-align:center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($assessments as $assessment)
                    <tr >
                        <td>{{ $count++ }}</td>
                        <td>{{ $assessment->student->name }}</td>
                        <td>{{ $assessment->lesson->name }}</td>
                      
                        <td><a
                                                href="{{ asset('storage/uploads/assessment/'.$assessment->assessment)}}"
                                                class="btn btn-success btn-block flex-column" target="_blank"> <i
                                                    class="fa fa-download d-block"></i> Download Assessment </a>
                        </td>
                        <td><label class="switch" style="margin: 0 auto">
                                <input class="switch-input switch-status" type="checkbox" data-id="{{ $assessment->id }}"
                                    data-status-value="{{ $assessment->status }}" @if($assessment->
                                status == 1) checked @endif /> <span class="switch-label" data-on="Completed"
                                    data-off="In reviewed"></span> <span class="switch-handle"></span> </label></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
          </div>
        </div>
        <nav>
          <div class="align-middle"> {{ $assessments->links('pagination::bootstrap-4') }} </div>
        </nav>
      </div>
      @else
      <div class="alert alert-light alert-dismissible border-1 border-left-3 border-left-warning" role="alert">
        <div class="text-black-70">Ohh no! No assessment to display.</div>
      </div>
      @endif
      @include('instructor.includes.footer') </div>
  </div>
</div>
@endsection 

@section('footer-scripts') 
<script>
$(document).ready(function() {
     $('.switch-status').change(function() {
        if ($(this).attr('data-status-value') == 0) {
            var val = 1;
        } else {
            var val = 0;
        }
        $(this).attr("data-status-value", val);
        var id = $(this).attr('data-id');
        $.ajax({
            url: '{{ route("instructor-assessment-status")}}',
            type: 'POST',
            data: {
                'id': id,
                'val': val,
                'field_name': 'status',
                '_token': '{{ csrf_token() }}'
            },
        });
    });
});
</script> 
@endsection