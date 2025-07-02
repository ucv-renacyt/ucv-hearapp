<?php include 'app/components/header.php';

$clasesCount = General::getCountClases();
$cursosCount = General::getCountCursos();
$temasCount = General::getCountTemas();
$sedesCount = General::getCountSedes();
$docenteCount = General::getCountDocentes();
$estudianteCount = General::getCountEstudiantes();
?>

<?php include 'app/components/sidebar.php'; ?>

<?php include 'app/components/topbar.php'; ?>



<!-- start content -->
<div class="container-fluid px-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 d-flex align-items-center gap-2 font_two">Bienvenido Adminsitrador <?= $adminObj->nombre ?> !</h1>

    </div>
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold font_two text-uppercase mb-1">
                                Total Clases</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $clasesCount ?></div>
                        </div>
                        <div class="col-auto">
                            <img src="files/gif/checklist.gif" alt="" width="50">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold font_two text-uppercase mb-1">
                                Total Cursos</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $cursosCount ?></div>
                        </div>
                        <div class="col-auto">
                            <img src="files/gif/checklist.gif" alt="" width="50">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold font_two text-uppercase mb-1">
                                Total Sedes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $sedesCount ?></div>
                        </div>
                        <div class="col-auto">
                            <img src="files/gif/checklist.gif" alt="" width="50">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold font_two text-uppercase mb-1">
                                Total Temas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $temasCount ?></div>
                        </div>
                        <div class="col-auto">
                            <img src="files/gif/checklist.gif" alt="" width="50">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold font_two text-uppercase mb-1">
                                Total Docentes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $docenteCount ?></div>
                        </div>
                        <div class="col-auto">
                            <img src="files/gif/checklist.gif" alt="" width="50">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold font_two text-uppercase mb-1">
                                Total Estudiantes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $estudianteCount  ?></div>
                        </div>
                        <div class="col-auto">
                            <img src="files/gif/calendar.gif" alt="" width="50">
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="row">
        <div class="col-xl-6 col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold font_two">Estadísticas Mensuales de Clases</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="pt-4 pb-2 d-flex justify-content-center">
                        <canvas id="myChart" style="max-height: 300px;"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Número de Clases por Día
                        </span>
                    </div>
                </div>
            </div>
        </div>
       
     
    </div>
</div>
<!-- end content -->
<?php include 'app/components/loading.php'; ?>
<?php include 'app/components/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Obtener los datos de clases por día desde PHP
    let clasesData = <?php echo json_encode(General::getClassesPorDia()); ?>;

    // Procesar los datos para el gráfico
    let clasesLabels = [];
    let clasesCount = [];
    clasesData.forEach(function(item) {
        let label = item.dia + '/' + item.mes; // Formato día/mes
        clasesLabels.push(label);
        clasesCount.push(item.total_clases);
    });


    // Dibujar el gráfico de clases por día
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: clasesLabels,
            datasets: [{
                label: 'Clases por día',
                data: clasesCount,
                backgroundColor: 'rgba(54, 162, 235, 0.2)', // Azul suave
                borderColor: 'rgba(54, 162, 235, 1)', // Borde azul
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