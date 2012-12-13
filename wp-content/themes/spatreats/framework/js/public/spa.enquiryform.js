jQuery(document).ready(function($){
		$.validator.addMethod("notEqual", function(value, element, param) {
	  return this.optional(element) || value != param;
	}, "Please choose a value!");

if($(".frmcontact").length > 0 ){
	
	$(".frmcontact").each(function(){
		$(this).validate({ 
			onfocusout: function(element) {	
				$(element).valid();
			},		   
			rules:{ 
			  name  	: {required: true,minlength: 3,notEqual:'Name'},
			  email 	: {required: true,email: true,notEqual:'Email'},		  
			  message	: {required: true,minlength: 10,notEqual:'Message'}
			}
		});
	});

	$(".frmcontact").each(function(){
		$this 		= $(this); 
		$admin_id 	= $(this).find("#admin_emailid").val();
		$name 		= $(this).find("#name");
		$email 		= $(this).find("#email");
		$msg 		= $(this).find("#message");

		$this.submit(function(){
			if($name.is(".valid") && $email.is(".valid") && $msg.is(".valid")){
				var action = $this.attr('action');
				$this.find('#send').attr('disabled', 'disabled').after('');
				
				
				$this.find("#ajax_message").slideUp(750, function (){
					$this.find("#ajax_message").hide();
					$.post(action,{
						admin_emailid : $admin_id
						,name 	: $name.val()
						,email 	: $email.val()
						,message: $msg.val()
					}, function(data){
						$this.find("#ajax_message").html(data);
						$this.find("#ajax_message").slideDown('slow');
						$(this).find('#send').attr('disabled', '');
						if (data.match('success') != null) $(this).slideUp('slow');
					});
				});
				
			}
			return false;
		});
	});
}

});