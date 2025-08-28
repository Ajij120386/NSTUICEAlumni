
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Alumni Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #dbeafe, #f8fafc);
            font-family: 'Segoe UI', sans-serif;
          margin: 0;
      padding: 0;  
        }
          

        .dashboard-wrapper { max-width: 1200px; margin: auto; }
        .glass-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.85);
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 30px;
        }
        .dashboard-header {
            background: linear-gradient(90deg, #4f46e5, #3b82f6);
            color: white;
            padding: 20px 30px;
            font-size: 28px;
            font-weight: bold;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            text-align: center;
        }
        .dashboard-tile {
            display: block;
            color: white;
            padding: 30px 20px;
            border-radius: 15px;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s ease-in-out;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .dashboard-tile:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
        }
        /* Style for the icon */
        .tile-icon {
            font-size: 42px;
            margin-bottom: 15px;
        }
        /* Style for Batch Number */
        .tile-batch-number {
            font-size: 22px;
            font-weight: bold;
        }
        /* Style for Batch Name */
        .tile-batch-name {
            font-size: 18px;
            margin-top: 5px;
        }
     
        .btn-back {
            background-color: white;
            color: #4f46e5;
            font-weight: 600;
            border-radius: 6px;
            border: none;
            transition: 0.3s ease;
        }
        .btn-back:hover { background-color: #e0e7ff; }
    </style>
</head>
<body>

<?php
// ✅ Corrected Array of Batch names
$batch_names = [
    1 => 'শুকতারা',
    2 => 'PHOENIX',
    3 => 'STALWART 52',
    4 => 'HASTA LA VISTA',
    5 => 'HAKUNA MATATA',
    6 => 'কৃষ্ণচূড়া',
    7 => 'সংবৃত্ত', // Corrected
    8 => 'শতরঞ্জ-৮'
];

// Array of background colors for the tiles
$bg_colors = ['bg-primary', 'bg-success', 'bg-info', 'bg-danger', 'bg-secondary', 'bg-dark', 'bg-primary', 'bg-success'];
?>

<?php
include 'header.php';
?>


<div class="container mt-4 dashboard-wrapper">
    <!-- 🔙 Back + Title -->
    

    <!-- 📘 Alumni Dashboard -->
    <div class="glass-card">
        <div class="dashboard-header">🎓 Alumni Batches</div>
        <div class="row g-4 mt-2">
            <?php
            $color_index = 0;
            foreach ($batch_names as $batch_number => $batch_name) {
                $current_bg = $bg_colors[$color_index % count($bg_colors)];

                // ✅ LOGIC CHANGE: If it's the last two batches (7 or 8), make them wider
                if ($batch_number >= 7) {
                    $column_class = 'col-md-6 col-sm-6';
                } else {
                    $column_class = 'col-md-4 col-sm-6';
                }
                ?>
                <div class="<?php echo $column_class; ?>">
                    <a href="alumni_info.php?batch=<?php echo $batch_number; ?>" class="dashboard-tile <?php echo $current_bg; ?>">
                        <!-- ✅ LAYOUT CHANGE: Stacked icon, number, and name -->
                        <div class="tile-icon">🎓</div>
                        <div class="tile-batch-number">Batch <?php echo $batch_number; ?></div>
                        <div class="tile-batch-name"><?php echo $batch_name; ?></div>
                    </a>
                </div>
                <?php
                $color_index++;
            }
            ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>