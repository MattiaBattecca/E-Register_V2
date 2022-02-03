<?php 
include('template/template_header_pub.php');
include('dal.php');
?>

<p class="intestazione">Scuola ISII Marconi</p>

<div class="container" id="Cerca">
    <h2>Cerca una classe</h2>
    <form method="get" action="cerca_act.php">
        <input name="classe" id="classe" placeholder="Cerca una classe...">
        <button type="submit">Cerca</button>
    </form>
</div>

<?php 
$arr=mesi();
?>

<div class="container" id="Andamento">
    <h2>Andamento annuale</h2>

    <p>
        <canvas id="myChart" style="width:100%;"></canvas>

        <script>
            var xValues = ["SET","OTT","NOV","DIC","GEN","FEB","MAR","APR","MAG","GIU"];

            new Chart("myChart", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{ 
                data: [<?php
                foreach ($arr as $a ) {
                    echo($a.",");
                }?>],
                borderColor: "red",
                fill: false
                }]
            },
            options: {
                legend: {display: false}
            }
            });
        </script>
    </p>
    
</div>

<div class="container" id="Voti">
    <h2>Statistiche generali</h2>
    <table>
        <tr>
            <th>Media</th>
            <th>Massimo</th>
            <th>Minimo</th>
            <th>Deviazione</th>
        </tr>

        <tr>
            <td class="voto"><?=number_format(media_tot()[0],2);?></td>
            <td class="voto"><?=number_format(massimo_tot()[0],2);?></td>
            <td class="voto"><?=number_format(minimo_tot()[0],2);?></td>
            <td class="voto"><?=number_format(deviazione_tot()[0],2);?></td>
        </tr>

    </table>
</div>

<?php include('template/template_footer.php');?>