

let HOST_URL = "https://mmi.unilim.fr/~berkersuzan1/SAE2.03-Berkersuzan/";
let DataMovie = {};

 DataMovie.requestMovies = async function(){
    let answer = await fetch(HOST_URL + "/server/script.php?todo=readmovies" );
    let movies = await answer.json();
    return movies;
}



export {DataMovie};