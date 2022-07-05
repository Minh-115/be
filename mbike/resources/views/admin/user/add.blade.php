@extends('layouts.admin')
@section('title')
<title>Menu add</title>
@endsection
@section('content')

<div class="content-wrapper">
    @include('partials.content-header',['name' => 'User','key'=>'Add'])
    <div class="content">
      <div class="container-fluid">
        <div class="row">
        <form action="{{route('users.store')}}" method="POST">
          @csrf
          <div class="col-md-6">
          <div class="form-group">
                <label >Tên nhân viên </label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                placeholder="Nhâp tên"              
                >
                @error('name')
                <div class="alert alart-danger">{{$message}}</div>
                @enderror()
            </div>

            <div class="form-group">
                <label >Email </label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                placeholder="Nhâp email"              
                >
                @error('email')
                <div class="alert alart-danger">{{$message}}</div>
                @enderror()
            </div>

            <div class="form-group">
                <label >Mật khẩu </label>
                <input type="text" name="password" class="form-control @error('password') is-invalid @enderror" 
                placeholder="Nhâp mật khẩu"              
                >
                @error('password')
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