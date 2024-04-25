<?php
session_start();

require('conn.php');

$error = ''; 


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cree'])) {

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
   
        $email = $_POST['email'];
        $password = $_POST['password'];
        
      
        $query = "SELECT * FROM signup WHERE email = :email";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        
    
        $stmt->execute();
        
       
        if ($stmt->rowCount() > 0) {
         
            $user = $stmt->fetch();
          
            if ($user && password_verify($password, $user['password'])) {
            
                $_SESSION['email'] = $email;
               
                header("Location: blog.php");
                exit();
            } else {
          
                $error = "Mot de passe incorrect.";
            }
        } else {
      
            $error = "Adresse e-mail introuvable. Veuillez créer un compte.";
        }
    } else {
        
        $error = "Veuillez fournir une adresse e-mail et un mot de passe.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign In</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff; 
            margin: 0; 
            padding: 0; 
        }
        
        header {
            background-color: #FF3333; 
            color: #fff;
            padding: 0.2rem; 
            text-align: center;
        }
        
        header h1 {
            margin: 0;
            font-size: 1.2rem; 
        }
        
        nav {
            background-color: #ccc;
            padding: 0.2rem;
            text-align: center;
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
            color: #333;
            text-decoration: none;
            padding: 0; 
        }
        
        .container {
            width: 300px;
            margin: 50px auto;
            background-color: #00cc85; 
            padding: 20px;
            border: 1px solid #8d0909;
            border-radius: 4px;
            box-shadow: 0px 0px 10px rgba(174, 0, 0, 0.1);
        }
        
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
        }
        
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid rgb(4, 106, 4); 
            border-radius: 4px;
            box-sizing: border-box;
        }
        
        .error {
            color: red; 
        }
        
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #FF0000; 
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        input[type="submit"]:hover {
            background-color: #FF3333;
        }

        footer {
            background-color: #FF0000; 
            color: #fff;
            padding: 0.2rem;
            text-align: center;
            font-size: 0.8rem; 
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Palestine Blog</h1>
            <nav>
                <ul>
                    <li><a href="accueil.php">Accueil</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <div class="container">
            <h1>Sign in</h1>
            <form method="post" action="blog.php">
             <label for="email">Email:</label>
                <input type="email" name="email" required />
                <span class="error" id="email-error"></span>
                <br/>
                <label for="password">Password:</label>
                <input type="password" name="password" required />
                <span class="error" id="password-error"></span>
                <br/>
                <input type="submit" name="signin" value="Sign In" />
            </form>
            <a href="signup.php" class="signup-link"> Create An Account</a>
        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2023 Palestine Blog. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>