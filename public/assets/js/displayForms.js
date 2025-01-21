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


function searchCourses(query) {
    if (query.length === 0) {
        window.location.reload();
        return;
    }
  
    fetch(`/search-ajax?query=${query}`)
    .then((response) => response.json())
    .then((data) => {
        
        const coursesContainer = document.getElementById("courses-container");
        coursesContainer.innerHTML = "";
        
        data.courses.forEach((course) => {
          const courseElement = document.createElement("div");
          courseElement.classList.add(
            "relative",
            "cursor-pointer",
            "bg-white",
            "rounded-xl",
            "shadow-md",
            "overflow-hidden",
            "hover:shadow-lg",
            "transition-shadow",
            "group"
          );
          courseElement.innerHTML = `
            <div onclick="window.location.href='/login'" class="absolute w-full h-full  justify-center items-center bg-opacity-80 hidden top-0 right-0 p-4 bg-blue-800 text-white group-hover:flex">
                Log in to see the Content
            </div>
            <img src="https://dummyimage.com/120" alt="Course thumbnail" class="w-full h-48 object-cover">
            <div class="h-28">
                <div class="flex items-center space-x-2 justify-between w-full px-4 py-1">
                    <h3 class="text-xl font-bold">${course.title}</h3>
                    <span class="px-2 py-1 bg-indigo-100 text-indigo-800 text-xs rounded-full">${course.category_name}</span>
                </div>
                <p class="text-gray-600 line-clamp-2 p-4">${course.description}</p>
            </div>
            <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2 justify-between w-full px-4 py-1">
                            <span class="text-sm text-gray-600">${course.full_name}</span>
                            <?php if (!$course['profile_picture']): ?>
                                <div class="w-14 h-14 flex items-center justify-center bg-gray-200 text-gray-500 text-xs rounded-full">
                                    No Pic
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
            <div class="pb-4 flex justify-between items-center px-4">
                <p class="text-blue-500 line-clamp-2 px-4">${course.tag_name}</p>
                <div>
                </div>
            </div>
          `;
          coursesContainer.appendChild(courseElement);
        });
      })
      .catch((error) => console.error("Error fetching courses:", error));
  }