<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthorChangePasswordForm extends Component
{
    public $current_password, $new_password, $confirm_new_password;

    public function changePassword() {
        $this->validate([
            'current_password' => [
                'required', function($attribute, $value, $fail) {
                    if(!Hash::check($value, User::find(auth('web')->id())->password)) {
                        return $fail(__('The current password is incorrect'));
                    }
                },
            ],
            'new_password' => 'required|min:5',
            'confirm_new_password' => 'same:new_password'
        ],[
            'current_password.required' => 'Enter Current Password',
            'new_password.required' => 'Enter New Password',
            'confirm_new_password.same' => 'The Confirm Password must be equal to the New Password'
        ]);

        $query = User::find(auth('web')->id())->update([
            'password' => Hash::make($this->new_password)
        ]);

        if ($query) {
            session()->flash('message', 'Success, Password is Updated!');
        } else {
            session()->flash('error', 'Failed, Error in password update process!');
        }
    }

    public function render()
    {
        return view('livewire.author-change-password-form');
    }
}
