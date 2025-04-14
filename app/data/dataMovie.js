

let HOST_URL = "https://mmi.unilim.fr/~berkersuzan1/SAE2.03-Berkersuzan";
let DataMovie = {};

 DataMovie.requestMovies = async function(age = 99){
    let answer = await fetch(HOST_URL + `/server/script.php?todo=category&age=${age}`);
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

DataMovie.requestFavoris = async function (id_movie, id_profil) {
    let answer = await fetch(HOST_URL + `/server/script.php?todo=addToFavorite&id_movie=`+id_movie +'&id_profil=' +id_profil);
    let movies = await answer.json();
    return movies;
}

DataMovie.requestDeleteFavorite = async function (id_movie, id_profil) {
    let answer = await fetch(HOST_URL + `/server/script.php?todo=deleteFavorite&id_movie=`+id_movie +'&id_profil=' +id_profil);
    let movies = await answer.json();
    return movies;
}

export {DataMovie};