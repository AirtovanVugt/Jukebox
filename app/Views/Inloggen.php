<?= $this->include('layouts/header') ?>

    <div class="inloggen">
        <h1 class="hoofdLetters">inloggen</h1>
        <?= form_open("/Admin/Users/update/") ?>
            <label class="label" for="Name">Name</label>
            <input class="input" type="text" name="Name">

            <label class="label" for="Name">Password</label>
            <input class="input" type="password" name="Password">

            <div class="centerV">
                <button class="hoofdLetters">inloggen</button>
            </div>
        </form>
    </div>

</body>
</html>

<script>
    
</script>