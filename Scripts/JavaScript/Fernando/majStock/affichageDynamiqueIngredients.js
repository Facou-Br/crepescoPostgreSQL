$(document).ready(function () {
  /**
   * Evenement qui permet de récupérer les ingrédiens en fonction du fournisseur sélectionné et de mettre à jour l'interface utilisateur.
   * Les ingrédients sont récupérés via un script PHP et affichés dynamiquement.
   * 
   * @Facou-Br
   */
  $("select.fournisseurs").change(function () {
    //console.log("Debut de la fonction lors du changement de fournisseur.")
    let fournisseurs = $(this).val();
    //console.log(fournisseurs);
    $(".ingredients").empty();
    $.ajax({
      url: "../../../Scripts/PhP/Fernando/majStock/selectIngredients.php",
      type: "GET",
      data: {
        fournisseurs: fournisseurs,
      },
      datatype: "json",
      success: function (data) {
        //console.log(data);
        let arrayFournisseurs = JSON.parse(data);
        //console.log(arrayFournisseurs);
        $(".ingredients").append("<br>");
        $.each(arrayFournisseurs, function (key, val) {
          $(".ingredients").append(
            `<label for=${key}>${val} :</label>`
          );
          $(".ingredients").append(
            `<input type='number' name=${key} required value=0 id=${key} class='produit'><br>`
          );
        });
        $(".ingredients").append(
          "<br> <input id='majStock' class='majStock' type='submit' value='Mettre à jour le stock'>"
        );
      },
      error: function () {
        alert("Erreur lors de la récupération des Ingredients par rapport au fournisseur.");
      },
    });
  });

  /**
   * Evenement qui écoute le clic sur le bouton de mise à jour du stock.
   * Envoie les données des ingrédients à un script PHP pour mettre à jour le stock dans la base de données.
   * 
   * Demande confirmation à l'utilisateur avant de mettre à jour le stock.
   * Affiche un message de succès ou d'erreur en fonction de la réponse du serveur.
   * 
   * @Facou-Br
   * @param {Event} e - Retire l'événement par défaut du formulaire.
   */
  $("#formulaireIngredients").on("submit", function (e) {
    e.preventDefault();

    let idIngredients = [];
    let ingredients = [];

    $(".produit").each(function () {
      idIngredients.push($(this).attr("id"));
      ingredients.push($(this).val());
    });

    let ingredientsObj = {};
    for (let i = 0; i < idIngredients.length; i++) {
      ingredientsObj[idIngredients[i]] = ingredients[i];
    }

    //console.log(ingredientsObj);


    $.ajax({
      url: "../../../Scripts/PhP/Fernando/majStock/majStock_Fournisseur.php",
      type: "POST",
      data: {
        ingredientsObj: JSON.stringify(ingredientsObj),
      },
      success: function (response) {
        if (confirm("Êtes vous sûr de vouloir mettre à jour le stock ?")) {
          $.ajax({
            url: "../../../Scripts/PhP/Fernando/majStock/majStock_Fournisseur.php",
            type: "POST",
            data: {
              action: "COMMIT",
            },
            success: function () {
              console.log(response);
              alert("COMMIT avec succées.");
            },
            error: function () {
              alert("Erreur lors de la mise à jour du stock.");
            },
          });
        } else {
          $.ajax({
            url: "../../../Scripts/PhP/Fernando/majStock/majStock_Fournisseur.php",
            type: "POST",
            data: {
              action: "ROLLBACK",
            },
            success: function () {
              alert("ROLLBACK avec succées.");
            },
            error: function () {
              alert("Erreur lors de la mise à jour du stock.");
            },
          });
        }
      },
      error: function () {
        alert("Erreur lors de la mise à jour du stock.");
      },
    });

  });
});