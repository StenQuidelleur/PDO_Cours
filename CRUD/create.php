<?php

require '../config/connect.php';

$pdo = new PDO(DSN, USER, PASS);
if ($pdo === false) {
    echo 'Connection Error :' .$pdo->error_log();
}

if (isset($_POST)) {
    if (!empty($_POST['firstname']) && !empty($_POST['lastname'])) {
        try {
            $query = 'INSERT INTO user (firstname, lastname) VALUES (:firstname,:lastname)';
            $statement = $pdo->prepare($query);
            $statement->bindValue(':firstname', $_POST['firstname'], PDO::PARAM_STR);
            $statement->bindValue(':lastname', $_POST['lastname'], PDO::PARAM_STR);
            $statement->execute();

            return header('Location: http://localhost:8888/PDO_Cours/index.php');
        } catch (PDOException $e){
            echo $e->getMessage(); 
        }
    }
}

?>

<?php include('../layout/layout_start.php'); ?>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Créer un utilisateur</span>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Home</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-5">
        
        <form method="POST" class="col-4">
            <div class="mb-3">
                <label for="firstname" class="form-label">Firstname</label>
                <input type="text" class="form-control" name="firstname" id="firstname">
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Lastname</label>
                <input type="text" class="form-control" name="lastname" id="lastname">
            </div>
            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>
<?php include('../layout/layout_end.php'); ?>