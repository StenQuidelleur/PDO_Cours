<?php

/* READ User datas */

$statement = $pdo->query('SELECT * FROM user');
$users = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include('./layout/layout_start.php'); ?>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Liste de mes utilisateurs</span>
        </div>
    </nav>
    <div class="container mt-5">
        <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Firstname</th>
                <th scope="col">Lastname</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $key => $user) { ?>
                <tr>
                    <th scope="row"><?= $key+1; ?></th>
                    <td><?= $user['firstname']; ?></td>
                    <td><?= $user['lastname']; ?></td>
                    <td>
                        <a href="CRUD/edit.php?id=<?= $user['id']; ?>" class="btn mt-3 btn-warning">Modifier</a>
                        <a href="CRUD/delete.php?id=<?= $user['id']; ?>" class="btn mt-3 btn-danger">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
        </table>
        <a href="CRUD/create.php" class="btn mt-3 btn-primary">Ajouter un utilisateur</a>
    </div>
<?php include('./layout/layout_end.php'); ?>