<?php

/** @var array $shoppingBag */
/** @var int $sum*/
?>
<div class="container">
    <div class="row mt-4">


        <div class="col-md-4 order-md-2 mb-4 py-2 ">
            <h3>Ваше замовлення</h3>

            <ul class='card mx-4 my-4 px-4 py-4 shadow bg-white rounded'>
                <?php foreach ($shoppingBag as $value) : ?>

                    <li class='d-flex justify-content-between'>
                        <div>

                            <strong><?= $value->product->name ?></strong><br>
                            <small>Кількість: <?= $value->Quantity ?></small><br>
                            <small>Ціна: <?= $value->product->price ?></small>
                        </div>

                    </li>
                <?php endforeach; ?>
                <div>
                    <hr/>
                </div>
                <li class="d-flex justify-content-between">

                    <span>До сплати</span>
                    <strong><?= $sum ?> грн</strong>
                </li>
            </ul>
        </div>


        <form class="col-md-8 order-md-1" action="/checkout/addOrder/" method="post">


            <?php
            /*if (count($products) == 0) {
                echo " <div class='alert alert-danger' role='alert'>Додайте товари до кошику</div>";
            }*/
            if ($_REQUEST['error'] == "1") {
                echo " <div class='alert alert-danger' role='alert'>Некоректно введено назву міста</div>";
            } else if ($_REQUEST['error'] == "2") {
                echo " <div class='alert alert-danger' role='alert'>Некоректно введено вулицю</div>";
            } else if ($_REQUEST['error'] == "3") {
                echo " <div class='alert alert-danger' role='alert'>Некоректно введено номер будинку</div>";
            } else if ($_REQUEST['error'] == "4") {
                echo " <div class='alert alert-danger' role='alert'>Некоректно введено номер квартири</div>";
            } else if ($_REQUEST['error'] == "5") {
                echo " <div class='alert alert-danger' role='alert'>Дана кількість товару недоступна</div>";
            } else if ($_REQUEST['error'] == "6") {
                echo " <div class='alert alert-danger' role='alert'>Зареєструйтеся аби зробити дану покупку</div>";
            } else if ($_REQUEST['error'] == "7") {
                echo " <div class='alert alert-danger' role='alert'>Дану покупку здійснити неможливо</div>";
            }
            ?>
            <h3 class="title">Оформлення</h3>

            <div class=" col-lg-10 col-md-10 col-12 order-md-1 pt-4">


            </div>


            <h4 class="title pt-4">Адреса доставки</h4>

            <div class="mb-3">
                <label for="city">Місто</label>
                <input name="city" type="text" class="form-control" id="city" placeholder="Місто">
            </div>
            <div class="mb-3">
                <label for="street">Вулиця</label>
                <input type="text" name="street" class="form-control" id="street" placeholder="Вулиця">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="house">Номер будинку</label>
                    <input type="text" name="house" class="form-control" id="house" placeholder="Будинок">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="apartment">Номер квартири</label>
                    <input type="text" name="apartment" class="form-control" id="apartment"
                           placeholder="Квартира">
                </div>
            </div>
            <br>

            <input type="submit" class='btn btn-add' value="Оформити замовлення"/>
        </form>
    </div>
</div>


