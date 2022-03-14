// Get ViewPassword Button and Password Field
const password = document.querySelector(".registerPassword")
const viewPasswordBtn = document.querySelector(".view-Password");

// View Password
if (viewPasswordBtn){
	viewPasswordBtn.addEventListener("change",function(){
		if(this.checked){
			password.type = "text";
			console.log("Hey You");
		} else{
			password.type = "password";
			console.log("Hey You");
		}
	})
}