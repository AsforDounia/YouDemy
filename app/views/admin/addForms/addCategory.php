<form id="addCategory" action="/admin/addCategory" method="POST" class="space-y-4">
    <div>
        <label for="categoryName" class="block text-lg font-semibold text-gray-700 mb-4">Category Name</label>
        <div class="relative">
            <input type="text" id="categoryName" name="categoryName" placeholder="Enter The Category Name"
                class="w-full px-6 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" required>
           
        </div>
    </div>


    <!-- Submit Button -->
    <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition-colors flex items-center justify-center space-x-2">
        <span>Add Category</span>
        <i class="fas fa-arrow-right text-sm"></i>
    </button>
</form>