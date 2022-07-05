<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/headpageHeader') ?>

<h1 class="white">Naam: <?php echo $song["nameSong"]; ?></h1><br>
<h2 class="white">Lyrics:</h2>
<p class="white"><?php echo $song["lyrics"]; ?></p>
<br>
<p class="white">duurt <?php echo $song["Tijd"]; ?></p>
<br>
<a class="white" href="/playlist">back</a>

</body>
</html>