<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function create_users(Request $request)
    {
		$name=$request->input('name');
		$email=$request->input('email');
		$bio=$request->input('bio');
		$profile=$request->file('profile');
		
		
		if(!empty($name) && !empty($email) && !empty($bio) && !empty($profile)){
			
			$user_exist = User::where('email',$email)->getQuery()->get();
			$user = $user_exist->count();
			
			if($user==0){
				$file = $profile;
                $fileName = time() . $file->getClientOriginalName();
                $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'profile';
                $file->move($destinationPath, $fileName);
					
			$data=[
			      'name'=>$name,
			      'email'=>$email,
			      'bio'=>$bio,
			      'profile'=>$fileName,
			      ];
			User::insert($data);
			$message='user created successfully';
			}else{
				$data=[];
			    $message='email already exist';
			}
		}else{
			$data=[];
			$message='parameter missing';
		}
		$result=[
		        'message'=> $message,
		        'data'=> $data,
		        ];
		$json = json_encode($result);
		print_r($json);
    }

    public function listusers(Request $request)
    {
        $result = User::getQuery()->get();
		$json = json_encode($result);
		print_r($json);
    }

    public function select_business(Request $request)
    {
        $user_id=$request->input('user_id');
        $businessId=$request->input('businessId');
		
		if(!empty($user_id) && !empty($businessId)){
			

			$data=[
			      'businessId'=>$businessId,
			      
			      ];
			User::where('id', $user_id)->update($data);
			$message='business updated successfully';
			
		}else{
			$data=[];
			$message='parameter missing';
		}
		$result=[
		        'message'=> $message,
		        'data'=> $data,
		        ];
		$json = json_encode($result);
		print_r($json);
    }

}
