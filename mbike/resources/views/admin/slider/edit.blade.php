@extends('layouts.admin')
@section('title')
<title>Menu add</title>
@endsection
@section('content')

<div class="content-wrapper">
    @include('partials.content-header',['name' => 'Slider','key'=>'Edit'  ])
    <div class="content">
      <div class="container-fluid">
        <div class="row">
        <form action="{{route('sliders.update',['id'=>$slider->id])}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="col-md-6">
            <div class="form-group">
                <label >Tên slider</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                placeholder="Nhâp tên "
                value="{{$slider->name}}"
                >
                @error('name')
                <div class="alert alart-danger">{{$message}}</div>
                @enderror()
            </div>

            <div class="form-group">
                <label >Mô tả slider</label>
                <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" 
                placeholder="Nhâp mô tả"
                value="{{$slider->description}}"
                >
                @error('description')
                <div class="alert alart-danger">{{$message}}</div>

                @enderror()
            </div>

            <div class="form-group">
                <label >Ảnh slider</label>
                <input type="file" name="image_path" class="form-control-file @error('image_path') is-invalid @enderror">
                <div class="col-md-4">
                <div class="row">
                <img src="{{$slider->image_path}}" alt="" srcset="">

                </div>

                </div>
                @error('image_path')
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