<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <title><?= $data['title']; ?></title>
    <link rel="icon" type="image/x-icon" href="<?= BASEURL; ?>/icon/favicon.ico">
</head>
<body>
<div style="height:20px;" class="d-flex mb-4 p-1 justify-content-end">
    <div class="accbutton" style="<?= !isset($_SESSION['login']) ? 'display: none;' : '' ?>">
        <button type="button" onclick="confirm('Apakah anda yakin ingin keluar?') ? location.href='<?= BASEURL; ?>/akun/logout' : '';" class="btn btn-outline-danger">Sign Out</button>
    </div>
    <div class="accbutton" style="<?= isset($_SESSION['login']) ? 'display: none;' : '' ?>">
        <a class="btn btn-outline-light text-black" href="<?= BASEURL; ?>/akun/signup" role="button">Register</a>
        <a class="btn btn-primary" href="<?= BASEURL; ?>/akun/login" role="button">Login</a>
    </div>
</div>