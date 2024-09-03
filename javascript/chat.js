import { DeletedFecth } from "./deletedMsg";

const form = document.querySelector(".typing-area"),
inputField = form.querySelector(".input-field"),
inputFile = form.querySelector(".input-file"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box");



form.onsubmit = (e)=>{
    e.preventDefault();
}


chatBox.onmouseenter = ()=>{
    chatBox.classList.add('active')
}
chatBox.onmouseleave = ()=>{
    chatBox.classList.remove('active')
}


sendBtn.onclick = async ()=>{
    let formData = new FormData(form)

    await fetch('php/insert-chat.php', { method: 'POST', body: formData})
    .then(resp => {
        if(resp.status === 200){
            inputField.value = '';
            scrollToBottom()
        }
    })
    .catch(err => alert("Le formulaire n'a pas été soumis, réessayer plus tard! ;("))
}

const getChat = ()=>{
    let formData = new FormData(form)

    fetch('php/get-chat.php', { method: 'POST', body: formData})
    .then(resp => {
        if(resp.status === 200){
            return resp.text();
        }
    })
    .then(data => {
        chatBox.innerHTML = data;
        if (!chatBox.classList.contains('active')) {
            scrollToBottom();
        }
    })
}
let t;
const updatedData = ()=>{
     t = setInterval(()=> getChat(),500)
     console.log(t);
        
}
const stopFetch = ()=>{
    clearInterval(t)
    console.log(t);
    
}

const scrollToBottom = ()=>{
    chatBox.scrollTop = chatBox.scrollHeight;
}

document.addEventListener('click', (e)=>{
    
    if(chatBox.contains(chatBox.querySelector('div'))){
        let modals = document.querySelectorAll('.modal')
        
        if (e.target.className == 'fas fa-chevron-down') {
            modals.forEach(modal =>{
                if (e.target.id === modal.getAttribute('id')) {
                    
                    stopFetch()
                    modal.style.display = 'block'
                    let btns = modal.querySelectorAll('a')
                    DeletedFecth(btns, modal, updatedData)
                }else{
                    modal.style.display = 'none'
                }
                
            })
        }
    }
})
 updatedData()
 
 
 