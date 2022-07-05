@extends('layouts.admin')
@section('title')
<title>Menu add</title>
@endsection
@section('content')

<div class="content-wrapper">
    @include('partials.content-header',['name' => 'Slider','key'=>'Add'  ])
    <div class="content">
      <div class="container-fluid">
        <div class="row">
        <form action="{{route('sliders.store')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="col-md-6">
            <div class="form-group">
                <label >Tên slider</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                placeholder="Nhâp tên "
                
                >
                @error('name')
                <div class="alert alart-danger">{{$message}}</div>
                @enderror()
            </div>

            <div class="form-group">
                <label >Mô tả slider</label>
                <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" 
                placeholder="Nhâp mô tả"
                
                >
                @error('description')
                <div class="alert alart-danger">{{$message}}</div>

                @enderror()
            </div>

            <div class="form-group">
                <label >Ảnh slider</label>
                <input type="file" name="image_path" class="form-control-file @error('image_path') is-invalid @enderror">
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