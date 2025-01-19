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
        <?php include('partials/header.php'); ?>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 lg:ml-64">
            <?php include('partials/sidebar.php'); ?>
            <!-- Main -->
            <main class="flex-1 bg-gray-100 min-h-screen overflow-y-auto py-24">
                <div class="w-full">
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 p-6">
                        
                        <!-- Users Card -->
                        <div  onclick="window.location.href='/admin/dashboard/manageUsers'" class="bg-white p-6 rounded-xl shadow cursor-pointer hover:shadow-lg">
                            <div class="flex items-center">
                                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-users fa-2x fa-inverse text-black"></i>
                                </div>

                                <span class="text-2xl font-bold ml-auto"><?=$data['totalUsers'] ?></span>
                            </div>
                            <p class="text-gray-500 mt-4">Total Users</p>
                        </div>
                        
                        <!-- Courses Card -->
                        <div onclick="window.location.href='/admin/dashboard/manageCourses'" class="bg-white p-6 rounded-xl shadow cursor-pointer hover:shadow-lg">
                            <div class="flex items-center">
                                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-book-open fa-2x text-black"></i>
                                </div>
                                <span class="text-2xl font-bold ml-auto"><?=$data['totalCourses']?></span>
                            </div>
                            <p class="text-gray-500 mt-4">Total Courses</p>
                        </div>
                        
                        <!-- Categories Card -->
                        <div onclick="window.location.href='/admin/dashboard/manageCategories'" class="bg-white p-6 rounded-xl shadow cursor-pointer hover:shadow-lg">
                            <div class="flex items-center">
                                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-th-large fa-2x text-black"></i>
                                </div>
                                <span class="text-2xl font-bold ml-auto"><?=$data['CategoriesCount']?></span>
                            </div>
                            <p class="text-gray-500 mt-4">Total Categories</p>
                        </div>

                        <!-- Tags Card -->
                        <div onclick="window.location.href='/admin/dashboard/manageTags'" class="bg-white p-6 rounded-xl shadow cursor-pointer hover:shadow-lg">
                            <div class="flex items-center">
                                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-tags fa-2x text-black"></i>
                                <!-- <i class="fas fa-box fa-2x fa-inverse text-black"></i> -->
                                </div>
                                <span class="text-2xl font-bold ml-auto"><?=$data['TagsCount']?></span>
                            </div>
                            <p class="text-gray-500 mt-4">Total Tags</p>
                        </div>

                        <!-- top teachers -->
                        <div onclick="window.location.href='/admin/dashboard/manageUsers'" class="bg-white p-6 rounded-xl shadow cursor-pointer hover:shadow-lg">
                            <div class="flex items-center">
                                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-star fa-2x fa-inverse text-black"></i>

                                </div>
                                <div class="ml-auto">
                                    <?php
                                    if($data['Top3Teachers']) :
                                    foreach($data['Top3Teachers'] as $teacher) : ?>
                                        <div><?=$teacher['full_name']?></div>
                                    <?php endforeach;
                                    endif ;?>
                                </div>
                        
                            </div>
                            <p class="text-gray-500 mt-4">Top 3 Teachers</p>
                        </div>
                        <!-- Pending Teachers Card -->
                        <div onclick="window.location.href='/admin/dashboard/manageUsers'" class="bg-white p-6 rounded-xl shadow cursor-pointer hover:shadow-lg">
                            <div class="flex items-center">
                                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-chalkboard-teacher fa-2x fa-inverse text-black"></i>
                                </div>
                                <span class="text-2xl font-bold ml-auto"><?=$data['TotalPendingTeachers']?></span>
                            </div>
                            <p class="text-gray-500 mt-4">Pending Teachers</p>
                        </div>
                        <!-- Most Popular course -->
                        <div onclick="window.location.href='/admin/dashboard/manageCourses'" class="bg-white p-6 rounded-xl shadow cursor-pointer hover:shadow-lg">
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
                    </div>
                    
                    <!-- Bottom Section -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 p-6">
                        <!-- New Courses -->
                        <div class="bg-white p-6 rounded-xl shadow">
                            <h2 class="text-xl font-bold mb-4">Distribution Of Courses By Category</h2>
                            <!-- Add your activities content here -->
                            <div class="space-y-4">

                        <?php
                        if($data['distributionOfCourses']) :
                        foreach($data['distributionOfCourses'] as $distributionOfCourse) : ?>
                            <div class="p-4 bg-gray-100 rounded-lg flex justify-between">
                                <span>
                                    <?= $distributionOfCourse['category_name'] ?>
                                </span>
                                <span>
                                    <?= $distributionOfCourse['total_courses'] ?>
                                </span>
                            </div>
                        <?php
                        endforeach ;
                        endif ;
                        ?>
                            </div>
                        </div>
                        
                        <!-- Quick Actions -->
                        <div class="bg-white p-6 rounded-xl">
                            <h2 class="text-xl font-bold mb-4">Quick Actions</h2>
                            <div class="grid grid-cols-2 gap-4">
                                <a href="/admin/displayForm/addUser"  class="text-center p-6  bg-purple-200 rounded-lg hover:bg-purple-400  transition-colors">
                                    Add User
                                </a>
                                <a href="/admin/displayForm/addCategory" class="text-center p-6  bg-purple-200 rounded-lg hover:bg-purple-400  transition-colors">
                                    Add Categoty
                                </a>
                                <a href="/admin/displayForm/AddTagForm" class="text-center p-6 bg-purple-200 rounded-lg hover:bg-purple-400  transition-colors">
                                    Add Tag
                                </a>
                            </div>
                        </div>
                    </div>
                    </div>

                </div>

                <?php if(isset($data['form']) || isset($data['formAddTag'])) : ?>
                    <div id="quickAction" class="fixed bg-[rgba(0,0,0,0.9)] flex justify-center items-center p-6 w-screen h-screen top-0 left-0 z-50">
                        <div class="bg-white p-6 pt-2 rounded-xl shadow">
                            <div class="flex justify-end items-center ">
                                <button onclick="hideElement('quickAction')"><i class="fas fa-times text-indigo-600 hover:text-indigo-700 transition-colors"></i></button>

                            </div>
                            
                        <?php
                        if(isset($data['form'])){
                            require_once 'addForms/addUser.php';
                        }
                        if(isset($data['formAddTag'])){
                            require_once 'addForms/addTag.php';
                        }
                        ?>
                    </div>
                    </div>
                <?php endif ?>
            </main>
        </div>
    </div>
    <script src="/assets/js/displayForms.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
</body>

</html>


