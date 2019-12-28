$(".upvote").click(function(){
	const id = $(this).attr("data-picture");
	$.post("controllers/picture.controller.php"),{
			"action":"upvote",
			"id":$("#id").val()
	}).done(function(data){});
});
$(".downvote").click(function(){
	const id = $(this).attr("data-picture");
	$.post("controllers/picture.controller.php"),{
			"action":"downvote",
			"id":$("#id").val()
	}).done(function(data){});
});
$(".comment").click(function(){
	const comment = $(this).attr("data-picture");
	$.post("controllers/picture.controller.php"),{
		"action":"addcomment",
		"comment":$("comment").val()
	}).done(function(data){});
$(".follow").click(function(){
	const id = $(this).attr("data-user");
	$.post("profile.controller.php"),{
	"action":"follow",
	"id":$("#id").val()}).done(function(data){});

