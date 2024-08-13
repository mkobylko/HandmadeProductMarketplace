<?php
/** @var array $user */

?>
<div class="col-md-1- col-7 mx-auto mt-5 px-4 py-4">

    <div class='card mb-4 shadow bg-white rounded'>
        <div id='updUser'>
        <div class="row " id="hideAfterRefresh">
                <div class="col-md-5 mt-3 text-center px-4 py-4 ">
                    <p class="mb-4"><small>login</small></p>
                    <strong class="mt-4"><?= $user->login ?></strong>
                </div>

                <div class="col-md-7">
                    <div class="card-body p-3">

                        <div class="row pt-3 px-4 py-4 text-center">
                            <div class="col-6 mb-4">
                                <p>Ім'я</p>
                                <p><?= $user->fullName ?></p>

                            </div>
                            <div class="col-6 mb-3">
                                <p>Email</p>
                                <p><?= $user->email ?></p>
                            </div>

                            <div>
                                <button type='submit' class='mt-2 btn btn-add btn-ac' data-bs-toggle="modal"
                                        data-bs-target="#updateUser">Редагувати профіль
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="modal fade" id="updateUser" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <form action="" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Оновити дані</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body text-center mt-3">

                    <div class="mb-3 mt-4">
                        <label for="login" class="form-label">Логін</label>
                        <input type="text" class="form-control" id="login" value="<?= $user->login ?>"
                               name="login">
                    </div>

                    <div class="mb-3 mt-4">
                        <label for="fullName" class="form-label">Ім'я</label>
                        <input type="text" class="form-control" id="fullName" value="<?= $user->fullName ?>" name="fullName">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" value="<?= $user->email ?>" id="email" name="email"">
                    </div>

                </div>
                <div class="px-4 py-3 text-center">
                    <a href="javascript:updateUser()" class="btn btn-lg btn-add">Оновити</a>
                </div>
            </form>
        </div>
    </div>
</div>