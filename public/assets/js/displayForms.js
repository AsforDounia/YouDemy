function hideElement($id){
    const element = document.getElementById($id);
    element.classList.add('hidden');
}

function displaySelectedOptions() {
    const selectElement = document.getElementById('multi-select');
    console.log(selectElement);
    const selectedOptions = Array.from(selectElement.selectedOptions).map(option => option.text);
    console.log(selectedOptions);

    const selectedOptionsValue = Array.from(selectElement.selectedOptions).map(option => option.value);
    console.log(selectedOptionsValue);


    const displayDiv = document.getElementById('selected-options');
    console.log(displayDiv);

    const selectedOptionsInput = document.getElementById('selectedOptions');
    let currentContent = displayDiv.textContent;
    let currentInput = selectedOptionsInput.value;
    let optionRemoved = false;
    selectedOptions.forEach(option => {
        if (currentContent.includes(option)) {
            currentContent = currentContent.replace(option, '').replace(/,\s*,/g, ',').trim();
            currentInput = currentInput.replace(option, '').replace(/,\s*,/g, ',').trim();
            optionRemoved = true;
            return;
        }
    });
    selectedOptionsValue.forEach(option => {
        if (currentInput.includes(option)) {
            currentInput = currentInput.replace(option, '').replace(/,\s*,/g, ',').trim();
            optionRemoved = true;
            return;
        }
    });

    if(optionRemoved){
        displayDiv.textContent = currentContent;
        selectedOptionsInput.value = currentInput;
    }
    else{
        displayDiv.textContent = currentContent + (currentContent ? ' , ' : '') + selectedOptions.join(', ');
        selectedOptionsInput.value = currentInput + (currentInput ? ', ' : '') + selectedOptionsValue.join(', ');
    }
    
}