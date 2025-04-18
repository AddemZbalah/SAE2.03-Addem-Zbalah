const templateFile = await fetch("component/footer/template.html");
const template = await templateFile.text();




let Footer = {}
Footer.format = function () {
    return template;
}
export {Footer};