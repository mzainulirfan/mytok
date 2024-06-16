<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<h1 class="text-2xl font-semibold capitalize">users : <?= $user['fullname_user']; ?></h1>
<?php if (session()->getFlashdata('success')) : ?>
    <div class="border border-green-300 bg-green-200/25 text-green-700 p-4 rounded-lg my-4" role="alert">
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('errors')) : ?>
    <div class="border border-red-300 bg-red-200/25 text-green-700 p-4 rounded-lg my-4" role="alert">
        <?= session()->getFlashdata('errors'); ?>
    </div>
<?php endif; ?>
<div class="flex gap-4 mt-6">
    <div class="border p-6 rounded-lg w-4/12  space-y-5 flex flex-col items-center">
        <div class="w-20 h-20 bg-gray-500 rounded-full">
            <img src="" alt="">
        </div>
        <div class="flex flex-col space-y-6">
            <div>
                <p>fullname: <?= esc($user['fullname_user']); ?></p>
                <p>email: <?= esc($user['email_user']); ?></p>
                <p>phone: <?= esc($user['phone_user']); ?></p>
            </div>
            <div class="flex space-x-2">
                <button type="button" data-modal-target="edit-modal" data-modal-toggle="edit-modal" class="border px-4 py-2 rounded-lg capitalize hover:bg-gray-200 hover:text-slate-900 transition duration-200">edit</button>
                <form action="<?= base_url(); ?>users/<?= $user['user_id']; ?>" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" onclick="return confirm('Apakah yakin data <?= esc($user['fullname_user']); ?> mau dihapus?')" class="border px-4 py-2 rounded-lg capitalize hover:bg-gray-200 hover:text-slate-900 transition duration-200">delete</button>
                </form>
            </div>
        </div>
    </div>
    <div class="border p-6 rounded-lg flex-1">
        <?php if (!empty($orders)) : ?>
            <div class="relative overflow-x-auto border rounded-lg my-4">
                <table class="w-full text-sm text-left text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Id Order
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Amount
                            </th>
                            <th scope="col" class="px-6 py-3">
                                payment status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order) : ?>
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    <a href="<?= base_url(); ?>orders/<?= esc($order['order_id']); ?>/detail" class="hover:underline hover:text-blue-500 transition duration-200">#order<?= esc($order['order_id']); ?></a>
                                </th>
                                <td class="px-6 py-4">
                                    <span class="font-semibold text-gray-700"><?= formatRupiah(esc($order['order_total_amount'])); ?></span>
                                </td>
                                <td class="px-6 py-4">
                                    <?php if ($order['order_payment_status'] == 'unpaid') : ?>
                                        <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full capitalize">
                                            <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                                            <?= esc($order['order_payment_status']); ?>
                                        </span>
                                    <?php else : ?>
                                        <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full capitalize">
                                            <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                                            <?= esc($order['order_payment_status']); ?>
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?= esc($order['created_at']); ?>
                                </td>
                                <td class="px-6 py-4 flex space-x-2 items-center">
                                    <a href="<?= base_url(); ?>orders/<?= esc($order['order_id']); ?>/detail" class="font-medium text-blue-600 hover:underline capitalize">detail</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <div class="flex flex-col space-y-2 items-center">
                <p>no order found</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- create modal -->
<div id="edit-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900 capitalize">
                    Edit <?= $user['fullname_user']; ?>
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="edit-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="<?= base_url(); ?>users/<?= esc($user['user_id']); ?>/update" method="post" class="p-5">
                <input type="hidden" name="userId" value="<?= esc($user['user_id']); ?>">
                <input type="hidden" name="usernameUser" value="<?= esc($user['username_user']); ?>">
                <?= csrf_field() ?>
                <div class="flex flex-col space-y-1.5 mb-3">
                    <label for="fullnameUser">Fullname</label>
                    <input type="text" name="fullnameUser" id="fullnameUser" value="<?= (old('fullnameUser') ? old('fullnameUser') : $user['fullname_user']); ?>" placeholder="fullname" class="border p-2 border-gray-300 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('fullnameUser')) ? 'invalid' : 'form-control' ?>">
                    <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('fullnameUser')) : ?>
                        <div class=" text-red-500 text-xs">
                            <?= $validation->getError('fullnameUser'); ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="flex flex-col space-y-1.5 mb-3">
                    <label for="emailUser">Email User</label>
                    <input type="email" name="emailUser" id="emailUser" value="<?= (old('emailUser') ? old('emailUser') : $user['email_user']); ?>" placeholder="email" class="border p-2 border-gray-300 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('emailUser')) ? 'invalid' : 'form-control' ?>">
                    <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('emailUser')) : ?>
                        <div class=" text-red-500 text-xs">
                            <?= $validation->getError('emailUser'); ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="flex flex-col space-y-1.5 mb-3">
                    <label for="phoneUser">Phone User</label>
                    <input type="text" name="phoneUser" id="phoneUser" value="<?= (old('phoneUser') ? old('phoneUser') : $user['phone_user']); ?>" placeholder="phone" class="border p-2 border-gray-300 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('phoneUser')) ? 'invalid' : 'form-control' ?>">
                    <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('phoneUser')) : ?>
                        <div class=" text-red-500 text-xs">
                            <?= $validation->getError('phoneUser'); ?>
                        </div>
                    <?php endif ?>
                </div>
                <button class="border p-2 rounded-lg outline-none focus:ring focus:ring-gray-400 hover:bg-gray-200 hover:text-slate-900 transition duration-200 capitalize" type="submit">update</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
