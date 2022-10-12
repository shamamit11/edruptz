@extends('instructor.layout')
@section('content')
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header"> @include('instructor.includes.header')
  <div class="app-main"> @include('instructor.includes.nav')
    <div class="app-main__outer">
      <div class="app-main__inner">
        <ol class="nobg breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('instructor-dashboard')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{route('instructor-course')}}">Courses</a></li>
          <li class="breadcrumb-item active">Lessons</li>
        </ol>
        <div class="app-page-title">
          <div class="page-title-wrapper">
            <div class="page-title-heading">
              <div>{{ $row_course->name }}
                <div class="page-title-subheading">{{ $row_course->summary }}</div>
              </div>
            </div>
            <div class="page-title-actions">
              <div class="d-inline-block">
                <button type="button" class="btn-shadow btn btn-success" onclick="window.location.href='{{ route('instructor-lesson-add', ['course_id='. Crypt::encryptString($row_course->id)]) }}'"> <span class="btn-icon-wrapper pr-2 opacity-7"> <i class="fa fa-plus fa-w-20"></i> </span> Create Lesson </button>
              </div>
            </div>
          </div>
        </div>
        @if($lessons->count() > 0)
        <div class="card-shadowNone">
          <div class="card mt-4">
            <div class="card-header"><i class="fa fa-file-text icon-gradient bg-love-kiss mr-2" aria-hidden="true"></i> Lessons</div>
            <div class="card-body">
              <div class="nestable">
                <ul class="nestable-list">
                  @foreach($lessons as $lesson)
                  <li class="nestable-item nestable-item-handle" id="lesson-{{ $lesson->id }}">
                    <div class="nestable-content">
                      <div class="media align-items-center">
                        <div class="media-body">
                          <h5 class="card-title h6 mb-0"> {{ $lesson->name }}</h5>
                          <div>Lesson #: {{ $lesson->orders }}</div>
                        </div>
                        <div class="media-right"> <a href="{{route('instructor-lesson-add', ['course_id='. Crypt::encryptString($lesson->course_id).'&id='. Crypt::encryptString($lesson->id)])}}" class="btn btn-sm addEditBtn"><i class="fa fa-pencil"> Edit</i></a></div>
                      </div>
                    </div>
                  </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>
        <nav>
          <div class="align-middle mt-4"> {{ $lessons->links('pagination::bootstrap-4') }} </div>
        </nav>
      </div>
      @else
      <div class="alert alert-light alert-dismissible border-1 border-left-3 border-left-warning" role="alert">
        <div class="text-black-70">Ohh no! No courses to display. Add some courses.</div>
      </div>
      @endif
      @include('instructor.includes.footer') </div>
  </div>
</div>
@endsection 

@section('footer-scripts') 
<script>
$(document).ready(function() {
    $('.delete-row-btn').click(function() {
        var id = $(this).data("id");
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            reverseButtons: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("instructor-lesson-delete")}}',
                    type: 'POST',
                    data: {
                        'id': id,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function() {
                        $("#lesson-" + id).remove();
                        swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'Your data has been deleted.',
                            'success'
                        );
                    }
                });
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    '',
                    'error'
                )
            }
        })
    });
});
</script> 
@endsection