const form = document.querySelector(".login form")
const continueBtn = form.querySelector(".sub input")
const errorText = form.querySelector(".login .error-txt")

form.onsubmit = (e)=>{
    e.preventDefault()
}
continueBtn.onclick = ()=>{

    let formData = new FormData(form)

    fetch('php/login.php', { method: 'POST', body: formData})
    .then(resp => {
        if(resp.status === 200){
            return resp.text();
        }
    })
    .then(data => {
        if (data == 'OK') {
            location.href = 'users.php'
        }else{
            errorText.innerText = data;
            errorText.style.display = 'block';
        }
    }
    )
    .catch(err => alert("Le formulaire n'a été soumis, réessayer plus tard! ;("))
}