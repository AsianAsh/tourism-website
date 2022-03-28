// Current Date Details(mm, dd, today) already declared in current_date.js
let twoYearsFromNow = new Date();
twoYearsFromNow.setFullYear(twoYearsFromNow.getFullYear() + 2);
let maxyyyy = twoYearsFromNow.getFullYear();
let maxCheckInDate = maxyyyy + '-' + mm + '-' + dd;

if(document.getElementById("inputCheckInDate")){
    document.getElementById("inputCheckInDate").setAttribute("min", today);
 }
 
 if(document.getElementById("inputCheckInDate")){
    document.getElementById("inputCheckInDate").setAttribute("max", maxCheckInDate);
 }