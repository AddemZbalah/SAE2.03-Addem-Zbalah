import { Card } from "../Card/script.js";
// import { DataMovie } from "../../data/dataMovie.js";


let templateFile = await fetch('./component/MovieCategory/template.html');
let template = await templateFile.text();

let RecommendedMovies = {};

RecommendedMovies.format = function(movies) {
    let html = template;
    html = html.replace("{{title}}", "Films Populaires");

    for (let movie of movies) {
        movie.showDelete = false;
    }

    let html2 = Card.formatMany(movies);
    html = html.replace("{{movies}}", html2);

    return html;
};