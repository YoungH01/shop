@extends('layouts.app');
@section('content')
<div class="container">
    <h1 class="mb-5">Thêm sản phẩm</h1>
    <form action="{{ route('product.add.implement') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Tên sản phẩm:</label>
                <input type="text" class="form-control" value="{{ old('name_product') }}" id="name" name="name_product" placeholder="tên của sản phẩm">
                @if ($errors->has('name_product'))
                    <span class="text-danger">{{ $errors->first('name_product') }}</span>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="inputCategory">Loại sản phẩm</label>
                <select class="form-control" name="category" id="inputCategory">
                    <option value="" disabled  {{ old('category') ? '' : 'selected'}}>Chọn loại sản phẩm</option>
                    @foreach ($category as $item)
                        <option value="{{ $item->name }}" {{ old('category') == $item->name ? 'selected' : ''}}>{{$item->name}}</option>
                    @endforeach
                </select>
                @if ($errors->has('category'))
                    <span class="text-danger">{{ $errors->first('category') }}</span>
                @endif
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputNewPrice">Giá mới của sản phẩm</label>
              <input type="number" name="new_price" value="{{ old('new_price') }}" class="form-control" id="inputNewPrice" placeholder="Giá sản phẩm">
                @if ($errors->has('new_price'))
                    <span class="text-danger">{{ $errors->first('new_price') }}</span>
                @endif
            </div>
            <div class="form-group col-md-6">
              <label for="inputOldPrice">Giá cũ của sản phẩm</label>
              <input type="number" name="old_price" value="{{ old('old_price') }}" class="form-control" id="inputOldPrice" placeholder="Giá sản phẩm">
              @if ($errors->has('old_price'))
                    <span class="text-danger">{{ $errors->first('old_price') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label for="descriptions">Mô tả sản phẩm</label>
            <textarea class="form-control" name="descriptions" id="descriptions" rows="4">{{ old('descriptions') }}</textarea>
            @if ($errors->has('descriptions'))
                <span class="text-danger">{{ $errors->first('descriptions') }}</span>
            @endif
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputQuantity">Size, màu và Số lượng sản phẩm</label>
                <input type="string" name="quantity" value="{{ old('quantity') }}" class="form-control" id="inputQuantity" placeholder="theo format (color,size,quantity)">
                  @if ($errors->has('quantity'))
                      <span class="text-danger">{{ $errors->first('quantity') }}</span>
                  @endif
            </div>
            <div class="form-group col-md-6">
                <label for="images">Hình ảnh sản phẩm:</label>
                <input type="file" class="form-control" id="images" name="images[]" multiple>
                @if ($errors->has('images.*'))
                    @foreach ($errors->get('images.*') as $error)
                        <span class="text-danger">{{ $error[0] }}</span>
                    @endforeach
                @endif
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
    </form>
</div>
@endsection