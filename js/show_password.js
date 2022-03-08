// Get ViewPassword Button and Password Field
const password = document.querySelector("#registerPassword")
const viewPasswordBtn = document.querySelector(".view-Password");

// View Password
viewPasswordBtn.addEventListener("change",function(){
  if(this.checked){
    password.type = "text";
  }else{
    password.type = "password";
  }
})


// Get ViewPassword Button and Password Field
const loginPassword = document.querySelector("#loginPassword")
const viewLoginPasswordBtn = document.querySelector(".view-Login-Password");

// View Password
viewLoginPasswordBtn.addEventListener("change",function(){
  if(this.checked){
    loginPassword.type = "text";
  }else{
    loginPassword.type = "password";
  }
})
