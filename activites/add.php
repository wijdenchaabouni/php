<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}
require_once '../config/db.php';

$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = trim($_POST['titre']);
    $date = $_POST['date'];
    $lieu = trim($_POST['lieu']);
    $type = trim($_POST['type']);
    $duree = trim($_POST['duree']);
  
    if ($titre && $date && $lieu && $type && $duree) {
        $stmt = $pdo->prepare("INSERT INTO activites (titre, date, lieu, type, duree) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$titre, $date, $lieu, $type, $duree]);
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
    <title>Ajouter une activité - Club de Voyage</title>
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
<body class="py-5">
    <div class="container">
        <div class="card card-custom">
            <h2 class="mb-4 text-center"><i class="bi bi-airplane-engines"></i> Ajouter une activité de voyage</h2>
            <?php if ($erreur): ?>
                <div class="alert alert-danger"><?= $erreur ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <label>Destination</label>
                    <input type="text" name="titre" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Date</label>
                    <input type="date" name="date" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Point de départ</label>
                    <input type="text" name="lieu" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Type de voyage</label>
                    <input type="text" name="type" class="form-control" placeholder="ex: Excursion, Randonnée, Séjour" required>
                </div>
                <div class="mb-3">
                    <label>Durée</label>
                    <input type="text" name="duree" class="form-control" placeholder="ex: 3 jours, 1 semaine" required>
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
                <a href="index.php" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</body>
</html>
