let HOST_URL = "https://mmi.unilim.fr/~berkersuzan1/SAE2.03-Berkersuzan";

let DataProfil = {};

DataProfil.addProfil= async function (fdata) {
    // fetch possède un deuxième paramètre (optionnel) qui est un objet de configuration de la requête HTTP:
    //  - method : la méthode HTTP à utiliser (GET, POST...)
    //  - body : les données à envoyer au serveur (sous forme d'objet FormData ou bien d'une chaîne de caractères, par exempe JSON)
    DataProfil.addProfil = async function (formData) {
        try {
          let response = await fetch("http://votre-site.com/server/script.php?todo=profil", {
            method: "POST",
            body: formData,
          });
          return await response.json();
        } catch (error) {
          console.error("Erreur lors de l'ajout du profil :", error);
          return { success: false, message: "Erreur de connexion au serveur" };
        }
      };
}

export {DataProfil};