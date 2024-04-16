<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class Authors extends Component
{
    public $name, $email, $username, $author_type, $direct_publisher;

    public function addAuthor() {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username|min:6|max:20',
            'author_type' => 'required',
            'direct_publisher' => 'required'
        ],
        [
            'author_type.required' => 'Select Author Type',
            'direct_publisher.required' => 'Specify Author Publication Access'
        ]);

        // rest of operation will be continue after completing email configurations
        // this step is not neccessary for the moment
    }

    public function render()
    {
        return view('livewire.authors', [
            'authors' => User::where('id', '!=', auth()->id())->get()
        ]);
    }
}
