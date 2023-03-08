

<?php
session_start();
// Vérification des informations d'identification
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // Vérification CSRF
    if (empty($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
        die('Erreur CSRF');
    }

    // Vérification du nombre de tentatives de connexion
    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 0;
    }

    if ($_SESSION['login_attempts'] > 5) {
        die('Trop de tentatives de connexion. Réessayez plus tard.');
    }

    // Vérification du temps de la dernière tentative de connexion
    if (isset($_SESSION['last_login_attempt']) && (time() - $_SESSION['last_login_attempt'] < 5)) {
        die('Trop de tentatives de connexion en peu de temps.');
    }

    // Connexion à la base de données
    $db = new PDO('mysql:host=localhost;dbname=ma_base_de_donnees;charset=utf8', 'nom_utilisateur', 'mot_de_passe');

    // Utilisation d'une requête préparée pour protéger contre l'injection SQL
    $stmt = $db->prepare("SELECT * FROM utilisateurs WHERE nom_utilisateur = :username AND mot_de_passe = :password");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    // Vérification du résultat de la requête
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = htmlspecialchars($username, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        header('Location: index.php');
        exit;
    } else {
        echo 'Nom d\'utilisateur ou mot de passe incorrect';
    }
}

// Génération d'un jeton CSRF
session_start();
$token = bin2hex(random_bytes(32));
$_SESSION['token'] = $token;
?>

<!-- Formulaire de connexion -->
<form method="post" action="">
    <input type="text" name="username">
    <input type="password" name="password">
    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>">
    <button type="submit">Se connecter</button>
</form>