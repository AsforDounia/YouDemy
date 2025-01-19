<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

    <title>Youdemy Platform</title>
</head>

<body>

    <div class="flex">
    <?php include(__DIR__.'/../admin/partials/header.php'); ?>
        <div class="flex flex-col flex-1 lg:ml-64">
        <?php include(__DIR__.'/../admin/partials/sidebar.php'); ?>
            <!-- Main -->
            <main class="flex-1 bg-gray-100 min-h-screen overflow-y-auto py-24">
                <div class="w-full">
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 p-6">
                        
                        <!-- Enrollments Card -->
                        <div  onclick="window.location.href='/teacher/dashboard/totalEnrollments'" class="bg-white p-6 rounded-xl shadow cursor-pointer hover:shadow-lg">
                            <div class="flex items-center">
                                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-users fa-2x fa-inverse text-black "></i>
                                </div>
                                <span class="text-2xl font-bold ml-auto"><?= $data['totalEnrollments'] ?></span>
                            </div>
                            <p class="text-gray-500 mt-4">Total Enrollments</p>
                        </div>
                        
                        <!-- Courses Card -->
                        <div onclick="window.location.href='/dashboard/manageCourses'" class="bg-white p-6 rounded-xl shadow cursor-pointer hover:shadow-lg">
                            <div class="flex items-center">
                                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-book-open fa-2x text-black"></i>
                                </div>
                                <span class="text-2xl font-bold ml-auto"><?= $data['totalCourses'] ?></span>
                            </div>
                            <p class="text-gray-500 mt-4">Total Courses</p>
                        </div>
          

              
                        <!-- Most Popular course -->
                        <div onclick="window.location.href='/dashboard/manageCourses'" class="bg-white p-6 rounded-xl shadow cursor-pointer hover:shadow-lg">
                            <div class="flex items-center">
                                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-award fa-2x text-black"></i>
                                </div>
                                <span class="ml-auto">
                                    <?php
                                        if($data['mostPopularCourse']){
                                            echo $data['mostPopularCourse']['title'];
                                        }
                                    ?>
                                </span>
                            </div>
                            <p class="text-gray-500 mt-4">Most Popular Course</p>
                        </div>

                        <!-- Add Course Card -->
                        <div onclick="window.location.href='/dashboard/addCourse'" class="bg-white p-6 rounded-xl shadow cursor-pointer hover:shadow-lg">
                            <div class="flex items-center">
                                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-plus fa-2x text-black"></i>
                                </div>
                                <span class="text-2xl font-bold ml-auto"></span>
                            </div>
                            <p class="text-gray-500 mt-4">Add New Course</p>
                        </div>
                    </div>
                    
                    <!-- Bottom Section -->
                    <div class="grid grid-cols-1 p-6">
                        <!-- New Courses -->
                        <div class="bg-white p-6 rounded-xl shadow">
                            <h2 class="text-xl font-bold mb-4">Distribution Of Courses By Enrollments</h2>
                            <!-- Add your activities content here -->
                            <div class="space-y-4">
                            <?php
                                if($data['distributionOfCourses']) :
                                    foreach($data['distributionOfCourses'] as $distributionOfCourse) : ?>
                                        <div class="p-4 bg-gray-100 rounded-lg flex justify-between">
                                            <span>
                                                <?= $distributionOfCourse['title'] ?>
                                            </span>
                                            <span>
                                                <?= $distributionOfCourse['total_students'] ?>
                                            </span>
                                        </div>
                                    <?php
                                    endforeach ;
                                endif ;
                            ?>
                            </div>
                        </div>

                    </div>
                    </div>

                </div>

            </main>
        </div>
    </div>
    <script src="/assets/js/displayForms.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
</body>

</html>


