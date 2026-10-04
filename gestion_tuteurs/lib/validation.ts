

export const isValidPassword = (password:string) => {
  const passwordTrimed = password.trim(); 
  const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d@$!%*?&]{8,20}$/;
     const MAJUSCULE = /[A-Z]/;
     const MINUSCULE = /[a-z]/;
     const CHIFFRE = /[0-9]/;
     const LONGUEUR_MINIMALE = 8;
     const LONGUEUR_MAXIMALE = 20;
     
    if(passwordTrimed.length < LONGUEUR_MINIMALE || passwordTrimed.length > LONGUEUR_MAXIMALE) {
         return false;
     }
     if(!MAJUSCULE.test(passwordTrimed)) {
         return false;
     }
     if(!MINUSCULE.test(passwordTrimed)) {
         return false;
     }
     if(!CHIFFRE.test(passwordTrimed)) {
         return false;
     }  
  return passwordRegex.test(passwordTrimed);
}

export const isValidEmail = (email:string) => {
  const emailTrimed = email.trim();
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(emailTrimed);
};

export const isValidName = (name:string) => {
  const nameTrimed = name.trim();
  const nameRegex = /^[A-Za-zÀ-ÖØ-öø-ÿ\s'-]+$/;
  return nameRegex.test(nameTrimed);
}