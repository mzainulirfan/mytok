<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<h1 class="text-2xl font-semibold capitalize">Detail : #order <?= esc($order['order_id']); ?></h1>
<div class="mt-6 border p-4 py-6 rounded-lg">
  Billed to :
  <p>product list</p>
  <ul>
    <?php foreach ($orderItems as $item) : ?>
      <li><?= esc($item['product_name']); ?></li>
    <?php endforeach; ?>
  </ul>
</div>
<?= $this->endSection(); ?>