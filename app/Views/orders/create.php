<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<h1 class="text-2xl font-semibold capitalize">cart</h1>
<div class="p-4 my-6 rounded-lg flex gap-6">
    <div class="w-7/12">
        <h2 class="mb-4 text-lg font-medium text-gray-900">Select product</h2>
        <div class="relative overflow-x-auto border rounded-lg my-4">
            <table class="w-full text-sm text-left text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 w-full">
                            Product Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3 w-1">
                            Qty
                        </th>
                        <th scope="col" class="px-6 py-3 text-end">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product) : ?>
                        <form action="<?= base_url(); ?>orders/addToCart" method="post">
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap w-full truncate">
                                    <a href="" class="hover:underline hover:text-blue-500 transition duration-200 truncate"><?= esc($product['product_name']); ?></a>
                                </th>
                                <td class="px-6 py-4">
                                    <span class="font-semibold text-gray-700"><?= esc($product['product_price']); ?></span>
                                </td>
                                <td class="px-6 py-4 w-3">
                                    <input type="number" name="productQty" id="productQty" value="<?= esc($product['product_stock'] == 0) ? 0 : 1; ?>" class="w-[4rem] p-2 rounded-lg" min="1" max="<?= esc($product['product_stock']); ?>" <?= esc($product['product_stock'] == 0) ? 'disabled' : ''; ?>>
                                </td>
                                <td class="px-6 py-4">
                                    <input type="hidden" name="productId" value="<?= esc($product['product_id']); ?>">
                                    <input type="hidden" name="productName" value="<?= esc($product['product_name']); ?>">
                                    <input type="hidden" name="productPrice" value="<?= esc($product['product_price']); ?>">
                                    <?php if ($product['product_stock'] != 0) : ?>
                                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md capitalize flex-shrink-0 whitespace-nowrap">
                                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2 2H3.30616C3.55218 2 3.67519 2 3.77418 2.04524C3.86142 2.08511 3.93535 2.14922 3.98715 2.22995C4.04593 2.32154 4.06333 2.44332 4.09812 2.68686L4.57143 6M4.57143 6L5.62332 13.7314C5.75681 14.7125 5.82355 15.2031 6.0581 15.5723C6.26478 15.8977 6.56108 16.1564 6.91135 16.3174C7.30886 16.5 7.80394 16.5 8.79411 16.5H17.352C18.2945 16.5 18.7658 16.5 19.151 16.3304C19.4905 16.1809 19.7818 15.9398 19.9923 15.6342C20.2309 15.2876 20.3191 14.8247 20.4955 13.8988L21.8191 6.94969C21.8812 6.62381 21.9122 6.46087 21.8672 6.3335C21.8278 6.22177 21.7499 6.12768 21.6475 6.06802C21.5308 6 21.365 6 21.0332 6H4.57143ZM10 21C10 21.5523 9.55228 22 9 22C8.44772 22 8 21.5523 8 21C8 20.4477 8.44772 20 9 20C9.55228 20 10 20.4477 10 21ZM18 21C18 21.5523 17.5523 22 17 22C16.4477 22 16 21.5523 16 21C16 20.4477 16.4477 20 17 20C17.5523 20 18 20.4477 18 21Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    <?php else : ?>
                                        <button type="button" class="bg-blue-400 text-white px-4 py-2 rounded-md capitalize flex-shrink-0 whitespace-nowrap" disabled>
                                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2 2H3.30616C3.55218 2 3.67519 2 3.77418 2.04524C3.86142 2.08511 3.93535 2.14922 3.98715 2.22995C4.04593 2.32154 4.06333 2.44332 4.09812 2.68686L4.57143 6M4.57143 6L5.62332 13.7314C5.75681 14.7125 5.82355 15.2031 6.0581 15.5723C6.26478 15.8977 6.56108 16.1564 6.91135 16.3174C7.30886 16.5 7.80394 16.5 8.79411 16.5H17.352C18.2945 16.5 18.7658 16.5 19.151 16.3304C19.4905 16.1809 19.7818 15.9398 19.9923 15.6342C20.2309 15.2876 20.3191 14.8247 20.4955 13.8988L21.8191 6.94969C21.8812 6.62381 21.9122 6.46087 21.8672 6.3335C21.8278 6.22177 21.7499 6.12768 21.6475 6.06802C21.5308 6 21.365 6 21.0332 6H4.57143ZM10 21C10 21.5523 9.55228 22 9 22C8.44772 22 8 21.5523 8 21C8 20.4477 8.44772 20 9 20C9.55228 20 10 20.4477 10 21ZM18 21C18 21.5523 17.5523 22 17 22C16.4477 22 16 21.5523 16 21C16 20.4477 16.4477 20 17 20C17.5523 20 18 20.4477 18 21Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </form>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="border-l p-4 flex-1">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-medium text-gray-900">Your Cart <?= (!empty($cartItems)) ?  esc($totalQuantity) : ''; ?><span></span></h2>
            <?php if (!empty($cartItems)) : ?>
                <form action="<?= base_url(); ?>orders/clearCart" method="post">
                    <button type="submit" class="text-red-800 p-2 border rounded-lg border-red-200 hover:bg-red-200 flex-shrink-0 whitespace-nowrap">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 3H15M3 6H21M19 6L18.2987 16.5193C18.1935 18.0975 18.1409 18.8867 17.8 19.485C17.4999 20.0118 17.0472 20.4353 16.5017 20.6997C15.882 21 15.0911 21 13.5093 21H10.4907C8.90891 21 8.11803 21 7.49834 20.6997C6.95276 20.4353 6.50009 20.0118 6.19998 19.485C5.85911 18.8867 5.8065 18.0975 5.70129 16.5193L5 6M10 10.5V15.5M14 10.5V15.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </form>
            <?php endif ?>
        </div>
        <?php if (empty($cartItems)) : ?>
            <div class="grid place-content-center h-52">
                <div class="flex flex-col items-center gap-3">
                    <svg class="w-12 h-12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 2H3.30616C3.55218 2 3.67519 2 3.77418 2.04524C3.86142 2.08511 3.93535 2.14922 3.98715 2.22995C4.04593 2.32154 4.06333 2.44332 4.09812 2.68686L4.57143 6M4.57143 6L5.62332 13.7314C5.75681 14.7125 5.82355 15.2031 6.0581 15.5723C6.26478 15.8977 6.56108 16.1564 6.91135 16.3174C7.30886 16.5 7.80394 16.5 8.79411 16.5H17.352C18.2945 16.5 18.7658 16.5 19.151 16.3304C19.4905 16.1809 19.7818 15.9398 19.9923 15.6342C20.2309 15.2876 20.3191 14.8247 20.4955 13.8988L21.8191 6.94969C21.8812 6.62381 21.9122 6.46087 21.8672 6.3335C21.8278 6.22177 21.7499 6.12768 21.6475 6.06802C21.5308 6 21.365 6 21.0332 6H4.57143ZM10 21C10 21.5523 9.55228 22 9 22C8.44772 22 8 21.5523 8 21C8 20.4477 8.44772 20 9 20C9.55228 20 10 20.4477 10 21ZM18 21C18 21.5523 17.5523 22 17 22C16.4477 22 16 21.5523 16 21C16 20.4477 16.4477 20 17 20C17.5523 20 18 20.4477 18 21Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="capitalize">empty cart</span>
                </div>
            </div>
        <?php else : ?>
            <div class="relative overflow-x-auto border rounded-lg my-4">
                <table class="w-full text-sm text-left text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Product Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3 text-end">
                                Qty
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cartItems as $item) : ?>
                            <?php
                            // Pastikan kunci 'quantity' ada
                            if (!isset($item['quantity'])) {
                                $item['quantity'] = 1; // Inisialisasi dengan 1 jika tidak ada
                            }
                            ?>
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    <a href="" class="hover:underline hover:text-blue-500 transition duration-200"><?= esc($item['product_name']); ?></a>
                                </th>
                                <td class="px-6 py-4">
                                    <span class="font-semibold text-gray-700"><?= esc($item['product_price']); ?></span>
                                </td>
                                <td class="px-6 py-4 flex items-center space-x-2">
                                    <span><?= esc($item['quantity']); ?></span>
                                    <form action="<?= base_url(); ?>orders/removeFromCart" method="post">
                                        <input type="hidden" name="productName" value="<?= esc($item['product_name']); ?>">
                                        <button class="p-2 rounded-lg bg-red-100 text-red-600" type="submit">
                                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M17 7L7 17M7 7L17 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr class="font-semibold text-gray-900">
                            <th scope="row" class="px-6 py-3 text-base">&nbsp;</th>
                            <td class="px-6 py-3"><?= view_cell('\App\Cells\CartTotalHelper::totalPrice') ?></td>
                            <td class="px-6 py-3"><?= esc(esc($totalQuantity)); ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection(); ?>