export const DeletedFecth = (btns, modal, fnc)=>{
    btns.forEach(btn=>{
        btn.addEventListener('click', (e)=>{
            e.preventDefault()
            
            if (e.target.id === "del") {
                
                fetch('php/deletedMsg.php', {
                    method: 'POST', 
                    body:'msg_id='+ modal.getAttribute('id'),
                    headers: {'Content-type' : 'application/x-www-form-urlencoded'}
                }
                ).then(async resp => {
                    if(resp.status === 200){
                       return await resp.text()
                    }
                })
                .then(data => {
                    let succes = document.createElement('div')
                    let body = document.body
                    succes.setAttribute('id', 'succes-del')
                    succes.textContent = data
                    modal.innerHTML = ''
                    body.style.cursor = 'wait'
                    modal.append(succes)               
                    setTimeout(()=>{
                        body.style.cursor = 'default'
                        modal.style.display = 'none' 
                        fnc()
                    }, 1000)
                })
            }else{
                modal.style.display = 'none' 
                console.log(e.target.id);
                fnc()
            }
        })
    })
}

