@extends('admin.layout')
@section('content')
<div class="main-content d-flex flex-column"> @include('admin.includes.top-nav')
  <div class="breadcrumb-area">
    <h1>Reviews</h1>
    <ol class="breadcrumb">
      <li class="item"><a href="{{ route('admin-review')}}">Reviews</a></li>
      <li class="item">{{ $title }}</li>
    </ol>
  </div>
  <div class="card mb-10">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h3>{{ $title }}</h3>
    </div>
    <div class="card-body">
      <form enctype="multipart/form-data" method="post" action="{{$action}}" id="form">
        @csrf
        <input type="hidden" class="form-control" name="id" value="{{ isset($row->id)? $row->id : '' }}">
        <div class="mb-3">
          <label class="form-label"> Name</label>
          <input type="text" class="form-control" name="name" value="{{old('name' , isset($row->name)? $row->name : '' )}}">
          @if($errors->has('name'))
            <div class="error">{{$errors->first('name')}}</div>
            @endif
        </div>
        <div class="mb-3">
          <label class="form-label"> Designation</label>
          <input type="text" class="form-control" name="designation" value="{{old('designation' , isset($row->designation)? $row->designation : '' )}}">
          @if($errors->has('designation'))
            <div class="error">{{$errors->first('designation')}}</div>
            @endif
        </div>
        <div class="mb-3">
          <label class="form-label">Review</label>
          <textarea class="description form-control" name="description">{{old('description' , isset($row->description)? $row->description : '' )}}</textarea>
          @if($errors->has('description')) 
            <div class="error">{{$errors->first('description')}}</div>
            @endif
        </div>
        <div class="mb-3">
          <label class="form-label">Image</label>
          <br>
          <input name="image" type="file" accept="image/*"/>
          <input name="old_image" type="hidden" value="{{ isset($row->image)? $row->image : '' }}"/>
          @if($row && $row->image)
          <div id="image">
            <div style="margin:5px 0 0 0;"> <img src="{{asset('/storage/uploads/review/'.$row->image)}}" width="150" style="border-radius:10px" /> </div>
            <div style="margin:5px 0 0 0;">
              <button type="button" class="btn btn-xs btn-danger" Onclick="confirmDelete('image')">Delete Image</button>
            </div>
          </div>
          @endif </div>
        <div class="mb-3">
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
              <label class="form-label">Status</label>
              <label class="switch">
                <input type="checkbox" class="switch-input" name="status"  value="1" {{ ((isset($row->
                status) && $row->status == 1) ||  !isset($row->status))? 'checked' : '' }}  /> <span class="switch-label" data-on="Show" data-off="Hide"></span> <span class="switch-handle"></span> </label>
            </div>
            
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
  @include('admin.includes.footer') </div>
@endsection
@section('footer-scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>
<script>
$().ready(function() {
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
                  url: '{{ route("admin-review-imagedelete")}}',
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
	ClassicEditor.create(document.querySelector('.description'), {
  removePlugins: [ 'CKFinder', 'EasyImage', 'Image',  'ImageUpload', 'MediaEmbed']
});
});

</script>
@endsection
