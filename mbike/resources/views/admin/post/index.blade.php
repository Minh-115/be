@extends('layouts.admin')
@section('title')
<title>Trang chu</title>
@endsection
@section('content')

@section('css')
<link rel="stylesheet" href="{{asset('admins/post/index/index.css')}}">
@endsection


<div class="content-wrapper">
@include('partials.content-header',['name' => 'Post','key'=>'List'])
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <a href="{{route('posts.create')}}" class="btn btn-success float-right m-2">Add</a>
          </div>
          <div class="col-md-12">
          <table class="table" style="position:absolute">
            <thead>
              <tr>
                <th scope="col-md-1">Id</th>
                <th scope="col-md-3">Tên bài viết</th>
                <th scope="col-md-3">Nội dung tóm tắt</th>
                <th scope="col-md-2">Hình ảnh</th>
                <th scope="col-md-3">Action</th>

              </tr>
            </thead>
            <tbody>
           @foreach($posts as $post)
              <tr>
              <td>{{$post->post_id}}</td>            
                <td>{{$post->post_title}}</td>
                <td>{{$post->post_desc}}</td>
                <td> <img class="image_slider_150_100" src="{{$post->image_path}}" alt=""></td>

                <td>
                  <a href="{{route('posts.edit',['id'=>$post->post_id])}}" class="btn btn-success">edit</a>
                  <a href="{{route('posts.delete',['id'=>$post->post_id])}}" class="btn btn-danger">delete</a>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
          </div>
          <div class="col-md-12">
          {{$posts->links('pagination::bootstrap-4')}}
          </div>

          
          
        
        </div>
      </div>
    </div>
  </div>
  @endsection