let templateFile = await fetch("./component/Movie/template.html");
let template = await templateFile.text();

let Movie = {};

Movie.format = function (movies) {
  let html = "";
  movies.forEach((movie) => {
    let movieHtml = template;
    movieHtml = movieHtml.replace("{{nom}}", movie.name);
    movieHtml = movieHtml.replace("{{affiche}}", movie.image);
    html += movieHtml;
  });

  return html;
};

export {Movie};