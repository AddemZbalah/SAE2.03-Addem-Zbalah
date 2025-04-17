const templateFile = await fetch("component/Hero/template.html");
const template = await templateFile.text();




let Hero = {}
Hero.format = function () {
    return template;
}
export {Hero};