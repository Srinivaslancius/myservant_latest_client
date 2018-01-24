// Wait for the DOM to be ready
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='form']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      name_contact: "required",
      lastname_contact: "required",
      ememail_contactail: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        email: true
      },   
      phone_contact: {
        required: true,
        // Specify that email should be validated
        // by the built-in "number" rule
        number: true,        
        minlength: 10
      },   
     
    },
    // Specify validation error messages
    messages: {
      name_contact: "Please enter your firstname",
      lastname_contact: "Please enter your lastname",     
      email_contact: "Please enter a valid email address",
      phone_contact: "Please enter a valid mobile number"
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});