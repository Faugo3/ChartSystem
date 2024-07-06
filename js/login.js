const form = document.querySelector(".login form"),
continueBtn = form.querySelector(".button input"),
errorText = form.querySelector(".error-txt");

form.onsubmit = (e)=>{
    e.preventDefault();   //preventing form from submitting
}

continueBtn.onclick = ()=>{
    // let's start Ajax
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/login.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data == "Success!"){
                   location.href = "user.php";
                }else{
                    errorText.textContent = data;
                    errorText.style.display = "block";
                }
            }
        }
    }
    // sending of the form data through ajax to php
    let formData = new FormData(form);   //creating new formData object
    xhr.send(formData);  // sending the form data to php
}