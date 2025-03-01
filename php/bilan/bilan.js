function AnneBilan() {
   const anne= document.getElementById("nombre").value;
    window.location.href ='liste.php?anne='+anne+'';
}

function AnnePassif() {
    const anne= document.getElementById("nombre").value;
     window.location.href ='listepasif.php?anne='+anne+'';
 }