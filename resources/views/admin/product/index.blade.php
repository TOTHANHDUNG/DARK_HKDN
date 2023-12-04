@extends('admin.theme.layout')
@section('content')
<div id="content">
    @if(Session::has('message'))
    <div class="alert alert-success">
      {{ Session::get('message') }}
    </div>
    @endif
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="{{ url(Request::route()->getPrefix()) }}" class="btn btn-primary">Quản lý</a>
        <a href="{{route('product.create')}}" class="btn btn-success">Thêm mới</a>
    </div>
    <form action="{{route('product.index')}}" method="GET">
      @csrf
      <label>Tìm kiếm</label>
      <input type="text" value="{{@$filters['keyword']}}" name="keyword">
      <label for="idcat">Category:</label>
      <select name="idcat" class="form-control" class="col-sm-3 col-md-6 col-lg-4">
          <option value=''>---Vui lòng chọn danh mục sản phẩm---</option>>
          @foreach ($categories as $key =>$cat)
            <option value="{{$cat->id}}" {{!empty($filters['idcat']) && $filters['idcat'] == $cat->id ? "selected" : ""}}>{{($key+1).'. '.$cat->name}}</option>
          @endforeach
      </select>
      <button type="submit"  class="btn btn-info"><i class="fa fa-search"></i></button>
      </td>
      </form>
</div>
        <table class="table table-bordered">
              <thead>
                <th>STT</th>
                <th>Name</th>
                <th>Danh Mục</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Image</th>
                <th>Edit</th>
                <th>Delete</th>
              </thead>
              <tbody>
               
                @foreach($products  as $key => $product)
               
                  <tr>
                    <td>{{$key+1}} </td>

                    <td>{{$product->name}} </td>
                    <td>{{$product->idcat}} </td>
                    <td>{{$product->price}} </td>
                    <td>{{$product->discount}} </td>
                    <td><img src="{{asset('images/'. $product->image)}}" width="40" /></td>

                    <td><a href="{{route('product.edit', $product->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a></td>
                    <td>
                    <form action="{{route('product.destroy', $product->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                    </td>
                    </form>
                  </tr>
                @endforeach
              </tbody>

             
          </table>
@stop
