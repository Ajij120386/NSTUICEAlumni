<?php
// Database connection

include 'conn.php';


// Handle form submission
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $ice_batch = $_POST['ice_batch'];
    $workplace = $_POST['workplace'];
    $designation = $_POST['designation'];
    $sector = $_POST['sector'];
    $facebook = $_POST['facebook'];
    $linkedin = $_POST['linkedin'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $stmt = $conn->prepare("INSERT INTO alumni_info 
        (name, ice_batch, workplace, designation, sector, facebook, linkedin, email, phone) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $name, $ice_batch, $workplace, $designation, $sector, $facebook, $linkedin, $email, $phone);

    if ($stmt->execute()) {
        $message = "✅ Your response has been recorded successfully!";
    } else {
        $message = "❌ Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>NSTU ICE Alumni Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
        }
        .form-container {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 { text-align: center; color: #333; }
        label { display: block; margin-top: 15px; font-weight: bold; }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        button {
            margin-top: 20px;
            padding: 12px 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        button:hover { background-color: #218838; }
        .message {
            text-align: center;
            margin-top: 15px;
            font-weight: bold;
            color: green;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>NSTU ICE Alumni Form</h2>
    <?php if($message != "") { echo "<div class='message'>$message</div>"; } ?>
    <form method="POST" action="">
        <label>Name *</label>
        <input type="text" name="name" required>

        <label>ICE Batch *</label>
        <select name="ice_batch" required>
            <option value="">Select Batch</option>
            <option value="01">01</option>
            <option value="02">02</option>
            <option value="03">03</option>
            <option value="04">04</option>
            <option value="05">05</option>
            <option value="06">06</option>
            <option value="07">07</option>
            <option value="08">08</option>
        </select>

        <label>Workplace *</label>
        <input type="text" name="workplace" required>

        <label>Current Position / Designation *</label>
        <input type="text" name="designation" required>

        <label>Sector / Industry *</label>
        <select name="sector" required>
            <option value="">Select Sector</option>
            <option value="Government">Government</option>
            <option value="Private">Private</option>
            <option value="NGO / Development">NGO / Development</option>
            <option value="Academia / Research">Academia / Research</option>
            <option value="Entrepreneurship">Entrepreneurship</option>
            <option value="Freelancing / Consultancy">Freelancing / Consultancy</option>
            <option value="Other">Other</option>
        </select>

        <label>Facebook Profile Link</label>
        <input type="url" name="facebook">

        <label>LinkedIn Profile Link *</label>
        <input type="url" name="linkedin" required>

        <label>Email Address *</label>
        <input type="email" name="email" required>

        <label>Phone Number</label>
        <input type="text" name="phone">

        <button type="submit">Submit</button>
    </form>
</div>

</body>
</html>
