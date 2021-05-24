 /* Con questa funzione carico gli elementi all'interno del sito e creo gli spazi dove mettere le informazioni */ 
 
 function aggiungiElementi(json) {
   prodotto.innerHTML = ''; /*Quando la barra di ricerca è vuota, tutti i prodotti scompaiono */
   for (let i of json) {
     let elemento=document.createElement("div");
      elemento.setAttribute("class", "pr");

     let titolo=document.createElement("h1");
     let testo=document.createTextNode(i.name);
     titolo.appendChild(testo);
      

      let bottonepreferiti=document.createElement("a");
      bottonepreferiti.setAttribute("class", "prefe");

      let icona=document.createElement("img");
      icona.setAttribute("class", "cuore")
      icona.src="img/star.png";

      bottonepreferiti.appendChild(titolo);
      bottonepreferiti.appendChild(icona)


     let fotoprodotto=document.createElement("img");
     fotoprodotto.setAttribute("class", "fotopr");
     fotoprodotto.src=i.image_link;

     let descr=document.createElement("p");
     let paragrafo=document.createTextNode('€ '+i.price);

     descr.appendChild(paragrafo);
     elemento.appendChild(bottonepreferiti)
     elemento.appendChild(fotoprodotto);
     elemento.appendChild(descr); 
     prodotto.appendChild(elemento);

     bottonepreferiti.addEventListener("click", aggiungiPrefe);
    }
  }

  function search(event) {
   event.preventDefault(); 
   const content = document.querySelector('#barraricerca').value;
   /* Verifico che il testo all'interno della barra di ricerca sia stato letto, ed eseguo la fetch */
   if(content) {
 	   const text = encodeURIComponent(content);
	   console.log('Eseguo ricerca elementi riguardanti: ' + text);
     fetch ("carico_prodotti.php?q="+text).then(onResponse).then(onJson);
    }
	 else {
	   alert("Non hai inserito nessuna ricerca!");
  	}
  }

  function VisualizzaPrefe(json){
    prefer.classList.remove("favorite");
    for (let j of json){

    
    let t2=j.nome;
    let ip2=j.immagine;

    let boxprefe=document.createElement("div");
    boxprefe.setAttribute("class", "prodottoprefe");

    let preferiti2=document.createElement("a");
    preferiti2.setAttribute("class", "prefe2");
    preferiti2.addEventListener("click", togliPreferiti);

    let icona2=document.createElement("img");
    icona2.src="img/prestar.png";
    let titolo2=document.createElement("h1");
    let testo2=document.createTextNode(t2);
    let fotoprodotto2=document.createElement("img");
    fotoprodotto2.src=ip2;

    titolo2.appendChild(testo2);
    preferiti2.appendChild(titolo2);
    preferiti2.appendChild(icona2);
    boxprefe.appendChild(preferiti2);
    boxprefe.appendChild(fotoprodotto2);
    prefer.appendChild(boxprefe);

    }
  }

  fetch('ritorno_preferiti_db.php').then(onResponse).then(onJson2);

  function aggiungiPrefe(Event) {
    prefer.classList.remove("favorite");
    let t2=Event.currentTarget.parentNode.querySelector(".prefe h1").textContent;
    let ip2=Event.currentTarget.parentNode.querySelector(".fotopr").src;

    let boxprefe=document.createElement("div");
    boxprefe.setAttribute("class", "prodottoprefe");

    let preferiti2=document.createElement("a");
    preferiti2.setAttribute("class", "prefe2");
    preferiti2.addEventListener("click", togliPreferiti);

    let icona2=document.createElement("img");
    icona2.src="img/prestar.png";
    let titolo2=document.createElement("h1");
    let testo2=document.createTextNode(t2);
    let fotoprodotto2=document.createElement("img");
    fotoprodotto2.src=ip2;

    titolo2.appendChild(testo2);
    preferiti2.appendChild(titolo2);
    preferiti2.appendChild(icona2);
    boxprefe.appendChild(preferiti2);
    boxprefe.appendChild(fotoprodotto2);
    prefer.appendChild(boxprefe);

    const formdata = new FormData(); 
    formdata.append("nome", t2);
    formdata.append("immagine", ip2);
    fetch("carico_prodotti_db.php", {method: "post", body: formdata});

    Event.currentTarget.removeEventListener("click", aggiungiPrefe);
}

function onError(e){
  console.log(e);
}

function togliPreferiti(Event){
  let prodott=document.querySelector(".prodotto");
  let click=Event.currentTarget.querySelector("h1").textContent;

  prefer.removeChild(Event.currentTarget.parentNode);
  let prod=prefer.querySelectorAll(".prodottoprefe");
  let ListaContenuti=prodott.querySelectorAll(".pr");
  if (prod.length==0) {
      prefer.classList.add("hidden");
  }
  for (let d of ListaContenuti) {
      let z=d.querySelector("h1").textContent;
      console.log(z);
      console.log(click);
      if (z ===  click) {
          
          d.querySelector("a").addEventListener("click", aggiungiPrefe);
      }
  }
  console.log(click);

  const formdata = new FormData(); 
  formdata.append("nome", click);
  fetch("tolgo_prodotti_db.php", {method: "post", body: formdata});

} 

 function onResponse(response){
   return response.json();
  }

 function onJson(json) {
   console.log(json);
   aggiungiElementi(json);
  }

  function onJson2(json) {
    VisualizzaPrefe(json);
  
  }

 // Aggiungo event listener al form per la RICERCA
 const form = document.querySelector('#search_content');
 form.addEventListener('submit', search)

 const prodotto=document.querySelector(".prodotto");

 const prefer=document.querySelector(".favorite");