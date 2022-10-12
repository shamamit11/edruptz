@extends('admin.layout')
@section('content')
    <div class="main-content d-flex flex-column"> @include('admin.includes.top-nav')
        <div class="breadcrumb-area">
            <h1>Instructors</h1>
            <ol class="breadcrumb">
                <li class="item"><a href="{{ route('admin-instructor') }}">Instructors</a></li>
                <li class="item">{{ $title }}</li>
            </ol>
        </div>
        <div class="card mb-10">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3>{{ $title }}</h3>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" method="post" action="{{ $action }}" id="form">
                    @csrf
                    <input type="hidden" class="form-control" name="id" value="{{ isset($row->id) ? $row->id : '' }}">
                    <input type="hidden" class="form-control" name="course_id" value="{{ $course_id }}">
                    <input type="hidden" class="form-control" name="slug"
                        value="{{ isset($row->slug) ? $row->slug : '' }}">

                    <div class="mb-3">
                        <label class="form-label">Lesson Title</label>
                        <input type="text" name="name" class="form-control"
                            value="{{ old('name', isset($row->name) ? $row->name : '') }}">
                        @if ($errors->has('name'))
                            <div class="error">{{ $errors->first('name') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lesson Number</label>
                        <input type="text" name="lesson_number" class="form-control"
                            value="{{ old('lesson_number', isset($row->orders) ? $row->orders : $orders) }}">
                        @if ($errors->has('lesson_number'))
                            <div class="error">{{ $errors->first('lesson_number') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Summary</label>
                        <textarea name="summary" class="form-control" rows="3">{{ old('summary', isset($row->summary) ? $row->summary : '') }}</textarea>
                        @if ($errors->has('summary'))
                            <div class="error">{{ $errors->first('summary') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control description" name="description">{{ old('description', isset($row->description) ? $row->description : '') }}</textarea>
                        @if ($errors->has('description'))
                            <div class="error">{{ $errors->first('description') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">File</label>
                        <br>
                        <input name="file" type="file" />
                        <input name="old_file" type="hidden" value="{{ isset($row->file) ? $row->file : '' }}" />
                        @if ($errors->has('file'))
                            <div class="error">{{ $errors->first('file') }}</div>
                        @endif
                        @if ($row && $row->file)
                            <div id="file">
                                <div style="margin:15px 0 0 0;">
                                    <a href="{{ asset('storage/uploads/lesson/' . $row->file) }}" class="btn btn-sm btn-info" target="_blank"><i class="bx bxs-file-blank"></i> {{ $row->file }}</a>
                                </div>
                                <div style="margin:5px 0 0 0;">
                                    <button type="button" class="btn btn-sm btn-danger"
                                        Onclick="confirmDelete('file')">Delete
                                        File</button>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Video <small style="color: red">&nbsp; Max. Video Size: 200
                                MB</small></label>
                        <br>
                        <input name="video" type="file"/>
                        <input name="old_video" type="hidden" value="{{ isset($row->video) ? $row->video : '' }}" />
                        @if ($errors->has('video'))
                            <div class="error">{{ $errors->first('video') }}</div>
                        @endif
                        @if ($row && $row->video)
                            <div id="video">
                                <div style="margin:15px 0 0 0;">
                                    <video controls width="300" muted>
                                        <source src="{{ asset('storage/uploads/lesson/' . $row->video) }}"
                                            type="video/mp4">
                                        Your browser does not support HTML5 video.
                                    </video>
                                </div>

                                <div style="margin:5px 0 0 0;">
                                    <button type="button" class="btn btn-sm btn-danger"
                                        Onclick="confirmDelete('video')">Delete
                                        Video</button>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Assessment</label>
                        <br>
                        <input name="assessment" type="file" />
                        <input name="old_assessment" type="hidden"
                            value="{{ isset($row->assessment) ? $row->assessment : '' }}" />
                        @if ($errors->has('assessment'))
                            <div class="error">{{ $errors->first('assessment') }}</div>
                        @endif
                        @if ($row && $row->assessment)
                            <div id="assessment">
                                <div style="margin:15px 0 0 0;">
                                    <a href="{{ asset('storage/uploads/lesson/' . $row->assessment) }}" class="btn btn-sm btn-info" target="_blank"><i class="bx bxs-file-blank"></i> {{ $row->assessment }}</a>
                                </div>
                                <div style="margin:5px 0 0 0;">
                                    <button type="button" class="btn btn-sm btn-danger"
                                        Onclick="confirmDelete('assessment')">Delete
                                        Assessment</button>
                                </div>
                            </div>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        @include('admin.includes.footer')
    </div>
@endsection
@section('footer-scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>
    <script>
        $().ready(function() {
            ClassicEditor.create(document.querySelector('.description'), {
                removePlugins: ['CKFinder', 'EasyImage', 'Image', 'ImageUpload', 'MediaEmbed']
            });

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
                            url: '{{ route('admin-instructor-course-lesson-filedelete') }}',
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
        })
    </script>
@endsection
