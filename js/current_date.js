// Get the current date - to set a limit to the options for registration of date of birth
let today = new Date();
let dd = today.getDate();
let mm = today.getMonth() + 1; //January is 0 so +1 fixes this issue
let yyyy = today.getFullYear();

if (dd < 10) {
   dd = '0' + dd;
}

if (mm < 10) {
   mm = '0' + mm;
} 
    
today = yyyy + '-' + mm + '-' + dd;

if(document.getElementsByClassName("registerDOB")){
   document.getElementsByClassName("registerDOB").setAttribute("max", today);
}
