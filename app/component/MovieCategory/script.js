import { Card } from "../Card/script.js";

let templateFile = await fetch('./component/MovieCategory/template.html');
let template = await templateFile.text();

let MovieCategory = {};

MovieCategory.format = function(category, movies) {
    let html = template;
    html = html.replace("{{title}}", category.name);

    let html2 = Card.formatMany(movies);
    html = html.replace("{{movies}}", html2)

    return html
};

MovieCategory.formatMany = async function(categories){
    let html = "";
    for (const elt of categories) {
        const movies = await DataMovie.requestMovieCategory(elt.category);
        html += MovieCategory.format(elt.category, movies);
    }
    return html;
};

export { MovieCategory }
