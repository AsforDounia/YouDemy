<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <h1>Admin Dashboard</h1>
    <div>
        <h2>Total Users: <?= $totalUsers; ?></h2>
        <h3>Recent Activities:</h3>
        <ul>
            <?php foreach ($recentActivities as $activity): ?>
                <li><?= htmlspecialchars($activity); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
