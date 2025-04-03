let templateFile = await fetch('./component/Card/template.html');
let template = await templateFile.text();


let Card = {};

Card.format = function(card){
    let html= template;
    html = html.replace('{{title}}', card.title);
    html = html.replace('{{img}}', card.img);
    html = html.replace('{{link}}', card.trailer);
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
