@extends('instructor.layout')
@section('content')
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header"> @include('instructor.includes.header')
  <div class="app-main"> @include('instructor.includes.nav')
    <div class="app-main__outer">
      <div class="app-main__inner">
        <ol class="nobg breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('instructor-dashboard')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{route('instructor-course')}}">Courses</a></li>
          <li class="breadcrumb-item active">Lesson</li>
        </ol>
        <div class="card-shadowNone">
          <div class="row">
            <div class="col-md-8">
              <div class="card mt-4">
                <div class="card-header"><i class="fa fa-align-left icon-gradient bg-love-kiss mr-2" aria-hidden="true"></i> {{ $title }}</div>
                <div class="card-body">
                  <form action="{{ $action }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" name="id" value="{{ isset($row->id)? $row->id : '' }}">
                    <input type="hidden" class="form-control" name="course_id" value="{{ $course_id }}">
                    <input type="hidden" class="form-control" name="slug" value="{{ isset($row->slug)? $row->slug : '' }}">
                    <div class="form-group">
                      <label class="form-label">Lesson Title</label>
                      <input type="text" name="name" class="form-control" value="{{old('name' , isset($row->name)? $row->name : '' )}}">
                      @if($errors->has('name'))
                      <div class="error">{{$errors->first('name')}}</div>
                      @endif </div>
                      
                    <div class="form-group">
                      <label class="form-label">Lesson Number</label>
                      <input type="text" name="lesson_number" class="form-control" value="{{old('lesson_number' , isset($row->orders)? $row->orders :  $orders )}}">
                      @if($errors->has('lesson_number'))
                      <div class="error">{{$errors->first('lesson_number')}}</div>
                      @endif </div>
                    <div class="form-group">
                      <label class="form-label">Summary</label>
                      <textarea name="summary" class="form-control" rows="3">{{old('summary' , isset($row->summary)? $row->summary : '' )}}</textarea>
                      @if($errors->has('summary'))
                      <div class="error">{{$errors->first('summary')}}</div>
                      @endif </div>
                    <div class="form-group">
                      <label class="form-label">Description</label>
                      <textarea class="form-control description" name="description">{{old('description' , isset($row->description)? $row->description : '' )}}</textarea>
                      @if($errors->has('description'))
                      <div class="error">{{$errors->first('description')}}</div>
                      @endif </div>
                    <div class="form-group">
                      <label class="form-label">File</label>
                      <br>
                      <input name="file" type="file" />
                      <input name="old_file" type="hidden" value="{{ isset($row->file)? $row->file : '' }}" />
                      @if($errors->has('file'))
                      <div class="error">{{$errors->first('file')}}</div>
                      @endif 
                      @if($row && $row->file)
                      <div id="file">
                        <div style="margin:5px 0 0 0;">
                          <button type="button" class="btn btn-xs btn-danger" Onclick="confirmDelete('file')">Delete
                          File</button>
                        </div>
                      </div>
                      @endif </div>
                    <div class="form-group">
                      <label class="form-label">Video</label>
                      <br>
                      <input name="video" type="file" />
                      <input name="old_video" type="hidden" value="{{ isset($row->video)? $row->video : '' }}" />
                      @if($errors->has('video'))
                      <div class="error">{{$errors->first('video')}}</div>
                      @endif 
                      @if($row && $row->video)
                      <div style="margin:15px 0 0 0;">
                        <video controls>
                    		<source src="{{ asset('storage/uploads/lesson/'.$row->video)}}" type="video/mp4">
                    				Your browser does not support HTML5 video. 
                        </video>
                      </div>
                      <div id="video">
                        <div style="margin:5px 0 0 0;">
                          <button type="button" class="btn btn-xs btn-danger" Onclick="confirmDelete('video')">Delete
                          Video</button>
                        </div>
                      </div>
                      @endif </div>
                    <div class="form-group">
                      <label class="form-label">Assessment</label>
                      <br>
                      <input name="assessment" type="file" />
                      <input name="old_assessment" type="hidden" value="{{ isset($row->assessment)? $row->assessment : '' }}" />
                      @if($errors->has('assessment'))
                      <div class="error">{{$errors->first('assessment')}}</div>
                      @endif 
                      @if($row && $row->assessment)
                      <div id="assessment">
                        <div style="margin:5px 0 0 0;">
                          <button type="button" class="btn btn-xs btn-danger" Onclick="confirmDelete('assessment')">Delete
                          Assessment</button>
                        </div>
                      </div>
                      @endif </div>
                    <div class="form-group">
                      <button type="submit" class="btn-shadow btn btn-success"> <span class="btn-icon-wrapper pr-2 opacity-7"> </span> Save Lesson </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @include('instructor.includes.footer') </div>
  </div>
</div>
@endsection 
@section('footer-scripts') 
<script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script> 
<script>
$().ready(function() {
    ClassicEditor.create(document.querySelector('.description'), {
        removePlugins: ['CKFinder', 'EasyImage', 'Image', 'ImageUpload', 'MediaEmbed']
    });
	
	 //to delete
    confirmDelete = function(field_name) {
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
                    url: '{{ route("instructor-lesson-filedelete")}}',
                    type: 'POST',
                    data: {
                        'id': '{{ @$row->id }}',
                        'field_name': field_name,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function() {
                        $("#" + field_name).remove();
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
    }
   
});
</script> 
@endsection