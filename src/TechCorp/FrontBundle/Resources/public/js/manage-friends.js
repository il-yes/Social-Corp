var manageFriend = function(friendId, action){
	alert (action +''+ friendId);
}
$('.add-friend').click(function(){
	var friendId = $(this).data('user-id');
	manageFriend(friendId, 'add');
});

$('.remove-friend').click(function(){
	var friendId = $(this).data('user-id');
	manageFriend(friendId, 'remove');
});