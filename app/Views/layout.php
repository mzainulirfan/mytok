<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url(); ?>dist/css/style.css">
    <link rel="icon" type="image/png" href="<?= base_url(); ?>dist/img/logo.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
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
    <script src="<?= base_url(); ?>dist/js/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script>
        $(document).ready(function() {
            // Delegation to handle dynamically added elements
            $(document).on('click', '#btnEdit', function() {
                // Get data from button
                var categoryId = $(this).data('categoryid');
                var categoryName = $(this).data('categoryname');
                var categoryDescription = $(this).data('categorydescription');
                // Set data to modal fields
                // $('#categoryName').text(categoryName);
                $('#categoryId').val(categoryId);
                $('#categoryName').val(categoryName);
                $('#categoryNameLabel').text(categoryName);
                $('#categoryDescription').val(categoryDescription);
            });
        });
        $(document).ready(function() {
            // Delegation to handle dynamically added elements
            $(document).on('click', '#btnUpdateStock', function() {
                // Get data from button
                var productId = $(this).data('productid');
                var productName = $(this).data('productname');
                // Set data to modal fields
                // $('#productName').val(productName);
                $('#productId').val(productId);
                $('#productName').val(productName);
                $('#productNameLabel').text(productName);
            });
        });
    </script>
</body>

</html>
