import {DataProfile} from "./dataProfile.js";


// URL où se trouve le répertoire "server" sur mmi.unilim.fr
let HOST_URL = "https://mmi.unilim.fr/~zbalah3/SAE2.03-Addem-Zbalah/";//"http://mmi.unilim.fr/~????"; // CHANGE THIS TO MATCH YOUR CONFIG

let DataMovie = {};

 /**
     * Fetches data from the server based on the specified day.
     *
     * @returns The response from the server.
     * 
     * DataMenu.request permet de récupérer des données depuis le serveur.
     * Elle prend en paramètre une semaine (1, 2, ..., 52) et un jour (lundi mardi...)
     * renvoie les données contenues dans la réponse du serveur (data).
     */
DataMovie.request = async function(){
    // fetch permet d'envoyer une requête HTTP à l'URL spécifiée. 
    // L'URL est construite en concaténant HOST_URL à "/server/script.php?direction=" et la valeur de la variable dir. 
    // L'URL finale dépend de la valeur de HOST_URL et de dir.
        let answer = await fetch(HOST_URL + "/server/script.php?todo=read");
        let data = await answer.json();
        return data;

}

DataMovie.requestMovieDetails = async function(id){
    // fetch permet d'envoyer une requête HTTP à l'URL spécifiée. 
    // L'URL est construite en concaténant HOST_URL à "/server/script.php?direction=" et la valeur de la variable dir. 
    // L'URL finale dépend de la valeur de HOST_URL et de dir.
        let answer = await fetch(HOST_URL + "/server/script.php?todo=readmoviedetails&id=" + id);
        let data = await answer.json();
        return data;

    }
    
DataMovie.requestCategory = async function(){
    // fetch permet d'envoyer une requête HTTP à l'URL spécifiée. 
    // L'URL est construite en concaténant HOST_URL à "/server/script.php?direction=" et la valeur de la variable dir. 
    // L'URL finale dépend de la valeur de HOST_URL et de dir.
        let answer = await fetch(HOST_URL + "/server/script.php?todo=readcategory");
        let data = await answer.json();
        return data;
    
    }

    DataMovie.requestMovieCategories = async function(idcategory, age){
        // Si age est -1 ou undefined, ne pas ajouter de filtre d'âge
        let url = HOST_URL + "/server/script.php?todo=readmoviescategory&id=" + idcategory;
        // N'ajouter le filtre d'âge que si age est défini et différent de -1
        if (age != undefined && age != -1) {
            url += "&min_age=" + age;
        }
        let answer = await fetch(url);
        let data = await answer.json();
        return data;
    }

    // DataMovie.toggleFavorite = async function(movieid, profileid) {
    //     if (!profileid) return false;
        
    //     let config = {
    //         method: "POST",
    //         body: movieid + ";" + profileid // Format simple pour les données
    //     };
        
    //     let answer = await fetch(HOST_URL + "/server/script.php?todo=toggleFavorite", config);
    //     return await answer.text();
    // };
    
    // DataMovie.getFavorites = async function(profileid) {
    //     if (!profileid) return [];
        
    //     let answer = await fetch(HOST_URL + "/server/script.php?todo=getFavorites&profileId=" + profileId);
    //     return await answer.json();
    // };


/* C'EST QUOI async/await ?
    
   Il y a des instructions qui prennent du temps sans qu'on puisse prédire combien.
   fetch (et answer.json() ) en font partie.
   Il n'est en effet pas possible de savoir combien de temps le serveur prendra à nous répondre.
   Peut-être même qu'il est en panne et ne répondra pas du tout !
   Le mot clé await permet de dire à javascript qu'il faut ATTENDRE la réponse du serveur avant de 
   poursuivre l'exécution du code (sinon on va vouloir lire les données avant de les avoir reçues).
   Et pour pouvoir utiliser await, il faut ajouter le mot clé async à la fonction.

*/

DataMovie.addFavorite = async function(movieId) {
    let currentUser = DataProfile.getCurrentUser();
    if (!currentUser) {
        return "Veuillez sélectionner un profil";
    }

    let answer = await fetch(HOST_URL + "/server/script.php?todo=addFavorite&movie_id=" + movieId + "&profile_id=" + currentUser.id);
    console.log(answer);
    let data = await answer.json();
    return data;
};

    // DataMovie.addfavorite = async function (movie,profile) {
    //     let config = {
    //         method: "POST",
    //     };
    //     let answer = await fetch(HOST_URL + `/server/script.php?todo=addfavorite&profile_id=${profile.id}&movie_id=${movie.id}`, config);
    //     let data = await answer.json();
    //     return data;
    // }

    // DataMovie.delfavorite = async function (id) {
    //     let config = {
    //         method: "POST",
    //     };
    //     let answer = await fetch(HOST_URL + `/server/script.php?todo=delfavorite&profile_id=${profile.id}&movie_id=${movie.id}`, config);
    //     let data = await answer.json();
    //     return data;
    // }
    
    // DataMovie.getfavorite = async function (id_user) {
    //     let answer = await fetch(HOST_URL + `/server/script.php?todo=getfavoris&id_user=${profile.id}`);
    //     let data = await answer.json();
    //     return data;
    // }

export {DataMovie};