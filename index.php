<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit;
}
?>

<!doctype html>
<html lang="fr">
<head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
 
    <title><?= $title ?? 'Club de Voyage' ?></title>

    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/bootsnav.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    
    <style>
        body {
            background-color: #f0f8ff; 
            font-family: 'Segoe UI', sans-serif;
        }

        .navbar {
            background-color: #fff; 
            border-bottom: 2px solid #e0e0e0; 
        }

        .navbar-brand {
            color: #2c3e50; 
        }

        .navbar-nav .nav-link {
            color: #5f6368; 
        }

        .navbar-nav .nav-link:hover {
            color: #0277bd; 
        }

        .btn-outline-warning {
            color: #0277bd; 
            border-color: #0277bd;
        }

        .btn-outline-warning:hover {
            background-color: #0277bd;
            color: #fff;
        }

        .main-container {
            padding-top: 110px;
            padding-bottom: 60px;
        }

        .section-title {
            text-align: center;
            font-size: 2.2rem;
            font-weight: bold;
            color: #0277bd; 
        }

        .card-custom {
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            padding: 20px;
        }
    </style>
</head>

<body>
    <header class="top-area">
        <div class="header-area">
    
            <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow">
                <div class="container">
                    <a class="navbar-brand" href="/club_project"><i class="bi bi-airplane-engines"></i> Club de Voyage</a>
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item"><a class="nav-link" href="/club_project/membres/index.php">🌍 Membres</a></li>
                            <li class="nav-item"><a class="nav-link" href="/club_project/activites/index.php">🗺️ Activités</a></li>
                            <li class="nav-item"><a class="nav-link" href="/club_project/inscriptions/index.php">📝 Inscriptions</a></li>
                        </ul>
                        <span class="navbar-text text-dark me-3">Bonjour, <?= htmlspecialchars($_SESSION['username']) ?></span>
                        <a href="/club_project/auth/logout.php" class="btn btn-outline-warning">Se déconnecter</a>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <main class="container main-container">
     
        </main>
<div class="welcome-card mt-5 text-center">
    <img src="https://cdn-icons-png.flaticon.com/512/4729/4729433.png" width="80" alt="logo agent">
    <h1>Bienvenue au Club de voyage !</h1>
    <p>Rejoignez une communauté d'agents passionnés, prêts à relever tous les défis !</p>
    <hr>
    <p>🎯 Vous pouvez :<br>
        ➕ Ajouter de nouveaux voyage<br>
        🗂️ Planifier et superviser des missions stratégiques<br>
        ✅ Suivre les inscriptions aux activités du club</p>
    <a href="activites/index.php" class="btn btn-primary btn-lg mt-3">
        <i class="bi bi-calendar-event"></i> Voir les prochaines voyages
    </a>
</div>
</div>
</body>
</html>

