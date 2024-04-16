<div>
    
    <form method="post" wire:submit.prevent="UpdateAuthor()">
        <div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{session('message')}}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label required">Name</label>
                    <input type="text" class="form-control" placeholder="Name" wire:model='name'/>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label required">Username</label>
                    <input type="text" class="form-control" placeholder="Username" wire:model='username'/>
                    @error('username')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label required">Email</label>
                    <input type="email" class="form-control" placeholder="Email" disabled wire:model='email'/>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Biography</label>
            <textarea class="form-control" name="example-textarea" rows="6" placeholder="Biography" wire:model='biography'></textarea>
            @error('biography')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>

</div>
