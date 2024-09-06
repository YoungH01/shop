@extends('layouts.app');
@section('content')
    <div class="d-flex justify-content-end">
        <div class="header-right d-flex flex-end flex-wrap mt-2 mt-sm-0">
            <div class="d-flex align-items-center">
                <a href="#">
                <p class="m-0 pr-3">Product</p>
                </a>
                <a class="pl-3 mr-4" href="#">
                <p class="m-0">ADE-00234</p>
                </a>
            </div>
           <a href="{{route('product.add.view')}}">
                <button type="button" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text">
                    <i class="mdi mdi-plus-circle"></i>
                    Add Prodcut 
                </button>
           </a>
        </div>
    </div>
    <div class="row mt-5">
        <table class="table">
            <thead>
                <tr class="text-center">
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Mô tả</th>
                    <th>Số lượng</th>
                    <th>Giá mới</th>
                    <th>Hình ảnh chính</th>
                    <th>Tuỳ chỉnh</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr class="text-center">
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->category }}</td>
                        <td style="max-width: 100px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $product->descriptions }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->new_price }}</td>
                        <td>
                            <img src="{{ asset($product->productImage->first()->img) }}" alt="{{ $product->title }}" style="width: 50px">
                        </td>
                        <td>
                            <a href="{{route('product.update.view',$product->id)}}" class="btn btn-outline-warning" type="submit">Chỉnh sửa</a>
                            <form action="{{ route('product.remove', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button class="btn btn-outline-danger" style="width:100px" type="submit" onclick="return confirm('Are you sure you want to delete this product?')">Xoá</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
       
    </div>

@endsection