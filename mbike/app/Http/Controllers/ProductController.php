<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Components\Recusive;
use App\Models\Comment;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Models\Tag;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\Paginator;

class ProductController extends Controller
{
    use StorageImageTrait;
    private $product;
    public function __construct(Product $product)
    {
      $this->product=$product;
    }
    public function boot()
{
    
    Paginator::useBootstrap();
}
    public function index()
    {
        $products = Product::latest()->paginate(5);
        return view('admin.product.index',compact('products'));
    }
    public function create()
    {
        $htmlOption = $this->getCategory($parentId = '');
        return view('admin.product.add',compact('htmlOption'));
    }
    public function getCategory($parentId)
    {
        $data = Category::all();
        $recusive = new Recusive($data); 
        $htmlOption = $recusive->categoryRecusive($parentId);
        return $htmlOption;
    }
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $dataProductCreate = [
                'name'=>$request->name,
                'price' =>$request->price,
                'content'=>$request->content,
               
                'category_id'=>$request->category_id,
            ];
            $dataUploadFeatureImage = $this->storageTraiUpload($request,'feature_image_path','product');
            if(!empty($dataUploadFeatureImage)){
                $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            $product = Product::create($dataProductCreate);
            //insert data to product_image
            if($request->hasFile('image_path')){
                foreach($request->image_path as $fileItem){
                    $dataProductImageDetail = $this->storageTraiUploadMutiple($fileItem,'product');
                    $product->images()->create([
                        'product_id'=>$product->id,
                        'image_path'=>$dataProductImageDetail['file_path'],
                        'image_name'=>$dataProductImageDetail['file_name'],
                    ]);
                }
            }
            //insert tags for product
            // if(!empty($request->tags)){
            //     foreach($request->tags as $tagItem){
            //         $tagInstance = Tag::firstOrCreate([
            //             'name'=>$tagItem,
            //         ]);
            //         $tagIds[] = $tagInstance->id;
            //     }
            // }
            // $product->tags()->attach($tagIds);
            
            DB::commit();
        return redirect()->route('products.index');
        } catch(\Exception $excpt){
            DB::rollBack();
            Log::error('Message:' . $excpt->getMessage(). 'Line:' . $excpt->getLine());
        }
        
    }
    public function edit($id)
    {
        $product = Product::find($id);
        $htmlOption = $this->getCategory($product->category_id);
        return view('admin.product.edit',compact('product','htmlOption'));
    }
    public function update($id,Request $request)
    {
        try{
            DB::beginTransaction();
            $dataProductUpdate = [
                'name'=>$request->name,
                'price' =>$request->price,
                'content'=>$request->content,
               
                'category_id'=>$request->category_id,
            ];
            $dataUploadFeatureImage = $this->storageTraiUpload($request,'feature_image_path','product');
            if(!empty($dataUploadFeatureImage)){
                $dataProductUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductUpdate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            Product::find($id)->update($dataProductUpdate);
            $product = Product::find($id);
            //insert data to product_image
            if($request->hasFile('image_path')){
                ProductImage::where('product_id',$id)->delete();
                foreach($request->image_path as $fileItem){
                    $dataProductImageDetail = $this->storageTraiUploadMutiple($fileItem,'product');
                    $product->images()->create([
                        'image_path'=>$dataProductImageDetail['file_path'],
                        'image_name'=>$dataProductImageDetail['file_name'],
                    ]);
                }
            }
            //insert tags for product
            // if(!empty($request->tags)){
            //     foreach($request->tags as $tagItem){
            //         $tagInstance = Tag::firstOrCreate([
            //             'name'=>$tagItem,
            //         ]);
            //         $tagIds[] = $tagInstance->id;
            //     }
            // }
            
            // $product->tags()->sync($tagIds);
            DB::commit();
            return redirect()->route('products.index');
        } catch(\Exception $excpt){
            DB::rollBack();
            Log::error('Message:' . $excpt->getMessage(). 'Line--' . $excpt->getLine());
        }
    }
    public function delete($id)
    {
        $this->product->find($id)->delete($id);
        return redirect()->route('products.index');
    }
    public function load_comment(Request $request){
       $product_id = $request->product_id;     
       $comment = Comment::where('comment_product_id',$product_id)->get();
       $put = '';
       foreach($comment as $key=>$com){
        $put.='<div class="row style_comment">
        <div class="col-md-1">
          <img width="80%" src="'.url('image/users.png').'">     
          </div>
       <div class="col-md-10">
          <p style="color:green;">'.$com->comment_name.'</p>
         <p>'.$com->comment.' </p>
         </div>
            </div>
           ';
       }
       echo $put;
    }
    public function send_comment(Request $request){
        $product_id = $request->product_id;     
        $comment_name = $request->comment_name;
        $comment = $request->comment;
        $comment_insert = new Comment();
        $comment_insert->comment = $comment;
        $comment_insert->comment_name = $comment_name;
        $comment_insert->comment_date = 15;   
        $comment_insert->comment_product_id = $product_id;
        $comment_insert->save();
      
    }
}
