<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<h1 class="text-2xl font-semibold capitalize">detail product</h1>
<div class="flex space-x-6 my-6">
    <div class="border w-5/12 bg-gray-500 h-96 rounded-lg"></div>
    <div class="flex flex-col flex-1">
        <div class="flex flex-col mb-4 flex-1 space-y-3">
            <div class="flex flex-col space-y-2 border-b pb-6 w-full">
                <h5 class="text-xl capitalize font-semibold"><?= $product['product_name']; ?></h5>
                <p class="mt-4 text-lg">Rp. <?= esc($product['product_price']); ?></p>
                <p class="bg-gray-300 px-2 py-0.5 rounded text-sm capitalize font-semibold text-gray-600 w-max"><?= esc($product['category_name']); ?></p>
            </div>
            <div class="block border-b pb-6">
                <h4 class="mt-6">Description</h4>
                <p><?= esc($product['product_desc']); ?></p>
                <p class="mb-6">created at <?= esc($product['created_at']); ?></p>
                <a href="<?= base_url(); ?>product/<?= esc($product['product_slug']); ?>/edit" class="mt-4 border px-4 py-2 rounded-lg capitalize bg-gray-500 text-white hover:bg-gray-200 hover:text-slate-900 transition duration-200 w-max">add to cart</a>
            </div>
        </div>

        <a href="<?= base_url(); ?>product/<?= esc($product['product_slug']); ?>/edit" class="border border-gray-300 px-4 py-2 rounded-lg capitalize hover:bg-gray-200 hover:text-slate-900 transition duration-200 w-max">edit</a>
    </div>
</div>

<?= $this->endSection(); ?>
