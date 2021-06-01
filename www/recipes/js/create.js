$(document).ready(function() {
  var totalIngredients = $('.ingredient').length;
  var totalSteps = $('.step').length;

  $('#addIngredient').click(function() {
    console.log(totalIngredients);
    let ingredientTemplate = $(`
      <div class="ingredient border border-light rounded m-4 p-4 d-flex">
        <div class="w-50">
          <div class="form-group d-flex">
            <label for="ingredients[${totalIngredients}][name]">Name</label>
            <input required type="text" class="form-control ml-4" id="ingredients[${totalIngredients}][name]" name="ingredients[${totalIngredients}][name]" placeholder="Ingredient name ...">
          </div>
          <div class="form-group d-flex">
            <label for="ingredients[${totalIngredients}][quantity]">Quantity</label>
            <input required type="text" class="form-control ml-4" id="ingredients[${totalIngredients}][quantity]" name="ingredients[${totalIngredients}][quantity]" placeholder="Ingredient Quantity ...">
          </div>
          <div class="form-group d-flex">
            <label for="ingredients[${totalIngredients}][unit]">Unit</label>
            <select class="form-control ml-4" id="ingredients[${totalIngredients}][unit]" name="ingredients[${totalIngredients}][unit]">
              <option>cups</option>
              <option>liters</option>
              <option>grams</option>
              <option>pieces</option>
              <option>kilograms</option>
            </select>
          </div>
        </div>
        <div class="w-50 flex-row-reverse d-flex">
          <i data-feather="trash" class="removeIngredient border border-danger rounded bg-danger text-white clickable"></i>
        </div>
      </div>
    `);

    $('#ingredients').append(ingredientTemplate);
    totalIngredients++;
    feather.replace();
  });

  $('#ingredients').on('click', '.removeIngredient', function() {
    $(this).closest('.ingredient').remove();
  });

  $('#addStep').click(function() {
    let stepTemplate = $(`
      <div class="step border border-light rounded m-4 p-4">
        <div class="d-flex justify-content-between">
          <h4>Step <span class="stepNum"></span></h4>
          <i data-feather="trash" class="removeStep border border-danger rounded bg-danger text-white clickable"></i>
        </div>
        <div class="form-group">
          <label for="steps[${totalSteps}][description]">Description</label>
          <textarea class="form-control w-100" id="steps[${totalSteps}][description]" name="steps[${totalSteps}][description]" rows="3"></textarea>
        </div>
        <div class="form-group">
          <label for="steps[${totalSteps}][image_url]">Image</label>
          <input type="url" class="form-control ml-4" id="steps[${totalSteps}][image_url]" name="steps[${totalSteps}][image_url]" placeholder="www.image.com/image.png">
        </div>
      </div>
    `);
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