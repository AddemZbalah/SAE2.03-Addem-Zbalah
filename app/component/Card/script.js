let templateFile = await fetch('./component/Card/template.html');
let template = await templateFile.text();


let Card = {};

Card.format = function(card){
    let html= template;
 
    while (html.includes('{{id}}')) {
        html = html.replace('{{id}}', card.id);
    }
    html = html.replace('{{id_del_movie}}', card.id);
    html = html.replace('{{id_movie}}', card.id);
    html = html.replace('{{title}}', card.name);
    html = html.replace('{{img}}', card.image);



    if (card.isFavorite) {
        html = html.replace("star_notactive.svg", "star_active.svg");
    }

    if (card.showDelete) {
        html = html.replace('class="card__delfavorite-btn"', 'class="card__delfavorite-btn"');
    } else {
        html = html.replace('class="card__delfavorite-btn"', 'class="card__delfavorite-btn hidden"');
    }

    return html;
}

Card.formatMany = function(movies){
    let html = '';
    for (const m of movies) {
        html += Card.format(m);
    }
    return html;
}

export {Card};
