$(".upvote").click(function(){
	const PictureID = $(this).attr("data-picture");
	console.log(PictureID);
	$.post("controllers/picture.controller.php",{
			"action":"upvote",
			"PictureID":PictureID
	}).done(function(data){});
});
$(".downvote").click(function(){
	const PictureID = $(this).attr("data-picture");
	$.post("controllers/picture.controller.php",{
			"action":"downvote",
			"PictureID":PictureID
	}).done(function(data){});
});
$(".comment").click(function(){
	const PictureID = $(this).attr("data-picture");
	const comment = $(this).parent().parent().find("input");
	$.post("controllers/picture.controller.php",{
		"action":"addcomment",
		"comment":comment.val(),
		"PictureID":PictureID
	}).done(function(data){

	});
});
// $(".follow").click(function(){
// 	const PictureID = $(this).attr("data-user");
// 	$.post("profile.controller.php",{
// 	"action":"follow",
// 	"PictureID":PictureID
// 	}).done(function(data){
//
// 	});
// });