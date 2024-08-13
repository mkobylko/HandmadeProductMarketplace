<style>
    .bn{
        background: black;
        overflow: hidden;
    }
    img {
        object-fit: cover;
        opacity: 0.5;
    }
    .centered {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .textTrueBack{
        color: black;
        font-size: larger;
        font-weight: bold;
        background-color: burlywood;
    }
    .textTrueArch{
        color: black;
        font-size: larger;
        font-weight: bold;
        background-color: burlywood;
    }
</style>
<script>
    function backup() {
        $.get("/backupArchive/backup/", {})
            .done(function ()
            {
                $("#buttonBack").hide();
                $("#textTrueBack").text('Виконано бекап');
            })

    }
    function archive() {
        $.get("/backupArchive/archive/", {})
            .done(function ()
            {
                $("#buttonArch").hide();
                $("#textTrueArch").text('Виконано архівацію');
            })

    }
</script>


<div class="text-center bn">
    <img src="/themes/images/forPageBack.jpg" alt="Snow" style="width:100%;">

    <div class="centered">
        <div class="mb-4">
            <a href="javascript:backup()" id="buttonBack" class="btn mt-2 btn-add">Зробити бекап</a>
            <div id="textTrueBack" class="textTrueBack"></div>
        </div>
        <div class="mb-4">
            <a href="javascript:archive()" id="buttonArch" class="btn mt-2 btn-add">Зробити архівацію замовлень</a>
            <div id="textTrueArch" class="textTrueArch"></div>
        </div>
    </div>

</div>
