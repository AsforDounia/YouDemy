<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

    <title>Youdemy Platform</title>
</head>

<body>
    <div class="flex">
        <?php include('partials/header.php'); ?>
        <!-- Main Content -->
        <div class="flex flex-col flex-1 lg:ml-64">
            <?php include('partials/sidebar.php'); ?>
            <!-- Main -->
            <main class="flex-1 bg-gray-100 min-h-screen overflow-y-auto pt-24 px-20">
                <!-- <button onclick="openModal('add')" class="px-4 py-2 text-sm font-bold text-white bg-[#2E5077] border-2 border-[#2E5077] rounded transition hover:bg-transparent hover:text-[#2E5077] float-right">
                    Add Category
                </button> -->
                <a href="/admin/displayForm/addCategory"  class="px-4 py-2 text-sm font-bold text-white bg-[#2E5077] border-2 border-[#2E5077] rounded transition hover:bg-transparent hover:text-[#2E5077] float-right">Add Category</a>
                <h1 class="text-xl font-bold text-gray-700 my-10">Categories</h1>
                <?php
                    if (isset($_SESSION["add_category_error"])) {
                        echo "<p class='text-red-500'>" . $_SESSION["add_category_error"] . "</p>";
                        unset($_SESSION["add_category_error"]); // Unset the session variable after displaying
                    }
                ?>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-5">
                    <?php foreach ($categories as $category): ?>
                        <div class="bg-white border border-gray-300 rounded-lg shadow-md p-4">
                            <!-- Category Name -->
                            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                                <?php echo htmlspecialchars($category['category_name']); ?>
                            </h3>

                            <!-- Action -->
                            <div class="flex justify-between">
                                <a href="/admin/displayForm/editCategory" class="text-blue-500 hover:underline">Edit</a>
                                <?php if(isset($data['formEditCat'])) : ?>
                                    <div id="editCat" class="fixed bg-[rgba(0,0,0,0.9)] flex justify-center items-center p-6 w-screen h-screen top-0 left-0 z-50">
                                        <div class="bg-white p-6 pt-2 rounded-xl shadow w-1/3">
                                            <div class="flex justify-end items-center ">
                                                <button onclick="hideElement('editCat')"><a href="/admin/dashboard/manageCategories"><i class="fas fa-times text-indigo-600 hover:text-indigo-700 transition-colors"></i></a></button>
                                            </div>
                                            <form id="editCategory" action="/admin/editCategory" method="POST" class="space-y-4">
                                                <input type="hidden" name="category_id" value="<?php echo $category['category_id']; ?>">
                                                <div>
                                                    <label for="categoryName" class="block text-lg font-semibold text-gray-700 mb-4">Category New Name</label>
                                                    <div class="relative">
                                                        <input value="<?php echo htmlspecialchars($category['category_name']); ?>" type="text" id="categoryName" name="categoryName" placeholder="Enter The Category Name"
                                                            class="w-full px-6 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" required>
                                                    </div>
                                                </div>


                                                <!-- Submit Button -->
                                                <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition-colors flex items-center justify-center space-x-2">
                                                    <span>Edit Category</span>
                                                    <i class="fas fa-arrow-right text-sm"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                <?php endif ?>














                                <a onclick="return confirm('Are you sure you want to delete this category?');" href="/admin/deleteCategory/<?=$category['category_id']?>" class="text-red-500 hover:underline">Delete</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </main>
        </div>
    </div>
    <?php if(isset($data['formAddCat'])) : ?>
        <div id="addCat" class="fixed bg-[rgba(0,0,0,0.9)] flex justify-center items-center p-6 w-screen h-screen top-0 left-0 z-50">
            <div class="bg-white p-6 pt-2 rounded-xl shadow w-1/3">
                <div class="flex justify-end items-center ">
                    <button onclick="hideElement('addCat')"><a href="/admin/dashboard/manageCategories"><i class="fas fa-times text-indigo-600 hover:text-indigo-700 transition-colors"></i></a></button>

                </div>
                <?php require_once 'addForms/addCategory.php'; ?>
            </div>
        </div>
    <?php endif ?>
    <?php if(isset($data['editCat'])) : ?>
        <div id="editCat" class="fixed bg-[rgba(0,0,0,0.9)] flex justify-center items-center p-6 w-screen h-screen top-0 left-0 z-50">
            <div class="bg-white p-6 pt-2 rounded-xl shadow w-1/3">
                <div class="flex justify-end items-center ">
                    <button onclick="hideElement('editCat')"><a href="/admin/dashboard/manageCategories"><i class="fas fa-times text-indigo-600 hover:text-indigo-700 transition-colors"></i></a></button>
                </div>
                <?php require_once 'addForms/editCategory.php'; ?>
            </div>
        </div>
    <?php endif ?>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <script src="/assets/js/displayForms.js"></script>

</body>

</html>
