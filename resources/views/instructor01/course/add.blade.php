@extends('instructor.layout')
@section('content')
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header"> @include('instructor.includes.header')
  <div class="app-main"> @include('instructor.includes.nav')
    <div class="app-main__outer">
      <div class="app-main__inner">
        <ol class="nobg breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('instructor-dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active"> Course</li>
        </ol>
        <div class="app-page-title">
          <div class="page-title-wrapper">
            <div class="page-title-heading">
              <div>Add Course </div>
            </div>
          </div>
        </div>
        <div class="card-shadowNone">
          <div class="row">
            <div class="col-md-8">
              <div class="card mt-4">
                <div class="addCourseHead card-header"><i class="fa fa-align-left icon-gradient bg-love-kiss mr-2" aria-hidden="true"></i> {{ $title }}</div>
                <div class="card-body">
                  <form action="{{ $action }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" name="id" value="{{ isset($row->id)? $row->id : '' }}">
                    <input type="hidden" class="form-control" name="slug" value="{{ isset($row->slug)? $row->slug : '' }}">
                    <div class="form-group">
                      <label class="form-label">Course Category</label>
                      <select name="category_id" class="custom-select form-control">
                      @if($categories->count() > 0)
                      @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if(@$row->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                         @endforeach
                        @endif
                      </select>
                      @if($errors->has('category_id'))
                      <div class="error">{{$errors->first('category_id')}}</div>
                      @endif </div>
                    <div class="form-group">
                      <label class="form-label">Course Title</label>
                      <input type="text" name="name" class="form-control" value="{{old('name' , isset($row->name)? $row->name : '' )}}">
                      @if($errors->has('name'))
                      <div class="error">{{$errors->first('name')}}</div>
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
                      <label class="form-label">Duration of Course</label>
                      <input type="text" name="duration" value="{{old('duration' , isset($row->duration)? $row->duration : '' )}}" class="form-control" >
                      @if($errors->has('duration'))
                      <div class="error">{{$errors->first('duration')}}</div>
                      @endif </div>
                    <div class="form-group">
                      <label class="form-label">Number of Lessons</label>
                      <input type="text" name="lectures" value="{{old('lectures' , isset($row->lectures)? $row->lectures : '' )}}" class="form-control">
                      @if($errors->has('lectures'))
                      <div class="error">{{$errors->first('lectures')}}</div>
                      @endif </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <label class="form-label">Suitable Ages From </label>
                          <input type="text" class="form-control" name="age_from"
                                value="{{old('age_from' , isset($row->age_from) ? $row->age_from : '')}}">
                          @if($errors->has('age_from'))
                          <div class="error">{{$errors->first('age_from')}}</div>
                          @endif </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <label class="form-label"> To </label>
                          <input type="text" class="form-control" name="age_to"
                                value="{{old('age_to' , isset($row->age_to) ? $row->age_to : '')}}">
                          @if($errors->has('age_to'))
                          <div class="error">{{$errors->first('age_to')}}</div>
                          @endif </div>
                      </div>
                    </div>
                    @if($row && count($row->skills) > 0)
                    @php $cnt = 1; @endphp
                    @foreach($row->skills as $course_skill)
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <label class="form-label">Skills </label>
                          <select name="skill_id_{{$cnt}}" class="form-control">
                           @if($skills->count() > 0)
                           @foreach($skills as $skill)
                            <option value="{{ $skill->id }}" @if($course_skill->skill_id == $skill->id) selected @endif>{{ $skill->name }}</option>
                           @endforeach
                           @endif
                          </select>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <label class="form-label">Percentage</label>
                          <input type="text" class="form-control" name="percent_{{$cnt}}" value="{{ $course_skill->percent }}"
                                value="{{old('percent_'.$cnt , isset($row->percent) ? $row->percent : '')}}">
                          @if($errors->has('percent'))
                          <div class="error">{{$errors->first('percent')}}</div>
                          @endif </div>
                      </div>
                    </div>
                     @php $cnt++; @endphp
                    @endforeach
                    @if(count($row->skills) < 3)
                    @for($i = count($row->skills); $i< 3; $i++)
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <label class="form-label">Skills  </label>
                          <select name="skill_id_{{$i+1}}" class="form-control">
                           @if($skills->count() > 0)
                           @foreach($skills as $skill)
                            <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                           @endforeach
                           @endif
                          </select>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <label class="form-label">Percentage</label>
                          <input type="text" class="form-control" name="percent_{{$i+1}}"
                                value="{{old('percent_'.$i+1)}}">
                          @if($errors->has('percent'))
                          <div class="error">{{$errors->first('percent')}}</div>
                          @endif </div>
                      </div>
                    </div>
                    @endfor
                    @endif
                    @else
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <label class="form-label">Skills </label>
                          <select name="skill_id_1" class="form-control">
                           @if($skills->count() > 0)
                           @foreach($skills as $skill)
                            <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                           @endforeach
                           @endif
                          </select>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <label class="form-label">Percentage</label>
                          <input type="text" class="form-control" name="percent_1"
                                value="{{old('percent_1')}}">
                          @if($errors->has('percent_1'))
                          <div class="error">{{$errors->first('percent_1')}}</div>
                          @endif </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <label class="form-label">Skills </label>
                          <select name="skill_id_2" class="form-control">
                           @if($skills->count() > 0)
                           @foreach($skills as $skill)
                            <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                           @endforeach
                           @endif
                          </select>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <label class="form-label">Percentage</label>
                          <input type="text" class="form-control" name="percent_2"
                                value="{{old('percent_2')}}">
                          @if($errors->has('percent_2'))
                          <div class="error">{{$errors->first('percent_2')}}</div>
                          @endif </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <label class="form-label">Skills </label>
                          <select name="skill_id_3" class="form-control">
                           @if($skills->count() > 0)
                           @foreach($skills as $skill)
                            <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                           @endforeach
                           @endif
                          </select>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <label class="form-label">Percentage</label>
                          <input type="text" class="form-control" name="percent_3"
                                value="{{old('percent_3')}}">
                          @if($errors->has('percent_3'))
                          <div class="error">{{$errors->first('percent_3')}}</div>
                          @endif </div>
                      </div>
                    </div>
                    @endif
                    <div class="form-group">
                      <label class="form-label">Amount (USD)</label>
                      <input type="text" name="amount" value="{{old('amount' , isset($row->amount)? $row->amount : '' )}}" class="form-control">
                      @if($errors->has('amount'))
                      <div class="error">{{$errors->first('amount')}}</div>
                      @endif </div>
                    <div class="form-group">
                      <label class="form-label">Image</label>
                      <br>
                      <input name="image" type="file" accept="image/*" />
                      <input name="old_image" type="hidden" value="{{ isset($row->image)? $row->image : '' }}" />
                      @if($row && $row->image)
                      <div id="image">
                        <div class="addEditImage"> <img src="{{asset('/storage/uploads/course/'.$row->image)}}"
                                style="border-radius:10px" /> </div>
                        <div>
                          <button type="button" class="btn btn-xs btn-danger" Onclick="confirmDelete('image')">Delete
                          Image</button>
                        </div>
                      </div>
                      @endif </div>
                    <div class="form-group">
                      <button type="submit" class="btn-shadow btn btn-success"> <span class="btn-icon-wrapper pr-2 opacity-7"> </span> Save Course </button>
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
                    url: '{{ route("instructor-course-imagedelete")}}',
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