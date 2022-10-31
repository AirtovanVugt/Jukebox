<?php
     echo $this->include('playlistClass/playlistClass');
     echo $this->include('layouts/header');
     echo $this->include('layouts/headpageHeader');
     $sessionId = session()->get("playlist");
     $tijdelijkeplaylist = new tijdelijkeplaylist($sessionSongs);
?>

<div id="backgroundplaylistSection" class=backgroundplaylistSection>
     <div class="playlistSection">
          <i id="closeSection" class="fa-solid fa-xmark"></i>
          <h1 id="titleplaylist"></h1>
          <div id="theList">
               <a id="tijdelijke">tijdelijke playlist</a>
               <br>
               <?php foreach($playlist as $count => $playlists){ ?>
                    <a id="setinPlaylist<?= $playlists->playlistId ?>"><?= $playlists->namePlaylist; ?></a><br>
               <?php } ?>
          </div>
     </div>
</div>

<div class="container">
     <div class="playlistSide">
          <div class="Playlist">
               <p>je tijdelijke Playlist</p>
               <?php foreach($tijdelijkeplaylist->songs as $count => $playlists){ ?>
                    <a href="/showSong/<?= $sessionId[$count]; ?>" class="namePlaylist"><?php echo $playlists; ?></a><a href="/removeInSession/<?php echo $count ?>"><i class="fa-solid fa-trash-can"></i></a><br>
               <?php } ?>
               <p>deze playlist duurt <?= $sessiontime["minutes"]; ?>:<?= $sessiontime["secondes"]; ?> minuten</p>
               <div class="createPlaylist">
               <?php
                    echo form_open("/createPlaylist");
               ?>
                    <labe>Maak de playlist aan</label>
                    <input type="text" name="namePlaylist">
                    <input type="submit" value="aanmaken">
                    </form>
               </div>

               <div class="opgeslagenplaylisten">
                    <?php foreach($playlist as $count => $playlists){ ?>
                         <h4 id="jePlaylisten<?= $count ?>"><?= $playlists->namePlaylist; ?></h4><a href="/deletePlaylist/<?= $playlists->playlistId ?>"><i class="fa-solid fa-trash-can"></i></a><br>
                         <div id="liedjesvanPlaylist<?= $count ?>" class="liedjesvanPlaylist">
                              <?php
                                   foreach($songinplaylist as $count => $songplaylist){
                                        if($songplaylist->playlistId == $playlists->playlistId){
                              ?>
                                             <a href="/showSong/<?= $songplaylist->songId; ?>"><?= $songplaylist->nameSong; ?></a><a href="/removesongInPlaylist/<?= $songplaylist->songplaylistId; ?>"><i class="fa-solid fa-trash-can"></i></a><br>
                              <?php
                                        }
                                   }
                              ?>
                                   <p id="timePlaylist<?= $playlists->playlistId ?>"></p>
                              <?php
                                   $hidden = ["playlistId" => $playlists->playlistId];
                                   echo form_open("/changPlaylisname", "", $hidden);
                              ?>
                                        <label for="namePlaylist">verander de playlist naam</label><br>
                                        <input type="text" name="namePlaylist"><br>
                                        <input type="submit" value="verander">
                                   </form>
                         </div>
                    <?php } ?>
               </div>
          </div>
     </div>

     <div class="songsSide">
          <?php foreach($songs as $count => $song){ ?>
               <div class="songblock">
                    <a href="/showSong/<?= $song->songId; ?>">
                         <div>
                              <p><?= $song->nameSong; ?></p>
                         </div>
                    </a>
                    <div class="playlistZetten" id="song<?php echo $count; ?>"></div>
               </div>
          <?php
               }
          ?>
     </div>

     <div class="chooseGenre">
          <ul>
               <li>Genres:</li>
               <?php foreach($genres as $count => $genre){ ?>
                    <li><a class="chooceGenre" href="/oneGenre/<?= $genre->genreId ?>"><?= $genre->genre; ?></a></li>
               <?php } ?>
               <li><a href="/oneGenre/0">all songs</a></li>
          </ul>
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
     console.log(playlists, songsinplaylist);

     var minutes = [];
     var secondes = [];
     var totalmin = 0;
     var totalsec = 0;

     for(let i=0; i<=playlists.length-1; i++){
          for(let j=0; j<=songsinplaylist.length-1; j++){
               if(playlists[i]["playlistId"] == songsinplaylist[j]["playlistId"]){
                    var time = songsinplaylist[j]["time"];
                    var thetime = time.split(":");
                    minutes.push(Number(thetime["0"]));
                    secondes.push(Number(thetime["1"]));
               }
          }
          for(let j=0; j<=minutes.length-1; j++){
               totalmin += minutes[j];
               totalsec += secondes[j];
               if(totalsec >= 59){
                    totalsec -= 60;
                    totalmin++;
               }
          }
          if(totalmin == 0 && totalsec == 0){
               document.getElementById("timePlaylist" + playlists[i]["playlistId"]).innerText = "deze playlist duurt " + totalmin + "0:0" + totalsec;
          }
          else if(totalsec <= 9){
               document.getElementById("timePlaylist" + playlists[i]["playlistId"]).innerText = "deze playlist duurt " + totalmin + ":0" + totalsec;
          }
          else{
               document.getElementById("timePlaylist" + playlists[i]["playlistId"]).innerText = "deze playlist duurt " + totalmin + ":" + totalsec;
          }
          
          minutes = [];
          secondes = [];
          totalmin = 0;
          totalsec = 0;
     }

     document.getElementById("closeSection").onclick = function(){
          document.getElementById("backgroundplaylistSection").style.display = "none";
     }

     for(let i=0; i<=songs.length-1; i++){
          document.getElementById("song" + i).onclick = function(){
               document.getElementById("titleplaylist").innerText = songs[i]["nameSong"];
               document.getElementById("backgroundplaylistSection").style.display = "block";
               document.getElementById("tijdelijke").href = "/setInSession/" + songs[i]["songId"];
               for(let j=0; j<=playlists.length-1; j++){
                    document.getElementById("setinPlaylist" + playlists[j]["playlistId"]).href = "/setsongInPlaylist/" + playlists[j]["playlistId"] + "/" + songs[i]["songId"];
               }
          }
     }

     for(let i=0; i<=playlists.length-1; i++){
          document.getElementById("jePlaylisten" + i).onclick = function(){
               if(document.getElementById("liedjesvanPlaylist" + i).style.display == "block"){
                    document.getElementById("liedjesvanPlaylist" + i).style.display = "none";
               }
               else{
                    document.getElementById("liedjesvanPlaylist" + i).style.display = "block";
               }
          }
     }

</script>