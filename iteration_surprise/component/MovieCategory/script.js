
import { Card } from "../Card/script.js";
import { DataProfile } from "../../data/dataProfile.js";
import { DataMovie } from "../../data/dataMovie.js";

let templateFile = await fetch('./component/MovieCategory/template.html');
let template = await templateFile.text();

let MovieCategory = {};



MovieCategory.format = function(category, movies) {
    let html = template;
    let hideClass = '';

    if (DataProfile.getCurrentUser()) {
        hideClass = 'hidden';
    }

    if (!movies || movies.length === 0) {
        if (category === "Films Populaires") {
            return '<div class="movie-category"><h2>Films Populaires</h2><p>Aucun film populaire disponible</p></div>';
        }
        
        return ""; 
    }
    
    html = html.replace("{{title}}", category);
    

    let html2 = Card.formatMany(movies);
    html = html.replace("{{movies}}", html2);
    html = html.replace("{{hideClass}}", hideClass);



    return html
};

MovieCategory.formatMany = async function(categories,min_age){
    let html = "";
    for (const elt of categories) {
        const movies = await DataMovie.requestMovieCategories(elt.id, min_age);
        if (movies.length == 0) {
            continue;
        }
        else{
            html += MovieCategory.format(elt.name, movies);
        }
    }

    return html;
};

export { MovieCategory }
