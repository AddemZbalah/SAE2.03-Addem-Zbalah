let HOST_URL = "https://mmi.unilim.fr/~zbalah3/SAE2.03-Addem-Zbalah/";

let DataProfile = {};

DataProfile.addUserProfile = async function (fdata) {
  
    let config = {
      method: "POST",
      body: fdata,
    };
    let answer = await fetch(HOST_URL + "/server/script.php?todo=addUserProfile", config);
    let data = await answer.json();
    return data;
  };

  DataProfile.addNewProfile = async function(formData) {
    try {
        formData.append('todo', 'addNewProfile'); // Ajout explicite du paramètre todo
        
        let config = {
            method: "POST",
            body: formData
        };
        
        let answer = await fetch(HOST_URL + "/server/script.php?todo=addNewProfile", config); // Correction du chemin
        
        if (!answer.ok) {
            throw new Error('Erreur serveur');
        }
        
        let text = await answer.text();
        return text;
        
    } catch (error) {
        console.error("Erreur:", error);
        return "Erreur lors de l'ajout du profil";
    }
};
  

export { DataProfile };