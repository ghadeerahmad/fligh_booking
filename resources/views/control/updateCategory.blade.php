@extends('layouts.control')
@section('title','تعديل تصنيف')
@section('css')

<script type='text/javascript'>
    function preview_image(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('image');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
@section('content')
<div class="form-box col-md-10">
    <h3 class="text-center">تعديل تصنيف</h3>
    <form method="POST" action="{{url('/control/updateCategory',$cate->id)}}" enctype="multipart/form-data">
    @csrf
    @error('error')
    <div class="alert alert-danger">{{$message}}</div>
    @endif
    @if(session()->has('success'))
    <div class="alert alert-success">{{session()->get('success')}}</div>
    @endif
    <div class="row">
        <div class="col-md-4">
            <img src="@if($cate->image != null) {{asset('storage/'.$cate->image)}} @else{{asset('assets/img/placeholder.png')}}@endif" width="100%" id="image">
            <input type="file" name="image" onchange="preview_image(event)">
        </div>
        <div class="col-md-8">
        <div class="form-group">
        <label class="control-label">الاسم بالعربي</label>
        <input type="text" name="ar_name" class="form-control" value="{{$cate->ar_name}}">
        @error('ar_name')
        <p style="color: red;">{{$message}}</p>
        @endif
    </div>
    <div class="form-group">
        <label class="control-label">الاسم بالانجليزية</label>
        <input type="text" name="en_name" class="form-control" value="{{$cate->en_name}}">
        @error('en_name')
        <p style="color: red;">{{$message}}</p>
        @endif
    </div>
        </div>
    </div>
    <div class="form-group text-center">
        <button type="submit" class="btn btn-primary">حفظ</button>
    </div>
    </form>
</div>
@endsection