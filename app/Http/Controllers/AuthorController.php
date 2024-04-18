<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class AuthorController extends Controller
{
    public function index(Request $request) {
        return view('back.pages.home');
    }

    public function logout() {
        Auth::guard('web')->logout();
        return redirect()->route('author.login');
    }

    public function resetForm(Request $request, $token = null) {
        $data = [
            'pageTitle' => 'Reset Password',
        ];

        return view('back.pages.auth.reset', $data)->with(['token'=>$token, 'email'=>$request->email]);
    }

    public function changeProfilePicture(Request $request) {
        $user = User::find(auth('web')->id());
        $path = 'back/dist/img/authors/';
        $file = $request->file('file'); // input field name for profile image upload-> authorprofileheader.blade.php
        $old_picture = $user->getAttributes()['picture'];
        $file_path = $path.$old_picture;
        $new_picture_name = 'AIMG'.$user->id.time().rand(1, 100000).".jpg";

        if($old_picture != null && File::exists(public_path($file_path))) {
            File::delete(public_path($file_path));
        }

        $upload = $file->move(public_path($path), $new_picture_name);
        // dd($upload);
        if ($upload) {
            $user->update([
                'picture' => $new_picture_name
            ]);
            return response()->json(["status" => 1, 'msg' => 'Your Profile Picture Has Been Updated Successfully!']);
        } else {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong']);
        }

    }

    public function changeBlogLogo(Request $request) {
        $settings = Setting::find(1);
        $logo_path = 'back/dist/img/logo-favicon/';
        $old_logo = $settings->getAttributes()['blog_logo'];
        $file = $request->file('blog_logo');
        $file_name = time()."_".rand(1, 100000)."_howzthat_logo.png";

        if($request->hasFile('blog_logo')){
            if($old_logo != null && File::exists(public_path($logo_path. $old_logo))){
                File::delete(public_path($logo_path.$old_logo));
            }

            $upload = $file->move(public_path($logo_path), $file_name);

            if ($upload) {
                $settings->update([
                    'blog_logo' => $file_name
                ]);
                return response()->json(["status" => 1, 'msg' => 'Blog Picture Has Been Updated Successfully!']);
            } else {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong']);
            }
        }
    }

    public function changeBlogFavicon(Request $request) {
        $settings = Setting::find(1);
        $fav_path = 'back/dist/img/logo-favicon/';
        $old_fav = $settings->getAttributes()['blog_favicon'];
        $file = $request->file('blog_favicon');
        $file_name = time()."_".rand(1, 100000)."_howzthat_fav.ico";

        if($request->hasFile('blog_favicon')){
            if($old_fav != null && File::exists(public_path($fav_path. $old_fav))){
                File::delete(public_path($fav_path.$old_fav));
            }

            $upload = $file->move(public_path($fav_path), $file_name);

            if ($upload) {
                $settings->update([
                    'blog_favicon' => $file_name
                ]);
                return response()->json(["status" => 1, 'msg' => 'Favicon Icon Has Been Updated Successfully!']);
            } else {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong']);
            }
        }
    }

    public function createPost(Request $request) {
        $request->validate([
            'post_title' => 'required|unique:posts,post_title',
            'post_content' => 'required',
            'post_category' => 'required|exists:sub_categories,id',
            'featured_image' => 'required|mimes:jpg,jpeg,png|max:1024'
        ]);

        if($request->hasFile('featured_image')) {
            $path = 'images/post_images/';
            $file = $request->file('featured_image');
            $filenam = $file->getClientOriginalName();
            $new_filename = time().'_'. $filenam;

            $upload = Storage::disk('public')->put($path.$new_filename, (string) file_get_contents($file));

            $post_thumbnail_path = $path.'thumbnails';
            if (!Storage::disk('public')->exists($post_thumbnail_path)) {
                Storage::disk('public')->makeDirectory($post_thumbnail_path, 0755, true, true);
            }

            Image::read(storage_path('app/public/'.$path.$new_filename))
                    ->resizeDown(200, 200)
                    ->save(storage_path('app/public/'.$path.'thumbnails/'.'thumb_'.$new_filename));

            Image::read(storage_path('app/public/'.$path.$new_filename))
                    ->resize(500, 350)
                    ->save(storage_path('app/public/'.$path.'thumbnails/'.'resized'.$new_filename));

            if ($upload) {
                $post = new Post();
                $post->author_id = auth()->id();
                $post->category_id = $request->post_category;
                $post->post_title = $request->post_title;
                $post->post_content = $request->post_content;
                $post->featured_img = $new_filename;
                $saved = $post->save();

                if ($saved) {
                    toastr()->success('Success, New Post Created!!!');
                } else {
                    return response()->json(["status" => 3, 'msg' => 'Error in post creation']);
                }
                
            } else {
                return response()->json(["status" => 3, 'msg' => 'Error in image upload']);
            }
            
        }
    }

}
