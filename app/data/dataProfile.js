let HOST_URL = "https://mmi.unilim.fr/~zbalah3/SAE2.03-Addem-Zbalah/";

let DataProfile = {};

DataProfile.request = async function(){
    let answer = await fetch(HOST_URL + "/server/script.php?todo=getUsersProfiles");  
    let data = await answer.json();
    return data;
}

export {DataProfile};