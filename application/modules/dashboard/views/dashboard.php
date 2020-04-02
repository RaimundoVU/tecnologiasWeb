<div id="dashboard" class="container-fluid">
    <div class=" d-flex flex-row">
        <h1 class="mr-auto">Asignaturas</h1>

        <div class="d-flex flex-row justify-contentbetween">
        <div class="btn-group">
                <button class="btn btn-outline-secondary align-self-center btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Filtrar curso
                </button>
                <div class="dropdown-menu">
                    <? foreach( $subjects as $subject): ?>
                        <a class="dropdown-item" onclick="udpateBySubjet(<?=$subject->id?>)"><?= $subject->nombre?></a>
                    <? endforeach;?>
                </div>
            </div>
            <div class="btn-group">
                <button class="btn btn-outline-secondary align-self-center btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Filtrar año
                </button>
                <div class="dropdown-menu">
                    <? foreach ($years as $year): ?>
                        <a class="dropdown-item" onclick="updateByYear(<?=$year?>)"><?= $year ?></a>
                    <? endforeach; ?>
                </div>
            </div>
            <div class="btn-group">
                <button class="btn btn-outline-secondary align-self-center btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Filtrar semestre
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" onclick="updateBySemester(1)">Primer Semestre</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" onclick="updateBySemester(2)">Segundo Semestre</a>
                </div>
            </div>
            <button class="btn btn-success btn-sm align-self-center">
                Administración
                <i class="fas fa-cogs"></i>
            </button>
        </div>
    </div>

    <div class="container-fluid d-flex flex-row">

        <div class="d-flex align-content-start flex-column side">
            <div class="card side">
                <div class="card-body">
                    <h5 class="card-title">
                        <b>Usuarios</b>
                        <a class="btn btn-sm btn-warning float-right" href="<?= base_url() ?>users">
                            Editar
                            <i class="fas fa-user-edit"></i>
                        </a>
                    </h5>
                    <p class="card-text">
                        <ul>
                            <? foreach ($users as $user) : ?>
                                <li>
                                    <?= $user->nombres ?>
                                </li>
                            <? endforeach; ?>
                        </ul>
                    </p>
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center flex-row flex-wrap">
            <? foreach ($instances as $instance) : ?>
                <div class="card section align-self-start ">
                    <div class="card-body">
                        <h5 class="card-title"><b><?= $instance->nombre ?></b></h5>
                        <p class="card-text">
                            <b><?= $instance->anho . "-" . $instance->semestre ?></b>
                            <ul class="card-data">
                                <li>
                                    <b>Profesor:</b> <?= $instance->nombres . " " . $instance->apellido_paterno . " " . $instance->apellido_materno ?>
                                </li>
                                <!--<li>
                                    <b>Alumnos:</b> 37
                                </li>-->
                            </ul>
                        </p>
                        <div class="d-flex justify-content-end align-items-end">
                            <button class="btn btn-primary" onclick="openSubject(<?= $instance->id ?>)">
                                Ver asignatura
                                <i class="fas fa-chalkboard-teacher"></i>
                            </button>

                        </div>
                        <div class="d-flex justify-content-end align-items-end" style="margin-top: 10px;">
                            <button class="btn btn-warning" onclick="copyFolder(<?= $instance->id ?>)">
                                Copiar material
                                <i class="fas fa-chalkboard-teacher"></i>
                            </button>
                        </div>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</div>
<div class="modal fade" id="modalClone" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Copiar el material</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <div>
                        <label> Copiar archivos desde: </label>
                        <input class="form-control" type="text" id="source" name="source" readonly>
                        <input class="form-control" type="text" id="sourceId" name="sourceId" readonly hidden>
                    </div>
                    <div style="margin-top: 10px" class="form-group ui-widget">
                        <label>A:</label>
                        <input class="form-control" type="text" autocomplete="off" id="search_input" placeholder="Buscar Asignatura">
                        <input hidden id="subject_code" name="subject_code">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <input class="btn btn-primary" onclick="transferFiles()" value="Transferir">
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Styles for dashboard -->
<style type="text/css">
    .card {
        margin: 20px;
    }

    .card.section {
        width: 300px;
        min-height: 210px;
    }

    ul.card-data {
        padding-left: 0px;
        list-style-type: none;
    }

    .dashboard {
        margin: 10px;

    }

    .side {
        width: 250px;
        margin: 10px;
    }

    .search_box {
        width: 100%;
        max-width: 650px;
        margin: 0 auto;
        z-index: 9999999999 !important;
    }

    .pac-container {
        z-index: 9999999999 !important;
    }

    ul.ui-autocomplete {
        z-index: 1100 !important;
    }

    .btn-group {
        margin-left: 5px;
        margin-right: 5px;
    }
</style>
</style>

<script>
    var site_url = '<?= base_url() ?>';
    $(function() {
        $("#search_input").autocomplete({
            source: "<?php echo base_url('dashboard/fetch'); ?>",
            select: function(event, ui) {
                event.preventDefault();
                $("#search_input").val(ui.item.value);
                $("#subject_code").val(ui.item.id);
            }
        });
    });

    function transferFiles() {
        var subjectCode = $("#subject_code").val();
        var idSource = $("#sourceId").val();
        $.post(
            site_url + "dashboard/transferFiles", {
                subject_code: subjectCode,
                sourceId: idSource
            },
            function(data) {

                alert("se han transferido todos los archivos")
                $("#modalClone").modal('hide');
            });
    }

    function openSubject(id) {

        window.location.replace("<?php echo base_url('subject/subject/detail/'); ?>" + id);
    }

    function copyFolder(id) {
        var nombre = <?= json_encode($instances) ?>;
        const selected = nombre.filter(obj => Number(obj.id) === id)[0];
        console.log(selected);
        $("#source").val(selected.nombre + " (" + selected.anho + "-" + selected.semestre + ")");
        $("#sourceId").val(selected.id);
        $("#modalClone").modal('show');
    }

    function udpateBySubjet(id_subject) {
        window.location.replace(site_url + "dashboard/subject/" + id_subject );
    }

    function updateByYear(year) {
        window.location.replace(site_url + "dashboard/year/" + year );
    }

    function updateBySemester(semester) {
        window.location.replace(site_url + "dashboard/semester/" + semester );
    }
</script>