<?php
/** @var array $seller */
/** @var array $product */
/** @var array $user */
?>

<script>
    function addToShoppingBag() {

        let productId = <?php echo "$product->id" ?>;
        let quantity = $("#quantity").val();
        let price = <?php echo "$product->price" ?>;

        $.get("/shoppingBag/add",
            {
                'productId': productId,
                'quantity': quantity,
                'price': price
            },
            function (data) {
                $("#shoppingBag").text("Кошик (" + data.trim() + ")")
            }
        );
    }

    function addToShoppingBagAndBuy() {
        let productId = <?php echo "$product->id" ?>;
        let quantity = $("#quantity").val();
        let price = <?php echo "$product->price" ?>;

        $.get("/shoppingBag/add",
            {
                'productId': productId,
                'quantity': quantity,
                'price': price
            },
            function (data) {
                window.location.href = "/checkout/";
            }
        );
    }

    function addReviews() {

        let message = $("#message").val();
        let userId = "<?php echo $user->idUser ?>";
        let productId = <?php echo "$product->id" ?>;

        let mark = 1;
        for (let i = 2; i <= 5; i++) {
            if ($("#mark" + i).hasClass("checked")) {
                mark += 1;
            }
        }

        $.post("/reviews/add",
            {
                'productId': productId,
                'userId': userId,
                'mark': mark,
                'message': message
            },
            function (data) {
                let comment = JSON.parse(data);
                $("#reviews").prepend(commentHtml(comment))
            }
        );
    }

    function commentHtml(comment) {

        let html = "<div class='col-lg-2 col-md-12 col-12 col-sm'>"
            + "<p class='text-center mt-4'><strong>" + comment.user.login + "</strong></p>"
            + "</div>"

            + "<div class='border rounded col-lg-10 col-md-12 col-12 col-sm mb-4 '>"
            + "<div class='mt-2 row'>"
            + "<div class='col-6'>";
        for (let i = 1; i <= 5; i++) {
            if (i <= comment.mark) {
                html += "<span class='fa fa-star checked'></span>";
            } else {
                html += "<span class='fa fa-star'></span>";
            }
        }
        html += "</div><div class='col-6 text-end'>"
            + "<p>" + comment.date + "</p>"
            + "</div> </div>"
            + "<p>" + comment.text + "</p>"

        html += "</div>";
        return html;
    }

    $(document).ready(function () {
        let productId = <?php echo "$product->id" ?>;
        $.get("/reviews/getAll",
            {
                'productId': productId
            },
            function (data) {
                let comments = JSON.parse(data);
                let html = '';
                for (let i = 0; i < comments.length; i++) {
                    html += commentHtml(comments[i]);
                }
                $("#reviews").html(html);
            }
        )
    });

    function starmark(item) {
        let mark = item.id[4];

        for (let i = 2; i <= 5; i++) {
            if (i <= mark) {
                $("#mark" + i).addClass("checked");
            } else {
                $("#mark" + i).removeClass("checked");
            }
        }
    }

</script>


<?php if ($product === null): ?>
    <div class='alert alert-danger' role='alert'>Product doesn't exist</div>
<?php endif; ?>


<?php if ($product != null): ?>
    <?php

    if ($product->photo == null) {
        $photo = "/themes/images/noImage.jpg";
    } else {
        $photo = "data:image/jpg;charset=utf8;base64," . base64_encode($product->photo);
    }
    ?>
<?php endif; ?>

<div class="container">
    <section class='container productBuy'>

        <div class='row mt-5'>

            <div class='col-lg-5 col-md-12 col-12 pt-1 '>

                <?php echo "<img class='img-fluid pb-1' src='$photo' width='100%' alt=''>" ?>

            </div>


            <div class='col-lg-7 col-md-12 col-12 pt-2 pr-5 '>

                <div class="product-info">
                    <h3><?= $product->name ?></h3><br>

                    <div class='row mt-4 mb-4'>
                        <div class='col-lg-4 col-md-12 col-12'>
                            <h3 class='text-muted'>Ціна</h3>
                            <h5><?= $product->price ?> UAH</h5>
                            <h3 class='text-muted mt-4'>Розмір</h3>
                            <h5><?= $product->dimension ?></h5>

                        </div>


                        <div class='col-lg-8 col-md-12 col-12'>
                            <h3 class='text-muted '>Продавець</h3>
                            <h5><?= $seller->login ?></h5>
                            <h3 class='text-muted mt-4'>Опис товару</h3>
                            <h5><?= $product->description ?></h5>

                        </div>
                    </div>


                    <?php if ($product->quantity != 0): ?>
                        <input id='quantity' type='number' value='1' min='1' max='<?= $product->quantity ?>'>
                        <a href='javascript:addToShoppingBag()' class='btn btn-add'>Додати в кошик</a><br><br>
                        <a href='javascript:addToShoppingBagAndBuy()' class='btn btn-buyProduct btn-act'>Купити</a>
                    <?php endif; ?>

                    <?php if ($product->quantity == 0): ?>
                        <div>Нема в наявності</div>
                    <?php endif; ?>
                </div>

            </div>

        </div>


    </section>


    <section id='featured' class='my-2 pb-2 py-4 mt-4'>
        <div class='container text-center mt-2 py-2'>
            <h3>Коментарі</h3>
            <hr class='mx-auto'>
        </div>
    </section>

    <?php if ($user !== null) : ?>
    <div class="row">
        <h5 class="mb-4"><strong>Новий коментар</strong></h5>


        <div class="col-lg-2 mt-4 text-center col-md-12 col-12 col-sm"><p>Ваща оцінка</p></div>
        <div class="col-lg-4 mt-4 col-md-12 col-12 col-sm">
            <!--checked-->
            <span onmouseover="starmark(this)" onclick="starmark(this)" id="mark1"
                  class="fa fa-star checked"></span>
            <span onmouseover="starmark(this)" onclick="starmark(this)" id="mark2"
                  class="fa fa-star checked"></span>
            <span onmouseover="starmark(this)" onclick="starmark(this)" id="mark3"
                  class="fa fa-star checked"></span>
            <span onmouseover="starmark(this)" onclick="starmark(this)" id="mark4"
                  class="fa fa-star checked"></span>
            <span onmouseover="starmark(this)" onclick="starmark(this)" id="mark5"
                  class="fa fa-star checked"></span>
        </div>
        <div class="col-lg-6 col-md-12 mt-4 col-12 col-sm">
            <div class="text-end">
                <a href="javascript:addReviews()" class='btn btn-add'>Надіслати</a>
            </div>
        </div>
        <div class="col-lg-2 col-md-12 col-12 col-sm">
            <p id='user' class='text-center mt-4'><strong><?= $user->login ?></strong></p>
        </div>
        <div class="col-lg-10 col-md-12 col-12 col-sm">
            <label for="message"></label>
            <textarea name='message' class="form-control" id="message" placeholder="Your message"
                      required=""></textarea><br><br>
        </div>
    </div>
    <?php endif ?>

    <div id="reviews" class="row mt-4 mb-4">
        <div>LOADING COMMENTS...</div>
    </div>
</div>