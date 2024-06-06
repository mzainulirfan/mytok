<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url(); ?>dist/css/style.css">
    <title><?= isset($title) ? $title . ' | ' : ''; ?> myTok</title>
</head>

<body class="font-inter text-slate-900">
    <?= $this->include('partial/header'); ?>
    <main class="flex">
        <?= $this->include('partial/sidebar'); ?>
        <main class="p-6 w-full">
            <?= $this->renderSection('content'); ?>
        </main>
    </main>
</body>

</html>
