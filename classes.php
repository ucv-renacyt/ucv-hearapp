<?php include 'app/components/header.php';
$teacherAll = General::getTeacherActiveAll();
$courseAll = General::getCourseAll();
$temasAll = General::getTemasAll();
$studentsAll = General::getStudentsActiveAll();
$classesAll = General::getClassesAll();


?>

<?php include 'app/components/sidebar.php'; ?>

<?php include 'app/components/topbar.php'; ?>

<style>
    #students_id {
        max-height: 300px;
        /* Puedes ajustar esta altura según tus necesidades */
        overflow-y: auto;
        border: 1px solid #ced4da;
        /* Opcional: agrega un borde para hacer más evidente el contenedor */
        padding: 10px;
    }

    .card-margin {
        margin-bottom: 1.875rem;
    }

    .card {
        border: 0;
        box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
        -webkit-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
        -moz-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
        -ms-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #ffffff;
        background-clip: border-box;
        border: 1px solid #e6e4e9;
        border-radius: 8px;
    }

    .card .card-header.no-border {
        border: 0;
    }

    .card .card-header {
        background: none;
        padding: 0 0.9375rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        min-height: 50px;
    }

    .card-header:first-child {
        border-radius: calc(8px - 1px) calc(8px - 1px) 0 0;
    }

    .widget-49 .widget-49-title-wrapper {
        display: flex;
        align-items: center;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-primary {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: #edf1fc;
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-primary .widget-49-date-day {
        color: #4e73e5;
        font-weight: 500;
        font-size: 1.5rem;
        line-height: 1;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-primary .widget-49-date-month {
        color: #4e73e5;
        line-height: 1;
        font-size: 1rem;
        text-transform: uppercase;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-secondary {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: #fcfcfd;
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-secondary .widget-49-date-day {
        color: #dde1e9;
        font-weight: 500;
        font-size: 1.5rem;
        line-height: 1;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-secondary .widget-49-date-month {
        color: #dde1e9;
        line-height: 1;
        font-size: 1rem;
        text-transform: uppercase;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-success {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: #e8faf8;
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-success .widget-49-date-day {
        color: #17d1bd;
        font-weight: 500;
        font-size: 1.5rem;
        line-height: 1;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-success .widget-49-date-month {
        color: #17d1bd;
        line-height: 1;
        font-size: 1rem;
        text-transform: uppercase;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-info {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: #ebf7ff;
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-info .widget-49-date-day {
        color: #36afff;
        font-weight: 500;
        font-size: 1.5rem;
        line-height: 1;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-info .widget-49-date-month {
        color: #36afff;
        line-height: 1;
        font-size: 1rem;
        text-transform: uppercase;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-warning {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: floralwhite;
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-warning .widget-49-date-day {
        color: #FFC868;
        font-weight: 500;
        font-size: 1.5rem;
        line-height: 1;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-warning .widget-49-date-month {
        color: #FFC868;
        line-height: 1;
        font-size: 1rem;
        text-transform: uppercase;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-danger {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: #feeeef;
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-danger .widget-49-date-day {
        color: #F95062;
        font-weight: 500;
        font-size: 1.5rem;
        line-height: 1;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-danger .widget-49-date-month {
        color: #F95062;
        line-height: 1;
        font-size: 1rem;
        text-transform: uppercase;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-light {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: #fefeff;
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-light .widget-49-date-day {
        color: #f7f9fa;
        font-weight: 500;
        font-size: 1.5rem;
        line-height: 1;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-light .widget-49-date-month {
        color: #f7f9fa;
        line-height: 1;
        font-size: 1rem;
        text-transform: uppercase;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-dark {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: #ebedee;
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-dark .widget-49-date-day {
        color: #394856;
        font-weight: 500;
        font-size: 1.5rem;
        line-height: 1;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-dark .widget-49-date-month {
        color: #394856;
        line-height: 1;
        font-size: 1rem;
        text-transform: uppercase;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-base {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: #f0fafb;
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-base .widget-49-date-day {
        color: #68CBD7;
        font-weight: 500;
        font-size: 1.5rem;
        line-height: 1;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-base .widget-49-date-month {
        color: #68CBD7;
        line-height: 1;
        font-size: 1rem;
        text-transform: uppercase;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-meeting-info {
        display: flex;
        flex-direction: column;
        margin-left: 1rem;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-meeting-info .widget-49-pro-title {
        color: #3c4142;
        font-size: 14px;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-meeting-info .widget-49-meeting-time {
        color: #B1BAC5;
        font-size: 13px;
    }

    .widget-49 .widget-49-meeting-points {
        font-weight: 400;
        font-size: 13px;
        margin-top: .5rem;
    }

    .widget-49 .widget-49-meeting-points .widget-49-meeting-item {
        display: list-item;
        color: #727686;
    }

    .widget-49 .widget-49-meeting-points .widget-49-meeting-item span {
        margin-left: .5rem;
    }

    .widget-49 .widget-49-meeting-action {
        text-align: right;
    }

    .widget-49 .widget-49-meeting-action a {
        text-transform: uppercase;
    }
</style>


<!-- start content -->
<div class="container-fluid px-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 d-flex align-items-center gap-2 font_two"><i class='bx bxs-book-bookmark me-1'></i> Gesti&oacute;n de Clases</h1>
        <div class="d-flex gap-1">
            <a href="#" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='bx bx-user-plus me-1'></i> Agregar</a>
        </div>
    </div>
    <!-- Modal Agregar -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="addClasses" method="POST" enctype="multipart/form-data" action="add_class.php">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Clase</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body row">
                        <div class="col-xl-4">
                            <div class="form-floating mb-3">
                                <select class="form-select selectProduct" id="curso_id" name="curso_id" onchange="loadThemes(this.value)" required>
                                    <option value="" selected>Seleccionar una opción</option>
                                    <?php foreach ($courseAll as $result) : ?>
                                        <option value="<?= htmlspecialchars($result->id) ?>"><?= htmlspecialchars($result->nombre) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="curso_id">Cursos</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select selectProduct" id="theme_id" name="theme_id" required>
                                    <option value="" selected>Seleccionar una opción</option>
                                    <!-- Temas se cargarán aquí -->
                                </select>
                                <label for="theme_id">Temas</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select selectProduct" id="teacher_id" name="teacher_id" required>
                                    <option value="" selected>Seleccionar una opción</option>
                                    <?php foreach ($teacherAll as $result) : ?>
                                        <option value="<?= htmlspecialchars($result->id) ?>"><?= htmlspecialchars($result->full_name) ?> - <?= htmlspecialchars($result->code) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="teacher_id">Docentes</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="datetime-local" class="form-control" id="start_date" name="start_date" required>
                                <label for="start_date">Fecha de inicio</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="datetime-local" class="form-control" id="end_date" name="end_date" required>
                                <label for="end_date">Fecha de finalización</label>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="studentSearch" placeholder="Buscar estudiante...">
                                <label for="studentSearch">Buscar Estudiante</label>
                            </div>
                            <div class=" mb-3">
                                <label for="students_id">Estudiantes</label>
                                <div id="students_id">
                                    <?php foreach ($studentsAll as $result) : ?>
                                        <div class="form-check student-item">
                                            <input class="form-check-input" type="checkbox" value="<?= htmlspecialchars($result->id) ?>" id="student_<?= htmlspecialchars($result->id) ?>" name="students_id[]">
                                            <label class="form-check-label" for="student_<?= htmlspecialchars($result->id) ?>">
                                                <?= htmlspecialchars($result->full_name) ?> - <?= htmlspecialchars($result->code) ?> - <?= htmlspecialchars($result->nombreCampus) ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary"><i class='bx bx-save me-1'></i>Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row justify-content-center">

        <div class="form-floating mb-3 col-xl-3 col-md-12 px-2 py-1">
            <select class="form-select selectProduct" id="curso_id" name="curso_id" onchange="filterClassesByCourse(this.value)" required>
                <option value="" selected>Seleccionar una opción</option>
                <?php foreach ($courseAll as $result) : ?>
                    <option value="<?= htmlspecialchars($result->nombre) ?>"><?= htmlspecialchars($result->nombre) ?></option>
                <?php endforeach; ?>
            </select>
            <label for="curso_id">Cursos</label>
        </div>
        <div class="form-floating mb-3 col-xl-3 col-md-12 px-2 py-1">
            <select class="form-select selectProduct" id="curso_id" name="curso_id" onchange="filterClassesByTemas(this.value)" required>
                <option value="" selected>Seleccionar una opción</option>
                <?php foreach ($temasAll as $result) : ?>
                    <option value="<?= htmlspecialchars($result->nombre, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($result->nombre, ENT_QUOTES, 'UTF-8') ?></option>
                <?php endforeach; ?>
            </select>
            <label for="curso_id">Temas</label>
        </div>

        <div class="form-floating mb-3 col-xl-3 col-md-12 px-2 py-1">
            <select class="form-select selectProduct" id="profesor_id" name="profesor_id" onchange="filterClassesByTeacher(this.value)" required>
                <option value="" selected>Seleccionar una opción</option>
                <?php foreach ($teacherAll as $result) : ?>
                    <option value="<?= htmlspecialchars($result->full_name) ?>"><?= htmlspecialchars($result->full_name) ?></option>
                <?php endforeach; ?>
            </select>
            <label for="profesor_id">Profesores</label>
        </div>



    </div>

    <div class="row" id="class-cards">
        <?php foreach ($classesAll as $result) : ?>
            <?php
            // Calcular la duración en horas
            $start = new DateTime($result->start_date);
            $end = new DateTime($result->end_date);
            $diff = $start->diff($end);
            $hours = $diff->h + $diff->days * 24;

            // Formatear la duración en formato legible
            $duration = $start->format('H:i') . ' to ' . $end->format('H:i');

            // Obtener la fecha en formato abreviado
            $date = $start->format('d') . ' <span class="widget-49-date-month">' . $start->format('M') . '</span>';

            // Obtener los estudiantes de la clase actual
            $students = General::getStudentsByClassId($result->id);
            ?>

            <div class="col-lg-4 class-card" data-curso-name="<?= htmlspecialchars($result->name_curso, ENT_QUOTES, 'UTF-8') ?>" data-docente-name="<?= htmlspecialchars($result->nombreDocente, ENT_QUOTES, 'UTF-8') ?>" data-student-names='<?= $studentNamesJson ?>' data-theme-name="<?= htmlspecialchars($result->name_class, ENT_QUOTES, 'UTF-8') ?>">
                <div class="card card-margin">
                    <div class="card-header no-border">
                        <h5 class="card-title"><?= htmlspecialchars($result->name_curso, ENT_QUOTES, 'UTF-8') ?></h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="widget-49">
                            <div class="widget-49-title-wrapper">
                                <div class="widget-49-date-primary">
                                    <span class="widget-49-date-day"><?= $start->format('d') ?></span>
                                    <span class="widget-49-date-month"><?= $start->format('M') ?></span>
                                </div>
                                <div class="widget-49-meeting-info">
                                    <span class="widget-49-pro-title">Tema: <?= htmlspecialchars($result->name_class, ENT_QUOTES, 'UTF-8') ?></span>
                                    <span class="widget-49-pro-title">Docente: <?= htmlspecialchars($result->nombreDocente, ENT_QUOTES, 'UTF-8') ?></span>
                                    <span class="widget-49-meeting-time"><?= $duration ?> Hrs</span>
                                </div>
                            </div>
                            <ol class="widget-49-meeting-points">
                                <?php foreach ($students as $student) : ?>
                                    <li class="widget-49-meeting-item"><span><?= htmlspecialchars($student->nombreEstudiante, ENT_QUOTES, 'UTF-8') ?></span></li>
                                <?php endforeach; ?>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>




</div>
<!-- end content -->
<?php include 'app/components/loading.php'; ?>
<?php include 'app/components/footer.php'; ?>
<script src="assets/js/general/add-classes.js"></script>
<script>
    function loadThemes(cursoId) {
        if (cursoId) {
            $.ajax({
                url: 'config/general/get_themes.php',
                type: 'GET',
                data: {
                    curso_id: cursoId
                },
                dataType: 'json',
                success: function(data) {
                    let themeSelect = $('#theme_id');
                    themeSelect.html('<option value="" selected>Seleccionar una opción</option>');
                    $.each(data, function(index, theme) {
                        themeSelect.append(`<option value="${theme.id}">${theme.nombre}</option>`);
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error:', textStatus, errorThrown);
                }
            });
        }
    }
</script>
<script>
    document.getElementById('studentSearch').addEventListener('keyup', function() {
        let searchValue = this.value.toLowerCase();
        let students = document.querySelectorAll('#students_id .student-item');

        students.forEach(function(student) {
            let studentName = student.querySelector('label').textContent.toLowerCase();
            if (studentName.includes(searchValue)) {
                student.style.display = 'block';
            } else {
                student.style.display = 'none';
            }
        });
    });
</script>
<script>
    function filterClassesByCourse(courseName) {
        const classCards = document.querySelectorAll('.class-card');

        classCards.forEach(card => {
            if (courseName === '' || card.getAttribute('data-curso-name') === courseName) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>
<script>
    function filterClassesByTeacher(teacherName) {
        const classCards = document.querySelectorAll('.class-card');

        classCards.forEach(card => {
            if (teacherName === '' || card.getAttribute('data-docente-name') === teacherName) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>

<script>
    function filterClassesByTemas(themeName) {
        const classCards = document.querySelectorAll('.class-card');

        classCards.forEach(card => {
            const cardThemeName = card.getAttribute('data-theme-name');
            if (themeName === '' || cardThemeName === themeName) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>