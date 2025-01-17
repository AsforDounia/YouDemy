<?php
// if (strpos($_SERVER['REQUEST_URI'], 'manageUsers') !== false){
//     echo $_SERVER['REQUEST_URI'];
// }
?>


<div class="bg-purple-200 w-1/6 h-screen p-8 text-black  p-8">
    <div class="pb-16">
        <button class="drop-button  py-2 px-2"> <span class="pr-2"><i class="em em-grinning"></i></span> Hi, <?=$_SESSION['user']['name']?> <svg class="h-3 fill-current inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            </svg>
        </button>
    </div>

    
    <ul class="list-reset flex flex-row md:flex-col md:py-3 px-1 md:px-2 text-center md:text-left">
        <li class="mr-3 flex-1 group">
            <a href="/admin/dashboard" class="block py-1 md:py-3 pl-1 align-middle text-black no-underline border-b-2 border-black hover:border-purple-800">
                <i class="fas fa-tasks pr-0 md:pr-3 group-hover:text-purple-800 "></i><span class="pb-1 md:pb-0 text-xs md:text-base group-hover:text-purple-800  block md:inline-block">Home</span>
            </a>
        </li>
        <li class="mr-3 flex-1 group">
            <a href="/admin/dashboard/manageUsers" class="block group-hover:text-purple-800  py-1 md:py-3 pl-1 align-middle text-black no-underline border-b-2 border-black hover:border-purple-800  ">
                <i class="fas fa-tasks pr-0 md:pr-3  group-hover:text-purple-800 "></i><span class="pb-1 md:pb-0 text-xs md:text-base text-black group-hover:text-purple-800  text-black block md:inline-block">Users</span>
            </a>
        </li>
        <li class="mr-3 flex-1 group">
            <a href="/admin/dashboard/manageCourses" class="block py-1 md:py-3 pl-1 align-middle text-black no-underline border-b-2 border-gray-800 group-hover:border-purple-800 ">
                <i class="fa fa-envelope pr-0 md:pr-3 group-hover:text-purple-800 "></i><span class="pb-1 md:pb-0 text-xs md:text-base text-black group-hover:text-purple-800   block md:inline-block">Courses</span>
            </a>
        </li>
        <li class="mr-3 flex-1 group">
            <a href="#" class="block group-hover:text-purple-800  py-1 md:py-3 pl-1 align-middle text-black no-underline border-b-2 border-black hover:border-purple-800 ">
                <i class="fas fa-chart-area pr-0 md:pr-3 group-hover:text-purple-800 "></i><span class="pb-1 md:pb-0 text-xs md:text-base hover:text-purple-800  block md:inline-block">Categories</span>
            </a>
        </li>
        <li class="mr-3 flex-1 group">
            <a href="#" class="block group-hover:text-purple-800  py-1 md:py-3 pl-0 md:pl-1 align-middle text-black no-underline border-b-2 border-gray-800 hover:border-purple-800 ">
                <i class="fa fa-wallet pr-0 md:pr-3 group-hover:text-purple-800 "></i><span class="pb-1 md:pb-0 text-xs md:text-base text-black group-hover:text-purple-800  block md:inline-block">Tags</span>
            </a>
        </li>
    </ul>
</div>