const searchBar = document.querySelector('.users .search input'),
usersList = document.querySelector('.users .users-list')


searchBar.onkeyup = ()=>{
    let searchTerms = searchBar.value;
    
    searchBar.classList.add('active')

    if (searchTerms == "") {
        searchBar.classList.remove('active')
    }

    let xhr = new XMLHttpRequest()
    xhr.open("POST","php/search.php",true);
    xhr.onload = ()=>{
        if (xhr.readyState ===  XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                usersList.innerHTML = data;
            }
        }
    }
    xhr.setRequestHeader('Content-type' , 'application/x-www-form-urlencoded');
    xhr.send('searchTerm='+ searchTerms.trim());
    
}

setInterval(()=>{
    let xhr = new XMLHttpRequest()
    xhr.open("GET","php/users.php",true);
    xhr.onload = ()=>{
        if (xhr.readyState ===  XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (!searchBar.classList.contains('active')) {
                    // searchBar.blur();
                    usersList.innerHTML = data;
                }
            }
        }
    }
    xhr.send()
},500)