<div class="settings-tray">
  <div class="friend-drawer no-gutters friend-drawer--grey">
    <img class="profile-image" src="@if($chat->reciever->image != null) {{asset('storage/'.$chat->reciever->image)}}@else {{asset('assets/img/placeholder.png')}}@endif" alt="">

  </div>
</div>
<div class="chat-panel">
  <div id="msgs">
    @foreach($messages as $message)
    @if($message != '')
    <div class="row no-gutters">
      <div class="col-md-12">
        <div class="chat-bubble @if($message->user_id == auth()->user()->id){{'chat-bubble--right'}}@else{{'chat-bubble--left'}}@endif">
          {{$message->message}}
        </div>
      </div>
    </div>
    @endif
    @endforeach
  </div>
  <div class="row">
    <div class="col-12">
      <div class="chat-box-tray">
        <form method="POST" action="" id="send">
          <div class="row">
            <div class="col-md-10">
              <input type="text" placeholder="الرسالة..." name="message" id="message">
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-primary">إرسال</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $('#send').on('submit', function(e) {
    e.preventDefault();

    let message = $('#message').val();

    $.ajax({
      url: "{{url('/control/sendMessage',$chat->id)}}",
      type: "POST",
      data: {
        "_token": "{{ csrf_token() }}",
        message: message,
      },
      success: function(response) {
        document.getElementById("msgs").innerHTML += '<div class="row no-gutters"><div class="col-md-12"><div class="chat-bubble chat-bubble--right">' + response.message + '</div></div></div>';
        //$('#successMsg').show();
        console.log(response);
      },
      error: function(response) {
        $('#message').text(response.responseJSON.errors.message);
      },
    });
  });
</script>