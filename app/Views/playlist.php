<?= $this->include('layouts/header') ?>

<div class="muziekInplaylist" id="muziekInplaylist">
     <?php

          foreach($playlist as $count => $playlists){
     ?>
          <label><?php echo $playlists["namePlaylist"]; ?></label>
          <input type="checkbox" name=""><br>
     <?php } ?>
</div>

<header class="hoofdPagH">
     <p class="gebruiker">welkom <?= current_user()["UserName"]; ?></p>
     <a class="uitloggen" href="/uitloggen">Uitloggen</a>
</header>

<div class="container">
     <div class="playlistSide">
          <div class="Playlist">
               <p>je Playlists</p>
               <?php foreach($playlist as $count => $playlists){ ?>
                    <p class="namePlaylist"><?php echo $playlists["namePlaylist"]; ?></p>
               <?php } ?>
               <div class="createPlaylist">
                    <?php
                         $hidden = ["UserId" => current_user()["UserId"]];
                         echo form_open("/playlist/createPlaylist", "", $hidden);
                    ?>
                         <label for="playlistName">maak hier een playlist aan</label>
                         <input type="text" name="namePlaylist">
                         <input type="submit">
                    </form>
               </div>
          </div>
     </div>

     <div class="songsSide">
          <?php foreach($songs as $count => $song){ ?>
               <div class="songblock">
                    <a href="/showSong/<?= $song->id; ?>">
                         <div>
                              <p><?= $song->nameSong; ?></p>
                         </div>
                    </a>
                    <div class="playlistZetten" id="showmuziekInplaylist<?php echo $count ?>"></div>
               </div>
          <?php
               }
          ?>

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

<script>
     var muziekInplaylist = document.getElementById("muziekInplaylist");
     var liedjes = <?= json_encode($songs); ?>

     console.log(liedjes);

     for(let i=0; i<=liedjes.length-1; i++){
          document.getElementById("showmuziekInplaylist" + i).onclick = function(){

          }
     }

</script>