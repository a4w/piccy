$(".upvote").click(function(){
	const PictureID = $(this).attr("data-picture");
	const btn = $(this);
	$.post("controllers/picture.controller.php",{
			"action":"upvote",
			"PictureID":PictureID
	}).done(function(data){
		btn.parent().parent().find(".upvote-count").text(data.numberOfUpvotes);
		btn.parent().parent().find(".downvote-count").text(data.numberOfDownvotes);
	});
});
$(".downvote").click(function(){
	const PictureID = $(this).attr("data-picture");
	const btn = $(this);
	$.post("controllers/picture.controller.php",{
			"action":"downvote",
			"PictureID":PictureID
	}).done(function(data){
		btn.parent().parent().find(".upvote-count").text(data.numberOfUpvotes);
		btn.parent().parent().find(".downvote-count").text(data.numberOfDownvotes);
	});
});
$(".comment-btn").click(function(){
	const PictureID = $(this).attr("data-picture");
	const comment = $(this).parent().parent().find("input");
	$(this).parent().removeClass("border-danger");
	$(".field-error").remove();
	if (comment.val() == ""){
		$(this).parent().addClass("border-danger");
		$(this).parent().parent().after("<span class ='field-error'>Comment cannot be empty</span>");
		return;
	}
	$.post("controllers/picture.controller.php",{
		"action":"addcomment",
		"comment":comment.val(),
		"PictureID":PictureID
	}).done(function(data){
        comment.parent().parent().parent().parent().find('.all-comments').append('<div class="comment"><a href="profile.php?id='+data.userid+'" class="author d-inline">'+data.username+' </a><p class="comment-content d-inline">'+comment.val()+'</p></div>');
        comment.val("");
	});
});
$(".delete-pic").click(function(){
	const PictureID = $(this).attr("data-picture");
    $.post("controllers/picture.controller.php", {
        action: "delete-picture",
        PictureID: PictureID
    }).done(function(data){
        window.location.reload(true);
    });
});
