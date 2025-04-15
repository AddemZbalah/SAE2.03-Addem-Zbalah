import { Card } from "../Card/script.js";
import { DataMovie } from "../../data/dataMovie.js";

// On réutilise le template de MovieCategory
let templateFile = await fetch('./component/MovieCategory/template.html');
let template = await templateFile.text();

let RecommendedMovies = {};

RecommendedMovies.format = function(movies) {
    let html = template;
    html = html.replace("{{title}}", "Films Populaires");

    // Marque les favoris et cache la croix de suppression
    for (let movie of movies) {
        movie.showDelete = false;
    }

    let html2 = Card.formatMany(movies);
    html = html.replace("{{movies}}", html2);

    return html;
};