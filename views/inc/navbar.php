<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
  <div class="container">
      <a class="navbar-brand" href="<?php echo URLROOT . PAGE . '/index'; ?>"><?php echo SITENAME; ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">

        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT . PAGE; ?>/about">About</a>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto">
          <?php if(isset($_SESSION['email'])) {
          echo '<li class="nav-item">
                  <a class="nav-link" href="' . URLROOT . PAGE .'/logout">Logout</a>
                </li>';
        }
        ?>
          <?php if(!isset($_SESSION['email']) || empty($_SESSION['email'])) {
          echo '<li class="nav-item">
                 <a class="nav-link" href="' . URLROOT . PAGE .'/register">Register</a>
                </li>';
          echo '<li class="nav-item">
                  <a class="nav-link" href="' . URLROOT . PAGE .'/login">Login</a>
                </li>';
         }
        ?>
        </ul>
      </div>
    </div>
</nav>
