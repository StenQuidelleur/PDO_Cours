<?php

require '../config/connect.php';

$pdo = new PDO(DSN, USER, PASS);
if ($pdo === false) {
    echo 'Connection Error :' .$pdo->error_log();
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $request = "SELECT * FROM user WHERE id=" . $id;
    $sendRequest = $pdo->query($request);
    if ($sendRequest === false) {
        $pdo->errorInfo();
    }
    $user = $sendRequest->fetchObject();
}

if (isset($_POST) && !empty($_POST)) {
    if (!empty($_POST['firstname']) && !empty($_POST['lastname'])) {
        try {
            $editUser = $pdo->prepare("UPDATE user SET firstname=:firstname, lastname=:lastname WHERE user.id=:user_id");
            $editUser->bindValue(':firstname', $_POST['firstname'], PDO::PARAM_STR);
            $editUser->bindValue(':lastname', $_POST['lastname'], PDO::PARAM_STR);
            $editUser->execute();

            header('Location: http://localhost:8888/PDO_Cours/index.php');
        } catch (PDOException $e){
            echo $e->getMessage(); 
        }
    }
}

?>



<?php include('../layout/layout_start.php'); ?>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Modifier un utilisateur</span>
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
                <input type="text" class="form-control" name="firstname" id="firstname" value="<?= $user->firstname; ?>">
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Lastname</label>
                <input type="text" class="form-control" name="lastname" id="lastname" value="<?= $user->lastname; ?>">
            </div>
            <button type="submit" class="btn btn-success">Modifier</button>
        </form>
    </div>
<?php include('../layout/layout_end.php'); ?>