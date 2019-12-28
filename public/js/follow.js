$("#follow").click(function(){
	const followedUserID = $(this).attr("followedUserID");
	$.post("controllers/profile.controller.php",{
	"action":"follow",
	"FollowedUserID":followedUserID
	}).done(function(data){
		$("#follow").hide();
		$("#unfollow").show();
		updateNumberOfFollowers(Number($("#numberOfFollowers").attr("number")) + 1);
	});
});

$("#unfollow").click(function(){
	const followedUserID = $(this).attr("followedUserID");
	$.post("controllers/profile.controller.php",{
		"action":"unfollow",
		"UnfollowedUserID":followedUserID
	}).done(function(data){
		$("#unfollow").hide();
		$("#follow").show();
		updateNumberOfFollowers(Number($("#numberOfFollowers").attr("number")) - 1);
	});
});

function updateNumberOfFollowers(x){
	const numberOfFollowers = $("#numberOfFollowers");
	numberOfFollowers.attr("number", x);
	numberOfFollowers.text("Number Of Followers: " + x);
}

$(document).ready(function(){
	const follow = $("#follow");
	if (follow.attr("show") != "1")
		follow.hide();

	const unfollow = $("#unfollow");
	if (unfollow.attr("show") != "1")
		unfollow.hide();

	updateNumberOfFollowers(Number($("#numberOfFollowers").attr("number")));
});