<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<h1 class="text-2xl font-semibold capitalize">cart</h1>
<div class="py-4 my-3 rounded-lg flex gap-6">
    <?php if (!empty($cartItems)) : ?>
        <div class="flex flex-col w-8/12 gap-3">
            <form action="<?= base_url(); ?>orders/clearCart" method="post" class="text-end">
                <button type="submit" class="text-red-300 capitalize flex-shrink-0 whitespace-nowrap hover:text-red-500 transition duration-200 hover:underline hover:underline-offset-8">
                    clear cart
                </button>
            </form>
            <?php foreach ($cartItems as $item) : ?>
                <?php
                if (!isset($item['quantity'])) {
                    $item['quantity'] = 1;
                }
                ?>
                <div class="border p-4 rounded-lg  flex justify-between">
                    <div class="flex space-x-2 w-10/12">
                        <div class="w-24 h-20 bg-gray-300 rounded-md overflow-hidden">
                            <img src="<?= base_url(); ?>dist/img/product/product1.png" alt="product1" class="w-full object-cover">
                        </div>
                        <div class="flex flex-col justify-between">
                            <div class="flex flex-col">
                                <a href="<?= base_url(); ?>product/<?= esc($item['product_slug']); ?>/detail" class="font-semibold capitalize"><?= esc($item['product_name']); ?><span class="px-2 py-0.5 bg-green-100 rounded text-xs capitalize font-semibold text-green-600">In Stock</span></a>
                                <p>Stock : <span class="text-sm font-semibold"><?= esc($item['product_stock']); ?></span></p>
                            </div>
                            <form action="<?= base_url(); ?>orders/removeFromCart" method="post">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="productName" value="<?= esc($item['product_name']); ?>">
                                <button type="submit" class="text-gray-400 font-semibold capitalize text-xs hover:text-red-400 transition duration-200">remove</button>
                            </form>
                        </div>
                    </div>
                    <div class="flex-1 flex flex-col justify-between items-end">
                        <h5 class="font-semibold text-gray-900 text-nowrap"><?= formatRupiah(esc($item['product_price'])); ?></h5>
                        <form action="">
                            <div class="relative flex items-center">
                                <button type="button" id="decrement-button" data-input-counter-decrement="counter-input" class="flex-shrink-0 bg-gray-100 hover:bg-gray-200 inline-flex items-center justify-center border border-gray-300 rounded-md h-5 w-5 focus:ring-gray-100 focus:ring-2 focus:outline-none">
                                    <svg class="w-2.5 h-2.5 text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                    </svg>
                                </button>
                                <input type="text" id="counter-input" data-input-counter class="flex-shrink-0 text-gray-900 border-0 bg-transparent text-sm font-normal focus:outline-none focus:ring-0 max-w-[2.5rem] text-center" placeholder="" value="<?= esc($item['quantity']); ?>" required />
                                <button type="button" id="increment-button" data-input-counter-increment="counter-input" class="flex-shrink-0 bg-gray-100 hover:bg-gray-200 inline-flex items-center justify-center border border-gray-300 rounded-md h-5 w-5 focus:ring-gray-100 focus:ring-2 focus:outline-none">
                                    <svg class="w-2.5 h-2.5 text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="border-l pl-6 flex flex-col flex-1">
            <div class="flex flex-col space-y-3 mb-5 border-b pb-5">
                <h3 class="font-semibold mb-1">Address</h3>
                <div class="flex flex-col space-y-2">
                    <h5 class="font-semibold">Nahla Aufa <span class="text-gray-400 text-base">08499494949</span></h5>
                    <p class="text-sm text-gray-400">kp sukamanah no 41 desa bojongkunci kec pameungpeuk kab bandung jawa barat</p>
                    <p class="text-sm text-gray-400">8393939</p>
                </div>
                <button class="text-gray-500 hover:text-orange-500 text-end transition duration-200 capitalize">change address</button>
            </div>
            <div class=" flex flex-col">
                <h3 class="font-semibold mb-3">Pricing Details</h3>
                <div class="flex items-center justify-between">
                    <p class="text-gray-400">Subtotal</p>
                    <p class="font-semibold text-gray-700"><?= formatRupiah($totalPrice) ?></p>
                </div>
                <div class="flex items-center justify-between mb-8">
                    <p class="text-gray-400">Shipping Fee</p>
                    <p class="font-semibold text-gray-700">Rp 100.000</p>
                </div>
                <div class="flex items-center justify-between mt-5">
                    <a href="<?= base_url(); ?>product" class="capitalize text-gray-400 flex items-center space-x-1 hover:text-blue-400 transition duration-200">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 17L13 12L18 7M11 17L6 12L11 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span>shopping again</span>
                    </a>
                    <form action="<?= base_url(); ?>orders/checkout" method="post">
                        <input type="hidden" name="productId" value="<?= $item['product_id']; ?>">
                        <input type="hidden" name="totalAmount" value="<?= $totalPrice ?>">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg border capitalize ">checkout</button>
                    </form>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="w-full">
            <p>not found</p>
            <a href="<?= base_url(); ?>product" class="inline-flex items-center space-x-1 my-3 capitalize hover:text-blue-500 transition duration-200">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 17L13 12L18 7M11 17L6 12L11 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span>back to product</span>
            </a>
        </div>
</div>
<?php endif; ?>
<?= $this->endSection(); ?>
