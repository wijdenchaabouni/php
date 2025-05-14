<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}
require_once '../config/db.php';

$erreur = '';

$membres = $pdo->query("SELECT id, nom, prenom FROM membres ORDER BY nom ASC")->fetchAll();

$activites = $pdo->query("SELECT id, titre, date FROM activites ORDER BY date DESC")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $membre_id = $_POST['membre_id'];
    $activite_id = $_POST['activite_id'];

    if ($membre_id && $activite_id) {
        $check = $pdo->prepare("SELECT * FROM inscriptions WHERE membre_id = ? AND activite_id = ?");
        $check->execute([$membre_id, $activite_id]);
        if ($check->rowCount() == 0) {
            $stmt = $pdo->prepare("INSERT INTO inscriptions (membre_id, activite_id) VALUES (?, ?)");
            $stmt->execute([$membre_id, $activite_id]);
            header("Location: index.php");
            exit;
        } else {
            $erreur = "Ce membre est déjà inscrit à cette activité.";
        }
    } else {
        $erreur = "Veuillez sélectionner un membre et une activité.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouvelle inscription </title>
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
        <h2>➕ Nouvelle inscription </h2>
        <?php if ($erreur): ?>
            <div class="alert alert-danger"><?= $erreur ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label>Membre</label>
                <select name="membre_id" class="form-control" required>
                    <option value="">-- Choisir un membre --</option>
                    <?php foreach ($membres as $m): ?>
                        <option value="<?= $m['id'] ?>"><?= htmlspecialchars($m['prenom'] . ' ' . $m['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label>Activité</label>
                <select name="activite_id" class="form-control" required>
                    <option value="">-- Choisir une activité --</option>
                    <?php foreach ($activites as $a): ?>
                        <option value="<?= $a['id'] ?>"><?= htmlspecialchars($a['titre']) ?> (<?= $a['date'] ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Valider l'inscription</button>
            <a href="index.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>
