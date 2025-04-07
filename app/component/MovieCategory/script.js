import { Movie } from "../Movie/script.js";

let templateFile = await fetch("./component/MovieCategory/template.html");
let template = await templateFile.text();

let MovieCategory = {};

MovieCategory.format = function (category) {
    let html = template;
    html = html.replace("{{categoryName}}", category.name);
    
    let movieHtml = Movie.format(category.movie || []);
    console.log(movieHtml);
    html = html.replace("{{movieCard}}", movieHtml);

  return html;
};

export { MovieCategory };