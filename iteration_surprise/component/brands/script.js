const templateFile = await fetch("component/brands/template.html");
const template = await templateFile.text();




let Brands = {}
Brands.format = function () {
    return template;
}
export {Brands};