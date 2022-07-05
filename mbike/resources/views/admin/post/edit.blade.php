@extends('layouts.admin')
@section('title')
<title>Post edit</title>
@endsection
@section('content')
<script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
<div class="content-wrapper">
    @include('partials.content-header',['name' => 'Post','key'=>'edit'  ])
    <div class="content">
      <div class="container-fluid">
        <div class="row">
        <form action="{{route('posts.update',['id'=>$posts->post_id])}}" method="POST">
          @csrf
          <div class="col-md-6">
            <div class="form-group">
                <label >Tên danh mục</label>
                <input type="text" name="post_title" class="form-control" 
                value="{{$posts->post_title}}" >
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <label >Nội dung bài viết</label>
                <div class="row">
                <textarea style="margin-left: 10px;" name="post_content" id="post_content1" cols="50" rows="3" 
                value=""  placeholder="Nhâp nội dung bài viết"> {{$posts->post_content}}            
               </textarea>
               <script>
           CKEDITOR.replace('post_content1')
       </script>
              </div>
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <label >Nội dung tóm tắt</label>
                <input type="text" name="post_desc" class="form-control" value="{{$posts->post_desc}}"
                placeholder="Nhâp nội dung tóm tắt cho bài viết">
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <label >Hình ảnh bài viết</label>
                <input type="file" name="image_path" class="form-control-file @error('post_image') is-invalid @enderror">
                @error('post_image')
                <div class="alert alart-danger">{{$message}}</div>
                @enderror()
            </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
      </div>
    </div>
  </div>
  @endsection