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
            <main class="flex-1 bg-gray-100 min-h-screen overflow-y-auto py-24 px-20">
                <!-- <h1 class="text-xl font-bold text-gray-700 my-10">Users</h1>
                
                <div class="flex items-center justify-between space-x-4 bg-white p-4 px-8 rounded-lg shadow-md">
                   
                    <div class="flex items-center bg-gray-100 border border-gray-300 rounded px-3 w-3/4">
                        <i class="bx bx-search text-gray-400 text-lg"></i>
                        <input
                            type="text"
                            placeholder="Search..."
                            class="w-full bg-transparent border-none outline-none py-2 px-2 text-gray-800" />
                    </div>
                    
                    <select class="bg-gray-100 border border-gray-300 text-gray-800 py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 w-1/5">
                        <option value="teachers">All</option>
                        <option value="teachers">Teachers</option>
                        <option value="students">Students</option>
                    </select>
                </div> -->

                <!-- users table -->
                <table class="min-w-full table-auto bg-white border border-gray-300 rounded-lg shadow-md mt-10">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Profile Picture</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Full Name</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Email</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Role</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Status</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Created At</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700"></th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['users'] as $user): ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-8 py-2">
                                    <?php if (!$user['profile_picture']): ?>
                                        <div class="w-14 h-14 flex items-center justify-center bg-gray-200 text-gray-500 text-xs rounded-full">
                                            No Pic
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-600"><?= htmlspecialchars($user['full_name']) ?></td>
                                <td class="px-4 py-2 text-sm text-gray-600"><?= htmlspecialchars($user['email']) ?></td>
                                <td class="px-4 py-2 text-sm text-gray-600"><?= htmlspecialchars($user['role']) ?></td>
                                <td class="px-4 py-2 text-sm text-gray-600">
                                    <a class="inline-block py-1 px-2 text-xs font-semibold <?= $user['status'] === 'Active' ? 'text-green-800 bg-green-100' : 'text-yellow-800 bg-yellow-100' ?> rounded-full" href="/admin/changeStatusOfUser/<?=$user['user_id']?>"><?= $user['status']; ?></a>
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-600"><?= htmlspecialchars($user['created_at']) ?></td>
                                <td class="px-4 py-2 text-sm text-gray-600"><a href="/admin/deleteUser/<?= $user['user_id']; ?>" onclick="return confirm('Are you sure you want to delete this user?')"  class="text-red-500 hover:underline">Delete</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </main>
        </div>
    </div>
    <script src="/assets/js/displayForms.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
</body>

</html>




