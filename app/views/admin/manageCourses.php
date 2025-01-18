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
            <div id="courses-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($data['courses'] as $course): ?>
                <div class="relative bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <a href="/admin/deleteCourse/<?= $course['course_id'] ?>" onclick="return confirm('Are you sure you want to delete this course?');" class="absolute right-0 p-2 text-red-500 hover:underline">Delete</a>
                    <!-- <?php if ($course['content_url'] != null): ?>
                        <img src="<?= $course['content_url'] ?>" alt="<?= $course['title'] ?>" class="w-full h-48 object-cover">
                    <?php else: ?>
                        <img src="https://dummyimage.com/120" alt="Course thumbnail" class="w-full h-48 object-cover">
                    <?php endif; ?> -->
                    <img src="https://dummyimage.com/120" alt="Course thumbnail" class="w-full h-48 object-cover">
 
                    <div class="">
                        <div class="flex items-center space-x-2 justify-between w-full p-4 ">
                            <h3 class="text-xl font-bold"><?php echo $course['title'] ?></h3>
                            <span class="px-2 py-1 bg-indigo-100 text-indigo-800 text-xs rounded-full"><?= $course['category_name']; ?></span>
                        </div>
                        <p class="text-gray-600 line-clamp-2 px-4"><?php echo $course['description'] ?></p>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2 justify-between w-full px-4 py-1">
                            <span class="text-sm text-gray-600"><?= $course['full_name']; ?></span>
                            <?php if (!$course['profile_picture']): ?>
                                <div class="w-14 h-14 flex items-center justify-center bg-gray-200 text-gray-500 text-xs rounded-full">
                                    No Pic
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            </main>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <script src="/assets/js/displayForms.js"></script>

</body>

</html>


