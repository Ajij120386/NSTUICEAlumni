<?php
// Database connection

include 'conn.php';


// Fetch alumni data
$sql = "SELECT * FROM alumni_info ORDER BY submitted_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NSTU ICE Alumni</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .table-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        h1 {
            margin-bottom: 20px;
            color: #0d6efd;
        }
        .table th {
            background-color: #0d6efd;
            color: white;
        }
        .table td, .table th {
            vertical-align: middle;
        }
        .link-icons a {
            margin-right: 10px;
        }
    </style>
</head>
<body>

<div class="container table-container">
    <h1 class="text-center">NSTU ICE Alumni</h1>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>ICE Batch</th>
                    <th>Workplace</th>
                    <th>Designation</th>
                    <th>Sector</th>
                    <th>Facebook</th>
                    <th>LinkedIn</th>
                    <th>Email</th>
                    <th>Phone</th>
                   
                </tr>
            </thead>
            <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>". htmlspecialchars($row['id']) ."</td>";
                    echo "<td>". htmlspecialchars($row['name']) ."</td>";
                    echo "<td>". htmlspecialchars($row['ice_batch']) ."</td>";
                    echo "<td>". htmlspecialchars($row['workplace']) ."</td>";
                    echo "<td>". htmlspecialchars($row['designation']) ."</td>";
                    echo "<td>". htmlspecialchars($row['sector']) ."</td>";
                    echo "<td>";
                    if($row['facebook']) {
                        echo "<a href='". htmlspecialchars($row['facebook']) ."' target='_blank'>FB</a>";
                    } else {
                        echo "-";
                    }
                    echo "</td>";
                    echo "<td>";
                    if($row['linkedin']) {
                        echo "<a href='". htmlspecialchars($row['linkedin']) ."' target='_blank'>LinkedIn</a>";
                    } else {
                        echo "-";
                    }
                    echo "</td>";
                    echo "<td>". htmlspecialchars($row['email']) ."</td>";
                    echo "<td>". htmlspecialchars($row['phone']) ."</td>";
                  
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='11' class='text-center'>No records found</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap JS (optional for interactive components) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
