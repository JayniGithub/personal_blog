<div>
    
    <form method="post" wire:submit.prevent="changePassword()">
        <div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{session('message')}}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{session('message')}}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label required">Current Password</label>
                    <input type="password" class="form-control" placeholder="Current Password" wire:model='current_password'/>
                    @error('current_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label required">New Password</label>
                    <input type="password" class="form-control" placeholder="New Password" wire:model='new_password'/>
                    @error('new')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
              </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label required">Confirm New Password</label>
                    <input type="password" class="form-control" placeholder="Confirm New Password" wire:model='confirm_new_password'/>
                    @error('confirm_new_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>

</div>
