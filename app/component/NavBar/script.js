let templateFile = await fetch("./component/NavBar/template.html");
let template = await templateFile.text();

let NavBar = {};

NavBar.format = function (handlerMovies) {
  let html = template;
  html = html.replace("{{handlerMovies}}", handlerMovies);
  return html;
};

export { NavBar };
