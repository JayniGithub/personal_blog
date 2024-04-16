@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Settings')
@section('content')
    
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">Settings</h2>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
          <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
            <li class="nav-item">
              <a href="#tabs-home-ex1" class="nav-link active" data-bs-toggle="tab">General Settings</a>
            </li>
            <li class="nav-item">
              <a href="#tabs-profile-ex1" class="nav-link" data-bs-toggle="tab">Logo & Favicon</a>
            </li>
            <li class="nav-item">
              <a href="#tabs-profile-ex2" class="nav-link" data-bs-toggle="tab">Social Media</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="tab-pane active show" id="tabs-home-ex1">
              <div>
                @livewire('author-general-settings')
              </div>
            </div>
            <div class="tab-pane" id="tabs-profile-ex1">
              <div>
                <div class="row">
                  <div class="col-md-6">
                    <h3>Set Blog Logo</h3>
                    <div class="mb-3" style="max-width:200px;">
                      <img src="{{\App\Models\Setting::find(1)->blog_logo}}" alt="" class="img-thumbnail" id="logo-img-preview">
                    </div>
                    <form action="{{route('author.change-blog-logo')}}" method="post" id="changeBlogLogoForm">
                      @csrf
                      <div class="mb-2">
                        <input type="file" name="blog_logo" id="img-upload" class="form-control">
                      </div>
                      <button class="btn btn-primary">Change Logo</button>
                    </form>
                  </div>
                  <div class="col-md-6">
                    <h3>Set Blog Favicon Icon</h3>
                    <div class="mb-3" style="max-width:200px;">
                      <img src="{{\App\Models\Setting::find(1)->blog_favicon}}" alt="" class="img-thumbnail" id="favicon-img-preview">
                    </div>
                    <form action="{{route('author.change-blog-favicon')}}" method="post" id="changeBlogFaviconForm">
                      @csrf
                      <div class="mb-2">
                        <input type="file" name="blog_favicon" id="fav-upload" class="form-control">
                      </div>
                      <button class="btn btn-primary">Change Favicon</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tabs-profile-ex2">
              <div>
                @livewire('author-blog-social-media-form')
              </div>
            </div>
          </div>
        </div>
      </div>
      

@endsection

@push('scripts')

<script>
  jQuery(document).ready(function($) {
    $('#img-upload').change(function(event) {
      var url = URL.createObjectURL(event.target.files[0]);
      $('#logo-img-preview').attr("src", url);
      console.log(event);
    });

    $('#changeBlogLogoForm').submit(function(e) {
      e.preventDefault();
      var form = this;
      $.ajax({
        url: $(form).attr('action'),
        method: $(form).attr('method'),
        data: new FormData(form),
        processData: false,
        dataType: 'json',
        contentType: false,
        beforeSend: function(){},
        success: function(data){
          Livewire.dispatch('updateTopHeader');
        }
      });
    });

    // upload favicon icon
    $('#fav-upload').change(function(event) {
      var url = URL.createObjectURL(event.target.files[0]);
      $('#favicon-img-preview').attr("src", url);
      console.log(event);
    });

    $('#changeBlogFaviconForm').submit(function(e) {
      e.preventDefault();
      var form = this;
      $.ajax({
        url: $(form).attr('action'),
        method: $(form).attr('method'),
        data: new FormData(form),
        processData: false,
        dataType: 'json',
        contentType: false,
        beforeSend: function(){},
        success: function(data){}
      });
    });
  });
</script>
    
@endpush