<div>
    
    <div class="row mt-3">
        <div class="col-md-6 mb-2">
            <div class="card">
                <div class="card-header">
                  <ul class="nav nav-tabs card-header-tabs">
                    <h4>Categories</h4>
                    <li class="nav-item ms-auto">
                      <a class="btn btn-sm btn-primary" href="#" data-bs-target="#add-category-modal" data-bs-toggle="modal">
                        Add Category
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table table-striped">
                          <thead>
                            <tr>
                              <th>Category Name</th>
                              <th>N.of Subcategories</th>
                              <th class="w-1"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse ($categories as $category)
                            <tr>
                              <td>{{$category->category_name}}</td>
                              <td>{{$category->subcategories->count()}}</td>
                              <td>
                                <div class="btn-group">
                                    <a href="#" class="btn btn-sm btn-primary" wire:click.prevent="editCategory({{$category->id}})">Edit</a> &nbsp;
                                    <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                </div>
                              </td>
                            </tr>
                                            
                            @empty
                                <tr>
                                    <td colspan="3"><span class="text-danger">No Category Found</span></td>
                                </tr>
                            @endforelse
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="card">
                <div class="card-header">
                  <ul class="nav nav-tabs card-header-tabs">
                    <h4>SubCategories</h4>
                    <li class="nav-item ms-auto">
                      <a class="btn btn-sm btn-primary" href="#" data-bs-target="#add-subcategory-modal" data-bs-toggle="modal">
                        Add Subcategory
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table table-striped">
                          <thead>
                            <tr>
                              <th>Subcategory Name</th>
                              <th>Parent Categories</th>
                              <th>N.of Posts</th>
                              <th class="w-1"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse ($subcategories as $subcategory)
                            <tr>
                              <td>{{$subcategory->subcategory_name}}</td>
                              <td>{{$subcategory->categories->category_name}}</td>
                              <td>{{$subcategory->posts->count()}}</td>
                              <td>
                                <div class="btn-group">
                                    <a href="#" class="btn btn-sm btn-primary" wire:click.prevent="editSubCategory({{$subcategory->id}})">Edit</a> &nbsp;
                                    <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                </div>
                              </td>
                            </tr>
                                
                            @empty
                                <tr>
                                    <td colspan="4"><span class="text-danger">No Sub categories found.</span></td>
                                </tr>
                            @endforelse
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- models --}}
    
    <div wire:ignore.self class="modal modal-blur fade" id="add-category-modal" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{$updateCategoryMode ? 'Update Category' : 'Add Category'}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="" method="post" 
              @if ($updateCategoryMode)
                wire:submit.prevent='updateCategory()'
              @else
                wire:submit.prevent='addCategory()' 
              @endif>

              @if ($updateCategoryMode)
              <input type="hidden" wire:model='category_id'>
              @endif
                <div class="mb-3">
                    <label class="form-label">Catergory Name</label>
                    <input type="text" class="form-control" name="example-text-input" placeholder="Enter Category Name" wire:model='category_name'>
                    @error('category_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">{{$updateCategoryMode ? 'Update' : 'Add'}}</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>


    <div wire:ignore.self class="modal modal-blur fade" id="add-subcategory-modal" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{$updateSubCategoryMode ? 'Update SubCategory' : 'Add SubCategory'}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="" method="post"
                @if ($updateSubCategoryMode)
                    wire:submit.prevent='updateSubCategory()'
                @else
                    wire:submit.prevent='addSubCategory()' 
                @endif
              >  
              @if ($updateSubCategoryMode)
                <input type="hidden" wire:model='selected_subcategory_id'>
              @endif             
                <div class="mb-3">
                    <label class="form-label">Sub Category Name</label>
                    <input type="text" class="form-control" name="example-text-input" placeholder="Enter SubCategory Name" wire:model='subcategory_name'>
                    @error('subcategory_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="form-label">Parent Category</div>
                    <select class="form-select" wire:model="parent_category">
                        @if (!$updateSubCategoryMode)
                        <option value="">-- No Selected --</option>
                        @endif
                        @foreach (\App\Models\Category::all() as $category)
                            <option value="{{$category->id}}">{{$category->category_name}}</option>   
                        @endforeach
                    </select>
                    @error('parent_category')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">{{$updateSubCategoryMode ? 'Update' : 'Add'}}</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>

</div>
