const form = document.querySelector(".login form")
const continueBtn = form.querySelector(".sub input")
const errorText = form.querySelector(".login .error-txt")

form.onsubmit = (e)=>{
    e.preventDefault()
}
continueBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest()
    xhr.open("POST","php/login.php",true);
    xhr.onload = ()=>{
        if (xhr.readyState ===  XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (data == 'OK') {
                    location.href = 'users.php'
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