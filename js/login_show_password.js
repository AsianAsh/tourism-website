// Get ViewPassword Button and Password Field
const loginPassword = document.querySelector(".loginPassword")
const viewLoginPasswordBtn = document.querySelector(".view-Login-Password");

// View Password
if (viewLoginPasswordBtn){
	viewLoginPasswordBtn.addEventListener("change",function(){
		if(this.checked){
			loginPassword.type = "text";
		} else{
			loginPassword.type = "password";
		}
	})
}