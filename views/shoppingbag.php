<?php

/** @var array $shoppingBag */
?>
<div class="container">
    <div class="row">
        <div class="col-md-1- col-11 mx-auto">
            <div class="row mt-5 gx-3">
                <div class='card p-3 mb-5'>
                    <h2 class='py-3'>Кошик</h2>


                    <?php

                    foreach ($shoppingBag as $value) {
                        if ($value->product->photo === null) {
                            $photo = "/themes/images/noImage.jpg";
                        } else {
                            $photo = "data:image/jpg;charset=utf8;base64," . base64_encode($value->product->photo);
                        }

                            ?>
                            <div class='card mb-4 shadow bg-white rounded'>
                                <div class='row mt-3'>
                                    <div class='col-lg-5 col-md-12 col-12 pt-1 '>
                                        <div class="photoProductP">
                                            <?php echo "<img class='img-fluid pb-1' src='$photo' width='100%' alt=''>" ?>
                                        </div>
                                    </div>
                                    <div class='col-lg-4 col-md-12 col-12 right-side mb-4'>
                                        <p class='card-text fw-bold'><?= $value->product->name ?></p>
                                        <p class='text-xecondary'>Ціна: <?= $value->product->price ?> грн</p>
                                        <p>Розмір: <?= $value->product->dimension ?><p>
                                        <p> Кількість: <?= $value->Quantity ?></p>
                                        <strong>Сума:  <?= $value->sumPrice ?></strong>
                                    </div>

                                    <div class='col-lg-2 col-md-12 col-12 d-flex align-items-center justify-content-center '>
                                        <a href='/shoppingBag/remove?productId=<?=$value->product->id?>' class='btn btn-act'>Delete
                                <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor'
                                     class='bi bi-trash' viewBox='0 0 16 16'>
                                    <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/>
                                    <path fill-rule='evenodd'
                                          d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/>
                                </svg></a>
                                    </div>

                                </div>
                            </div>

                            <?php } ?>
                    <?php ?>
                    <div class="text-center">
                        <a href='/checkout/' class='btn btn-add btn-lg' style="width: 30%;">Купити</a>
                    </div>
                    <?php ?>
                </div>

            </div>

        </div>
    </div>
</div>
