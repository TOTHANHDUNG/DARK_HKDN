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
        <a href="{{route('category.create')}}" class="btn btn-success">Thêm mới</a>
    </div>
</div>
<table  class="table table-bordered" style="margin-top:20px;">
  <thead>
    <th>ID</th>
    <th>Name</th>
    <th>Edit</th>
    <th>Delete</th>
  </thead>
  <tbody>
    @foreach($cate  as $key => $category)
      <tr>
        <td>{{$category->id}}</td>
        <td>{{$category->name}} </td>
        <td><a href="{{route('category.edit', $category->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a></td>
        <td>
        <form action="{{route('category.destroy', $category->id)}}" method="POST">
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
