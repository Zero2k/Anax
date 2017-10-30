<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #FA7252;">
  <div class="container">
    <a class="navbar-brand" style="color: #FFF" href="<?= $app->url->create("") ?>">Ramverk 1</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <ul class="navbar-nav">
        <?= $app->navbar->renderNav() ?>
    </ul>
  </div>
  </div>
</nav>

