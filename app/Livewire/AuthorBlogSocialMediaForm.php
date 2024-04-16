<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BlogSocialMedia;

class AuthorBlogSocialMediaForm extends Component
{
    public $blogSocialMedia;
    public $facebook_url, $instergram_url, $youtube_url, $linkedin_url;

    public function mount() {
        $this->blogSocialMedia = BlogSocialMedia::find(1);
        $this->facebook_url = $this->blogSocialMedia->blg_facebook;
        $this->instergram_url = $this->blogSocialMedia->blg_instergram;
        $this->youtube_url = $this->blogSocialMedia->blg_youtube;
        $this->linkedin_url = $this->blogSocialMedia->blg_linkedin;
    }

    public function UpdateBlogSocialMedia() {
        $this->validate([
            'facebook_url' => 'nullable|url',
            'instergram_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url'
        ]);

        $update = $this->blogSocialMedia->update([
            'blg_facebook' => $this->facebook_url,
            'blg_instergram' => $this->instergram_url,
            'blg_youtube' => $this->youtube_url,
            'blg_linkedin' => $this->linkedin_url,
        ]);

        if ($update) {
            session()->flash('message', 'Success, Social Media URL Updated');
        }
    }

    public function render()
    {
        return view('livewire.author-blog-social-media-form');
    }
}
