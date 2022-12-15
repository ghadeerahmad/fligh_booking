@extends('layouts.control')
@section('title','إضافة تصنيف')
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
    <h3 class="text-center">إضافة تصنيف</h3>
    <form method="POST" action="{{url('/control/addCategory')}}" enctype="multipart/form-data">
    @csrf
    @error('error')
    <div class="alert alert-danger" role="alert">{{$message}}</div>
    @endif
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">{{session()->get('success')}}</div>
    @endif
    <div class="row">
        <div class="col-md-4">
            <img src="{{asset('assets/img/placeholder.png')}}" width="100%" id="image">
            <input type="file" name="image" onchange="preview_image(event)">
        </div>
        <div class="col-md-8">
        <div class="form-group">
        <label class="control-label">الاسم بالعربي</label>
        <input type="text" name="ar_name" class="form-control">
        @error('ar_name')
        <p style="color: red;">{{$message}}</p>
        @endif
    </div>
    <div class="form-group">
        <label class="control-label">الاسم بالانجليزية</label>
        <input type="text" name="en_name" class="form-control">
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