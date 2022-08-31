<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('css/style.css'); ?>">
    <script src="https://kit.fontawesome.com/bd7d037b53.js" crossorigin="anonymous"></script>
    <title>Home</title>
</head>
<body>

<?php if(session()->has("warning")): ?>
    <div id="warning">
        <?= session("warning") ?>
    </div>
<?php endif; ?>