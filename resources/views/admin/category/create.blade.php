@extends('admin.theme.layout')
@section('content')
<form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
     <label for="name">Name:</label>
     <input type="text" class="form-control" name="name">
   </div>
   {{-- <div class="form-group">
     <label for="image">Image:</label>
     <input type="file" class="form-control"name="image">
   </div> --}}
  {{-- <div class="form-group">
    <label for="discount">Description:</label>
    <input type="text" class="form-control"name="description">
  </div> --}}
  {{-- <div class="form-group">
    <label for="content">Content:</label>
    <textarea class="form-control" id="contents" name="content"></textarea>
    <script type="text/javascript">
        var editor = CKEDITOR.replace('contents',{
            language:'vi',
            filebrowserImageBrowseUrl: '../../editor/ckfinder/ckfinder.html?Type=Images',
            filebrowserFlashBrowseUrl: '../../editor/ckfinder/ckfinder.html?Type=Flash',
            filebrowserImageUploadUrl: '../../editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl: '../../editor/public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
        });
    </script>
  </div> --}}
   <button type="submit" name="btn_addcategory"class="btn btn-primary">Thực Hiện</button>
 </form>
 </div>
 @stop
