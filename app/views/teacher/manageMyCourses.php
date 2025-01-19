

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
    <?php include(__DIR__.'/../admin/partials/header.php'); ?>
        <!-- Main Content -->
        <div class="flex flex-col flex-1 lg:ml-64">
        <?php include(__DIR__.'/../admin/partials/sidebar.php'); ?>
            <!-- Main -->
            <main class="flex-1 bg-gray-100 min-h-screen overflow-y-auto pt-24 px-20">
            <div id="courses-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($data['courses'] as $course): ?>
                <div class="relative bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <a href="/admin/deleteCourse/<?= $course['course_id'] ?>" onclick="return confirm('Are you sure you want to delete this course?');" class="absolute right-0 p-2 text-red-500 hover:underline">Delete</a>
                    <img src="https://dummyimage.com/120" alt="Course thumbnail" class="w-full h-48 object-cover">
                    <!-- <?php if ($course['content_type'] === "Video") : ?>
                        <video class="w-full overflow-y-hidden" src="../app/views/teacher/uploads/<?= $course['content_url']; ?>"></video>
                    <?php else: ?>
                        <iframe class="w-full overflow-y-hidden" src="../app/views/teacher/uploads/<?= $course['content_url']; ?>"></iframe>
                    <?php endif; ?> -->
                    <div class="pb-6">
                        <div class="flex items-center space-x-2 justify-between w-full px-4 py-1">
                            <h3 class="text-xl font-bold"><?php echo $course['title'] ?></h3>
                            <span class="px-2 py-1 bg-indigo-100 text-indigo-800 text-xs rounded-full"><?= $course['category_name']; ?></span>
                        </div>
                        <p class="text-gray-600 line-clamp-2 p-4"><?php echo $course['description'] ?></p>
                    </div>
                    <div class="pb-4">
                        <p class="text-blue-500 line-clamp-2 px-4"><?php echo $course['tag_name'] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            </main>
        </div>
    </div>


    <?php if(isset($data['form']) && $data['form'] === 'addCourse') : ?>
        <div id="teacherAddCourse" class="fixed bg-[rgba(0,0,0,0.9)] flex justify-center items-center p-6 w-screen h-screen top-0 left-0 z-50">
            <div class="bg-white p-6 pt-2 rounded-xl shadow w-1/3">
                <div class="flex justify-end items-center ">
                    <button onclick="hideElement('teacherAddCourse')"><a href="/teacher/dashboard/manageMyCourses"><i class="fas fa-times text-indigo-600 hover:text-indigo-700 transition-colors"></i></a></button>
                </div>
                <form class="space-y-6" method="POST" action="/teacher/addCourse">
                    <?php if(isset($_SESSION['error'])) : ?>
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded text-sm">
                            <?php echo $_SESSION['error']; ?>
                            <?php unset($_SESSION['error']); ?>
                        </div>
                    <?php endif ; ?>
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" id="title" name="title"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2"
                            placeholder="Course Title">
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea id="description" name="description"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2"
                            placeholder="Course Description"></textarea>
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                        <select id="category" name="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2">
                            <?php foreach ($data['categories'] as $category): ?>
                                <option value="<?php echo $category['category_id'] ?>"><?php echo $category['category_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <div>

                            <label for="multi-select" class="text-sm font-medium text-gray-700">Tags</label>
                            <span id="selected-options" class="mt-2 text-sm text-gray-500">
                                Selected:
                            </span>
                        </div>
                        <input type="hidden" name="tags" id="selectedOptions" value="">
                        <select id="multi-select" name="" multiple class="h-16 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2" onchange="displaySelectedOptions()">
                            <?php foreach ($data['tags'] as $tag): ?>
                                <option value="<?php echo $tag['tag_id'] ?>"><?php echo $tag['tag_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div >

                        <label for="type" class="block text-sm font-medium text-gray-700">Content Type</label>
                        <select id="type" name="type"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2">
                            <option value="Video">Video</option>
                            <option value="Document">Document</option>
                        </select>
                    </div>
                        <div>
                            <label for="cdn" class="block text-sm font-medium text-gray-700">Link</label>
                            <input type="text" id="cdn" name="cdn" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2" />

                        </div>

                        <div>
                            <button type="submit"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Create Course
                            </button>
                        </div>
    
                </form>
            </div>
        </div>
    <?php endif ?>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <script src="/assets/js/displayForms.js"></script>

</body>

</html>


