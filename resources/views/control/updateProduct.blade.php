@extends('layouts.control')
@section('title','تعديل منتج')
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
    <h3 class="text-center">تعديل منتج</h3>
    <form method="POST" action="{{url('/control/updateProduct',$product->id)}}" enctype="multipart/form-data">
    @csrf
    @error('error')
    <div class="alert alert-danger" role="alert">{{$message}}</div>
    @endif
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">{{session()->get('success')}}</div>
    @endif
    <div class="row">
        <div class="col-md-4">
            <img src="@if($product->image != null){{asset('storage/'.$product->image)}}@else{{asset('assets/img/placeholder.png')}}@endif" width="100%" id="image">
            <input type="file" name="image" onchange="preview_image(event)">
        </div>
        <div class="col-md-8">
        <div class="form-group">
        <label class="control-label">الاسم</label>
        <input type="text" name="name" class="form-control" value="{{$product->name}}">
        @error('name')
        <p style="color: red;">{{$message}}</p>
        @endif
    </div>
    <div class="form-group">
        <label class="control-label">وصف المنتج</label>
        <textarea class="form-control" name="des" style="min-height: 200px;">{{$product->des}}</textarea>
        @error('des')
        <p style="color: red;">{{$message}}</p>
        @endif
    </div>
    <div class="form-group">
        <label class="control-label">السعر</label>
        <input type="text" name="price" class="form-control" value="{{$product->price}}">
        @error('price')
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