import { Card } from "../Card/script.js";
import { DataMovie } from "../../data/dataMovie.js";

let templateFile = await fetch('./component/MovieCategory/template.html');
let template = await templateFile.text();

let MovieCategory = {};

MovieCategory.format = function(category, movies) {
    let html = template;
    html = html.replace("{{title}}", category);

    let html2 = Card.formatMany(movies);
    html = html.replace("{{movies}}", html2);

    if (!movies || movies.length === 0) {
        return ""; // Ne retourne rien si pas de films
    }

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

    // if (html === "") {
    //     html = `<div class="movie-category__empty">
    //               <p>Aucun film disponible pour votre tranche d'âge.</p>
    //             </div>`;
    // }

    return html;
};

export { MovieCategory }
