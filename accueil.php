<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="vendor/twbs/bootstrap/dist/css/bootstrap-grid.css" rel="stylesheet">
    <title>Palestine Blog</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: ²; 
            color: #fff;
            padding: 1rem;
        }

        header h1 {
            margin: 0;
        }

        nav {
            background-color: transparent;
            padding: 1rem;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav li {
            display: inline-block;
            margin-right: 1rem;
        }

        nav a {
            color: #fff;
            text-decoration: none;
        }

        main {
            padding: 2rem;
            margin: 50px 0;
        }

        main article {
            margin-bottom: 2rem;
        }

        main article h2 {
            margin: 0 0 1rem;
        }

        main article p {
            margin: 0;
        }

        footer {
            background-color: #FF0000; 
            color: #fff;
            padding: 1rem;
            text-align: center;
        }

        footer p {
            margin: 0;
        }

        .photo {
            text-align: center;
            border: 2px solid #FF0000;
            padding: 20px;
            margin-top: 50px; 
            max-width: 80%; 
            margin-left: auto;
            margin-right: auto;
        }
        .photo img {
            width: 100%;
            height: auto; 
            max-width: 800px; 
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1><center>Palestine Blog</center></h1>
            <nav>
                <ul>
                    <li><a href="accueil.php">Home</a></li>
                    <li><a href="signin.php">Login</a></li>
                    <li><a href="signup.php">Signup</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <div class="container">
            <article>
                <h2>Welcome to Palestine Blog</h2>
                <p>This is a blog about Palestine and the situation over there .</p>
              
            </article>
           
        </div>
        <div class="photo">
            <img src="pa.jpg" alt="Your Photo">
        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2023 Palestine Blog. All rights reserved.</p>
        </div>
    </footer>
   
</body>
</html>