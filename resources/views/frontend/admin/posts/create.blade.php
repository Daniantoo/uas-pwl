@extends('layouts.app')
<style>
    .ck-editor__editable_inline {
        min-height: 400px;
    }
</style>

@section('content')
    <section id="latest-post">
        <div class="container mb-3 px-4">
            <h1>{{ $page_title }}</h1>
            <form action="{{ route('author.posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">{{ $error }}</div>
                            @endforeach
                        @endif

                        @csrf
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="name">Title</label>
                                <input class="form-control" name="title" id="title" value="{{ old('title') }}"
                                    required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="name">SEO Title</label>
                                <input class="form-control" name="seotitle" id="seotitle" value="{{ old('seotitle') }}"
                                    required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="meta_description">Meta Description (SEO)</label>
                                <textarea class="form-control" name="meta_description" id="meta_description" value="{{ old('description') }}"
                                    rows="3"></textarea>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="name">Description</label>
                                <textarea class="form-control" name="description" id="description" value="{{ old('description') }}" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="name">Category</label>
                                        <select name="category_id" id="category_id" class="form-control">
                                            <option value=""></option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="tag_id">Tags</label>
                                        <select name="tag_id[]" id="tag_id" class="form-control" multiple required>
                                            <option value=""></option>
                                            @foreach ($tags as $tag)
                                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                            <div class="col-3">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="is_publish">Publish?</label>
                                        <br>
                                        <input type="radio" name="is_publish" id="is_publish_yes" value="Publish"
                                            @if ($posts->is_published == 1) checked @endif>
                                        <label for="is_publish_yes">Yes</label>

                                        <input type="radio" name="is_publish" id="is_publish_no" value="Draft"
                                            @if ($posts->is_published == 0) checked @endif>
                                        <label for="is_publish_no">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                            <div class="form-group">
                                        <label for="active">Active?</label>
                                        <br>
                                        <input type="radio" name="active" id="active_yes" value="Yes"
                                            @if ($posts->activeed == 1) checked @endif>
                                        <label for="active_yes">Yes</label>

                                        <input type="radio" name="active" id="active_no" value="No"
                                            @if ($posts->activeed == 0) checked @endif>
                                        <label for="active_no">No</label>
                                    </div>
                            </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="name">Published at</label>
                                        <input name="published_at" id="published_at" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-12 col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="image">Featured Image</label>
                                    <br>
                                    <input type="file" name="image" id="image" accept="image/*">
                                </div>
                            </div>
                            <div class="col col-12 col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="image">Preview Featured Image</label>
                                    <br>
                                    <img id="imagePreview" src="" alt="Preview Gambar" style="display: none;"
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" name="submit" id="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Save
                        </button>
                        <button type="reset" name="reset" class="btn btn-danger">
                            <i class="fa fa-sync"></i> Reset
                        </button>
                        <a class="btn btn-dark" href="{{ route('author.posts') }}">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </div>
            </form>
        </div>
        </div>
    </section>
@endsection

@section('script_addon')
    <!-- select2 -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script> --}}
    <script src="{{ asset('assets/plugins/ckeditor5/ckeditor.js') }}"></script>
    <!-- datepicker -->
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css') }}">
    <script type="text/javascript"
        src="{{ asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $('#published_at').datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true
        });

        ClassicEditor.create(document.querySelector('#description'), {
                ckfinder: {
                    uploadUrl: "{{ route('image.upload') . '?_token=' . csrf_token() }}",
                }
            })
            .catch(error => {
                console.error(error);
            });

        $('#category_id').select2({
            theme: 'bootstrap4',
            placeholder: '-- Choose Category --'
        });
        $('#tag_id').select2({
            theme: 'bootstrap4',
            placeholder: '-- Choose Tag --'
        });

        const image = document.getElementById("image");
        const imagePreview = document.getElementById("imagePreview");

        image.addEventListener("change", function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = "block";
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.src = "";
                imagePreview.style.display = "none";
            }
        });
    </script>
@endsection
