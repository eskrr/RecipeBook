  function validateForm() {
    if( $('#InputEmail').val() != "user@mail.com" || $('#InputPassword').val() != "password" ){
        alert("Sign in must be filled out");
        return false;
    }
  }
