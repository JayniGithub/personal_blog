@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Add New Post')
@section('content')
    
    <div class="page-header d-print-none">
        <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
            <h2 class="page-title">
                Add New Post
            </h2>
            </div>
        </div>
        </div>
    </div>

    <form action="{{route('author.posts.create')}}" method="post" id="addNewPostForm" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <div>
                    @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{session('message')}}
                    </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <div class="mb-3">
                            <label class="form-label">Post Title</label>
                            <input required type="text" class="form-control" name="post_title" placeholder="Enter Post Title">
                            <span class="text-danger error-text post_title_error"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Post Content</label>
                            <textarea class="ckeditor form-control" name="post_content" id="editor" rows="6" placeholder="Post Content.."></textarea>
                            <span class="text-danger error-text post_content_error"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <div class="form-label">Post Category</div>
                            <select class="form-select" name="post_category" required>
                                <option value="">--- No Select ---</option>
                                @foreach (\App\Models\SubCategory::all() as $subcategory)                           
                                    <option value="{{$subcategory->id}}">{{$subcategory->subcategory_name}}</option>    
                                @endforeach
                            </select>
                            <span class="text-danger error-text post_category_error"></span>
                        </div>
                        <div class="mb-3">
                            <div class="form-label">Featured Image</div>
                            <input type="file" class="form-control" name="featured_image" id="featured_image">
                            <span class="text-danger error-text post_featured_image_error"></span>
                        </div>
                        <div class="image-holder mb-2" style="max-width: 250px">
                            <img src="" alt="" class="img-thumbnail" id="img-previewer">
                        </div>
                        <button type="submit" class="btn btn-primary">Save Post</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection

@push('scripts')
<script src="/ckeditor/ckeditor.js"></script>
<script>
    let editorinstance;
    
    
    jQuery(document).ready(function($) {
        var myEditor = ClassicEditor.create(document.querySelector('#editor'))
                                    .then(editor => {editorinstance =editor;})
                                    .catch(e => {console.error(e)});

        $('#featured_image').change(function(event) {
        var url = URL.createObjectURL(event.target.files[0]);
        $('#img-previewer').attr("src", url);
        console.log(event);
        });

        $('#addNewPostForm').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            const postContent = editorinstance.getData();
            var formData = new FormData(form);
            formData.append('post_content', postContent)
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function(){
                    $(form).find('span.error-text').text('');
                },
                success: function(data){
                    this.reset();
                    // document.querySelector('#editor').setData('');
                    // window.location.reload();
                },
                error:function() {
                    // $.each(response.responseJSON.errors, function(prefix, val){
                    //     $(form).find('span.'+prefix+ '_error').text(val[0]);
                    // });
                }
            });
        });
  });
</script>
    
@endpush