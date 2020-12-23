<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function create_products(Request $request)
    {
		$name=$request->input('name');
		$mrp=$request->input('mrp');
		$description=$request->input('description');
		$user_id=$request->input('user_id');
		$images=$request->file('images');
		if(!empty($images)){
		$image_count=count($images);
		}
		
		if(!empty($name) && !empty($mrp) && !empty($description) && !empty($user_id) && !empty($images) && $image_count<=2){
			$file_name=[];
			for($i=0;$i<$image_count;$i++){
				$file = $images[$i];
                $fileName = time() . $file->getClientOriginalName();
                $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'products';
                $file->move($destinationPath, $fileName);
				
				$file_name[]=$fileName;
			}
			$images=implode($file_name,',');

			$data=[
			      'name'=>$name,
			      'mrp'=>$mrp,
			      'description'=>$description,
			      'userId'=>$user_id,
			      'images'=>$images,
			      ];
			Product::insert($data);
			$message='product created successfully';
			
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

    public function listproducts(Request $request)
    {
        $result = Product::getQuery()->get();
		$json = json_encode($result);
		print_r($json);
    }

    public function updateproducts(Request $request)
    {
        $product_id=$request->input('product_id');
        $name=$request->input('name');
		$mrp=$request->input('mrp');
		$description=$request->input('description');
		$user_id=$request->input('user_id');
		$images=$request->file('images');
		if(!empty($images)){
		$image_count=count($images);
		}
		
		if(!empty($product_id) && !empty($name) && !empty($mrp) && !empty($description) && !empty($user_id) && !empty($images) && $image_count<=2){
			$file_name=[];
			for($i=0;$i<$image_count;$i++){
				$file = $images[$i];
                $fileName = time() . $file->getClientOriginalName();
                $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'products';
                $file->move($destinationPath, $fileName);
				
				$file_name[]=$fileName;
			}
			$images=implode($file_name,',');

			$data=[
			      'name'=>$name,
			      'mrp'=>$mrp,
			      'description'=>$description,
			      'userId'=>$user_id,
			      'images'=>$images,
			      ];
			Product::where('id', $product_id)->update($data);
			$message='product updated successfully';
			
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
    
    public function deleteproducts(Request $request)
    {
		$product_id=$request->input('product_id');
		if(!empty($product_id)){
       Product::where('id', $product_id)->delete();
	   $message='product deleted successfully';
	   }else{
			$message='parameter missing';
		}
		$result=[
		        'message'=> $message,
		        ];
		$json = json_encode($result);
		print_r($json);
    }
}
