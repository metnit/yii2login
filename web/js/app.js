var check =0;

$( "#register-button" ).click(function() {

	var csrfToken = $('meta[name="csrf-token"]').attr("content");


	var username  = $('#loginform-username').val();
    var password  = $('#loginform-password').val();
    var confirm  = $('#loginform-confirm-password').val();
    var email  = $('#loginform-email').val();
    var submit = 0;

    var file_data = $('#image_form').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);

    var other_data = $('form').serializeArray();
    $.each(other_data,function(key,input){
        form_data.append(input.name,input.value);
    });
  

    //function
  	submit += userRegister(username);
    submit += passRegister(password);
    submit += comnfirmpass(password,confirm);
    submit += validemail(email);

    //console.log(submit);

    if(submit == 4){

    	$.ajax({
            url: '/site/apiregister',
            type: 'post',
            dataType: 'json',
            data: form_data,     
          //  data: { username:username, password:password, email:email, _csrf:csrfToken},
            async: false,
            cache: false,
            contentType: false,
            processData: false,
           success: function(data)
           {

           	//console.log(data);
               if(data=='pass'){
               		//console.log('pass');
               		$(location).attr('href','/site/login');
               }
           }
         });

	}



});


$( "#login-button" ).click(function() {

  var username  = $('#loginform-username').val();
  var password  = $('#loginform-password').val();
  var csrfToken = $('meta[name="csrf-token"]').attr("content");
  var submit = 0;

  //function
  submit += user(username);
  submit += pass(password);
  submit += userInput(username);
 // console.log(submit);

  if(submit == 3){
		   $.ajax({
		           url: '/site/apilogin',
		           type: 'post',
		           dataType: 'json',
		           cache:false,
		           data: { username:username, password :password, _csrf:csrfToken},
		           success: function(data)
		           {
		           	   if(data==1){
		           	   		$('.password-error').html('Password ไม่ถูกต้อง');
		           	   }else if(data ==2){
		           	   		$('.username-error').html('ไม่พบ Username ในระบบ');
		           	   }else{
		           	   		$(location).attr('href','/user/index');
		           	   }
		           }

		         });
	}

});

function user(username){
	 
	 if(!username){
    	$('.username-error').html('Username ไม่สามารถเว้นว่าง');
    	return 0;
    }else{
    	$('.username-error').html('');
    	return 1;
    }
}

function pass(password){

    if(!password){
    	$('.password-error').html('Password ไม่สามารถเว้นว่าง');
    	return 0;
    }else{
    	$('.password-error').html('');
    	return 1;
    }
}

function validemail(email){
	if(email){

	    if( !isValidEmailAddress( email ) ){
	    			$('.email-error').html('กรอก Eamil ไม่ถูกต้อง');
	    			return 0;
	    }else{
	    			$('.email-error').html('');
	    			return 1;
	    }

    }else{
    	$('.email-error').html('');
    	return 1;
    }
}

function comnfirmpass(password,confirm){

    if(!confirm){

    	$('.confirm-password-error').html('Comfirm password ไม่สามารถเว้นว่าง');

    	return 0;

    }else if(password && confirm){

    	if(password==confirm){

    		$('.confirm-password-error').html('');

    		return 1;

    	}else{
    		$('.confirm-password-error').html('Password และ Comfirm password ต้องตรงกัน');

    		return 0;
    	}
	
	}
}

function userInput(username){
	 if(username && username.match(/^[a-z0-9]+$/gi)){
    	$('.username-error').html('');
 		return 1;
    }else if(username){
    	$('.username-error').html('Username ไม่ถูกต้อง');
    	return 0;
    }
}

function userRegister(username){

	if(username){
		if(username.match(/^[a-z0-9]+$/gi)){
				findUser(username);
				return parseInt(check);
		}else{
				$('.username-error').html('Username ใช้ได้เฉพาะ A-Z, a-z, 0-9 ไม่เกิน 12ตัว');
				return 0;
		}
		
	}else{
		$('.username-error').html('Username ไม่สามารถเว้นว่าง');
		return 0;
	}

}

function passRegister(password){

	if(!password){
    	$('.password-error').html('Password ไม่สามารถเว้นว่าง');
    	return 0;
    }else{
    	if(password.length >= 6){
	    	$('.password-error').html('');
	    	return 1;
    	}else{
    		$('.password-error').html('Password ต้องมากกว่า 6 ตัว');
    		return 0;
    	}

    }

}

function isValidEmailAddress(email) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(email);
}

function findUser(username){
	  var csrfToken = $('meta[name="csrf-token"]').attr("content");		
			$.ajax({
		           url: '/site/finduser',
		           type: 'post',
		           dataType: 'json',
		           cache:false,
		           data: { username:username, _csrf:csrfToken},
		           success: function(data)
		           {
		           	   if(data==0){
		           	   		$('.username-error').html('มี Username นี้ในระบบแล้ว');
		           	   		check = 0;
		           	   }else if(data ==1){
		           	   		$('.username-error').html('');
		           	   		check = 1;
		           	   }
		           },
		           async: false 

		    });
}


