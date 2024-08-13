<?php
/** @var array $users */
/** @var int $flag */
?>
<div class="container">
    <div class="col-md-1- col-10 mx-auto mt-5">

        <?php foreach ($users as $user): ?>
            <?php if($user->type !=1 ): ?>
            <div class='card  mb-4 py-3 shadow cv rounded'>

                <div class="row mt-3">

                    <div class='col-lg-3 mt-2 col-md-12 col-12 pt-1 '>
                        <div class="col1 text-center"><?= $user->login ?></div>
                    </div>

                    <div class='col-lg-5 col-md-12 col-12'>
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-12">
                                <h6 class="text-muted ">Email</h6>
                                <p><?= $user->email ?></p>

                            </div>

                            <div class="col-lg-6 col-md-12 col-12">
                                <h6 class="text-muted ">Повне ім'я</h6>
                                <p><?= $user->fullName ?></p>
                            </div>
                        </div>
                    </div>

                    <div class='col-lg-4 col-md-12 col-12 text-center'>
                        <?php if ($user->banned == 0) : ?>
                            <a href='/users/banned?id=<?= $user->idUser ?>' class='mt-3 btn btn-add'> Забанити
                                юзера</a>
                        <?php else : ?>
                            <a href='/users/unbanned?id=<?= $user->idUser ?>' class='mt-3 btn btn-act'> Відновити
                                юзера</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif;?>
        <?php endforeach; ?>

    </div>

</div>