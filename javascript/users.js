const searchBar = document.querySelector('.users .search input'),
usersList = document.querySelector('.users .users-list')


searchBar.onkeyup = ()=>{
    let searchTerms = searchBar.value;
    
    searchBar.classList.add('active')

    if (searchTerms == "") {
        searchBar.classList.remove('active')
    }

    fetch('php/search.php', { method: 'POST',body:'searchTerm='+ searchTerms.trim(), headers: {'Content-type' : 'application/x-www-form-urlencoded'}})
    .then(async resp => {
        if(resp.status === 200){
           return await resp.text()
        }
    })
    .then(data => {
        usersList.innerHTML = data;
    })
    
}

setInterval(()=>{

    fetch('php/users.php', {method:'GET'})
    .then(async resp => {
        if (resp.status === 200) {
            return await resp.text()
        }
    })
    .then(data => {
        if (!searchBar.classList.contains('active')) {
            usersList.innerHTML = data
        }
    })
},500)