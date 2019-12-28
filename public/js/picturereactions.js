$(".upvote").click(function(){
	const PictureID = $(this).attr("data-picture");
	const btn = $(this);
	$.post("controllers/picture.controller.php",{
			"action":"upvote",
			"PictureID":PictureID
	}).done(function(data){
		btn.parent().parent().find(".upvote-count").text(data.numberOfUpvotes);
	});
});
$(".downvote").click(function(){
	const PictureID = $(this).attr("data-picture");
	const btn = $(this);
	$.post("controllers/picture.controller.php",{
			"action":"downvote",
			"PictureID":PictureID
	}).done(function(data){
		btn.parent().parent().find(".downvote-count").text(data.numberOfDownvotes);
	});
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