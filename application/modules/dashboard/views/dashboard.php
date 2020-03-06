<div id="dashboard" class="container-fluid">
    <div class=" d-flex flex-row">
        <h1 class="mr-auto">Asignaturas</h1>

        <div class="d-flex flex-row">
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
                         <button class="btn btn-sm btn-danger float-right">
                             Editar
                             <i class="fas fa-user-edit"></i>
                            </button>
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
            <? foreach ($sections as $section) : ?>
                <div class="card section align-self-start ">
                    <div class="card-body">
                        <h5 class="card-title"><b><?= $section ?></b></h5>
                        <p class="card-text">
                            <b>2019-2 v2</b>
                            <ul class="card-data">
                                <li>
                                    <b>Profesor:</b> Dieguito Maradona

                                </li>
                                <li>
                                    <b>Alumnos:</b> 37
                                </li>
                            </ul>
                        </p>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary">
                                Ver asignatura
                                <i class="fas fa-chalkboard-teacher"></i>
                            </button>
                        </div>
                    </div>
                </div>
            <? endforeach; ?>
        </div>



    </div>

</div>

<!-- Styles for dashboard -->
<style type="text/css">
    .card {
        margin: 20px;
    }

    .card.section {
        width: 30%;
        height: 210px;
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
</style>