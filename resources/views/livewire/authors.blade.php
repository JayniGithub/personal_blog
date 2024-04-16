<div>
    
    <div class="page-header d-print-none">
        <div class="container-xl">
          <div class="row g-2 align-items-center">
            <div class="col">
              <h2 class="page-title">
                Authors
              </h2>
              <div class="text-muted mt-1">1-18 of 413 people</div>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
              <div class="d-flex">
                <input type="search" class="form-control d-inline-block w-9 me-3" placeholder="Search Author…">
                <a href="#" class="btn btn-primary" data-bs-target="#add-author-modal" data-bs-toggle="modal">
                  <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
                  New Author
                </a>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
          <div class="row row-cards">
                @forelse ($authors as $author)
                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body p-4 text-center">
                        <span class="avatar avatar-xl mb-3 rounded" style="background-image: url({{$author->picture}})"></span>
                        <h3 class="m-0 mb-1"><a href="#">{{$author->name}}</a></h3>
                        <div class="text-muted">{{$author->email}}</div>
                        <div class="mt-3">
                            <span class="badge bg-purple-lt">{{$author->authorType->name}}</span>
                        </div>
                        </div>
                        <div class="d-flex">
                        <a href="#" class="card-btn btn-primary">Edit</a>
                        <a href="#" class="card-btn">Delete</a>
                        </div>
                    </div>
                </div>
                @empty
                    <div class="text-danger">No Author Found</div>
                @endforelse
            </div>
        </div>
    </div>


    {{-- modals --}}

    <div wire:ignore.self class="modal modal-blur fade" id="add-author-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Author</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form wire:submit.prevent="addAuthor()" action="" method="post">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="example-text-input" placeholder="Enter Name" wire:model='name'>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="example-text-input" placeholder="Enter Email" wire:model="email">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="example-text-input" placeholder="Enter Username" wire:model="username">
                    @error('username')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="form-label">Author Type</div>
                    <select class="form-select" wire:model="author_type">
                      <option value="">--- No Selected ---</option>
                      @foreach (\App\Models\Type::all() as $type)
                      <option value="{{$type->id}}">{{$type->name}}</option>
                      @endforeach
                    </select>
                    @error('author_type')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="form-label">Is Direct Publisher</div>
                    <div>
                        <label class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="direct_publisher" value="0" wire:model="direct_publisher">
                            <span class="form-check-label">0</span>
                        </label>
                        <label class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="direct_publisher" value="1" wire:model="direct_publisher">
                            <span class="form-check-label">1</span>
                        </label>
                    </div>           
                    @error('direct_publisher')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>

</div>
