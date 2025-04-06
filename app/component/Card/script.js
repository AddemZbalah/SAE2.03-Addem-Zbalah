let templateFile = await fetch('./component/Card/template.html');
let template = await templateFile.text();


let Card = {};

Card.format = function(card){
    let html= template;
    html = html.replace('{{title}}', card.name);
    html = html.replace('{{img}}', card.image);
    html = html.replace('{{link}}', card.trailer);
    html = html.replace('{{handler}}', `"C.handlerDetail(${card.id})"`);
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
