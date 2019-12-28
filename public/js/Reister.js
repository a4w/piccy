$("#register").click(function());
{
	$("#username").removeClass("border-danger");
	$("#password").removeClass("border-danger");
	$("#email").removeClass("border-danger");
	$(".field-error").remove();
	if($("#username").val() === ""){
		$("#username").addClass("border-danger");
		$("#username").parent().append("<span class='field-error'>Username is Empty!</span>");
		return;
	}
	if($("#username").val().length < 4 || $("#username").val().length > 10){
	$("#username").addClass("border-danger");
	$("#username").parent().append("<span class ='field-error'>Username Must be between 4-10</span>");
	return;
	}
	if($("#password").val() != $("#confirm_password").val()){
	
	$("#password").addClass("border-danger");
	$("#password").parent().append("<span class ='field-error'>Passwords do not match</span>");
	return;
	}
	if($("#password").val().length < 8 || $("#password").val().length > 16){
	
	$("#password").addClass("border-danger");
	$("#password").parent().append("<span class ='field-error'>Passwords between 8-16</span>");
	return;
	}
	if($("#email").val() === ""){
	$("#email").addClass("border-danger");
	$("#email").parent().append("<span class ='field-error'>Email Is Empty!</span>");
	return;
	}
	$.post("controllers/user.controller,php", {
		"action" : "register",
		"username":$("#username").val(),
		"password":$("#password").val(),
		"bio":$("#bio").val(),
	"email":$("#email").val()}).done(function(data){
		if(data.error)
		{
			$("#username").addClass("border-danger");
			$("#username").parent().append("<span class ='field-error'>Already Exist</span>");
		}
		else
		{
			
		}
	
	});
	
	
	
}
