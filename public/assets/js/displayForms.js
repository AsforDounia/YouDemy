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
            "bg-white",
            "rounded-xl",
            "shadow-md",
            "overflow-hidden",
            "hover:shadow-lg",
            "transition-shadow"
          );
          courseElement.innerHTML = `
                      <img src="https://imgs.search.brave.com/EGqm4HJm7tNfNqNsYcEvAr0_fIb-EdneZ77mYaObBzE/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly93d3cu/c2N1LmVkdS9tZWRp/YS9tb2JpL3Nlc3Np/b24taW1hZ2VzLWFu/ZC1zY3JlZW5zaG90/cy9NQUItNTAweDUw/MC5wbmc" alt="Course thumbnail" class="w-full h-48 object-cover">
                      <div class="p-6">
                          <div class="flex items-center space-x-2 mb-2">
                              <span class="px-2 py-1 bg-indigo-100 text-indigo-800 text-xs rounded-full">Development</span>
                          </div>
                          <h3 class="text-xl font-bold mb-2">${course.title}</h3>
                          <p class="text-gray-600 mb-4 line-clamp-2">${
                            course.description
                          }</p>
                          <div class="flex items-center justify-between">
                              <div class="flex items-center space-x-2">
                                  <img src="/api/placeholder/32/32" alt="Instructor" class="w-8 h-8 rounded-full">
                                  <span class="text-sm text-gray-600">John Doe</span>
                              </div>
                              ${
                                data.user_role === "student"
                                  ? `
                                  <div class="flex items-center space -x-4">
                                      <a href="#" class="bg-white text-indigo-600 px-6 py-2 rounded-lg font-semibold hover:bg-indigo-50 transition-colors">
                                          Enroll
                                      </a>
                                  </div>
                              `
                                  : `
                                  <div class="flex items-center space-x-4">
                                      <a href="login" class="bg-red-50 text-red-600 px-6 py-2 rounded-lg font-semibold hover:bg-red-100 transition-colors">
                                          Log In First
                                      </a>
                                  </div>
                              `
                              }
                          </div>
                      </div>
                  `;
          coursesContainer.appendChild(courseElement);
        });
      })
      .catch((error) => console.error("Error fetching courses:", error));
  }