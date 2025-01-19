<!-- Sidebar -->
<div id="sidebar" class="fixed top-0 left-0 h-full w-64 bg-white z-40 transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
    <div class="flex items-center justify-start h-20">
        <span class="">
            <i class="fas fa-headset fa-2x fa-inverse text-black p-5"></i>
        </span>
        <span>
            Hi, <?=$_SESSION['user']['name']?>
        </span>
    </div>
    <ul class="flex flex-col py-8 pl-4">

        <!-- admin links -->
        <?php if ($_SESSION['user']['role'] === "Admin"): ?>
            <li>
                <a href="/admin/dashboard" class="flex items-center h-12 text-gray-500 hover:text-gray-800">
                    <i class="bx bx-home text-lg text-gray-400 w-12"></i>
                    <span class="text-sm font-medium">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="/admin/dashboard/manageUsers" class="flex items-center h-12 text-gray-500 hover:text-gray-800">
                    <i class="bx bx-user text-lg text-gray-400 w-12"></i>
                    <span class="text-sm font-medium">Users</span>
                </a>
            </li>

            <li>
                <a href="/admin/dashboard/manageCourses" class="flex items-center h-12 text-gray-500 hover:text-gray-800">
                    <i class="bx bx-book text-lg text-gray-400 w-12"></i>
                    <span class="text-sm font-medium">Courses</span>
                </a>
            </li>

            <li>
                <a href="/admin/dashboard/manageCategories" class="flex items-center h-12 text-gray-500 hover:text-gray-800">
                    <i class="bx bx-category text-lg text-gray-400 w-12"></i>
                    <span class="text-sm font-medium">Categories</span>
                </a>
            </li>

            <li>
                <a href="/admin/dashboard/manageTags" class="flex items-center h-12 text-gray-500 hover:text-gray-800">
                    <i class="bx bx-tag text-lg text-gray-400 w-12"></i>
                    <span class="text-sm font-medium">Tags</span>
                </a>
            </li>


        <?php elseif ($_SESSION['user']['role'] === "Teacher"): ?>
            <li>
                <a href="/teacher/dashboard" class="flex items-center h-12 text-gray-500 hover:text-gray-800">
                    <i class="bx bx-home text-lg text-gray-400 w-12"></i>
                    <span class="text-sm font-medium">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="/teacher/dashboard/manageCourses" class="flex items-center h-12 text-gray-500 hover:text-gray-800">
                    <i class="bx bx-book text-lg text-gray-400 w-12"></i>
                    <span class="text-sm font-medium">My Courses</span>
                </a>
            </li>
            <li>
                <a href="/teacher/addCourse" class="flex items-center h-12 text-gray-500 hover:text-gray-800">
                <i class="bx bx-plus text-lg text-gray-400 w-12"></i>
                    <span class="text-sm font-medium">Add Course</span>
                </a>
            </li>
        <?php endif ?>

    </ul>
</div>