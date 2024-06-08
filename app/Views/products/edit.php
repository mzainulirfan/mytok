<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<h1 class="text-2xl font-semibold">Edit <?= esc($product['product_name']); ?></h1>
<div class="mt-6 border p-6 rounded-lg">
    <form action="<?= base_url(); ?>product/update" method="post" class="w-8/12 space-y-4">
        <div class="flex flex-col space-y-1.5">
            <label for="productName">Product Name</label>
            <input type="text" value="<?= esc($product['product_name']); ?>" name="productName" id="productName" placeholder="product name" class="border p-2 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('productName')) ? 'invalid' : 'form-control' ?>">
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
                    <option value="<?= esc($category['category_id']); ?>" <?= ($product['product_category'] == $category['category_id']) ? 'selected' : ''; ?> class="capitalize"><?= esc($category['category_name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="flex flex-col space-y-1.5">
            <label for="productDescription">Description</label>
            <textarea name="productDescription" id="productDescription" rows="5" placeholder="Write your thoughts here..." class="border p-2 rounded-lg outline-none resize-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('productDescription')) ? 'invalid' : 'form-control' ?>"><?= esc($product['product_desc']); ?></textarea>
            <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('productDescription')) : ?>
                <div class=" text-red-500 text-xs">
                    <?= $validation->getError('productDescription'); ?>
                </div>
            <?php endif ?>
        </div>
        <div class="flex flex-col space-y-1.5">
            <label for="productPrice">Price</label>
            <input type="text" value="<?= esc($product['product_price']); ?>" name="productPrice" id="productPrice" placeholder="product price" class="border p-2 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('productPrice')) ? 'invalid' : 'form-control' ?>">
            <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('productPrice')) : ?>
                <div class=" text-red-500 text-xs">
                    <?= $validation->getError('productPrice'); ?>
                </div>
            <?php endif ?>
        </div>
        <div class="flex flex-col space-y-1.5">
            <label for="producttock">Stock</label>
            <input type="text" value="<?= esc($product['product_stock']); ?>" name="producttock" id="producttock" placeholder="product Stock" class="border p-2 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('producttock')) ? 'invalid' : 'form-control' ?>">
            <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('producttock')) : ?>
                <div class=" text-red-500 text-xs">
                    <?= $validation->getError('producttock'); ?>
                </div>
            <?php endif ?>
        </div>
        <button class="border p-2 rounded-lg outline-none form-control" type="submit">Save</button>
    </form>
</div>
<?= $this->endSection(); ?>
