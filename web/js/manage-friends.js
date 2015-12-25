var manageFriend = function(friendId, route){
	var url = Routing.generate(route, { 'friendId' : friendId });
	return $.post(url);
}
$('.add-friend').click(function(){
	var friendId = $(this).data('user-id');
	manageFriend(friendId, 'tech_corp_front_user_add_friend');
	$(this).addClass('disabled');
});

$('.remove-friend').click(function(){
	var friendId = $(this).data('user-id');
	manageFriend(friendId, 'tech_corp_front_user_remove_friend');
	$(this).addClass('disabled');
});