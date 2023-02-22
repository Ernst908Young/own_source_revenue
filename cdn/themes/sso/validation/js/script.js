$(document).ready(function(){


		$('#register-form').validate({
	    rules: {
	      	First_Name: {
	        required: true,
	        name:true,
	        minlength: 6,
	       required: true
	      },
		  
		 Last_Name: {
	        required: true
	      },
		  
		  password1: {
				required: true,
				minlength: 6
			},
			password2: {
				required: true,
				minlength: 6,
				equalTo: "#password1"
			},
		  
	      email: {
	        required: true,
	        email: true
	      },
		  mobile: {
		  	required: true,
		  	number: true,
		  	minlength: 10,
		  	maxlength: 10
		  },
		  PAN: {
		  	required: true,
		  	minlength: 10,
		  	maxlength: 10
		  },
		  Adhaar: {
		  	required: true,
		  	number: true,
		  	minlength: 12,
		  	maxlength: 12
		  },
		  country: {
		  	required: true,
		  },
		  state: {
		  	required: true,
		  },
		  City: {
		  	required: true,
		  },
		  District: {
		  	required: true,
		  },
		   PIN: {
		  	required: true,
		  	number: true,
		  	minlength: 6,
		  	maxlength: 10
		  },
	     
		   address: {
	      	minlength: 10,
	        required: true
	      },
		  
		  checkbox: "required"
		  
	    },
			highlight: function(element) {
				$(element).closest('.control-group').removeClass('success').addClass('error');
			},
			success: function(element) {
				element
				.text('OK!').addClass('valid')
				.closest('.control-group').removeClass('error').addClass('success');
			}
	  });

}); // end document.ready