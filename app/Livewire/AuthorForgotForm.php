<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthorForgotForm extends Component
{
    public $email;

    public function forgotHandler() {
        $this->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.required' => 'Email Address is required',
            'email.email' => 'Invalid Email Address',
            'email.exists' => 'Email Address is not registered'
        ]);

        $token = base64_encode(Str::random(64));
        DB::table('password_reset_tokens')->insert([
            'email' => $this->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        $user = User::where('email', $this->email)->first();
        $link = route('author.reset-form', ['token'=>$token, 'email'=>$this->email]);
        $body_message = "We recieved request to reset your password for <b>My Blog</b> account associate with
        ".$this->email.". <br> You can reset your password by clicking button below.";
        $body_message.= "<br>";
        $body_message.= '<a href="'.$link.'" target="_blank" style="color=#fff; border-color:#22bc66; border-style: solid;
        border-width:10px 180px; background-color:#22bc66; display:inline-block; text-decoration:none; border-radius:3px; 
        box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); -webkit-text-size-adjust:none; box-sizing: border-box;">Reset Password</a>';
        $body_message.= "<br>";
        $body_message.= "If you did not requested password reset, just ignore this email";

        $data = array(
            'name' => $user->name,
            'body_message' => $body_message,
        );

        Mail::send('forgot-email-template', $data, function($message) use ($user){
            $message->from('noreply@example.com', 'MyBlog');
            $message->to($user->email, $user->name)
                    ->subject('Reset Password');
        });

        $this->email = null;
        session()->flash('success', 'We have sent your password reset link');
    }

    public function render()
    {
        return view('livewire.author-forgot-form');
    }
}
