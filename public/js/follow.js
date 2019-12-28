$("#follow").click(function(){
	const followedUserID = $(this).attr("followedUserID");
	$.post("controllers/profile.controller.php",{
	"action":"follow",
	"FollowedUserID":followedUserID
	}).done(function(data){

	});
});

$("#unfollow").click(function(){
	const followedUserID = $(this).attr("followedUserID");
	$.post("controllers/profile.controller.php",{
		"action":"unfollow",
		"UnfollowedUserID":followedUserID
	}).done(function(data){

	});
});