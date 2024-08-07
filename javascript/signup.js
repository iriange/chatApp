const form = document.querySelector(".signUp form");
const continueBtn = form.querySelector(".sub input");
const errorText = form.querySelector(".signUp .error-txt");

form.onsubmit = (e)=>{
    e.preventDefault();
}
continueBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST","php/signup.php",true);
    xhr.onload = ()=>{
        if (xhr.readyState ===  XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (data == 'OK') {
                    location.href = 'users.php';
                }else{
                    errorText.innerText = data;
                    errorText.style.display = 'block';
                }
            }
        }
    }

    let formData = new FormData(form)
    xhr.send(formData)
}