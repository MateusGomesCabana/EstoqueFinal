<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ApiController extends Controller{

	public function products(){
		$products = Product::with(['categories','images'])->get();
		return response()->json($products);
	}
	public function categories(){
		$categories = Category::get();
		return response()->json($categories);
	}

	//post--->acertar
	public function saveCategories(Request $request){
		$name = $request->input('name_image');
		$url = $request->input('url_image');
		$validator = Validator::make($request->all(), [
            'name' => 'required|min:10|max:255',
            'description' => 'required',
        ]);
		if(!$validator->fails()){
			$result = Category::create([
    			'name' => $name, 
    			'image' => $url
			]);
			if(empty($Category)){
				return response()->json($Category);
			}
		}
		return response()->json(["menssage"=>"Erro ao salvear categoria"],500);
	}

}