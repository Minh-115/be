<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Components\Recusive;
use App\Traits\StorageImageTrait;
class PostController extends Controller
{
  use StorageImageTrait;

    private $post;
    public function __construct(Post $post)
    {
      $this->post=$post;
    }
    public function index()
    {
        $posts = Post::latest()->paginate(5);
        return view('admin.post.index',compact('posts'));
    }
    public function getPost($parentId)
    {
        $data = Post::all();
        $recusive = new Recusive($data); 
        $htmlOption = $recusive->categoryRecusive($parentId);
        return $htmlOption;
    }
    public function create(){
        return view('admin.post.add');
        }
    public function store(Request $request)
    {
       $dataInsert=[
            'post_title'=>$request->post_title,
            'post_content'=>$request->post_content,
            'post_desc'=>$request->post_desc
          
       ];
       $dataImagePost= $this->storageTraiUpload($request,'image_path','post');
     
       if(!empty($dataImagePost)){
       
        $dataInsert['image_path']=$dataImagePost['file_path'];
        }
                        $this->post->create($dataInsert);
                      
                        return redirect()->route('posts.index');
        }  
       
    
    
    
   
    public function edit($id){
      
        $posts= $this->post->find($id);      
        return view('admin.post.edit',compact('posts'));
      }  
    public function update($id,Request $request)
    {
        Post::find($id)->update([
            'post_title'=>$request->post_title,
            'post_content'=>$request->post_content,
            'post_desc'=>$request->post_desc

        ]);
        return redirect()->route('posts.index');
    }
    public function delete($id)
    {
        Post::find($id)->delete();
        return redirect()->route('posts.index');
    }
    // front-end
    public function list_post(){
        $sliders = Slider::latest()->get();
        $categorys = Category::where('parent_id',0)->get();
        $posts = Post::latest()->get();
          return view('post.list',compact('sliders', 'categorys','posts'));
    }
    public function post_detail($id){
        $posts = Post::find($id);  
        $sliders = Slider::latest()->get();
        $categorys = Category::where('parent_id',0)->get();          
         return view('post.post_detail',compact('posts','sliders','categorys'));
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
