let templateFile = await fetch("./component/Profile/template.html");
let template = await templateFile.text();

let Profile = {};

Profile.format = function(profile) {
    let html = template;
    html = html.replace("{{id}}", profile.id);
    html = html.replace("{{avatar}}", "../server/images/" + profile.avatar);
    html = html.replace("{{minAge}}", profile.min_age);
    html = html.replace("{{profileId}}", profile.id);
    html = html.replace("{{name}}", profile.name);
    html = html.replace("{{name}}", profile.name); 
    return html;
};

Profile.formatMany = function(profiles) {
    let html = "";
    for(let profile of profiles) {
        html += Profile.format(profile);
    }
    return html;
};

export { Profile };