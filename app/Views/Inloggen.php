<?= $this->include('layouts/header') ?>

<header>
    <?php
        if(isset($create)){
    ?>
        <a href="/inloggen"><button class="hoofdLetters">inloggen</button></a>
    <?php
        }
        else{
    ?>
        <a href="/create/createAccount"><button class="hoofdLetters">create account</button></a>
    <?php
        }
    ?>
</header>

<div class="inloggen">
    <h1 class="hoofdLetters"><?php if(isset($create)){ ?>create account<?php } else{ ?>inloggen<?php } ?></h1>
    <?php
        if(isset($create)){
            echo form_open("/Home/createAccount");
        }
        else{
            echo form_open("/Home/inloggen");
        }
    ?>
        <label class="label" for="UserName">Name</label>
        <input class="input" type="text" name="UserName">

        <label class="label" for="Name">Password</label>
        <input class="input" type="password" name="Password">

        <div class="centerV">
            <button class="hoofdLetters"><?php if(isset($create)){ ?> create account <?php } else{ ?> inloggen <?php } ?></button>
        </div>
    </form>
</div>
</body>
</html>

<script src="<?php echo base_url('js/warning.js'); ?>"></script>