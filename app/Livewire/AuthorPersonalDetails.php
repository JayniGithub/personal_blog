<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class AuthorPersonalDetails extends Component
{
    public $author;
    public $name, $username, $email, $biography;

    public function mount() {
        $this->author = User::find(auth('web')->id());
        $this->name = $this->author->name;
        $this->username = $this->author->username;
        $this->email = $this->author->email;
        $this->biography = $this->author->biography;
    }

    public function UpdateAuthor() {
        $this->validate([
            'name' => 'required|string',
            'username' => 'required|unique:users,username,'.auth('web')->id()
        ]);

        User::where('id', auth('web')->id())->update([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'biography' => $this->biography
        ]);

        $this->dispatch('updateAuthorProfileHeader');
        $this->dispatch('updateTopHeader');

        session()->flash('message', 'Success, Author Personal Details Updated!');
    }

    public function render()
    {
        return view('livewire.author-personal-details');
    }
}
