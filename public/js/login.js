$("#login").click(function(){
            $("#username").removeClass("border-danger");
            $("#password").removeClass("border-danger");
            $(".field-error").remove();
            if($("#username").val() === ""){
                $("#username").addClass("border-danger");
                $("#username").parent().append("<span class='field-error'>Username is Empty!</span>");
                return;
            }
            if($("#password").val() == ""){
                $("#password").addClass("border-danger");
                $("#password").parent().append("<span class ='field-error'>Passwords is Empty</span>");
                return;
            }
            
            $.post("controllers/user.controller.php", {
                "action" : "login",
                "username":$("#username").val(),
                "password":$("#password").val()
               }
            ).done(function(data){
                if(data.error){
					$("#status").text("Incorrect username or password!");
                }else{
            
                }
            });
        });