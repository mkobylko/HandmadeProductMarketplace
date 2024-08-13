
<?php
/** @var array $products */
?>
<div class="container">
    <div class="row">
        <div class="col-md-1- col-11 mx-auto">

            <h2 class='py-3'>Мої оголошення</h2>

            <div class='card p-2 mb-3'>

                <?php
                foreach ($products as $product) {

                    if ($product->photo === null) {
                        $photo = "/themes/images/noImage.jpg";
                    } else {
                        $photo = "data:image/jpg;charset=utf8;base64," . base64_encode($product->photo);
                    }

                    ?>
                    <div class='card mb-4 shadow bg-white rounded'>
                        <div class='row mt-3'>
                            <div class='col-lg-5 col-md-12 col-12 pt-1 '>
                                <div class="photoProduct">
                                    <?php echo "<img class='img-fluid pb-1' src='$photo' width='100%' alt=''>" ?>
                                </div>
                            </div>
                            <div class='col-lg-4 col-md-12 col-12 right-side'>
                                <p><strong><?=$product->name?></strong></p>
                                <p>Ціна: <?=$product->price?> UAH</p>
                                <p>Розмір:  <?=$product->dimension?></p>
                                <p>Кількість:  <?=$product->quantity?> шт</p>
                                <h3 class='mt-5 '>Опис товару</h3>
                                <span><?=$product->description?></span><br><br>
                                <?php if ($product->quantity == 0): ?>
                                    <p><strong>Стан оголошення: <span class="text-danger"> неактивне</span></strong></p>
                                <?php endif; ?>
                            </div>

                            <div class='col-lg-2 col-md-12 col-12 pt-4'>
                                <div class="mt-4 mb-4"><strong>Дії:</strong></div>
                                <?php echo "<a href='/sell/updateProduct?id=$product->id' class='btn btn-an-sale btn-act'>Редагувати оголошення</a>" ?>
                                <br><br>
                                <?php if ($product->quantity == 0): ?>
                                    <div class='deactiv text-center'>Оголошення дективовано</div>
                                <?php else:?>
                                    <?php echo "<a href='/announcementSale/reduce?id=$product->id' class='btn btn-an-sale btn-add'>Деактивувати оголошення</a>" ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>