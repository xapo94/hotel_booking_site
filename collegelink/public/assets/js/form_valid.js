document.addEventListener("DOMContentLoaded", () => {
  const $form = document.querySelector(".register-form");
  const $emailError = document.querySelector(".error-mail");
  const $passwordError = document.querySelector(".error-password");

  const getValidations = ({email, password}) => {
    let emailIsValid = false;
    let passwordIsValid = false;

    if (email !== "" && /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email) ){
      emailIsValid = true;
    }

    if (password !== "" && password.length > 4){
      passwordIsValid = true;
    }

    return {
      emailIsValid,
      passwordIsValid,
    };
  };


  $form.addEventListener("submit", (e) => {
    e.preventDefault();

    const {email, password} = e.target.elements;
    const values = {
      email : email.value,
      password : password.value,
    };
    const validations = getValidations(values);

    if (!validations.emailIsValid){
      $emailError.classList.remove("display-none");
    } else {
      $emailError.classList.add("display-none");
    }

    if (!validations.passwordIsValid){
      $passwordError.classList.remove("display-none");
    } else {
      $passwordError.classList.add("display-none");
    }

    if (validations.emailIsValid && validations.passwordIsValid){
      $form.submit();
    }


  });

  $emailError.classList.add("display-none");
  $passwordError.classList.add("display-none");

});
