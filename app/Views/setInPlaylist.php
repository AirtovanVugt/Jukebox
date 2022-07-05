<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/headpageHeader') ?>
<div class="bigCard">
    <h1><?php echo $songs["nameSong"]; ?></h1>
    <?php
        $hidden = ["UserId" => current_user()["UserId"], "songId" => $songs["id"]];
        echo form_open("/playlist/setSongInPlaylist", "", $hidden);
    ?>
    <?php foreach($playlist as $count => $playlists){ ?>
        <label><?php echo $playlists["namePlaylist"]; ?></label>
        <input type="hidden" name="playlist<?php echo $count; ?>" value="0">
        <input id="check<?php echo $count; ?>" type="checkbox" name="playlist<?php echo $count; ?>" value="0">
        <br>
    <?php } ?>
    <br>
    <input type="submit">
 
    </form>
</div>
<a class="white" href="/playlist">back</a>
<p class="white"><?php var_dump(session()->get("song")) ?></p>
</body>
</html>

<script>
    var playlists = <?php echo json_encode($playlist) ?>;

    for(let i=0; i<=playlists.length-1; i++){
        document.getElementById("check" + i).onclick = function(){
            if(document.getElementById("check" + i).checked == true){
                document.getElementById("check" + i).value = playlists[i]["playlistId"];
            }
            else{
                document.getElementById("check" + i).value = "0";
            }
        }
    }

</script>