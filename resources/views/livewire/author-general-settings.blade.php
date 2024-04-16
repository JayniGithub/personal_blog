<div>
    
    <form wire:submit.prevent="updateGeneralSettings()" method="post">
        <div>
            @if (session()->has('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
        @endif
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Blog Name</label>
                    <input type="text" class="form-control" placeholder="Enter Blog Name" wire:model='blog_name'/>
                    @error('blog_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Blog Email</label>
                    <input type="email" class="form-control" placeholder="Enter Blog Email" wire:model='blog_email'/>
                    @error('blog_email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Blog Description</label>
                    <textarea class="form-control" cols="50" rows="3" placeholder="Enter Blog Description" wire:model="blog_description"></textarea>
                    @error('blog_description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </form>

</div>
