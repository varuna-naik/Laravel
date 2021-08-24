<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users_new;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    
    public function index(Request $request,Users_new  $users)
    {
        $user = $users->getAllUsers($request);
        return json_encode($user);  
        // return json_encode($request->page); 
    }

    public function getUserById(Request $request){
        $user = Users_new::find($request->id);
        return json_encode($user);
    }
    
    public function search(Request $request,Users_new  $users)
    {
        $user = $users->getUser($request);
        if(sizeof($user)==0){
            return response()->json(['data'=>"No records found",'type'=> true]);
        }
        else{
            return response()->json(['data'=>$user,'type'=> false]);
        }
    }


    public function store(Request $request)
    {
        // $user = new Users_new([
        //     'firstname' => $request->input('firstname'),
        //     'lastname' => $request->input('lastname'),
        //     'gender' => $request->input('gender'),
        //     'birthday' => $request->input('birthday'),
        //     'email' => $request->input('email'),
        //     'contact' => $request->input('contact'),
        //     'address' => $request->input('address'),
        // ]);

        //validations
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email'=>'required|email',
            'contact'=>'required|max:10|min:10',
            'password' => 'required|min:6',
            'confirmPassword' => 'required_with:password|same:password|min:6'

        ],
        $messages = [
            
        ]);

        if ($validator->fails()) {

            return response()->json(['result' => $validator->messages(),'status' => 'error']);
        }
        else{
            $user=new Users_new();
            $user->firstname=$request->firstname;
            $user->lastname=$request->lastname;
            $user->email=$request->email;
            $user->address=$request->address;
            $user->contact=$request->contact;
            $user->gender=$request->gender;
            $user->birthday=$request->birthday;
            $user->password=Hash::make($request->password);
            
            $user->save();

            return response()->json('User created successfully!');
            // return $this->success([
            //     'token' => $user->createToken('API Token')->plainTextToken
            // ]);
        }

        
    }

    public function update(Request $request)
    {
        $user=Users_new::find($request->id);
        
        $user->update($request->all());
        // $user = Users_new::update($request->all());
        // $user->save();
        return response()->json($request);
    }

    public function destroy(Request $request)
    {   
        $user = Users_new::find($request->id);
        $user->delete();
        return json_encode('User deleted successfully!');
    }
}
?>