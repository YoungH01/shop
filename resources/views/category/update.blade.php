@extends('layouts.app');
@section('content')
{{-- {{dd($category)}} --}}
<div class="card">
    <div class="card-body">
       <h4 class="card-title">Cập nhật tên danh mục sản phẩm</h4>
       <form  method="POST" action="{{ route('category.update.implement', $category) }}" >
        @csrf
        <div class="form-group">
            <label for="cname">Category</label>
            <input type="text" class="form-control" name="name" minlength="2" value="{{ old('name',$category) }}" placeholder="nhập tên danh mục" />
            @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
         </div>
         <input class="btn btn-primary" type="submit" value="Cập nhật">
       </form>
    </div>
 </div>
@endsection