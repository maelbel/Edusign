<?php require 'views/partials/head.php'; ?>

<!-- Custom styles for this template -->
<link href="src/css/sign-in.css" rel="stylesheet">

<?php
    require 'views/partials/header.php';

    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
?>

<main class="d-flex align-items-center py-4 bg-body-tertiary h-auto">
  <form class="form-signin w-100 m-auto" action="/edusign/login" method="POST">
    <!-- si message d'erreur on l'affiche -->
    <?php if(isset($errorMessage)) : ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $errorMessage; ?>
    </div>
    <?php endif; ?>
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    
    <h1 class="h3 mb-3 fw-normal">Veuillez vous connecter</h1>

    <div class="form-floating">
      <input type="email" name="email" id="email" class="form-control"  placeholder="name@example.com">
      <label for="email">Adresse email</label>
    </div>
    <div class="form-floating">
      <input type="password" name="password" id="password" class="form-control"  placeholder="Password">
      <label for="password">Mot de passe</label>
    </div>

    <button class="btn btn-primary w-100 py-2" type="submit">Se connecter</button>
    <p class="mt-5 mb-3 text-body-secondary">&copy; 2023–2024</p>
  </form>
</main>

<?php require 'views/partials/footer.php'; ?>