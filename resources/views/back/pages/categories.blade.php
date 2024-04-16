@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Categories')
@section('content')
    
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">Categories & Subcategories</h2>
                </div>
            </div>
        </div>
    </div>
    
    @livewire('categories')
    
@endsection

@push('scripts')
    <script>
        window.addEventListener('hideCategoryModel', function(e){
            $('#add-category-modal').modal('hide');
        });
        window.addEventListener('showCategoryModel', function(e){
            $('#add-category-modal').modal('show');
        });
        window.addEventListener('hideSubCategoryModel', function(e){
            $('#add-subcategory-modal').modal('hide');
        });
        window.addEventListener('showSubCategoryModel', function(e){
            $('#add-subcategory-modal').modal('show');
        });
        $('#add-category-modal,#add-subcategory-modal').on('hidden.bs.modal', function(e) {
            Livewire.dispatch('resetModalForm');
        });
    </script>
@endpush