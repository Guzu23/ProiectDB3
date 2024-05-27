<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="css/styles.css" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- navigatie -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Expozitie de masini</a>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                        <?php
                        if (isset($_SESSION['username'])) {
                            echo '<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>';
                            if($isAdmin){
                                echo '<li class="nav-item"><a class="nav-link" href="add.php">Add cars</a></li>';
                            }
                            echo '<li>Salut ' . $_SESSION['username'] . '</li>';
                        } else {
                            echo '<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>';
                        }
                        ?>
                    </ul>
        </div>
    </nav>

    <!-- pagina -->
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                
                <h1 class="display-4 text-center mb-4">Login</h1>
                <!-- login form -->
                <form action="login_process.php" method="POST">
                    <div class="mb-3">
                        <label for="credential" class="form-label">Email or Username</label>
                        <input type="text" class="form-control" id="credential" name="credential" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
                <!-- buton inregistrare -->
                <div class="text-center mt-3">
                    <a href="register.php" class="btn btn-secondary">Or register!</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
