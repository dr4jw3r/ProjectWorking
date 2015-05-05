var ownVideo = document.getElementById('ownVideo');
var otherVideo = document.getElementById('otherVideo');

var WebRTC = new WebRTC();

WebRTC.connectToSocket('ws://langexchange.me:8080');

// Add event listener
document.addEventListener('socketEvent', function(socketEvent){
	switch(socketEvent.eventType)
	{
		case 'roomCreated':
			console.log('room created');
			var roomIdAjax = WebRTC.getRoomId();
	
			$.ajax({
				type: "POST",
				url: CONSTANTS.AJAX_URL + 'webrtc_ajax.php',
				data: {'function': 'save_room_id', 'room_id': roomIdAjax, 'alh': alh},
//				dataType: "json",
				success: function(data){
					console.log(data);
				},
				error: function(jqxhr, status, error){
					console.log(status);
					console.log(error);
					console.log(error.message);
				}
			});
		
			break;

		case 'p2pConnectionReady':
			console.log('p2pConnectionReady');
			break;

		case 'streamAdded':
			console.log('stream added');
			otherVideo.src = URL.createObjectURL(WebRTC.getOtherStream());
			break;
	}
});

//If room ID does not exist, create a room.
if(roomId == "null")
{
	var success = function(myStream)
	{
		ownVideo.src = URL.createObjectURL(myStream);
		WebRTC.createRoom();
	}
	WebRTC.getMedia({audio: true, video: true}, success);
}
//Else if room ID exists, join the room.
else
{
	var success = function(myStream)
	{
		ownVideo.src = URL.createObjectURL(myStream);
		WebRTC.joinRoom(roomId);
	}
	WebRTC.getMedia({audio: true, video: true}, success);
}
