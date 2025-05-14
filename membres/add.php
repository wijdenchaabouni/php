<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}
require_once '../config/db.php';

$erreur = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = trim($_POST['email']);

    if ($nom && $prenom && $email) {
        $stmt = $pdo->prepare("INSERT INTO membres (nom, prenom, email) VALUES (?, ?, ?)");
        $stmt->execute([$nom, $prenom, $email]);
        header("Location: index.php");
        exit;
    } else {
        $erreur = "Tous les champs sont obligatoires.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Membre </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #f0faff, #e6f7ff);
            font-family: 'Segoe UI', sans-serif;
        }
        .card-custom {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 123, 255, 0.1);
            padding: 30px;
        }
        h2 i {
            color: #0d6efd;
            margin-right: 8px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2>➕ Ajouter un membre</h2>
        <?php if (!empty($erreur)): ?>
            <div class="alert alert-danger"><?= $erreur ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label>Nom</label>
                <input type="text" name="nom" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Prénom</label>
                <input type="text" name="prenom" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Date de naissance</label>
                <input type="date" name="date_naissance" class="form-control">
            </div>
            <div class="mb-3">
                <label>Ville</label>
                <input type="text" name="ville" class="form-control">
            </div>
            <div class="mb-3">
                <label>Téléphone</label>
                <input type="text" name="telephone" class="form-control">
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Date d'inscription</label>
                <input type="date" name="date_inscription" class="form-control" value="<?= date('Y-m-d') ?>" required>
            </div>
            <div class="mb-3">
                <label>Statut</label>
                <select name="statut" class="form-select" required>
                    <option value="actif">Actif</option>
                    <option value="inactif">Inactif</option>
                    <option value="suspendu">Suspendu</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Ajouter</button>
            <a href="index.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>

