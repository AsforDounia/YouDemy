

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
    <div class="container mx-auto px-4 py-0">
        <!-- Header Section -->
        <div class="mb-8 fixed z-50 w-full">
            <h1 class="absolute -top-20 text-3xl font-bold text-gray-800">My Courses and Enrollments</h1>
        </div>

        <!-- Course Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
            <?php foreach ($data as $courseId => $courseDetails): ?>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <!-- Course Header -->
                    <div class="bg-blue-600 p-4">
                        <h2 class="text-xl font-semibold text-white">
                            <?= htmlspecialchars($courseDetails['course_title'] ?? 'Title unavailable') ?>
                        </h2>
                        <p class="text-blue-100 text-sm mt-1">
                            <?= htmlspecialchars($courseDetails['category_name'] ?? 'Category unknown') ?>
                        </p>
                    </div>

                    <!-- Course Content -->
                    <div class="p-4">
                        <!-- Course Stats -->
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div class="text-center p-2 bg-gray-50 rounded">
                                <p class="text-2xl font-bold text-blue-600">
                                    <?= isset($courseDetails['enrollments']) ? count($courseDetails['enrollments']) : 0 ?>
                                </p>
                                <p class="text-sm text-gray-600">Students</p>
                            </div>
                            <div class="text-center p-2 bg-gray-50 rounded">
                                <p class="text-2xl font-bold text-blue-600">
                                <?php
                                    $completed = empty($courseDetails['enrollments']) ? [] : array_filter($courseDetails['enrollments'], function($enrollment) {
                                        return $enrollment['status'] === 'Completed';
                                    });
                                    echo count($completed);
                                    ?>
                                </p>
                                <p class="text-sm text-gray-600">Completed</p>
                            </div>
                        </div>

                        <!-- Content Type Badge -->
                        <div class="mb-4">
                            <?php if (($courseDetails['content_type'] ?? '') === 'Video'): ?>
                                <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">
                                    <i class="fas fa-video mr-1"></i> Video
                                </span>
                            <?php else: ?>
                                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">
                                    <i class="fas fa-file mr-1"></i> Document
                                </span>
                            <?php endif; ?>
                        </div>

                        <!-- Students List -->
                        <div class="mt-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Students List</h3>
                            <div class="space-y-2 h-32 overflow-y-auto">
                                <?php
                                foreach ($courseDetails['enrollments'] as $enrollment):
                                ?>
                                    <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded">
                                        <div>
                                            <p class="text-sm font-medium text-gray-800">
                                                <?= htmlspecialchars($enrollment['student_name'] ?? 'Name unknown') ?>
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                <?= htmlspecialchars($enrollment['enrollment_date'] ?? 'Date unknown') ?>
                                            </p>
                                        </div>
                                        <span class="<?= ($enrollment['status'] ?? '') === 'Completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' ?> text-xs px-2 py-1 rounded-full">
                                            <?= htmlspecialchars($enrollment['status'] ?? 'Status unknown') ?>
                                        </span>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <!-- View All Link -->
                            <?php if (isset($courseDetails['enrollments']) && count($courseDetails['enrollments']) > 3): ?>
                                <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium mt-3 block text-center">
                                    View all students (<?= count($courseDetails['enrollments']) ?>)
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>


        </div>
    </div>
</body>
</html>
