import { Card } from "../Card/script.js";
import { DataMovie } from "../../data/dataMovie.js";

let templateFile = await fetch('./component/MovieCategory/template.html');
let template = await templateFile.text();

let MovieCategory = {};

MovieCategory.format = function(category, movies) {
    let html = template;
    html = html.replace("{{title}}", category);

    let html2 = Card.formatMany(movies);
    html = html.replace("{{movies}}", html2)

    return html
};

MovieCategory.formatMany = async function(categories){
    let html = "";
    for (const elt of categories) {
        const movies = await DataMovie.requestMovieCategories(elt.id);
        if (movies.length == 0) {
            continue
        }
        else{
            html += MovieCategory.format(elt.name, movies);
        }
    }
    return html;
};

export { MovieCategory }
