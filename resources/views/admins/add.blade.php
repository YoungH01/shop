@extends('layouts.app');
@section('content')
<div class="card">
    <div class="card-body">
       <h4 class="card-title">Thêm admin</h4>
       <form class="forms-sample" method="POST" action="{{route('admins.add.implement')}}">
         @csrf
          <div class="form-group">
             <label for="exampleInputName1">Tên</label>
             <input value="{{ old('name') }}" type="text" name="name" class="form-control" id="exampleInputName1" placeholder="Tên">
             @if ($errors->has('name'))
               <span class="text-danger">{{ $errors->first('name') }}</span>
             @endif
          </div>
          <div class="form-group">
             <label for="exampleInputEmail3">Email</label>
             <input value="{{ old('email') }}" type="text" name="email" class="form-control" id="exampleInputEmail3" placeholder="Email">
             @if ($errors->has('email'))
               <span class="text-danger">{{ $errors->first('email') }}</span>
             @endif
          </div>
          <div class="form-group">
            <label for="phone">Số điện thoại</label>
            <input value="{{ old('phone') }}" type="text" name="phone" class="form-control" id="phone" placeholder="Số điện thoại">
            @if ($errors->has('phone'))
              <span class="text-danger">{{ $errors->first('phone') }}</span>
            @endif
         </div>
          <div class="form-group">
            <label for="exampleInputEmail3">Địa chỉ</label>
            <input value="{{ old('address') }}" type="text" name="address" class="form-control" id="exampleInputEmail3" placeholder="Địa chỉ">
            @if($errors->has('address'))
               <span class="text-danger">{{ $errors->first('address') }}</span>
            @endif
         </div>
          <div class="form-group">
             <label for="exampleInputPassword4">Mật khẩu</label>
             <input value="{{ old('password') }}" type="password" name="password" class="form-control" id="exampleInputPassword4" placeholder="Mật khẩu">
             @if ($errors->has('password'))
               <span class="text-danger">{{ $errors->first('password') }}</span>
             @endif
          </div>
          <div class="form-group">
            <label for="exampleInputPassword5">Xác nhận mật khẩu</label>
            <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword5" placeholder="Mật khẩu">
            @if ($errors->has('password_confirmation'))
               <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
             @endif
         </div>
          <button type="submit" class="btn btn-primary me-2">Thêm admin</button>
       </form>
    </div>
 </div>
@endsection
