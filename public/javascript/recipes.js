    // フォームの追加
    const ingredients = document.getElementById('ingredients');

    const ingredientsAdd = document.getElementById('ingredients-add');
    ingredientsAdd.addEventListener('click', function() {
      const newInputsHTML = `
        <div class="ingredients-inputs">
            <input type="text" name="name[]" placeholder="食材">
            <input type="text" name="quantity[]" placeholder="量">
        </div>
    `;
    ingredients.insertAdjacentHTML('beforeend', newInputsHTML);
});

    // フォームの削除
    const ingredientsRemove = document.getElementById('ingredients-remove');
    ingredientsRemove.addEventListener('click', function() {
        const lastInputs = ingredients.querySelector('.ingredients-inputs:last-of-type');
        if (lastInputs) {
            ingredients.removeChild(lastInputs);
        }
    });
    
    //手順
const instructionsContainer = document.getElementById('instructions');

const addInstructions = document.getElementById('instructions-add');
addInstructions.addEventListener('click', function() {
    const newInstructionsHTML = `
        <div class="instructions-inputs">
            <input type="text" name="instructions_text[]" placeholder="手順">
            <input type="file" name="instructions_file[]" placeholder="ファイル" multiple>
        </div>
    `;
    instructionsContainer.insertAdjacentHTML('beforeend', newInstructionsHTML);
});

// フォームの削除
const removeInstructions = document.getElementById('instructions-remove');
removeInstructions.addEventListener('click', function() {
    const lastInstructions = instructionsContainer.querySelector('.instructions-inputs:last-of-type');
    if (lastInstructions) {
        instructionsContainer.removeChild(lastInstructions);
    }
});
