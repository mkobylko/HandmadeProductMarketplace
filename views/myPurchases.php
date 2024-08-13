<?php
/** @var array $orders */
/** @var int $flag   */
?>
<style>
    .gradient-background {

        background: linear-gradient(90deg, rgba(20,54,123,1) 0%, rgba(167,142,123,1) 86%);
    }
</style>
<script>
    function showArchivedPurchases(){
        $.get("/myPurchases/archive", {},
            function (data) {

                $("#btn").hide();
                let archive = JSON.parse(data);
                $("#archives").prepend(purchasesHtml(archive))
            }
        );
    }

    function purchasesHtml(orders) {
        let html = "";
        html += "<div class='mt-5 text-center'><h2 class='txt'>Архівні покупки</h2>" +
            "<div class='card p-2 mb-3 gradient-background' >";
        for (let i = 0; i < orders.length; i++) {
            let photo = orders[i].product.photo === null ? "/themes/images/noImage.jpg" : "data:image/jpg;charset=utf8;base64," + orders[i].product.photo;

            html += "<div class='card mb-4 shadow bg-white rounded'>" +
                "<div class='row mt-3'>" +
                "<div class='col-lg-5 col-md-12 col-12 pt-1 '>" +
                "<div class='photoProductP'>" +
                "<img class='img-fluid pb-1' src='" + photo + "' width='100%' alt=''>" +
                "</div> </div>" +
                "<div class='col-lg-7 col-md-12 col-12 right-side'>" +
                "<div class='mt-2 row'>" +
                "<div class='col-lg-6 col-md-12 col-12'>" +
                "<p><strong>" + orders[i].product.name + "</strong></p></div>" +
                "<div class='col-lg-5 col-md-12 col-12'>" +
                "<p class='mb-4 text-end'>Дата:" + orders[i].date + "</p></div></div>" +
                "<div class='row'>" +
                "<div class='col-lg-4 col-md-12 col-12'>" +
                "<p>Ціна:" + orders[i].product.price + "UAH</p>" +
                "<p>Розмір:" + orders[i].product.dimension + "</p>" +
                "<p>Кількість:" + orders[i].quantity + "шт</p></div>" +
                "<div class='col-lg-7 col-md-12 col-12'>" +
                "<h4>Опис товару</h4>" +
                "<span>" + orders[i].product.description + "</span><br><br></div></div></div></div></div>";
        }
        html += "</div></div";
        return html;
    }

</script>


<div class="container">
    <div class="row">
        <div class="col-md-1- col-11 mx-auto">
            <h2 class='py-3'>Мої покупки </h2>
            <div class='card p-2 mb-3'>

                <?php
                foreach ($orders as $order) {
                    if ($order->product->photo === null) {
                        $photo = "/themes/images/noImage.jpg";
                    } else {
                        $photo = "data:image/jpg;charset=utf8;base64," . base64_encode($order->product->photo);
                    }

                    ?>

                    <div class='card mb-4 shadow bg-white rounded'>
                        <div class='row mt-3'>
                            <div class='col-lg-5 col-md-12 col-12 pt-1 '>
                                <div class="photoProductP">
                                    <?php echo "<img class='img-fluid pb-1' src='$photo' width='100%' alt=''>" ?>
                                </div>
                            </div>
                            <div class='col-lg-7 col-md-12 col-12 right-side'>
                                <div class="mt-2 row">
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <p><strong><?=$order->product->name?></strong></p>

                                    </div>
                                    <div class="col-lg-5 col-md-12 col-12">
                                        <p class='mb-4 text-end'>Дата: <?=$order->date?></p>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-12 col-12">
                                        <p>Ціна: <?=$order->product->price?> UAH</p>
                                        <p>Розмір: <?=$order->product->dimension?></p>
                                        <p>Кількість: <?=$order->quantity?> шт</p>
                                    </div>

                                    <div class="col-lg-7 col-md-12 col-12">
                                        <h4>Опис товару</h4>
                                        <span><?=$order->product->description?></span><br><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div id="btn" class="mt-5 text-center"><a href="javascript:showArchivedPurchases()" role="button" class="btn-lg btn btn-outline-primary">
                    Показати архівні покупки</a>
            </div>

            <div id="archives" class="row mt-4 mb-4">

            </div>

        </div>
    </div>
</div>