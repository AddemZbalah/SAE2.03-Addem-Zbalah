let templateFile = await fetch('./component/formulaire/template.html');
let template = await templateFile.text();


let formulaire = {};

formulaire.format = function(handler){
    let html = template;
    html = html.replace('{{handlerAddMovie}}', handler);
    return html;

}

export {formulaire};