let HOST_URL = "https://mmi.unilim.fr/~zbalah3/SAE2.03-Addem-Zbalah/";

let DataProfile = {};


DataProfile.user = null;


DataProfile.setCurrentUser = function(profile) {
    DataProfile.user = profile;
};

DataProfile.getCurrentUser = function() {
    return DataProfile.user;
};

DataProfile.request = async function(){
    // try {
        // Correction du chemin vers le script PHP
        let answer = await fetch("../server/script.php?todo=getUsersProfiles");  
        let data = await answer.json();
        return data;
    // } catch (error) {
    //     console.error("Erreur de requête:", error);
    //     return [];
    // }
}

export {DataProfile};