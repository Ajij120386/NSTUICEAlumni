<?php
// session_start();
include 'conn.php';
?>
<!DOCTYPE html>
<html>
<head>
    <!-- The head section is now clean, as CSS is self-contained -->
    <style>
        :root {
            --primary-color: #0d2c4e; /* Deep University Blue */
            --secondary-color: #d4a017; /* Golden Accent */
            --white-color: #ffffff;
            --font-family: 'Poppins', sans-serif; /* Recommended: Add Poppins font link in main files */
        }

        body {
            margin: 0;
            font-family: var(--font-family), sans-serif;
            /* Add a small margin to the top of the body so content isn't hidden behind the sticky header */
            padding-top: 80px; 
        }

        .top-bar {
            background-color: var(--primary-color);
            color: var(--white-color);
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            position: fixed; /* Makes the header sticky */
            top: 0;
            width: 100%;
            z-index: 1000;
            box-sizing: border-box; /* Ensures padding is included in the width */
        }

        .left-section, .center-section, .right-section {
            display: flex;
            align-items: center;
        }

        .left-section a {
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .left-section img {
            height: 50px;
            margin-right: 15px;
        }

        .logo-text {
            color: var(--white-color);
            font-size: 24px;
            font-weight: 700;
        }

        /* Styling for the main navigation links */
        .center-section {
            gap: 15px; /* Adds space between the links */
        }

        .nav-link {
            color: var(--white-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px 15px;
            border-radius: 8px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--secondary-color);
        }

        .nav-link img {
            width: 24px; /* Slightly smaller icons for a cleaner look */
            margin-right: 8px;
            filter: brightness(0) invert(1); /* Makes icons white */
        }

        .nav-link .nav_menu_text {
            font-weight: 500;
            font-size: 16px;
        }
        
        /* Specific styling for the Exit button */
        .right-section .exit-link {
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 8px;
            padding: 10px 20px;
            transition: background-color 0.3s, border-color 0.3s;
        }
        
        .right-section .exit-link:hover {
            background-color: var(--white-color);
            border-color: var(--white-color);
            color: var(--primary-color);
        }

        .right-section .exit-link:hover img {
            filter: none; /* Revert icon color on hover */
        }

        /* --- Responsive Design for smaller screens --- */
        @media (max-width: 992px) {
            .nav_menu_text {
                display: none; /* Hide text on smaller screens */
            }
            .nav-link img {
                margin-right: 0;
            }
            .nav-link {
                padding: 10px;
            }
            .center-section {
                gap: 5px;
            }
        }
        
        @media (max-width: 768px) {
            .top-bar {
                flex-direction: column;
                height: auto;
                padding: 15px;
                position: static; /* Remove sticky header on very small screens */
            }
            body {
                padding-top: 0;
            }
            .center-section {
                margin: 15px 0;
            }
        }

    </style>
</head>
<body>

<div class="top-bar">
    <div class="left-section">
        <a href="home.php"> <!-- Link the logo to the homepage -->
            <img src="image/logo.jpeg" alt="Logo">
            <span class="logo-text">ICE Network</span>
        </a>
    </div>

    <div class="center-section">
        <a href="home.php" class="nav-link">
            <img src="image/home.ico" alt="Home">
            <span class="nav_menu_text">Home</span>
        </a>
        <a href="batch.php" class="nav-link">
            <img src="image/batch1.png" alt="Batch">
            <span class="nav_menu_text">Batch</span>
        </a>
        <a href="custom_search.php" class="nav-link">
            <img src="image/search2.png" alt="Searchify">
            <span class="nav_menu_text">Searchify</span>
        </a>
        <a href="alumni_form.php" class="nav-link">
            <img src="image/add.png" alt="Add Profile">
            <span class="nav_menu_text">Add Profile</span>
        </a>
    </div>

    <div class="right-section">
        <a href="home.php" class="nav-link exit-link">
            <img src="image/leave.png" alt="Exit">
            <span class="nav_menu_text">Exit Now</span>
        </a>
    </div>
</div>

<!-- NOTE: The search-related JavaScript has been removed as it's no longer needed. -->

</body>
</html>