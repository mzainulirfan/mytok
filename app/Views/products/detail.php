<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<h1 class="text-2xl font-semibold capitalize"><?= $product['product_name']; ?></h1>
<div class="flex items-start space-x-6 my-6">
  <div class="border w-6/12 bg-gray-500 h-96 rounded-lg"></div>
  <div>
    <h5 class="text-xl capitalize font-semibold"><?= $product['product_name']; ?></h5>
    <p class="mt-4 text-lg">Rp. <?= esc($product['product_price']); ?></p>
    <p class="mt-4"><?= esc($product['product_desc']); ?></p>
  </div>
</div>

<?= $this->endSection(); ?>