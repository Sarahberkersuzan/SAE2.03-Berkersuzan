

let HOST_URL = "https://mmi.unilim.fr/~berkersuzan1/SAE2.03-Berkersuzan";
let DataMovie = {};

 DataMovie.requestMovies = async function(age){
    let answer = await fetch(HOST_URL + "/server/script.php?todo=readmovies&age=" + age );
    let movies = await answer.json();
    return movies;
}

DataMovie.requestMovieDetails = async function(id){
    let answer = await fetch(HOST_URL + "/server/script.php?todo=detailread&id=" + id );
    let detail = await answer.json();
    return detail;
}

DataMovie.requestMoviesCategory = async function(){
    let answer = await fetch(HOST_URL + "/server/script.php?todo=category" );
    let category = await answer.json();
    return category;
}
export {DataMovie};