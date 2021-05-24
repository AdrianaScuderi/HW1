function aggiungiDipendenti(struttura) {
    for (let i of struttura) {
        let elemento=document.createElement("div");
        elemento.setAttribute("class", "dip");

        let nominativo=document.createElement("h1");
        let testo=document.createTextNode(i.nome + ' ' + i.cognome);
        nominativo.appendChild(testo);
    

        let fotodipendente=document.createElement("img");
        fotodipendente.setAttribute("class", "fotodipendente");
        fotodipendente.src=i.immagine;

        let ruolo=document.createElement("p");
        let paragrafo=document.createTextNode(i.ruolo);
        ruolo.appendChild(paragrafo);

        elemento.appendChild(nominativo)
        elemento.appendChild(fotodipendente);
        elemento.appendChild(ruolo); 

        dipendente.appendChild(elemento);  
    }
}
function onJson(json) {
    console.log(json);
    aggiungiDipendenti(json); 
   }
   
   function onResponse(response){
       return response.json();
   }
   
   fetch ('carico_dipendenti.php').then(onResponse).then(onJson);

const dipendente=document.querySelector(".dipendente");
