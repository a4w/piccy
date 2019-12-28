$("#follow").click(function(){
	const followerID = $(this).attr("follower");
	$.post("profile.controller.php",{
	"action":"follow",
	"PictureID":PictureID
	}).done(function(data){

	});
});