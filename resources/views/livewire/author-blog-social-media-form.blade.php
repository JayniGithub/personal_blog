<div>
    
    <form method="post" wire:submit.prevent="UpdateBlogSocialMedia()">
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
                    <label class="form-label">Facebook URL</label>
                    <input type="text" class="form-control" placeholder="Facebook URL" wire:model='facebook_url'/>
                    @error('facebook_url')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Instergram URL</label>
                    <input type="text" class="form-control" placeholder="Instergram URL" wire:model='instergram_url'/>
                    @error('instergram_url')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Youtube URL</label>
                    <input type="text" class="form-control" placeholder="Youtube URL" wire:model='youtube_url'/>
                    @error('youtube_url')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">LinkedIn URL</label>
                    <input type="text" class="form-control" placeholder="LinkedIn URL" wire:model='linkedin_url'/>
                    @error('linkedin_url')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </form>

</div>
