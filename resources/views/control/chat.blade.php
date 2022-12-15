@extends('layouts.control')
@section('title','المحادثة')
@section('css')
<style>body {
  background-color: #3498db;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-rendering: optimizeLegibility;
}

.container {
  margin: 60px auto;
  background: #fff;
  padding: 0;
  border-radius: 7px;
}

.profile-image {
  width: 50px;
  height: 50px;
  border-radius: 40px;
}

.settings-tray {
  background: #eee;
  padding: 10px 15px;
  border-radius: 7px;
}
.settings-tray .no-gutters {
  padding: 0;
}
.settings-tray--right {
  float: right;
}
.settings-tray--right i {
  margin-top: 10px;
  font-size: 25px;
  color: grey;
  margin-left: 14px;
  transition: 0.3s;
}
.settings-tray--right i:hover {
  color: #74b9ff;
  cursor: pointer;
}

.search-box {
  background: #fafafa;
  padding: 10px 13px;
}
.search-box .input-wrapper {
  background: #fff;
  border-radius: 40px;
}
.search-box .input-wrapper i {
  color: grey;
  margin-left: 7px;
  vertical-align: middle;
}

input {
  border: none;
  border-radius: 30px;
  width: 100%;
}
input::placeholder {
  color: #e3e3e3;
  font-weight: 300;
  margin-left: 20px;
}
input:focus {
  outline: none;
}

.friend-drawer {
  padding: 10px 15px;
  display: flex;
  vertical-align: baseline;
  background: #fff;
  transition: 0.3s ease;
}
.friend-drawer--grey {
  background: #eee;
}
.friend-drawer .text {
  margin-right: 12px;
  width: 50%;
}
.friend-drawer .text h6 {
  margin-top: 6px;
  margin-bottom: 0;
}
.friend-drawer .text p {
  margin: 0;
}
.friend-drawer .time {
  color: grey;
}
.friend-drawer--onhover:hover {
  background: #74b9ff;
  cursor: pointer;
}
.friend-drawer--onhover:hover p,
.friend-drawer--onhover:hover h6,
.friend-drawer--onhover:hover .time {
  color: #fff !important;
}

hr {
  margin: 5px auto;
  width: 60%;
}

.chat-bubble {
  padding: 10px 14px;
  background: #eee;
  margin: 10px 30px;
  border-radius: 9px;
  position: relative;
  animation: fadeIn 1s ease-in;
}
.chat-bubble:after {
  content: "";
  position: absolute;
  top: 50%;
  width: 0;
  height: 0;
  border: 20px solid transparent;
  border-bottom: 0;
  margin-top: -10px;
}
.chat-bubble--left:after {
  left: 0;
  border-right-color: #eee;
  border-left: 0;
  margin-left: -20px;
}
.chat-bubble--right:after {
  right: 0;
  border-left-color: #74b9ff;
  border-right: 0;
  margin-right: -20px;
}

@keyframes fadeIn {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}
.offset-md-9 .chat-bubble {
  background: #74b9ff;
  color: #fff;
}

.chat-box-tray {
  background: #eee;
  display: flex;
  align-items: baseline;
  padding: 10px 15px;
  align-items: center;
  margin-top: 19px;
  bottom: 0;
}
.chat-box-tray input {
  margin: 0 10px;
  padding: 6px 2px;
}
.chat-box-tray i {
  color: grey;
  font-size: 30px;
  vertical-align: middle;
}
.chat-box-tray i:last-of-type {
  margin-left: 25px;
}
</style>

@endsection
@section('content')
<div class="container">
	<div class="row no-gutters">
	  <div class="col-md-4 border-right">
		
		<div class="search-box">
		  <div class="input-wrapper">
			<i class="material-icons">search</i>
			<input placeholder="Search here" type="text">
		  </div>
		</div>
        @foreach($chats as $chat)
		<div class="friend-drawer friend-drawer--onhover" onclick="getMessages({{$chat->id}})">
		  <img class="profile-image" src="@if($chat->sender->image != null) {{asset('storage/'.$chat->sender->image)}}@else {{asset('assets/img/placeholder.png')}}@endif" alt="">
		  <div class="text">
			<h6>{{$chat->sender->name}}</h6>
		  </div>
		  <span class="time text-muted small"><?php 
      echo date('M-d H:m',strtotime($chat->created_at));

      ?></span>
		</div>
		<hr>
        @endforeach
	  </div>
	  <div class="col-md-8" id="messages">
	  </div>
	</div>
  </div>
@endsection
@section('js')
<script>// Video tutorial/codealong here: https://youtu.be/fCpw5i_2IYU
@if(isset($chat_id))
$(document).ready(function(){
    getMessages({{$chat_id}});
});
@endif
function getMessages(id){
    $( '.chat-bubble' ).hide('slow').show('slow');
    var link = "{{url('/control/getChat')}}";
  $.get(link+'/'+id,function(data){
      $("#messages").html(data);
  });
  
}
// Video tutorial/codealong here: https://youtu.be/fCpw5i_2IYU
</script>
@endsection