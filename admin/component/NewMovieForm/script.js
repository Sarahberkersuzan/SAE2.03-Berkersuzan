let templateFile = await fetch('./component/NewMovieForm/template.html');
let template = await templateFile.text();


let NewMovieForm = {};

NewMovieForm.format = function(handlerAdd){
    let html= template;
    html = html.replace('{{handlerAdd}}', handlerAdd);
    return html;
}

export {NewMovieForm};