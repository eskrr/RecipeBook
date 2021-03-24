  function validateForm() {
    if( $('#InputEmail').val() != "user@mail.com" || $('#InputPassword').val() != "password" ){
        alert("Incorrect user");
        return false;
    }
  }
