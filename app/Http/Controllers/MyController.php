<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use DB;
use Auth;
use Str;
use Illuminate\Support\Facades\Hash;

class MyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function insert(Request $request){   //Eloquent method with Post Model

        $validated = $request->validate([       //laravel built-in validation process
            'name' => 'required|max:50',
            'email' => 'required',
            'age' => 'required|min:1|max:2',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            ]);
            
            if($validated)
            {
                
            $data = new Post;       //add to db code
            $data->Name = $request->name;
            $data->Email = $request->email;
            $data->Age = $request->age;
            $data->Description = $request->description;
 
            $imageFile = $request->image;                          //Get image file
            if($imageFile){
                $imageName = Str::random(20);
                $ext = Str::lower($imageFile->extension());        // getting image extension, str::lower doesnt seem to be working
                $image_full_name = $imageName.'.'.$ext;
                $upload_path = 'images/';                          //stores image into /public/images/file.jpg
                $image_url = $upload_path.$image_full_name;
                $success = $imageFile->move($upload_path, $image_full_name);
                
                if($success){
                    $data->Image = $image_url;
                    $data->save();
                }
              
                $notification = array(      // Toastr code
                    'message' => 'Data added successfully!',
                    'alert-type' => 'success'
                );
               
                return Redirect()->route('main')->with($notification);
                
            }
        } 
    }

    public function main(){ //Home page and view data
        $data = Post::all();
        return view('main')->with('show', $data);

    }
    public function dashboard(){
        return view('home');
    }

    public function view($id)
    { 
        try{
        $data = Post::where('id', $id)->first();
        return view('view', compact('data'));
        } catch (Throwable $e){
            report($e);
            return false;
        }
    }

    public function edit($id)
    { 
        $data = Post::where('id', $id)->first();
        return view('edit')->with('data', $data);
    }
    public function edit_success(Request $request, $id)
    { 
        $data = Post::findorfail($id);
        $data->Name = $request->name;
        $data->Email = $request->email;
        $data->Age = $request->age;
        $data->Description = $request->description;

        if($imageFile = $request->image){            //Get new image file
            
            $old_image = $data->Image;
            unlink($old_image);                     // delete old image if new image is selected
            
            $imageName = Str::random(20);
            $ext = Str::lower($imageFile->extension());        // getting image extension, str::lower doesnt seem to be working
            $image_full_name = $imageName.'.'.$ext;
            $upload_path = 'images/';                          //stores image into /public/images/file.jpg
            $image_url = $upload_path.$image_full_name;
            $success = $imageFile->move($upload_path, $image_full_name);
            
            if($success){
                $data->Image = $image_url;
                $data->save();
            }
            
        } 
        
        $data->save();

        $notification = array(      // Toastr code
            'message' => 'Data edited successfully!',
            'alert-type' => 'info'
        );

        return Redirect('/')->with($notification);
    }

    public function delete($id)
    { 
        $data = Post::findorfail($id);
        $image_path = $data->Image;
        unlink($image_path);
        $data->delete();

        $notification = array(      // Toastr code
            'message' => 'Data deleted successfully!',
            'alert-type' => 'error'
        );

        return Redirect()->back()->with($notification);
    }

    public function changePass()        //Change user Password Page
    {
        return view('changepass');
    }
    public function changePassSuccess(Request $request)        //Successfully Change user Password
    {
        $validated = $request->validate([       //laravel built-in validation process
            'newpass' => 'required|min:8|same:confirm_new_pass',
            ]);

        $getpassword = Auth::user()->password;
        $oldpassword = $request->oldpass;
        
        if(Hash::check($oldpassword, $getpassword))
        {

            $getuser = User::find(Auth::id());
            $getuser->password = Hash::make($request->newpass);
            $getuser->save();
            Auth::logout();
            return Redirect()->route('login');
        }
        else return redirect()->back();
    }
    
}
