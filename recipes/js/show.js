$(document).ready(function() {
	console.log("ready");

  let id = getUrlParameter('id'); 

  $.ajax('/recipes/recipes.json', {
    dataType: 'json',
    type: 'GET',
    success: function(recipes) {
      let recipe;
      if (id) { 
        for (let i = 0; i < recipes.length; i++) {
          if (id == recipes[i].id) {
            recipe = recipes[i];
          }
        }
      } else {
        recipe = recipes[0];
      }
    
      $('#recipeName').text(recipe.name);
      $('#recipeAuthorName').text(recipe.author);
      $('#recipeAuthorImage').attr('href', `/user/show.html?=${recipe.author_id}`)
      $('#recipeDescription').text(recipe.description);
      $('#recipeCreatedAt').text(parseDate(recipe.created_at));

      $.each(recipe.ingredients, function(index, ingredient) {
        $('#recipeIngredients').append(
          `<li><strong>${ingredient.name}</strong>: ${ingredient.quantity} ${ingredient.unit}</li>`
        );
      });

      $.each(recipe.steps, function(index, step) {
        let stepTemplate = $('#stepTemplate');
        let stepHTML = $($.parseHTML(stepTemplate.html()));

        stepHTML.find('#stepDescription').text(step.description);
        if (step.image) {
          stepHTML.find('#stepImage').append(`
            <img class="step-image border rounded m-4" src="${step.image}">
          `);
        }


        $('#recipeSteps').append(stepHTML);
      });
    }
  });
});

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    return false;
};

var parseDate = function parseDate(timestamp) {
  var date = new Date(timestamp * 1000);
  console.log(date);
  return `${date.getDate()}/${date.getMonth() + 1}/${date.getFullYear()}`
}