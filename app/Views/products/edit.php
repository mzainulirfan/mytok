<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<h1 class="text-2xl font-semibold">Edit <?= esc($product['product_name']); ?></h1>
<div class="mt-6 p-6 rounded-lg">
    <form action="<?= base_url(); ?>product/update/<?= $product['product_id']; ?>" method="post" class="w-8/12 mx-auto space-y-4 border p-8 rounded-lg shadow-2xl">
        <?= csrf_field() ?>
        <input type="hidden" name="productId" value="<?= esc($product['product_id']); ?>">
        <div class="flex flex-col space-y-1.5">
            <label for="productName">Product Name</label>
            <input type="text" value="<?= esc(old('productName') ? old('productname') : $product['product_name']); ?>" name="productName" id="productName" placeholder="product name" class="border p-2 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('productName')) ? 'invalid' : 'form-control' ?>">
            <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('productName')) : ?>
                <div class=" text-red-500 text-xs">
                    <?= $validation->getError('productName'); ?>
                </div>
            <?php endif ?>
        </div>
        <div class="flex flex-col space-y-1.5">
            <label for="productCategory">Category</label>
            <select name="productCategory" id="productCategory" class="border p-2 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('productCategory')) ? 'invalid' : 'form-control' ?>">
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= esc($category['category_id']); ?>" <?= set_select('productCategory', $category['category_id'], ($product['product_category'] == $category['category_id'])); ?> class="capitalize"><?= esc($category['category_name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="flex flex-col space-y-1.5">
            <label for="productDescription">Description</label>
            <textarea name="productDescription" id="productDescription" rows="5" placeholder="Write your thoughts here..." class="border p-2 rounded-lg outline-none resize-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('productDescription')) ? 'invalid' : 'form-control' ?>"><?= esc(old('productDescription') ? old('productDescription') : $product['product_desc']); ?></textarea>
            <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('productDescription')) : ?>
                <div class=" text-red-500 text-xs">
                    <?= $validation->getError('productDescription'); ?>
                </div>
            <?php endif ?>
        </div>
        <div class="flex flex-col space-y-1.5">
            <label for="productPrice">Price</label>
            <input type="text" value="<?= esc(old('productPrice') ? old('productPrice') : $product['product_price']); ?>" name="productPrice" id="productPrice" placeholder="product price" class="border p-2 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('productPrice')) ? 'invalid' : 'form-control' ?>">
            <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('productPrice')) : ?>
                <div class=" text-red-500 text-xs">
                    <?= $validation->getError('productPrice'); ?>
                </div>
            <?php endif ?>
        </div>
        <div class="flex flex-col space-y-1.5">
            <label for="productStock">Stock</label>
            <input type="text" value="<?= esc(old('productStock') ? old('productStock') : $product['product_stock']); ?>" name="productStock" id="productStock" placeholder="product Stock" class="border p-2 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('productStock')) ? 'invalid' : 'form-control' ?>">
            <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('productStock')) : ?>
                <div class=" text-red-500 text-xs">
                    <?= $validation->getError('productStock'); ?>
                </div>
            <?php endif ?>
        </div>
        <div class="flex items-center space-x-2">
            <input type="checkbox" name="isActive" id="isActive" class="rounded" <?= esc($product['product_is_active']) ? 'checked' : ''; ?>>
            <label for="isActive">
                Publish this product?
            </label>
        </div>
        <button class="border p-2 rounded-lg outline-none form-control hover:bg-gray-200 hover:text-slate-900 transition duration-200" type="submit">Save</button>
        <a href="<?= base_url(); ?>product" class="border p-2 rounded-lg outline-none form-control hover:bg-gray-200 hover:text-slate-900 transition duration-200">back to product</a>
    </form>
</div>
<?= $this->endSection(); ?>
