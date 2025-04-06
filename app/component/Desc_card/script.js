let templateFile = await fetch('./component/Desc_card/template.html');
let template = await templateFile.text();


let Card_desc = {};

Card_desc.format = function(card){
    let html= template;
    html = html.replace('{{title}}', card.name);
    html = html.replace('{{img}}', card.image);
    html = html.replace('{{description}}', card.description);
    html = html.replace('{{realisteur}}', card.director);
    html = html.replace('{{duree}}', card.length);
    html = html.replace('{{date}}', card.year);
    html = html.replace('{{age}}', card.min_age);
    html = html.replace('{{categorie}}', card.id_category);
    html = html.replace('{{trailer}}', card.trailer);
    return html;
}


export {Card_desc};