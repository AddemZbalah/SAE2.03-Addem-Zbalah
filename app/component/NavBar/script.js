let templateFile = await fetch("./component/NavBar/template.html");
let template = await templateFile.text();

let NavBar = {};

NavBar.format = function (hAbout, profileOptions, avatar) {
  let html = template;
  html = html.replace("{{hAbout}}", hAbout);
  html = html.replace("{{avatarUrl}}", avatar);
  html = html.replace("{{profileOptions}}", profileOptions);
  html = html.replace("{{onProfileChange}}", "C.handleProfileChange(this.value)");
  return html;
};

export { NavBar };
