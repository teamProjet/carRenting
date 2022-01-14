// search for catalog by title

function search_car() {
    let input = document.getElementById('searchbar').value
    input=input.toLowerCase();
    let x = document.getElementsByClassName('h3_catalog');

	let z = document.getElementsByClassName('card_catalog');
      
    for (i = 0; i < x.length; i++) { console.log(x.length);
        
        if (!x[i].innerHTML.toLowerCase().includes(input)) {
            
                z[i].style.display="none";
            
            
        }
        else {
            z[i].style.display="flex";                 
        }
    }
}