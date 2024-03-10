const pwdField = document.querySelector(".form input[type='password']")
let showpwd = document.querySelector(".field i")

showpwd.onclick = ()=>{
    if (pwdField.type == 'password') {
        pwdField.type = 'text'
        showpwd.classList.add('active')
    } else {
        pwdField.type = 'password'
        showpwd.classList.remove('active')
    }
}