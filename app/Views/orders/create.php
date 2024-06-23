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
                <?php if ($userAddress) : ?>
                    <div class="flex flex-col space-y-2" id="selected-address">
                        <h5 class="font-semibold" id="address-name"><?= $userAddress['address_name']; ?> <span class="text-gray-400 text-base" id="address-phone"><?= $userAddress['address_phone']; ?></span></h5>
                        <p class="text-sm text-gray-400" id="address-details"><?= $userAddress['address_line'] . ' - ' . $userAddress['address_kecamatan'] . ' - ' . $userAddress['address_kabupaten'] . ' - ' . $userAddress['address_province']; ?></p>
                        <p class="text-sm text-gray-400" id="address-postcode">8393939</p>
                    </div>
                    <button data-modal-target="address-modal" data-modal-toggle="address-modal" class="text-gray-500 hover:text-orange-500 text-end transition duration-200 capitalize">change address</button>
                <?php else : ?>
                    No address found!.
                    <a class="hover:text-blue-400 hover:underline" href="<?= base_url(); ?>users/<?= $user['username_user']; ?>/address">Create address </a>
                <?php endif; ?>

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
    <?php endif; ?>
</div>

<!-- Default Modal -->
<div id="address-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-lg max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-xl font-medium text-gray-900">
                    Select address
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="address-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4">
                <form id="address-form">
                    <ul class="space-y-4 mb-4">
                        <?php foreach ($addresses as $address) : ?>
                            <li class="address-option" data-address-id="<?= $address['address_id']; ?>" data-address-name="<?= $address['address_name']; ?>" data-address-phone="<?= $address['address_phone']; ?>" data-address-details="<?= $address['address_line']; ?>" data-address-postcode="<?= $address['address_postal_code']; ?>">
                                <input type="radio" id="address-<?= $address['address_id']; ?>" name="address" value="address-<?= $address['address_id']; ?>" class="hidden peer" required />
                                <label for="address-<?= $address['address_id']; ?>" class="inline-flex items-center justify-between w-full p-5 text-gray-900 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-900 hover:bg-gray-100">
                                    <div class="block">
                                        <div class="w-full text-lg font-semibold"><?= $address['address_name']; ?></div>
                                        <div class="w-full text-gray-500"><?= $address['address_line'] . ' - ' . $address['address_kecamatan'] . ' - ' . $address['address_kabupaten'] . ' - ' . $address['address_province']; ?></div>
                                    </div>
                                </label>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </form>
                <button type="button" data-modal-hide="address-modal" class="text-white inline-flex w-full justify-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Done
                </button>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>