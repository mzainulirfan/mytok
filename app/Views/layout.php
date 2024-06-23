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
        // change category
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
        // update stock
        $(document).ready(function() {
            // Delegation to handle dynamically added elements
            $(document).on('click', '#btnUpdateStock', function() {
                // Get data from button
                var productId = $(this).data('productid');
                var productName = $(this).data('productname');
                var productQty = $(this).data('productqty');
                // Set data to modal fields
                // $('#productName').val(productName);
                $('#productId').val(productId);
                $('#productName').val(productName);
                $('#productStockQty').val(productQty);

                $('#productNameClear').val(productName);
                $('#productIdClear').val(productId);
                $('#productNameLabel').text(productName);
            });
        });

        // edit address user
        $(document).ready(function() {
            $(document).on('click', '#btnEditAddress', function() {
                // ambil data dari tombol
                var addressId = $(this).data('addressid');
                var addressName = $(this).data('addressname');
                var addressLine = $(this).data('addressline');
                var addressPhone = $(this).data('addressphone');
                var addressKecamatan = $(this).data('addresskec');
                var addressKabupaten = $(this).data('addresskab');
                var addressProv = $(this).data('addressprov');
                var addressPostal = $(this).data('addresspostal');
                // simpan nilai kedalam input
                $('#currentAddressId').val(addressId);
                $('#addressName').val(addressName);
                $('#nameLabel').text(addressName);
                $('#addressPhone').val(addressPhone);
                $('#addressLine').val(addressLine);
                $('#addressKecamatan').val(addressKecamatan);
                $('#addressKabupaten').val(addressKabupaten);
                $('#addressProvency').val(addressProv);
                $('#addressPostalCode').val(addressPostal);
            });
        });
        // img preview
        $(document).ready(function() {
            $('#photoUser').change(function() {
                var input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#previewImg').attr('src', e.target.result);
                        $('#previewDiv').removeClass('hidden');
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    $('#previewDiv').addClass('hidden');
                }
            });
        });


        $(document).ready(function() {
            // When a radio button is clicked
            $('.address-option').on('click', function() {
                // Select the corresponding radio button
                $(this).find('input[type="radio"]').prop('checked', true);
            });

            // When the select button is clicked
            $('#select-address-button').on('click', function() {
                // Get the selected address
                var selectedAddress = $('input[name="address"]:checked');
                if (selectedAddress.length > 0) {
                    // Get address details from data attributes
                    var addressName = selectedAddress.closest('.address-option').data('address-name');
                    var addressPhone = selectedAddress.closest('.address-option').data('address-phone');
                    var addressDetails = selectedAddress.closest('.address-option').data('address-details');
                    var addressPostcode = selectedAddress.closest('.address-option').data('address-postcode');

                    // Update the main address section
                    $('#address-name').text(addressName);
                    $('#address-phone').text(addressPhone);
                    $('#address-details').text(addressDetails);
                    $('#address-postcode').text(addressPostcode);

                    // Close the modal (assuming you're using a modal library, adjust accordingly)
                    // $('#address-modal').addClass('hidden'); // Hide the modal
                } else {
                    alert('Please select an address.');
                }
            });
        });
    </script>
</body>

</html>
