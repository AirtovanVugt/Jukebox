<?= $this->include('layouts/header') ?>

<header class="hoofdPagH">
     <p class="gebruiker">welkom <?= current_user()["UserName"]; ?></p>
     <a class="uitloggen" href="/uitloggen">Uitloggen</a>
</header>

<div class="container">
     <div class="playlistSide">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem architecto autem fuga voluptatem at, laudantium optio quo id pariatur accusamus praesentium odio corporis ad error perferendis tempora possimus voluptate est!
     </div>

     <div class="songsSide">
          <?php foreach($songs as $count => $song){ ?>
               <a href="/showSong/<?= $song->id; ?>">
               <div class="songblock">
                    <p><?= $song->nameSong; ?></p>
               </div>
          </a>
          <?php } ?>
     

     </div>
     <div class="chooseGenre">
          <ul>
               <li>Genres:</li>
               <?php foreach($genres as $count => $genre){ ?>
                    <li><a class="chooceGenre" href="/playlistgen/<?= $genre->GenreId ?>"><?= $genre->Genre; ?></a></li>
               <?php } ?>
               <li><a href="/playlist">all songs</a></li>
          </ul>
     </div>
</div>
</body>
</html>