let templateFile = await fetch('./component/NewProfileForm/template.html');
let template = await templateFile.text();


let AddNewProfilForm = {};

AddNewProfilForm.format = function (handler) {
    let html = template;
    html = html.replace('{{handler}}', handler);
    return html;
}


export { AddNewProfilForm };