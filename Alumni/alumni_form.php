<?php
include 'header.php';
include 'conn.php';

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define the upload directory
    $target_dir = "image/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $user_img = "";
    // Check if a file was uploaded
    if (isset($_FILES["user_img"]) && $_FILES["user_img"]["error"] == 0) {
        $target_file = $target_dir . basename($_FILES["user_img"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Create a unique name for the file to avoid overwriting
        $unique_name = uniqid() . '.' . $imageFileType;
        $target_path = $target_dir . $unique_name;

        // Allow certain file formats
        if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["user_img"]["tmp_name"], $target_path)) {
                $user_img = $unique_name;
            } else {
                $message = "❌ Sorry, there was an error uploading your file.";
            }
        } else {
            $message = "❌ Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
    }

    // Proceed with database insertion only if there was no upload error
    if (empty($message)) {
        $name = $_POST['name'];
        $ice_batch = $_POST['ice_batch'];
        $workplace = $_POST['workplace'];
        $designation = $_POST['designation'];
        $sector = $_POST['sector'];
        $facebook = $_POST['facebook'];
        $linkedin = $_POST['linkedin'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        // Notice the added 'user_img' column and the extra 's' in bind_param
        $stmt = $conn->prepare("INSERT INTO alumni_info 
            (name, user_img, ice_batch, workplace, designation, sector, facebook, linkedin, email, phone) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssss", $name, $user_img, $ice_batch, $workplace, $designation, $sector, $facebook, $linkedin, $email, $phone);

        if ($stmt->execute()) {
            $message = "✅ Your response has been recorded successfully!";
        } else {
            $message = "❌ Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>NSTU ICE Alumni Form</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }
    .card {
         border: 1px solid #f57c00;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

     .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }


    .card-header {
      background: linear-gradient(135deg, #007bff, #0056b3);
      color: #fff;
      text-align: center;
      font-size: 1.5rem;
      font-weight: 600;
      border-radius: 15px 15px 0 0;
      
    }
    .form-label {
      font-weight: 500;
      margin-top: 10px;
    }
    .btn-submit {
      background: linear-gradient(135deg, #28a745, #218838);
      border: none;
      font-weight: 600;
      transition: all 0.3s ease-in-out;
    }
    .btn-submit:hover {
      background: linear-gradient(135deg, #218838, #19692c);
      transform: scale(1.02);
    }
    .message {
      text-align: center;
      font-weight: bold;
      margin-bottom: 15px;
    }
  </style>
</head>
<body>

<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-lg-7 col-md-9">
      <div class="card">
        <div class="card-header">
          🎓 NSTU ICE Alumni Form
        </div>
        <div class="card-body p-4">
          
          <?php if($message != "") { 
            // Display error messages in red
            $message_class = strpos($message, '✅') !== false ? 'text-success' : 'text-danger';
            echo "<div class='message $message_class'>$message</div>"; 
          } ?>

          <!-- Add enctype for file uploads -->
          <form method="POST" action="" enctype="multipart/form-data">
            
            <label class="form-label">Name *</label>
            <input type="text" name="name" class="form-control" required>
            
            <!-- New file input for user image -->
            <label class="form-label">Profile Image</label>
            <input type="file" name="user_img" class="form-control">

            <label class="form-label">ICE Batch *</label>
            <select name="ice_batch" class="form-select" required>
              <option value="">Select Batch</option>
              <?php 
              for($i=1; $i<=8; $i++){ 
                echo "<option value='".str_pad($i,2,"0",STR_PAD_LEFT)."'>".str_pad($i,2,"0",STR_PAD_LEFT)."</option>";
              } 
              ?>
            </select>

            <label class="form-label">Workplace *</label>
            <input type="text" name="workplace" class="form-control" required>

            <label class="form-label">Current Position / Designation *</label>
            <input type="text" name="designation" class="form-control" required>

            <label class="form-label">Sector / Industry *</label>
            <select name="sector" class="form-select" required>
              <option value="">Select Sector</option>
              <option value="Government">Government</option>
              <option value="Private">Private</option>
              <option value="NGO / Development">NGO / Development</option>
              <option value="Academia / Research">Academia / Research</option>
              <option value="Entrepreneurship">Entrepreneurship</option>
              <option value="Freelancing / Consultancy">Freelancing / Consultancy</option>
              <option value="Other">Other</option>
            </select>

            <label class="form-label">Facebook Profile Link</label>
            <input type="url" name="facebook" class="form-control">

            <label class="form-label">LinkedIn Profile Link </label>
            <input type="url" name="linkedin" class="form-control" required>

            <label class="form-label">Email Address *</label>
            <input type="email" name="email" class="form-control" required>

            <label class="form-label">Phone Number</label>
            <input type="text" name="phone" class="form-control">

            <button type="submit" class="btn btn-submit w-100 mt-4">Submit</button>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>