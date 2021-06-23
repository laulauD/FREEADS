
const form = document.getElementById('searchForm');

form.addEventListener('submit', function (e){
    e.preventDefault();

    const token = document.querySelector('meta[name="csrf-token"]').content;

    const url = this.getAttribute('action');
    
    const query = document.getElementById('query').value;

fetch(url, {
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': token
    },
    method: 'post',
    body: JSON.stringify({
        query: query
    })

}).then(response => {
  
    response.json().then(data=> {
        const posts = document.getElementById('posts');
        posts.innerHTML= '';

        Object.entries(data)[0][1].forEach(element => {
            posts.innerHTML += `   
            <div class="card m-3" style="height:20rem;width:11rem;">
              <img class="card-img-top mx-auto" src="images/${element.photo}">
                <div class="card-body">
                    <h5 class="card-title">${element.titre}</h5>
                    <p class="overflo card-text">${element.description}</p>
                    <p class="card-text">${element.prix} €</p>
                    <a href="#" class="btn btn-secondary">Plus +</a>
                </div>
            </div>
    ` 
        });
  })
}).catch(error => {
    console.log(error)
})

});
