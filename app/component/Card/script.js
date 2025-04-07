let templateFile = await fetch('./component/Card/template.html');
let template = await templateFile.text();


let Card = {};

Card.format = function(card){
    let html= template;
    html = html.replace('<div class="card', `<div class="card" onclick="C.handlerDetail(${card.id})"`);
    html = html.replace('{{title}}', card.name);
    html = html.replace('{{img}}', card.image);
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
