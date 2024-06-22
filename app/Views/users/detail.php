<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<h1 class="text-2xl font-semibold capitalize">users : <?= $user['fullname_user']; ?></h1>
<?php if (session()->getFlashdata('success')) : ?>
    <div class="border border-green-300 bg-green-200/25 text-green-700 p-4 rounded-lg my-4" role="alert">
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('errors')) : ?>
    <div class="border border-red-300 bg-red-200/25 text-red-700 p-4 rounded-lg my-4" role="alert">
        <?= session()->getFlashdata('errors'); ?>
    </div>
<?php endif; ?>
<a href="<?= base_url(); ?>users" class="inline-flex items-center space-x-1 mt-3 capitalize hover:text-blue-500 transition duration-200">
    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M18 17L13 12L18 7M11 17L6 12L11 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
    <span>back to users</span>
</a>

<div class="flex gap-4 mt-6 w-full">
    <div class="flex flex-col w-4/12 gap-4">
        <div class="border p-6 rounded-lg space-y-5 flex flex-col items-center">
            <button data-modal-target="upload-foto-modal" data-modal-toggle="upload-foto-modal" type="button" class="w-40 h-40 bg-gray-200 rounded-full">
                <img src="<?= base_url(); ?>dist/img/profile/<?= ($user['photo_user'] == null) ? 'default.png' : $user['photo_user']; ?>" alt="" class="w-full h-full rounded-full object-cover">
            </button>
            <div class="flex flex-col space-y-6">
                <div>
                    <p>Fullname: <?= esc($user['fullname_user']); ?></p>
                    <p data-modal-target="change-username-modal" data-modal-toggle="change-username-modal" type="button">Username:
                        <span class="inline-flex items-center hover:text-blue-500 hover:underline transition duration-200 cursor-pointer">
                            <span><?= esc($user['username_user']); ?></span>
                            <button class="ml-2 w-4 h-4 inline-block">
                                <svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 3.99998H6.8C5.11984 3.99998 4.27976 3.99998 3.63803 4.32696C3.07354 4.61458 2.6146 5.07353 2.32698 5.63801C2 6.27975 2 7.11983 2 8.79998V17.2C2 18.8801 2 19.7202 2.32698 20.362C2.6146 20.9264 3.07354 21.3854 3.63803 21.673C4.27976 22 5.11984 22 6.8 22H15.2C16.8802 22 17.7202 22 18.362 21.673C18.9265 21.3854 19.3854 20.9264 19.673 20.362C20 19.7202 20 18.8801 20 17.2V13M7.99997 16H9.67452C10.1637 16 10.4083 16 10.6385 15.9447C10.8425 15.8957 11.0376 15.8149 11.2166 15.7053C11.4184 15.5816 11.5914 15.4086 11.9373 15.0627L21.5 5.49998C22.3284 4.67156 22.3284 3.32841 21.5 2.49998C20.6716 1.67156 19.3284 1.67155 18.5 2.49998L8.93723 12.0627C8.59133 12.4086 8.41838 12.5816 8.29469 12.7834C8.18504 12.9624 8.10423 13.1574 8.05523 13.3615C7.99997 13.5917 7.99997 13.8363 7.99997 14.3255V16Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </span>
                    </p>
                    <p>Email: <?= esc($user['email_user']); ?></p>
                    <p>Phone: <?= esc($user['phone_user']); ?></p>
                    <p>Gender: <?= esc($user['gender_user']); ?></p>
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
        <?php $url = new \CodeIgniter\HTTP\URI(current_url()); {
        ?>
            <nav class="w-full mb-4">
                <ul class="flex items-center space-x-1 border-b pb-4">
                    <li class="capitalize px-4 py-1 rounded-lg border <?= ($url->getSegment(3) == 'orders' || $url->getSegment(3) == 'detail') ? 'bg-gray-500 hover:bg-gray-400 text-white' : 'hover:bg-gray-200'; ?> transition duration-200"><a href="<?= base_url(); ?>users/<?= $user['username_user']; ?>/orders">Orders</a></li>
                    <li class="capitalize px-4 py-1 rounded-lg border <?= ($url->getSegment(3) == 'address') ? 'bg-gray-500 hover:bg-gray-400 text-white' : 'hover:bg-gray-200'; ?> transition duration-200"><a href="<?= base_url(); ?>users/<?= $user['username_user']; ?>/address">address</a></li>
                    <li class="capitalize px-4 py-1 rounded-lg border hover:bg-gray-100 transition duration-200"><a href="">Setting</a></li>
                </ul>
            </nav>
        <?php } ?>
        <?= $this->renderSection('userContent'); ?>
    </div>
</div>

<!-- change username modal -->
<div id="change-username-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900 capitalize">
                    Edit <?= $user['fullname_user']; ?>
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="change-username-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="<?= base_url(); ?>users/<?= esc($user['user_id']); ?>/changeusername" method="post" class="p-5">
                <?= csrf_field(); ?>
                <input type="hidden" name="userId" value="<?= esc($user['user_id']); ?>">
                <input type="hidden" name="usernameUser" value="<?= esc($user['username_user']); ?>">
                <input type="text" name="newUsername" id="newUsername" value="<?= (old('newUsername') ? old('newUsername') : $user['username_user']); ?>" placeholder="fullname" class="border w-full p-2 border-gray-300 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('newUsername')) ? 'invalid' : 'form-control' ?>">
                <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('newUsername')) : ?>
                    <div class=" text-red-500 text-xs">
                        <?= $validation->getError('newUsername'); ?>
                    </div>
                <?php endif ?>
                <button class="block mt-3 border p-2 rounded-lg outline-none focus:ring focus:ring-gray-400 hover:bg-gray-200 hover:text-slate-900 transition duration-200 capitalize" type="submit">Update</button>
            </form>
        </div>
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
                    <?= ($user['photo_user'] == null) ? 'Upload' : 'Change'; ?> Photo <?= $user['fullname_user']; ?>
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
                <input type="file" class="border border-gray-200 rounded-lg w-full" name="photoUser" id="photoUser" accept="image/*" required>
                <div id="previewDiv" class="h-full rounded-lg mt-4 overflow-hidden hidden">
                    <img class="w-full h-full object-cover" src="" alt="" id="previewImg">
                </div>
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
                    <label for="newUsername">Fullname</label>
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
                <div class="flex flex-col space-y-1.5 mb-3">
                    <label for="phoneUser">Gender User</label>
                    <div class="flex ">
                        <div class="flex items-center me-4 border p-2 rounded-md">
                            <input id="genderMale" type="radio" value="male" name="genderUser" <?= ($user['gender_user'] == 'male') ? 'checked' : ''; ?> class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                            <label for="genderMale" class="ms-2 text-sm font-medium">Male</label>
                        </div>
                        <div class="flex items-center me-4 border p-2 rounded-md    ">
                            <input id="genderFemale" type="radio" value="female" name="genderUser" <?= ($user['gender_user'] == 'female') ? 'checked' : ''; ?> class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                            <label for="genderFemale" class="ms-2 text-sm font-medium">Female</label>
                        </div>
                    </div>
                </div>
                <button class="border p-2 rounded-lg outline-none focus:ring focus:ring-gray-400 hover:bg-gray-200 hover:text-slate-900 transition duration-200 capitalize" type="submit">update</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
