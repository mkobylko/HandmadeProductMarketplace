<?php
/** @var array $orders */
/** @var int $flag */
/** @var int $oneMonthAgo */
/** @var array $monthsAgo */

?>
<style>
    .gradient-background {

        background: linear-gradient(90deg, rgba(20,54,123,1) 0%, rgba(167,142,123,1) 86%);
    }
</style>
<script>
    function showArchivedSales(){
        $.get("/mySales/archive", {},
            function (data) {
                $("#btn").hide();
                let archive = JSON.parse(data);
                $("#archives").prepend(purchasesHtml(archive))
            }
        );
    }

    function purchasesHtml(orders) {
        let html = "";
        html += "<div class='mt-5 text-center'><h2 class='txt'>Архівні продажі</h2>" +
            "<div class='card p-2 mb-3 gradient-background' >";
        for (let i = 0; i < orders.length; i++) {
            let photo = orders[i].product.photo === null ? "/themes/images/noImage.jpg" : "data:image/jpg;charset=utf8;base64," + orders[i].product.photo;

            html += "<div class='card mb-4 shadow bg-white rounded'>"+
                "<div class='row g-1 py-1 row-cols-1 row-cols-lg-3 row1'>"+
                "<div class='col-xs-4 col-lg-4'>"+
                "<div class='imgSales mt-4'>"+
                "<a href='/product?id="+ orders[i].product.id +"'><img src='" + photo + "' class='img-fluid' alt='Image of the product'></a>"+
                "</div></div>"+
                "<input type='hidden' id='productId' name='productId' value='" + orders[i].product.id +"'>"+
                "<div class='col-xs-3 col-lg-3 gx-4 py-2 '>"+
                "<p class='card-text fw-bold'>" + orders[i].product.name + "</p>"+
                "<p><span>Ціна: </span>" + orders[i].sumPrice +"</p>"+
                "<p><span>Розмір: </span>" + orders[i].product.dimension +"</p>"+
                "<p><span>Кількість: </span>" + orders[i].quantity +"</p>"+
                "<p><strong>Сума:" + (orders[i].quantity) * (orders[i].sumPrice)  +"</strong></p></div>"+

                "<div class='col-xs-5 col-lg-5 gx-4 py-2'>"+
                    "<p class='card-text fw-bold'>Деталі замовлення</p>"+
                    "<p class='text-center'><span class='text-muted'>email:</span>" + orders[i].user.email +"</p>"+
                    "<p class='text-center'><span class='text-muted'>Адреса:</span> м." + orders[i].city + "" +
                    "вул. " + orders[i].street + "</p>"+
                    "<div class='textThatTrue'>Замовлення виконано</div></div></div></div>";
        }
        html += "</div></div";
        return html;
    }




    function statusChecked(id) {
        $.get("/mySales/statusChecked", {'orderId': id})
            .done(function (data) {
                $("#buttonCheck").hide();
                $("#textThatTrue").text('Замовлення виконано');
            });
    }
</script>

<div class="container">

    <div class="row pt-5">

        <div class="col col-3 "></div>
        <div class="col col-6 d-flex flex-wrap justify-content-between">
        <canvas id="line-chart"></canvas>
        </div>
        <div class="col col-3"></div>
        <div class="col-md-1- col-11 mx-auto">
            <h2 class='py-3'>Мої продажі</h2>
            <div class='card p-2 mb-3'>

                <?php
                foreach ($orders as $order) :
                    if ($order->product->photo === null) {
                        $photo = "/themes/images/noImage.jpg";
                    } else {
                        $photo = "data:image/jpg;charset=utf8;base64," . base64_encode($order->product->photo);
                    }
                    $link = $order->product->id;
                    ?>
                    <div class='card mb-4 shadow bg-white rounded'>
                        <div class='row g-1 py-1 row-cols-1 row-cols-lg-3 row1'>

                            <div class='col-xs-4 col-lg-4'>
                                <div class='imgSales mt-4'>
                                    <?php echo "<a href='/product?id=$link'>
                                        <img src='$photo' class='img-fluid' alt='Image of the product'>
                                    </a>" ?>
                                </div>
                            </div>
                            <input type="hidden" id="productId" name="productId" value="<?= $order->product->id ?>">
                            <div class='col-xs-3 col-lg-3 gx-4 py-2 '>

                                <p class='card-text fw-bold'><?= $order->product->name ?></p>
                                <p><span>Ціна: </span><?= $order->sumPrice ?></p>
                                <p><span>Розмір: </span><?= $order->product->dimension ?></p>
                                <p><span>Кількість: </span><?= $order->quantity ?></p>
                                <p><strong>Сума: <?= ($order->quantity) * ($order->sumPrice) ?></strong></p>

                            </div>

                            <div class='col-xs-5 col-lg-5 gx-4 py-2'>
                                <p class='card-text fw-bold'>Деталі замовлення</p>
                                <!--<p class='text-center'><span class='text-muted '>Ім'я:  </span><?= $order->user->login ?></p>-->
                                <p class='text-center'><span
                                            class='text-muted'>email:  </span><?= $order->user->email ?></p>
                                <p class='text-center'><span class='text-muted '>Адреса:  </span>
                                    м. <?= $order->city ?>
                                    вул. <?= $order->street ?></p>

                                <?php if ($order->status == 0): ?>
                                    <!--if status =1 => button = disabled-->
                                    <a href="javascript:statusChecked(<?= $order->id ?>)"
                                       class="btn mt-4 btn-outline-dark textThatTrue"
                                       id="buttonCheck">Позначити як виконане</a>

                                <?php endif; ?>
                                <div id="textThatTrue" class="textThatTrue"></div>

                                <?php if ($order->status == 1): ?>
                                    <div class="textThatTrue">Замовлення виконано</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>


            </div>

            <div id="btn" class="mt-5 text-center"><a href="javascript:showArchivedSales()" role="button" class="btn-lg btn btn-outline-primary">
                    Показати архівні продажі</a>
            </div>

            <div id="archives" class="row mt-4 mb-4">

            </div>
        </div>
    </div>
</div>
<script
        src="https://cdn.jsdelivr.net/npm/chart.js@4.0.1/dist/chart.umd.min.js"></script>
<script>
    let array = [<?php echo implode(", ", $monthsAgo); ?>];
    let one = <?php echo $oneMonthAgo ?>;

    let myLineChart = new Chart(document.getElementById("line-chart"), {
        type: 'line',
        data: {
            labels: ["поточний місяць", "1 місяць тому", "2 місяці тому", "3 місяці тому"],
            datasets: [{
                label: "Кількість продаж за останні 4 місяці",
                data: [parseInt(one), parseInt(array[0]), parseInt(array[1]), parseInt(array[2]), parseInt(array[3])],
                backgroundColor: [
                    'rgba(105, 0, 132, .2)',
                ],
                borderColor: [
                    'rgba(200, 99, 132, .7)',
                ],
                borderWidth: 2
            },

            ]
        },
        options: {
            responsive: true
        }
    });


</script>