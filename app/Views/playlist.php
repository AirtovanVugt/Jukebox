<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/headpageHeader') ?>




<div class="container">
     <div class="playlistSide">
          <div class="Playlist">
               <p>je Playlists</p>
               <?php foreach($playlist as $count => $playlists){ ?>
                    <p class="namePlaylist" id="<?php echo $playlists["playlistId"]; ?>"><?php echo $playlists["namePlaylist"]; ?></p>
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
                    <a href="/setInPlaylist/<?= $song->id ?>">
                         <div class="playlistZetten"></div>
                    </a>
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
     <div class="playlistSection">
          <h1 class="white" id="titleplaylist"></h1>
          <div id="theList">

          </div>
     </div>
</div>
</body>
</html>
<script src="<?php echo base_url('js/warning.js'); ?>"></script>

<script>
     var playlists = <?php echo json_encode($playlist) ?>;
     var songs = <?php echo json_encode($songs) ?>;
     var songsinplaylist = <?php echo json_encode($songinplaylist) ?>;
     console.log(songs, playlists, songsinplaylist);

     for(let i=0; i<=playlists.length-1; i++){
          document.getElementById(playlists[i]["playlistId"]).onclick = function(){
               document.getElementById("titleplaylist").innerHTML = playlists[i]["namePlaylist"];
               var theList = document.getElementById("theList");
               theList.innerHTML = "";
               for(let t=0; t<=songsinplaylist.length-1; t++){
                    if(playlists[i]["playlistId"] == songsinplaylist[t]["playlistId"]){
                         var iets = songsinplaylist[t];
                         console.log(iets);
                         var a = document.createElement('a');
                         var breken = document.createElement("br");
                         a.innerText = songs[t]["nameSong"];
                         a.href = "/deleteSong/" + songsinplaylist[t]["songPlaylistId"];
                         theList.appendChild(a);
                         theList.appendChild(breken);
                    }
               }
          }
     }

</script>