<?php
include 'app/components/header.php';
include 'app/components/sidebar.php';
include 'app/components/topbar.php';

// Obtener el ID del curso desde la URL
$courseId = $_GET['id'];

// Obtener los datos del curso y sus temas
$course = General::getCourseById($courseId);
$temas = General::getThemeCourseId($courseId);
?>

<!-- start content -->
<div class="container-fluid px-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 d-flex align-items-center gap-2 font_two"><i class='bx bxs-book-bookmark me-1'></i> Editar Curso</h1>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-margin">
                <div class="card-body">
                    <form id="editCourse" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="course_id" value="<?= $courseId ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre">Nombre del Curso</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $course->nombre ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="temas">Temas</label>
                                    <div id="temasContainer">
                                        <?php foreach ($temas as $index => $tema) : ?>
                                            <div class="form-floating mb-3 tema-item" data-tema-id="<?= $tema->id ?>">
                                                <input type="text" class="form-control" id="tema<?= $index ?>" placeholder="Tema <?= $index ?>" name="temas[]" value="<?= $tema->nombre ?>" required>
                                                <label for="tema<?= $index ?>">Tema <?= $index ?></label>
                                                <button type="button" class="btn btn-danger btn-sm remove-tema-btn" data-tema-id="<?= $tema->id ?>">Eliminar</button>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-success" id="addTemaBtn">Agregar Tema</button>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end content -->

<?php include 'app/components/loading.php'; ?>
<?php include 'app/components/footer.php'; ?>
<script src="assets/js/general/edit-curso.js"></script>

<script>
    $(document).ready(function() {
        let temaCount = <?= count($temas) ?>;

        $('#addTemaBtn').click(function() {
            temaCount++;
            $('#temasContainer').append(`
                <div class="form-floating mb-3 tema-item" data-tema-id="new">
                    <input type="text" class="form-control" id="tema${temaCount}" placeholder="Tema ${temaCount}" name="temas[]" required>
                    <label for="tema${temaCount}">Tema ${temaCount}</label>
                    <button type="button" class="btn btn-danger btn-sm remove-tema-btn">Eliminar</button>
                </div>
            `);
        });

        $(document).on('click', '.remove-tema-btn', function(e) {
            const temaItem = $(this).closest('.tema-item');
            const temaId = temaItem.data('tema-id');

            if (temaId === 'new') {
                temaItem.remove();
            } else {
                if (confirm('¿Estás seguro de que deseas eliminar este tema?')) {
                    $.ajax({
                        url: 'config/general/delete_tema.php',
                        type: 'GET',
                        data: {
                            id: temaId
                        },
                        dataType: 'json',
                        success: function(data) {
                            if (data.status === 'success') {
                                temaItem.remove();
                            } else {
                                alert('Error al eliminar el tema.');
                            }
                        },
                        error: function() {
                            alert('Error al eliminar el tema.');
                        }
                    });
                }
            }
        });
    });
</script>