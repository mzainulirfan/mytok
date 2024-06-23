<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<div class="flex items-center justify-between w-8/12">
    <h1 class="text-2xl font-semibold capitalize">cart</h1>
    <?php if (!empty($cartItems)) : ?>
        <form action="<?= base_url(); ?>orders/clearCart" method="post" class="text-end">
            <button type="submit" class="text-red-500 capitalize flex-shrink-0 whitespace-nowrap hover:text-red-700 transition duration-200 hover:underline hover:underline-offset-8">
                clear cart
            </button>
        </form>
    <?php endif; ?>
</div>
<div class="py-4 my-3 rounded-lg flex gap-6">
    <?php if (!empty($cartItems)) : ?>
        <div class="flex flex-col w-8/12 gap-3">
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
                        <h5 class="font-semibold text-gray-900 text-nowrap"><?= formatRupiah(esc($item['product_price']) * $item['quantity']); ?></h5>
                        <form action="<?= base_url(); ?>orders/updateItemQty" method="post">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="productId" value="<?= esc($item['product_id']); ?>">
                            <?php if ($item['quantity'] >= 0) : ?>
                                <div class="flex items-center space-x-2">
                                    <input type="number" name="productQty" id="productQty" min="1" max="<?= $item['product_stock']; ?>" value="<?= esc($item['quantity']); ?>" class="w-16 px-2 py-1 border border-gray-200 rounded-md">
                                    <button type="submit" class="px-2 py-1 rounded-md bg-green-100 text-blue-600 font-semibold text-sm border-blue-600 border">Apply</button>
                                </div>
                            <?php else : ?>
                                <span class="p-2 border border-red-500 rounded-md">out of stock</span>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="border-l pl-6 flex flex-col flex-1">
            <div class="flex flex-col space-y-3 mb-5 border-b pb-5">
                <h3 class="font-semibold mb-1">Address</h3>
                <div class="flex flex-col space-y-3 mb-5 border-b pb-5">
                    <h3 class="font-semibold mb-1">Address</h3>
                    <div class="flex flex-col space-y-2" id="selected-address">
                        <h5 class="font-semibold" id="address-name">Nahla Aufa <span class="text-gray-400 text-base" id="address-phone">08499494949</span></h5>
                        <p class="text-sm text-gray-400" id="address-details">kp sukamanah no 41 desa bojongkunci kec pameungpeuk kab bandung jawa barat</p>
                        <p class="text-sm text-gray-400" id="address-postcode">8393939</p>
                    </div>
                    <button data-modal-target="address-modal" data-modal-toggle="address-modal" class="text-gray-500 hover:text-orange-500 text-end transition duration-200 capitalize">change address</button>
                </div>
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
                    <a href="<?= base_url(); ?>product" class="capitalize text-sm text-gray-400 flex items-center space-x-1 hover:text-blue-400 transition duration-200">
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
<!-- Default Modal -->
<div id="address-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-lg max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                    Select address
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="address-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <form id="address-form">
                    <?php foreach ($addresses as $address) : ?>
                        <div class="flex space-x-3 items-center address-option" data-address-id="<?= $address['address_id']; ?>" data-address-name="<?= $address['address_name']; ?>" data-address-phone="<?= $address['address_phone']; ?>" data-address-details="<?= $address['address_line']; ?>" data-address-postcode="<?= $address['address_postal_code']; ?>">
                            <input type="radio" id="address-<?= $address['address_id']; ?>" name="address" value="<?= $address['address_id']; ?>">
                            <label for="address-<?= $address['address_id']; ?>"><?= $address['address_name']; ?></label>
                        </div>
                    <?php endforeach; ?>
                    <button type="button" id="select-address-button" class="px-4 py-1 bg-blue-500 rounded-md text-white capitalize block">Select</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
