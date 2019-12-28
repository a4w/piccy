$(".follow").click(function(){
	const PictureID = $(this).attr("data-user");
	$.post("profile.controller.php",{
	"action":"follow",
	"PictureID":PictureID
	}).done(function(data){

	});
});