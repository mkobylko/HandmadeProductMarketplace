<?php
/** @var array $ordersAndCity */
/** @var array $orderAndCategory */
/** @var int $quantityOfAn */
/** @var array $sellers */
?>
<div class="container">
    <div class="row mt-3">
        <div class="col col-lg-4 text-start">
            <p><em>Статистика замовлень по містам</em></p>
            <table class="table table-primary table-striped ">
                <thead>
                <tr>
                    <th scope="col">Місто</th>
                    <th scope="col">Кількість замовлень</th>
                </tr>
                </thead>
<?php
    foreach ($ordersAndCity as $key => $value)
    {?>
        <tr>
            <td scope="row"><?=$key?></td>
            <td><?=$value?></td>

        </tr>
    <?php } ?>
            </table>
            <div class="mt-5 text-center">
            <div style="font-size:80px"><?=$quantityOfAn?></div>
            <div class="mt-3" style=" font-size:22px">Активних оголошень</div>
            </div>
        </div>

        <div class="col mt-5 col-lg-8 text-start">
            <div class="mt-5">
                <canvas id="barChart"></canvas></div>
        </div>

        <div class="mt-5 col-md-1- col-9 mx-auto">
            <div class="mt-5"><p><em>Кращі продавці</em></p></div>
            <table id="dtDynamicVerticalScrollExample" class="table table-striped " cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <th class="th-sm">Продавець
                    </th>
                    <th class="th-sm">Кількість проданого товару
                    </th>
                </tr>
                </thead>
                <?php
                foreach ($sellers as $key => $value)
                {?>
                <tbody>
                <tr>
                    <td><?=$key?></td>
                    <td><?=$value?></td>
                </tr>
                </tbody>
                <?php } ?>
            </table>
        </div>

    </div>
</div>
<div class="mt-5"></div>
<script
    src="https://cdn.jsdelivr.net/npm/chart.js@4.0.1/dist/chart.umd.min.js"></script>
<script>


let array = [<?php echo implode(", ", $orderAndCategory); ?>];


let ctxB = document.getElementById("barChart").getContext('2d');
let myBarChart = new Chart(ctxB, {
    type: 'bar',
    data: {
        labels: ["Ляльки-мотанки", "Шопери", "Прикраси", "Іграшки", "Творчість"],
        datasets: [{
            label: 'Кількість замовлень по категоріях в цьому місяці',
            data: [parseInt(array[0]), parseInt(array[1]), parseInt(array[2]), parseInt(array[3]), parseInt(array[4])],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>

