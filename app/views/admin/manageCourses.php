<?php require_once 'partials/header.php'; ?>



        <?php require_once 'partials/sidebar.php'; ?>
        <div class="flex justify-center w-full h-screen pt-8">
            <div class="bg-white p-6 rounded-xl shadow">
            <table>
                <thead>
                    <tr>
                        <th class="border-2 px-4 py-2">Teacher</th>
                        <!-- <th class="border-2 px-4 py-2">Course ID</th> -->
                        <th class="border-2 px-4 py-2">Course Title</th>
                        <th class="border-2 px-4 py-2">Course description</th>
                        <th class="border-2 px-4 py-2">Content Url</th>
                        <th class="border-2 px-4 py-2">Course Type</th>
                        <th class="border-2 px-4 py-2">Category</th>
                        <th class="border-2 px-4 py-2">Created_at</th>
                        <th class="border-2 px-4 py-2">Updated_at</th>
                        <th class="border-2 px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody >
                    <?php foreach($data['courses'] as $course): ?>
                        <tr>
                            <td class="border-2 px-4 py-2"><?= $course['full_name']; ?></td>
                            <!-- <td class="border-2 px-4 py-2"><?= $course['course_id']; ?></td> -->
                            <td class="border-2 px-4 py-2"><?= $course['title']; ?></td>
                            <td class="border-2 px-4 py-2"><?= $course['description']; ?></td>
                            <td class="border-2 px-4 py-2"><?= $course['content_url']; ?></td>
                            <td class="border-2 px-4 py-2"><?= $course['course_type']; ?></td>
                            <td class="border-2 px-4 py-2"><?= $course['category_name']; ?></td>
                            <td class="border-2 px-4 py-2"><?= $course['created_at']; ?></td>
                            <td class="border-2 px-4 py-2"></td>
                            <!-- <td class="border-2 px-4 py-2"> -->
                                <?php 
                                    // echo $course['updated_at']; 
                                ?>
                            <!-- </td> -->
                            <td class="border-2 px-4 py-2">
                                <a href="/admin/deleteCourse/<?=$course['course_id']?>" class="py-2 px-4"><i class="hover:text-red-700 fas fa-trash text-red-500"></i></a>
                            </td>
                            

                          

                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
        </div>

    </div>

    <?php if(isset($data['user_id'])) : ?>
        <div id="quickAction" class="fixed bg-[rgba(0,0,0,0.9)] flex justify-center items-center p-6 w-screen h-screen top-0 left-0 z-50">
            <div class="bg-white p-6 pt-2 rounded-xl shadow">
                <div class="flex justify-end items-center ">
                    <button onclick="hideElement('quickAction')"><i class="fas fa-times text-indigo-600 hover:text-indigo-700 transition-colors"></i></button>

                </div>
            <?php require_once 'addForms/editUserRole.php'; ?>
        </div>
        </div>
    <?php endif ?>
</body>
<script src="/assets/js/displayForms.js"></script>
</html>