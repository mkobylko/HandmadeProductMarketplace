<?php
/** @var array $reviews */
/** @var array $user */
?>
<script>
    function deleteReview(id) {
        $.get("/reviews/remove", {'idReview': id})
            .done(function (data) {
                $("#review" + id).remove();
            });
    }
</script>

<div class="container">
    <div class="row pt-5">
        <div class="col col-lg-2 text-start">
            <h3>Фільтри</h3>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <div class="mt-3">
                        <a href="/reviews?sort=asc" class="btn btn-add" style="width: 200px;">Відсортувати по
                            зростанню</a>
                    </div>
                    <div class="mt-3">
                        <a href="/reviews?sort=desc" class="btn btn-add" style="width: 200px;">Відсортувати по
                            спаданню</a>
                    </div>
                </li>
            </ul>
        </div>


        <div class="col col-10">

            <div class="row">

                <?php foreach ($reviews as $review) {
                    if ($review->product->photo === null) {
                        $photo = "/themes/images/noImage.jpg";
                    } else {
                        $photo = "data:image/jpg;charset=utf8;base64," . base64_encode($review->product->photo);
                    }


                    ?>
                    <div class="col col-md-5 mx-4 my-4 rounded shadow bg-white border" id="review<?= $review->id ?>">
                        <div class="row">

                            <div class="col">
                                <div class='reviews'>
                                    <?php echo "<img src='$photo' class='img-fluid' alt='Image of the product'>" ?>
                                    </a>
                                </div>
                            </div>

                            <div class="col-sm">
                                <div class="mt-2 row">
                                    <div class="col-6">
                                        <h6><?= $review->user->login ?></h6>
                                    </div>

                                    <div class="col-6">
                                        <h6 class='text-end'><?= $review->date ?></h6>
                                    </div>
                                </div>
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                    $productMark = $review->mark;
                                    if ($i <= $productMark) {
                                        echo "<span class='fa fa-star checked'></span>";
                                    } else {
                                        echo "<span class='fa fa-star'></span>";
                                    }
                                }
                                ?>
                                <div class="row mt-4 rowUnder">
                                    <a href='/product?id=<?= $review->product->id ?>' class='link'>
                                        <h4><?= $review->product->name ?></h4>
                                    </a>
                                    <p><?= $review->text ?></p>

                                </div>
                                <div class=''>
                                <?php if ($user !== null && $user->isAdmin()) : ?>
                                    <a href="javascript:deleteReview(<?= $review->id ?>)"
                                       class="btn btn-add"  >Видалити</a>
                                <?php endif; ?>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>

                <?php } ?>
            </div>
        </div>
    </div>
</div>