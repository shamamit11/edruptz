@extends('admin.layout')
@section('content')
<div class="main-content d-flex flex-column"> @include('admin.includes.top-nav')
    <div class="breadcrumb-area">
        <h1>Blog Images</h1>
        <ol class="breadcrumb">
            <li class="item"><a href="{{ route('admin-blog')}}">Blog Images</a></li>
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
                <input type="hidden" class="form-control" name="slug" value="{{ isset($row->slug)? $row->slug : '' }}">
                <div class="mb-3">
                    <label4> Date</label>
                        <input type="text" class="form-control" name="date"
                            value="{{old('date' , isset($row->date)?  $row->date : date('Y-m-d') )}}"
                            placeholder="YYYY-MM-DD" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
                        @if($errors->has('date'))
                        <div class="error">{{$errors->first('date')}}</div>
                        @endif
                </div>
                <div class="mb-3">
                    <label class="form-label"> Name</label>
                    <input type="text" class="form-control" name="name"
                        value="{{old('name' , isset($row->name)? $row->name : '' )}}">
                    @if($errors->has('name'))
                    <div class="error">{{$errors->first('name')}}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">Short Description</label>
                    <textarea name="short_description" class="form-control"
                        rows="3">{{old('short_description' , isset($row->short_description)? $row->short_description : '' )}}</textarea>
                    @if($errors->has('short_description'))
                    <div class="error">{{$errors->first('short_description')}}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control description"
                        name="description">{{old('description' , isset($row->description)? $row->description : '' )}}</textarea>
                    @if($errors->has('description'))
                    <div class="error">{{$errors->first('description')}}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <br>
                    <input name="image" type="file" accept="image/*" />
                    <input name="old_image" type="hidden" value="{{ isset($row->image)? $row->image : '' }}" />
                    @if($row && $row->image)
                    <div id="image">
                        <div style="margin:5px 0 0 0;"> <img src="{{asset('/storage/uploads/blog/'.$row->image)}}"
                                style="height:200px; border-radius:10px" /> </div>
                        <div style="margin:5px 0 0 0;">
                            <button type="button" class="btn btn-xs btn-danger" Onclick="confirmDelete('image')">Delete
                                Image</button>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <label class="switch">
                        <input type="checkbox" class="switch-input" name="status" value="1" {{ ((isset($row->
                status) && $row->status == 1) ||  !isset($row->status))? 'checked' : '' }} /> <span
                            class="switch-label" data-on="Show" data-off="Hide"></span> <span
                            class="switch-handle"></span> </label>
                </div>
                <div class="mb-3">
                    <label class="form-label"> Meta Title</label>
                    <input type="text" class="form-control" name="meta_title"
                        value="{{old('meta_title' , isset($row->meta_title)? $row->meta_title : '' )}}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Meta Description</label>
                    <textarea name="meta_description" class="form-control"
                        rows="3">{{old('meta_description' , isset($row->meta_description)? $row->meta_description : '' )}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    @include('admin.includes.footer')
</div>
@endsection
@section('footer-scripts')
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datepicker/datepicker.css') }}">
<script src="{{ asset('assets/admin/plugins/datepicker/datepicker.js') }}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script> 
<script>
$().ready(function() {
  $( 'input[name=date]' ).datepicker();
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
                    url: '{{ route("admin-blog-imagedelete")}}',
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