<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ICE Alumni Network | Home</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-color: #0d2c4e; /* Deep University Blue */
            --secondary-color: #d4a017; /* Golden Accent */
            --light-bg: #f5f8fa;
            --text-color: #333;
            --heading-color: #0d2c4e;
            --white-color: #ffffff;
            --font-family: 'Poppins', sans-serif;
        }

        /* --- General Styles --- */
        body {
            font-family: var(--font-family);
            margin: 0;
            padding: 0;
            color: var(--text-color);
            background-color: var(--white-color);
            line-height: 1.7;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 25px;
        }

        h1, h2, h3 {
            color: var(--heading-color);
            font-weight: 700;
        }

        section {
            padding: 80px 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title h2 {
            font-size: 36px;
            margin-bottom: 15px;
        }

        .section-title p {
            font-size: 18px;
            color: #555;
            max-width: 700px;
            margin: 0 auto;
        }

        /* --- Header --- */
        .main-header {
            background: var(--white-color);
            padding: 15px 0;
            border-bottom: 1px solid #e0e0e0;
            position: sticky;
            top: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 2px 15px rgba(0,0,0,0.06);
        }

        .main-header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .logo img {
            height: 50px;
            margin-right: 15px;
        }

        .logo-text {
            color: var(--primary-color);
            font-size: 24px;
            font-weight: 700;
        }
        
        .main-nav a {
            margin-left: 30px;
            text-decoration: none;
            color: var(--primary-color);
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .main-nav a:hover {
            color: var(--secondary-color);
        }

        /* --- Hero Section --- */

        /* --- Hero Section --- */
/* --- Hero Section --- */
.hero {
    /* (Your background image styles remain the same) */
    background-image: linear-gradient(rgba(13, 44, 78, 0.75), rgba(13, 44, 78, 0.75)), url('image/alumni.jpg');
    background-size: cover;
    background-position: center;
    padding: 100px 0;
    text-align: center;
}

/* Main headline - stays bright white and bold */
.hero h1 {
    color: #ffffff;
    font-size: 48px;
    line-height: 1.3;
    margin-bottom: 20px;
}

/* Paragraph - slightly softer for visual hierarchy */
.hero p {
    color: #e0e0e0; /* Changed from pure white to a light grey */
    font-size: 20px;
    max-width: 750px;
    margin: 0 auto 30px auto;
}

/* CTA Button - already good, this ensures text contrast */
.cta-button {
    background: var(--secondary-color); /* #d4a017 */
    color: var(--primary-color);       /* #0d2c4e - Ensures text is readable */
    padding: 15px 40px;
    text-decoration: none;
    font-weight: 700;
    font-size: 18px;
    border-radius: 50px;
    display: inline-block;
    transition: transform 0.3s, box-shadow 0.3s;
}

.cta-button:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 20px rgba(212, 160, 23, 0.4);
}

/* Secondary CTA - this is where the magic happens */
.secondary-cta {
    margin-top: 20px;
    /* The text "Already a member?" will inherit the soft grey from .hero p */
}

/* This is the default, non-hovered state of the link */
.secondary-cta a {
    color: var(--secondary-color); /* The gold color */
    text-decoration: none;
    font-weight: 600;
    display: inline-block; /* This is important for transform to work properly */
    transition: all 0.3s ease; /* This makes the hover effect smooth */
}

/* This is the state WHEN the mouse is hovering over the link */
.secondary-cta a:hover {
    color: #ffffff; /* Change color to white on hover */
    transform: scale(1.05); /* Makes the link 5% larger */
}
        /* --- NEW: Benefits Section --- */
        .benefits-grid {
            display: grid;
            /* Changed to 4 columns for the new combined section */
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }
        
        .benefit-card {
            background: var(--white-color);
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            border: 1px solid #f57c00;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .benefit-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 35px rgba(0,0,0,0.1);
        }

        .benefit-card .icon {
            font-size: 42px; /* Using Bootstrap Icons */
            color: var(--secondary-color);
            margin-bottom: 20px;
        }

        .benefit-card h3 {
            font-size: 20px;
            margin-bottom: 15px;
        }
        
        /* --- Portal Features Section --- */
        .portal-features {
             background-color: var(--light-bg);
        }

        .feature-card {
            background: var(--white-color);
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 4px 25px rgba(0,0,0,0.08);
           
            transition: transform 0.3s, box-shadow 0.3s;
             border: 1px solid #f57c00;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 35px rgba(0,0,0,0.12);
        }

        .feature-card .icon {
            font-size: 50px;
            color: var(--secondary-color);
            margin-bottom: 20px;
        }

        .feature-card h3 {
            font-size: 22px;
            margin-bottom: 15px;
        }
        
        .feature-card a {
            background: var(--primary-color);
            color: var(--white-color);
            padding: 10px 25px;
            border-radius: 30px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            transition: background-color 0.3s;
        }
        
        .feature-card a:hover {
            background-color: #091e36;
        }

        /* --- About Section --- */
        .about-section {
             background-color: var(--white-color);
        }

        .about-content {
            background: var(--light-bg);
            padding: 40px;
            border-radius: 15px;
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }
        
        .about-content .message-from {
            font-weight: 600;
            color: var(--secondary-color);
            margin-top: 25px;
            display: block;
        }

        /* --- Footer --- */
        .main-footer {
            background-color: var(--primary-color);
            color: #a9b4c2;
            padding: 50px 0;
            text-align: center;
        }
        
        .main-footer p {
            margin: 0;
        }
    </style>
</head>
<body>

    <header class="main-header">

    <?php




include 'header.php';

?>
         
    </header>

    <main>
        <!-- Hero Section -->
        <section class="hero">
            <div class="container">
                <h1>Your Journey is Their Roadmap</h1>
                <p>Our students are falling behind without proper guidance. As a senior alumnus, your experience is the most valuable resource for their careers. Step forward, share your story, and help us build a stronger future for the ICE department.</p>
                <a href="alumni_form.php" class="cta-button">Join the Network & Add Your Profile</a>
                <div class="secondary-cta">
                    <p>Already a member? <a href="custom_search.php">Explore the Alumni Directory &rarr;</a></p>
                </div>
            </div>
        </section>
        
        <!-- NEWLY ADDED & COMBINED BENEFITS SECTION -->
        <section class="benefits">
            <div class="container">
                <div class="section-title">
                    <h2>A Network of Opportunity</h2>
                    <p>By joining, you contribute to a powerful ecosystem that benefits both current students and our esteemed alumni.</p>
                </div>
                <div class="benefits-grid">
                    <div class="benefit-card">
                        <div class="icon"><i class="bi bi-compass"></i></div>
                        <h3>Provide Career Guidance</h3>
                        <p>Help juniors navigate their career paths by sharing insights from your professional journey.</p>
                    </div>
                    <div class="benefit-card">
                        <div class="icon"><i class="bi bi-mortarboard"></i></div>
                        <h3>Support Higher Studies</h3>
                        <p>Guide students aiming for higher education abroad with your direct, real-world experience.</p>
                    </div>
                    <div class="benefit-card">
                        <div class="icon"><i class="bi bi-arrows-fullscreen"></i></div>
                        <h3>Expand Your Network</h3>
                        <p>Access our exclusive directory to reconnect with batchmates and meet professionals in your field.</p>
                    </div>
                    <div class="benefit-card">
                        <div class="icon"><i class="bi bi-brightness-high"></i></div>
                        <h3>Give Back & Mentor</h3>
                        <p>Share your expertise and guide the next generation of leaders by participating in mentorship.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Portal Features Section -->
        <section class="portal-features">
            <div class="container">
                <div class="section-title">
                    <h2>Discover Your Network</h2>
                    <p>Our portal is more than a list. It's a powerful tool designed to connect students with the right mentors and help alumni find old friends.</p>
                </div>
                <div class="benefits-grid">
                    <div class="feature-card">
                        <div class="icon"><i class="bi bi-people-fill"></i></div>
                        <h3>Explore by Batch</h3>
                        <p>Travel back in time. Find your batchmates or explore the legacy of seniors and juniors in our interactive batch dashboard.</p>
                        <a href="batch.php">View Batches</a>
                    </div>
                    <div class="feature-card">
                        <div class="icon"><i class="bi bi-search"></i></div>
                        <h3>Powerful Search & Filter</h3>
                        <p>Looking for someone specific? Use our "Searchify" tool to find alumni by name, company, industry sector, or keyword.</p>
                        <a href="custom_search.php">Search Now</a>
                    </div>
                    <div class="feature-card">
                        <div class="icon"><i class="bi bi-person-lines-fill"></i></div>
                        <h3>Detailed Alumni Profiles</h3>
                        <p>Click on any alumnus's name to open their complete profile. You'll find career details and social links to build your network. Your next mentor is just one click away</p>
                        <a href="view_user.php?id=4">Find Alumni</a>
                    </div>
                </div>
            </div>
        </section>

    </main>
    
    <footer class="main-footer">
        <div class="container">
            <p>&copy; 2025 | Department of Information and Communication Engineering (ICE),NSTU</p>
        </div>
    </footer>

</body>
</html>