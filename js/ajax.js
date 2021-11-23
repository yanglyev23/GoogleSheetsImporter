$( document ).ready(function() {
    $("#btn").click(
		function(){
			sendAjaxForm('ajax_form', 'server.php');
			return false; 
		}
	);
});

function lighting(param){
	document.getElementById(param).style.borderColor = "red";
}

function lightingOff(){
	document.getElementById("name").style.borderColor = "";
	document.getElementById("email").style.borderColor = "";
	document.getElementById("phone").style.borderColor = "";
}

function clear(){
	document.getElementById("name").value = "";
	document.getElementById("email").value = "";
	document.getElementById("phone").value = "";
}

function sendAjaxForm(ajax_form, url) {
    $.ajax({
        url:     url,
        type:     "POST",
        data: $("#"+ajax_form).serialize(),
        success: function(response) {
			lightingOff();
        	result = $.parseJSON(response);
			if (result.success == "1"){
				document.getElementById("result").innerHTML = "Данные отправлены";
				clear();
			}
			else{
				for (index = 0; index < result.errors.length; ++index) {
					lighting(result.errors[index]);
				}
				document.getElementById("result").innerHTML = "Ошибка. Данные не отправлены.";
			}
    	}
 	});
}