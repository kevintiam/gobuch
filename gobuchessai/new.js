
            function verifNumero(champ) {
        var chiffres = new RegExp("[0-9]");
        var valid;
        for (x = 0; x < champ.value.length; x++) {
            
            if (champ.value.charAt(0)!='6') {
				alert("MR/Mme les numeros au cameroun commencent par 6 ");	
                champ.value='';
            }
			else
				
			
			valid = chiffres.test(champ.value.charAt(x));
		     if (valid == false){
		      alert("Veuillez entrer uniquement des chiffres ");
				champ.value = champ.value.substr(0, x) + champ.value.substr(x + 1, champ.value.length - x + 1); x--;
			}
        }
}   


function verifNom(){
	
	 if(document.form1.name.value== "")
	{
		   surligne(document.querySelector("#name"),true);
			document.querySelector("#errNom").innerHTML="Veuillez entrer un nom";
			return false;
	}
	   
	else{
		surligne(document.querySelector("#name"),false);
		document.querySelector("#errNom").innerHTML="";
		return true;
	}
}


function verifPrenom(){
	
	 if(document.form1.surname.value== "")
	{
		   surligne(document.querySelector("#surname"),true);
			document.querySelector("#errPrenom").innerHTML="Veuillez entrer un prenom";
			return false;
	}
	   
	else{
		surligne(document.querySelector("#surname"),false);
		document.querySelector("#errPrenom").innerHTML="";
		return true;
	}
}


function verifPseudo(){
	
	 if(document.form1.pseudo.value== "")
	{
		   surligne(document.querySelector("#pseudo"),true);
			document.querySelector("#errPseudo").innerHTML="Veuillez entrer un pseudo";
			return false;
	}
	   
	else{
		surligne(document.querySelector("#pseudo"),false);
		document.querySelector("#errPseudo").innerHTML="";
		return true;
	}
}


function verifBio(){
	
	 if(document.form1.bio.value== "")
	{
		   surligne(document.querySelector("#bio"),true);
			document.querySelector("#errBio").innerHTML="Veuillez preciser votre biographie";
			return false;
	}
	   
	else{
		surligne(document.querySelector("#bio"),false);
		document.querySelector("#errBio").innerHTML="";
		return true;
	}
}


function verifDate(){
	
	 if(document.form1.date.value== "")
	{
		   surligne(document.querySelector("#date"),true);
			document.querySelector("#errDate").innerHTML="Veuillez choisir une date";
			return false;
	}
	   
	else{
		surligne(document.querySelector("#date"),false);
		document.querySelector("#errDate").innerHTML="";
		return true;
	}
}

function verifTel(){
	
	 if(document.form1.telephone.value== "")
	{
		   surligne(document.querySelector("#telephone"),true);
			document.querySelector("#errTel").innerHTML="Veuillez preciser votre contact";
			return false;
	}
	
	else if(document.form1.telephone.value.length < 9){
		surligne(document.querySelector("#telephone"),true);
		document.querySelector("#errTel").innerHTML=" Il reste "+(9-(document.form1.telephone.value.length))+" chiffres";
		return false;
   }
      
	else{
		surligne(document.querySelector("#telephone"),false);
		document.querySelector("#errTel").innerHTML="";
		return true;
	}
}


function verifMdp(){
	
	var zoneErrtexte=document.querySelector("#errMdp");
	var zoneTexte=document.querySelector("#mdp");
	
	 if(zoneTexte.value== "")
	{
		   surligne(zoneTexte,true);
			zoneErrtexte.innerHTML="Veuillez preciser un mot de passe";
			return false;
	}
	   
	else if( zoneTexte.value.length <8 || zoneTexte.value.length >12 )
	{
			surligne(zoneTexte,true);
			zoneErrtexte.innerHTML="Au moins 8 et au plus 12 caractères ";
			return false;
	}  
	   
	else{
		surligne(zoneTexte,false);
		zoneErrtexte.innerHTML="";
		return true;
	}
}

	
function verifConMdp()
   {
	 if(document.querySelector("#mdp").value !=""){
		 
		   var a=document.querySelector("#conMdp");
		   var b=document.querySelector("#errCon")
		   
		  if(a.value=="")
		  {
				surligne(a,true);
				b.innerHTML="Veuillez confirmer le mot de passe";
				return false; 
		  }
		   
		   else if( a.value !=  document.querySelector("#mdp").value )
		   {
			   surligne(a,true);
			   b.innerHTML="Les mots de passe ne concordent pas";
				return false;
		   }
		   
		   else
		   {
			   surligne(a,false);
			   b.innerHTML="";
			   return true;
		   }
   }
   
   else return true;
}
	
	
function surligne(champ, erreur){

   if(erreur)
      champ.style.border = "2px solid red";
   else
      champ.style.border =""; 
}


function chargeVille(){
	
		var ville1= new Array("dschang","douala","maroua","yaounde");
		var ville2= new Array("tiko","manjo","kribi","baf");
	
	if(document.querySelector("#Dep").value == "76")
	{
		
		// document.form.ville.options.length = 4;
		var i;
		
		// for(i=0; i<4; i++){
			// document.form.ville.options[i].value= i;
				document.form.ville.options[1].text = ville2[2];
				
				// }
				
		alert(ville2[3]);
		// document.form.ville.options.selectedIndex=2;
		
	}
	
}


function imageProfil(){
	alert('zz');
	return true;
}

 function vide()
   {
	   
	  var nomOk=verifNom();
	  var prenomOk= verifPrenom();
	  var bioOk=verifBio();
	  var dateOk=verifDate();
	  var telOk=verifTel();
	  var mdpOk=verifMdp();
	  var conMdpOk=verifConMdp();
	  var pseudoOk=verifPseudo();
	   
	   
	   var ok=true;  var accept=false; 
	   
	   if(!nomOk) 		ok=false; 
	   if(!prenomOk) 	ok=false; 
	   if(!bioOk) 		ok=false;
	   if(!dateOk) 		ok=false;
	   if(!telOk) 		ok=false;
	   if(!mdpOk) 		ok=false;
	   if(!conMdpOk) 	ok=false;
	   if(!pseudoOk) 	ok=false;
	   
	   if(nomOk && prenomOk && pseudoOk && bioOk && dateOk && telOk && mdpOk && conMdpOk) accept=confirm("Le formulaire est Bien rempli!!! Voullez vous vraiment envoyer?");
	   
		if (ok && accept){document.form1.decision.value= "oui"; return true; }
		else return false;
   }