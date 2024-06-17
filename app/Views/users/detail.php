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
<!-- <div class="flex gap-4 mt-6 w-full">
    <div class="flex flex-col w-4/12 gap-4">
        <div class="flex flex-col">
            <div class="w-20 h-20 bg-gray-500 rounded-full">
                <button data-modal-target="upload-foto-modal" data-modal-toggle="upload-foto-modal" type="submit" class="border p-6 rounded-lg space-y-5 flex flex-col items-center">
                    <img src="" alt="">
                    <span class="w-5 h-5 block">
                        <svg class="w-full h-full" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16 5L19 2M19 2L22 5M19 2V8M22 12V17.2C22 18.8802 22 19.7202 21.673 20.362C21.3854 20.9265 20.9265 21.3854 20.362 21.673C19.7202 22 18.8802 22 17.2 22H6.8C5.11984 22 4.27976 22 3.63803 21.673C3.07354 21.3854 2.6146 20.9265 2.32698 20.362C2 19.7202 2 18.8802 2 17.2V6.8C2 5.11984 2 4.27976 2.32698 3.63803C2.6146 3.07354 3.07354 2.6146 3.63803 2.32698C4.27976 2 5.11984 2 6.8 2H12M2.14551 19.9263C2.61465 18.2386 4.16256 17 5.99977 17H12.9998C13.9291 17 14.3937 17 14.7801 17.0769C16.3669 17.3925 17.6073 18.6329 17.9229 20.2196C17.9998 20.606 17.9998 21.0707 17.9998 22M14 9.5C14 11.7091 12.2091 13.5 10 13.5C7.79086 13.5 6 11.7091 6 9.5C6 7.29086 7.79086 5.5 10 5.5C12.2091 5.5 14 7.29086 14 9.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                </button>
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
        <div class="border p-6 rounded-lg">
            <h5 class="capitalize text-md mb-4">change password</h5>
            <form action="<?= base_url(); ?>users/<?= $user['user_id']; ?>/resetpassword" method="post">
                <input type="hidden" name="usernameUser" value="<?= esc($user['username_user']); ?>">
                <?= csrf_field() ?>
                <div class="flex flex-col space-y-1.5 mb-3">
                    <input type="password" name="newPasswordUser" id="newPasswordUser" value="<?= esc(old('newPasswordUser')); ?>" placeholder="new password" class="border px-4 py-2 border-gray-300 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('newPasswordUser')) ? 'invalid' : 'form-control' ?>">
                    <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('newPasswordUser')) : ?>
                        <div class=" text-red-500 text-xs">
                            <?= $validation->getError('newPasswordUser'); ?>
                        </div>
                    <?php endif ?>
                    <button class="border p-2 rounded-lg outline-none focus:ring focus:ring-gray-400 hover:bg-gray-200 hover:text-slate-900 transition duration-200" type="submit">Update</button>
                </div>
            </form>
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
</div> -->
<div class="flex gap-4 mt-6 w-full">
    <div class="flex flex-col w-4/12 gap-4">
        <div class="border p-6 rounded-lg space-y-5 flex flex-col items-center">
            <button data-modal-target="upload-foto-modal" data-modal-toggle="upload-foto-modal" type="button" class="w-20 h-20 bg-gray-500 rounded-full">
                <img src="" alt="">
            </button>
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
        <div class="border p-6 rounded-lg">
            <h5 class="capitalize text-md mb-4">change password</h5>
            <form action="<?= base_url(); ?>users/<?= $user['user_id']; ?>/resetpassword" method="post">
                <input type="hidden" name="usernameUser" value="<?= esc($user['username_user']); ?>">
                <?= csrf_field() ?>
                <div class="flex flex-col space-y-1.5 mb-3">
                    <input type="password" name="newPasswordUser" id="newPasswordUser" value="<?= esc(old('newPasswordUser')); ?>" placeholder="new password" class="border px-4 py-2 border-gray-300 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('newPasswordUser')) ? 'invalid' : 'form-control' ?>">
                    <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('newPasswordUser')) : ?>
                        <div class=" text-red-500 text-xs">
                            <?= $validation->getError('newPasswordUser'); ?>
                        </div>
                    <?php endif ?>
                    <button class="border p-2 rounded-lg outline-none focus:ring focus:ring-gray-400 hover:bg-gray-200 hover:text-slate-900 transition duration-200" type="submit">Update</button>
                </div>
            </form>
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

<!-- upload foto modal -->
<div id="upload-foto-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900 capitalize">
                    Edit <?= $user['fullname_user']; ?>
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="upload-foto-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="<?= base_url(); ?>users/<?= esc($user['user_id']); ?>/upload" method="post" enctype="multipart/form-data" class="p-5">
                <?= csrf_field(); ?>
                <input type="hidden" name="userId" value="<?= esc($user['user_id']); ?>">
                <input type="hidden" name="usernameUser" value="<?= esc($user['username_user']); ?>">
                <input type="file" class="border border-gray-200 rounded-lg" name="photoUser" id="photoUser" accept="image/*" required>
                <button class="mt-3 border p-2 rounded-lg outline-none focus:ring focus:ring-gray-400 hover:bg-gray-200 hover:text-slate-900 transition duration-200 capitalize" type="submit">upload</button>
            </form>
        </div>
    </div>
</div>
<!-- edit user modal -->
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