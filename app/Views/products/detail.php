<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<h1 class="text-2xl font-semibold capitalize">detail product</h1>
<a href="<?= base_url(); ?>product" class="inline-flex items-center space-x-1 my-3 capitalize hover:text-blue-500 transition duration-200">
    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M18 17L13 12L18 7M11 17L6 12L11 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
    <span>back to product</span>
</a>
<div class="flex space-x-6 my-3">
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
                <form action="<?= base_url(); ?>orders/addToCart" method="post">
                    <input type="hidden" name="productId" value="<?= esc($product['product_id']); ?>">
                    <input type="hidden" name="productQty" value="<?= esc($product['product_stock'] == 0) ? 0 : 1; ?>">
                    <?php if ($product['product_stock'] == 0) : ?>
                        <button type="button" class="mt-4 border px-4 py-2 rounded-lg capitalize bg-gray-500 text-white hover:bg-gray-200 hover:text-slate-900 transition duration-200 w-max" disabled>add to cart</button>
                    <?php else : ?>
                        <button type="submit" class="mt-4 border px-4 py-2 rounded-lg capitalize bg-gray-500 text-white hover:bg-gray-200 hover:text-slate-900 transition duration-200 w-max">add to cart</button>

                    <?php endif; ?>
                </form>
            </div>
        </div>
        <a href="<?= base_url(); ?>product/<?= esc($product['product_slug']); ?>/edit" class="border border-gray-300 px-4 py-2 rounded-lg capitalize hover:bg-gray-200 hover:text-slate-900 transition duration-200 w-max">edit</a>
    </div>
</div>

<?= $this->endSection(); ?>
