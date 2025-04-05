let templateFile = await fetch("./component/Movie/template.html");
let template = await templateFile.text();

let Movie = {};

Movie.format = function (movies) {
  let html = "";
  movies.forEach((movie) => {
    let movieHtml = template;
    movieHtml = movieHtml.replace("{{nom}}", movie.name);
    movieHtml = movieHtml.replace("{{affiche}}", movie.image);
    movieHtml = movieHtml.replace("{{handler}}",`C.handlerDetail(${movie.id})`);
    html += movieHtml;
  });

  return html;
};

export {Movie};