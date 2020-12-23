<?php

namespace App\Http\Controllers;
use App\Models\Business;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function create_business(Request $request) 
    { 
		$name=$request->input('name');
		$email=$request->input('email');
		$registrationNo=$request->input('registrationNo');
				
		if(!empty($name) && !empty($email) && !empty($registrationNo)){
			
			$data=[
			      'name'=>$name,
			      'email'=>$email,
			      'registrationNo'=>$registrationNo,
			      
			      ];
			Business::insert($data);
			$message='business created successfully';
			
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

    public function listbusiness(Request $request)
    {
        $result = Business::getQuery()->get();
		$json = json_encode($result);
		print_r($json);
    }
}
