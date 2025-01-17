<?php require_once 'partials/header.php'; ?>



        <?php require_once 'partials/sidebar.php'; ?>
        <div class="flex justify-center w-full h-screen pt-8">
            <div class="bg-white p-6 rounded-xl shadow">
            <table>
                <thead>
                    <tr>
                        <th class="border-2 px-4 py-2">Picture</th>
                        <th class="border-2 px-4 py-2">ID</th>
                        <th class="border-2 px-4 py-2">Full Name</th>
                        <th class="border-2 px-4 py-2">Email</th>
                        <th class="border-2 px-4 py-2">Role</th>
                        <th class="border-2 px-4 py-2">Compte Status</th>
                        <th class="border-2 px-4 py-2">Created_at</th>
                        <th class="border-2 px-4 py-2">Updated_at</th>
                        <th class="border-2 px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody >
                    <?php foreach($data['users'] as $user): ?>
                        <?php if($user['status'] == 'Disabled'){
                            $textColor = "text-red-600" ;
                        }
                        else{
                            $textColor = "text-green-600" ;
                        }
                        ?>
                        <tr>
                            <td class="border-2 px-4 py-2"><?= $user['profile_picture']; ?></td>
                            <td class="border-2 px-4 py-2"><?= $user['user_id']; ?></td>
                            <td class="border-2 px-4 py-2"><?= $user['full_name']; ?></td>
                            <td class="border-2 px-4 py-2"><?= $user['email']; ?></td>
                            <td class="border-2 px-4 py-2"><?= $user['role']; ?></td>
                            <td class="border-2 px-4 py-2"><a class=<?= $textColor ?> href="/admin/changeStatusOfUser/<?=$user['user_id']?>"> <?= $user['status']; ?></a></td>
                            <td class="border-2 px-4 py-2"><?= $user['created_at']; ?></td>
                            <td class="border-2 px-4 py-2"><?= $user['updated_at']; ?></td>
                            <td class="border-2 px-4 py-2">
                                <a href="/admin/displayRoleForm/<?= $user['user_id']; ?>" class="py-2 px-4"><i class="hover:text-blue-700 fas fa-pencil-alt text-blue-500"></i></a>
                                <span>|</span>
                                <a href="/admin/deleteUser/<?=$user['user_id']?>" class="py-2 px-4"><i class="hover:text-red-700 fas fa-trash text-red-500"></i></a>
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