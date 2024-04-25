<?php
session_start(); 
function getCommentsAndEmails() {
   
    $conn = new PDO("mysql:host=localhost;dbname=php2", 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    $stmt = $conn->query("SELECT * FROM blog");
    $commentsAndEmails = $stmt->fetchAll(PDO::FETCH_ASSOC);

   
    $conn = null;

    return $commentsAndEmails;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    if(isset($_POST['email']) && isset($_POST['comm'])) {
        
        $email = $_POST['email'];
        $comm = $_POST['comm'];

        $conn = new PDO("mysql:host=localhost;dbname=php2", 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

       
        $stmt = $conn->prepare("SELECT * FROM blog WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $existingRecord = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingRecord) {
          
            $sql = "UPDATE blog SET comm = :comm WHERE email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':comm', $comm);
            $stmt->execute();
            echo "Comment updated successfully!";
        } else {
            
            try {
                $sql = "INSERT INTO blog (email, comm) VALUES (:email, :comm)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':comm', $comm);
                $stmt->execute();
                echo "Comment added successfully!";
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

   
        $conn = null;

      
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Ajouter un commentaire</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        header {
            background-color: #FF0000; 
            color: #fff;
            padding: 1rem;
            text-align: center;
        }

        header h1 {
            margin: 0;
        }

        main {
            padding: 20px;
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

   
    </style>
</head>
<body>
    <header>
        <h1>La Situation Générale En Palestine</h1>
    </header>
    <main>      
        <article>
        <div style="border: 1px solid #FF0000; padding: 10px; text-align: center;">
        <img src="p1.jpg" alt="Votre Image" style="max-width: 1000%; height: auto; max-height: 300px; display: block; margin: 0 auto;">
    </div>
            <p>La Palestine est confrontée à un conflit territorial prolongé avec Israël, caractérisé par des restrictions de mouvement et des conditions de vie difficiles pour les Palestiniens. Cette situation a un impact profond sur leur accès aux ressources essentielles et leur bien-être général. Malgré les défis, des efforts continus sont déployés pour promouvoir la paix et résoudre le conflit, mais une aide internationale supplémentaire est nécessaire pour soutenir les Palestiniens dans leur quête de stabilité et de prospérité.</p>
            
        </article>
        <section id="commentaires">
            <h2>Ajouter un commentaire</h2></br>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <label for="email">Adresse e-mail :</label></br>
                <input type="email" id="email" name="email" required></br>
                <label for="comm">Votre commentaire :</label> </br>
                <textarea id="comm" name="comm" rows="5" cols="110" required></textarea></br>
                <button type="submit">Ajouter</button>
            </form>
        </section>


        <section id="comments">
            <h2>Commentaires</h2>
            <?php
         
            $commentsAndEmails = getCommentsAndEmails();

            if ($commentsAndEmails) {
      
                foreach ($commentsAndEmails as $comment) {
                    echo "<div class='comment'>";
                    echo "<p><strong>Email:</strong> " . $comment['email'] . "</p>";
                    echo "<p><strong>Commentaire:</strong> " . $comment['comm'] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>Aucun commentaire pour le moment.</p>";
            }
            ?>
        </section>
    </main>
    <footer>
    <div class="container">
        <p>&copy; 2023 Palestine Blog. Tous droits réservés.</p>
    </div>
</footer>

</body>
</html>
