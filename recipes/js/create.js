$(document).ready(function() {
  $('#addIngredient').click(function() {
    let ingredientTemplate = $($('#ingredientForm').html());
    $('#ingredients').append(ingredientTemplate);
    feather.replace();
  });

  $('#ingredients').on('click', '.removeIngredient', function() {
    $(this).closest('.ingredient').remove();
  });


  $('#addStep').click(function() {
    let stepTemplate = $($('#stepForm').html());
    stepTemplate.find('.stepNum').text($('.step').length);
    $('#steps').append(stepTemplate);
    feather.replace();
  });

  $('#steps').on('click', '.removeStep', function() {
    $(this).closest('.step').remove();

    $('.step').each(function(index, step) {
      $(step).find('.stepNum').text(index);
    });
  });
});