<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home_style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Home Page</title>
</head>
<body>
    <div class="wrapper">
        <nav class="navbar">
            <img class="logo" src="brain_logo.png">
            <ul>
                <li><a class="active" href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact US</a></li>
                <li><a href="#">Services</a></li>
            </ul>
        </nav>
        <div class="center">
            <h1>Brain Tumor &</h1>
            <h1>Alzheimer's Detection</h1>
            <div class="buttons">
                <a href="login.php">
                    <button >Admin</button>
                </a>
                <!-- <button class="btn">User</button> -->
                <button class="dropdown">
                    <span>User</span>
                    <div class="dropdown-content">
                        <a href="brain_form.php">
                            <p>Brain Tumor </p>
                        </a>
                        <a href="form.php">
                            <p>Alzehmier</p>
                        </a>
                    </div>
                  </div>
                
            </div>
        </div>
    </div>
</body>
</html>