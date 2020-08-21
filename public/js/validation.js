/*******************************
******Frontend Validations******
********************************/

/*****Contact-us Page*****/
$(function() 
{
  $("#main-contact-form").validate(
  {
    rules: 
    {
      name:{
        required: true,
        pattern: /^[a-zA-Z\s]+$/
      },
      email: {
        required: true,
        email: true
      },
      subject: {
       	required: true,
      },
      message: {
        required: true,
      }
    },
    // Specify validation error messages
    messages: 
    {
      name: {
      	required: "* Name is Required",
      	pattern: "* Only alphabets are allowed"
      },
      email: {
        required: "* Please enter a value",
        email: "* Please enter valid Email Address"
      }, 
      subject: {
        required: "* Subject Field is Required"
      },
      message: "* Message Field is Required"
    },
    submitHandler: function(form) {
      form.submit();
    },
  });
});

/*****Account Page*****
*****Update Account*****/
$(function() 
{
  $("#account-form").validate(
  {
    rules: 
    {
      firstname: {
        required: true,
        lettersonly: true
      },
      lastname:{
        required: true,
        lettersonly: true
      },
      address: {
        required: true,
      },
      city: {
       	required: true,
       	lettersonly: true
      },
      state: {
        required: true,
        lettersonly: true
      },
      country: {
        required: true,
      },
      pincode: {
        required: true,
      },
      mobile: {
        required: true,
        digits: true,
        pattern: /^(\+\d{1,3}[- ]?)?\d{10}$/
      }
    },
    // Specify validation error messages
    messages: 
    {
      firstname: {
      	required: "* Firstname is Required",
      	lettersonly: "* Only alphabets are allowed"
      },
      lastname: {
      	required: "* Lastname is Required",
      	lettersonly: "* Only alphabets are allowed"
      },
      address: {
        required: "* Please enter your address for billing Process"
      }, 
      city: {
        required: "* Please enter your city",
        lettersonly: "* Only alphabets are allowed"
      },
      country: {
        required: "* Please select atleast one",
        lettersonly: "* Only alphabets are allowed"
      },
      state: {
        required: "* Please enter your state",
        lettersonly: "* Only alphabets are allowed"
      },
      pincode: "* Please enter pincode of your area",
      mobile: {
      	required: "* Please enter your mobile no.",
      	digits: "* Only digits are allowed",
      	pattern: "* Should contain 10 digits",
      }
    },
    submitHandler: function(form) {
      form.submit();
    },
  });
});

/*****Account Page*****
*****Update Password*****/

//check current user password
$(document).ready(function(){
	$('#current_password').keyup( function () {
 		var current_pwd = $(this).val();
 	 	$.ajax({
 	 		type: 'get',
 	 		url: 'account/check-user-pwd',
 	 		data: {current_pwd:current_pwd},
 	 		success:function(pwd){
 	 			// alert(pwd);
 	 			if(pwd == "false")
 	 			{
 	 				$('#chk_pwd').html("<font color='red'>Current Password is incorrect</font>");
 	 			}
 	 			else if(pwd == "true"){
 	 				$('#chk_pwd').html("<font color='green'>Current Password is correct</font>");
 	 			}
 	 		},error:function(){
 	 			alert('Error');
 	 		}
 	 	});
    });

    $("#password-form").validate(
  	{
	    rules: 
	    {
	      current_password:{
	        required: true
	      },
	      new_password: {
	        required: true,
	        minlength : 8
	      },
	      confirm_password: {
	       	required: true,
	       	equalTo : "#new_password"
	      }
	    },
	    // Specify validation error messages
	    messages: 
	    {
	      current_password: {
	      	required: "* Please Enter your current password",
	      },
	      new_password: {
	        required: "* Please enter a password",
	        minlength: "* The password must be at least 8 characters"
	      }, 
	      confirm_password: {
	        required: "* Please enter a confirm password",
	        equalTo :"* Password Confirmation should match the Password"
	      }
	    },
	    submitHandler: function(form) {
	      form.submit();
	    },
	  });
	});

/*********Checkout Page***********
*****Billing-Shipping Address*****/
$(function() 
{
  $("#checkout-form").validate(
  {
    rules: 
    {
      billing_firstname: {
        required: true,
        lettersonly: true
      },
      billing_lastname:{
        required: true,
        lettersonly: true
      },
      billing_address: {
        required: true,
      },
      billing_city: {
       	required: true,
       	lettersonly: true
      },
      billing_state: {
        required: true,
        lettersonly: true
      },
      billing_country: {
        required: true,
      },
      billing_pincode: {
        required: true,
      },
      billing_mobile: {
        required: true,
        digits: true,
        pattern: /^(\+\d{1,3}[- ]?)?\d{10}$/
      },
      shipping_firstname: {
        required: true,
        lettersonly: true
      },
      shipping_lastname:{
        required: true,
        lettersonly: true
      },
      shipping_address: {
        required: true,
      },
      shipping_city: {
       	required: true,
       	lettersonly: true
      },
      shipping_state: {
        required: true,
        lettersonly: true
      },
      shipping_country: {
        required: true,
      },
      shipping_pincode: {
        required: true,
      },
      shipping_mobile: {
        required: true,
        digits: true,
        pattern: /^(\+\d{1,3}[- ]?)?\d{10}$/
      }
    },
    // Specify validation error messages
    messages: 
    {
      billing_firstname: {
      	required: "* Firstname is Required",
      	lettersonly: "* Only alphabets are allowed"
      },
      billing_lastname: {
      	required: "* Lastname is Required",
      	lettersonly: "* Only alphabets are allowed"
      },
      billing_address: {
        required: "* Please enter your address for billing Process"
      }, 
      billing_city: {
        required: "* Please enter your city",
        lettersonly: "* Only alphabets are allowed"
      },
      billing_country: {
        required: "* Please select atleast one",
        lettersonly: "* Only alphabets are allowed"
      },
      billing_state: {
        required: "* Please enter your state",
        lettersonly: "* Only alphabets are allowed"
      },
      billing_pincode: "* Please enter pincode of your area",
      billing_mobile: {
      	required: "* Please enter your mobile no.",
      	digits: "* Only digits are allowed",
      	pattern: "* Should contain 10 digits",
      },
      shipping_firstname: {
      	required: "* Firstname is Required",
      	lettersonly: "* Only alphabets are allowed"
      },
      shipping_lastname: {
      	required: "* Lastname is Required",
      	lettersonly: "* Only alphabets are allowed"
      },
      shipping_address: {
        required: "* Please enter your address for billing Process"
      }, 
      shipping_city: {
        required: "* Please enter your city",
        lettersonly: "* Only alphabets are allowed"
      },
      shipping_country: {
        required: "* Please select atleast one",
        lettersonly: "* Only alphabets are allowed"
      },
      shipping_state: {
        required: "* Please enter your state",
        lettersonly: "* Only alphabets are allowed"
      },
      shipping_pincode: "* Please enter pincode of your area",
      shipping_mobile: {
      	required: "* Please enter your mobile no.",
      	digits: "* Only digits are allowed",
      	pattern: "* Should contain 10 digits",
      }
    },
    submitHandler: function(form) {
      form.submit();
    },
  });
});