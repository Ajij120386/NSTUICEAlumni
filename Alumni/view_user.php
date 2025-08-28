<?php


include 'header.php';

include 'conn.php';

// Get ID from URL
if (isset($_GET['id'])) {
    $alumni_id = intval($_GET['id']); // safety
} else {
    die("No alumni ID provided.");
}

// Fetch alumni by ID
$sql = "SELECT * FROM alumni_info WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $alumni_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("No alumni found with this ID.");
}

$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($row['name']) ?> - Alumni Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
               margin: 0;
      padding: 0;  
        }


            .profile-container {
        display: flex;
        justify-content: center; /* Horizontally centers the card */
        align-items: center;   /* Vertically centers the card */
        padding: 2rem 1rem;      /* Adds some spacing, especially on mobile */
    }


        .profile-card {
             margin: 10px;
               border: 1px solid #f57c00;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden; /* Ensures the header background doesn't leak out */
            width: 100%;
            max-width: 650px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .profile-header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 40px 20px;
            text-align: center;
            position: relative;
        }
        
      .profile-img {
    width: 200px;
    height: 200px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 20px;
    border: 6px solid #ffffff; 
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); 
}
        
        .profile-name {
            font-weight: 600;
            font-size: 1.75rem;
            margin-top: 15px;
            margin-bottom: 5px;
        }
        
        .profile-designation {
            font-weight: 300;
            font-size: 1.1rem;
            color: #e0e0e0;
        }

        .profile-body {
            padding: 30px;
        }

        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            font-size: 16px;
            border-bottom: 1px solid #f0f0f0;
            padding-bottom: 20px;
        }
        .info-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .info-item i {
            font-size: 1.5rem;
            color: #764ba2;
            margin-right: 20px;
            width: 30px; /* Fixed width for alignment */
            text-align: center;
        }
        
        .info-content {
            display: flex;
            flex-direction: column;
        }
        
        .info-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 2px;
        }

        .info-value {
            color: #555;
        }
        
        .info-value a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .info-value a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .btn-back {
            background-color: #6c757d;
            border: none;
            padding: 12px 25px;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .btn-back:hover {
            background-color: #5a6268;
            transform: scale(1.05);
        }

    </style>
</head>
<body>


<?php


include 'header.php';
?> 

<div class="profile-container">

<div class="profile-card">
    <div class="profile-header">
           <img src="image/<?= !empty($row['user_img']) ? htmlspecialchars($row['user_img']) : 'blank_pp.png' ?>" alt="Profile" class="rounded-circle profile-img">
        <h3 class="profile-name"><?= htmlspecialchars($row['name']) ?></h3>
        <p class="profile-designation"><?= htmlspecialchars($row['designation']) ?> at <?= htmlspecialchars($row['workplace']) ?></p>
    </div>

    <div class="profile-body">
        <div class="info-item">
            <i class="bi bi-person-badge-fill"></i>
            <div class="info-content">
                <span class="info-label">Batch</span>
                <span class="info-value">ICE-<?= htmlspecialchars($row['ice_batch']) ?></span>
            </div>
        </div>
        
        <div class="info-item">
            <i class="bi bi-briefcase-fill"></i>
            <div class="info-content">
                <span class="info-label">Sector</span>
                <span class="info-value"><?= htmlspecialchars($row['sector']) ?></span>
            </div>
        </div>

        <div class="info-item">
            <i class="bi bi-envelope-fill"></i>
            <div class="info-content">
                <span class="info-label">Email</span>
                <span class="info-value">
                    <a href="mailto:<?= htmlspecialchars($row['email']) ?>"><?= htmlspecialchars($row['email']) ?></a>
                </span>
            </div>
        </div>

        <div class="info-item">
            <i class="bi bi-telephone-fill"></i>
            <div class="info-content">
                <span class="info-label">Phone</span>
                <span class="info-value">
                    <a href="tel:<?= htmlspecialchars($row['phone']) ?>"><?= htmlspecialchars($row['phone']) ?></a>
                </span>
            </div>
        </div>
        
        <div class="info-item">
            <i class="bi bi-facebook"></i>
            <div class="info-content">
                <span class="info-label">Facebook</span>
                <span class="info-value">
                    <a href="<?= htmlspecialchars($row['facebook']) ?>" target="_blank">View Profile</a>
                </span>
            </div>
        </div>

        <div class="info-item">
            <i class="bi bi-linkedin"></i>
            <div class="info-content">
                <span class="info-label">LinkedIn</span>
                <span class="info-value">
                    <a href="<?= htmlspecialchars($row['linkedin']) ?>" target="_blank">View Profile</a>
                </span>
            </div>
        </div>

    </div>
</div>

</div>


</body>
</html>