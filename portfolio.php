<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$conn = new mysqli('localhost', 'root', '', 'responsive_portfolio');
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT username FROM users WHERE id = ?");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$stmt->bind_result($username);
$stmt->fetch();
$stmt->close();

$stmt = $conn->prepare("SELECT project_name, description FROM portfolio WHERE user_id = ?");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$stmt->bind_result($project_name, $description);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Portfolio</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            background-image: url('background'); /* Updated to match the image name */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        .portfolio-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 800px;
            margin: 2rem auto;
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 1rem;
        }

        .profile-pic {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 1rem;
        }

        .about-me {
            margin-bottom: 2rem;
            color: #555;
            font-size: 1rem;
            line-height: 1.5;
        }

        h2 {
            margin-bottom: 1rem;
            color: #333;
        }

        .project {
            margin-bottom: 1.5rem;
            padding: 1rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .project h3 {
            margin: 0 0 0.5rem;
            color: #333;
        }

        .project p {
            margin: 0;
            color: #666;
        }

        a {
            display: inline-block;
            margin-top: 1rem;
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="portfolio-container">
        <!-- Welcome and Profile Picture Section -->
        <h1>Welcome, <?= htmlspecialchars($username); ?></h1>
        <img src="../toths.jpg" alt="Profile Picture" class="profile-pic">
        <p class="about-me">
            Welcome to my portfolio. Hi there! I'm someone who loves to explore life through all its exciting experiences.
            Music is my ultimate escape, setting the soundtrack to my days and fueling my adventures. I have a passion for
            traveling and discovering new places, meeting people, and immersing myself in different cultures. Whether it's
            hiking through lush forests, trying new cuisines, or just soaking in breathtaking views, I live for adventure.
            I'm also an animal lover and appreciate the joy and comfort they bring. Good food is another one of my
            pleasures—whether it's street food in a faraway city or a homemade meal shared with friends, I enjoy every bite!
        </p>
        
        <!-- Projects Section -->
        <?php while ($stmt->fetch()): ?>
            <div class="project">
                <h3><?= htmlspecialchars($project_name); ?></h3>
                <p><?= htmlspecialchars($description); ?></p>
            </div>
        <?php endwhile; ?>
        
        <!-- Logout Link -->
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
