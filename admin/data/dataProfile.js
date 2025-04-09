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
  

export { DataProfile };