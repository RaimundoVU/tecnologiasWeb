<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

<style>
    .card,
    a {
        cursor: pointer;
    }
</style>

<div class="container">
    <h1 style="text-align: center"><?= $subject->asignatura?></h1>
    <div>
        <div class="card section">
            <div class="card-body">
                <h5 class="card-title"><b>Datos</b></h5>
                <p class="card-text">
                    <b>Semestre:</b> <?= $subject->semestre ?> - <?= $subject->anho ?>
                    <b>Profesor:</b> <?= $subject->nombres ?> <?= $subject->apellido_paterno ?> <?= $subject->apellido_materno?>
                </p>
            </div>
        </div>
    </div>
    <div style="margin-top: 10px">
        <h5 style="margin-left: 15px"> <b>Archivos</b></h5>
        <form action="<?= base_url(); ?>/subject/createZip" method="POST">
            <input class="btn btn-warning" type="submit" value="Descargar Curso en Zip">
            <input hidden type="text" id="pathFolderZip" name="pathFolderZip">
            <input hidden type="text" id="nameFolderZip" name="nameFolderZip">
        </form>
        <div class="shadow p-2 mb-4 bg-gray rounded" style="margin-top: 15px">
            <div class="row">
                <div class="col-3">
                <div style="height: 30px; padding-top:15px; text-align: center">
                        Carpetas
                    </div> <hr>
                    <div id="test" style="margin-top: 20px">
                    </div>
                </div>
               
                <div class="col" style="box-shadow: -2px 0px 0px #888;">
                    <div style="height: 30px; margin-top: 5px">
                        <div class="row">
                            <div class="col-9" style="text-align: center">
                                <h6 id="title"></h6>
                            </div>
                            <div class="col">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Opciones
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal">Crear Carpeta</a>
                                        <a class="dropdown-item" data-toggle="modal" data-target="#modalUpload">Subir Archivo</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="container">
                        <div class="row" style="min-height: 300px">

                            <div id="info"></div>

                        </div>
                    </div>


                </div>
            </div>

        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear carpeta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <div style="margin-top: 10px">
                        <label>Nombre de la carpeta</label>
                        <input class="form-control" type="text" id="folderName" name="folderName">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="createFolder()">Crear</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalUpload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Subir archivo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form" action="../subject/upload" method="post" enctype="multipart/form-data">
                <div class="modal-body">

                    <div>
                        <div style="margin-top: 10px">
                            <label>Ingrese el archivo</label>
                            <input class="form-control" type="file" id="inputFile" name="inputFile">
                            <input hidden class="form-control" type="text" id="pathInput" name="pathInput">
                            <input hidden type="text" id="idSubject" name="idSubject">
                            <input hidden type="text" id="principalPath" name="principalPath">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <input class="btn btn-primary" type="submit" value="Subir">
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    var tree = "";
    var currentPath = "";
    const idSubject = <?php echo  $idSubject ?>;
    const site_url = '<?php echo  base_url(); ?>';
    const path = '<?php echo  $path ?>';
    const semestre = '<?= $subject->semestre ?>';
    const anio = '<?= $subject->anho ?>';
    const subjectName = '<?= $subject->asignatura?>';


    $(function() {
        var files = <?= json_encode($directories); ?>;
        $("#idSubject").val(idSubject);
        $("#principalPath").val(path);
        $("#pathFolderZip").val(path);
        $("#nameFolderZip").val(subjectName+" ("+anio+"_"+semestre+")");
        make_tree(files);
        $("#test").html(tree);

        function make_tree(files) {
            tree += '<ul>';

            for (i in files) {
                if (typeof files[i] == "object") {
                    console.log("objeto" + i);
                    tree += '<li>' + i.trim().replace('\\', "");
                    make_tree(files[i]);
                    tree += '</li>';
                }
            }
            tree += '</ul>'
        }
    });

    $('#form').submit(function(){
        if (currentPath=="") {
            alert("Error! Debe abrir una carpeta para almacenar el archivo!");
            return false;
        }
        return true;
    })

    function createFolder() {
        let folderName = $("#folderName").val();
        $.post(
            site_url + "subject/createFolder", {
                pathFolder: currentPath,
                name: folderName,
                path: path
            },
            function() {
                location.reload();
            });
    }

    function downloadFile(nro) {
        console.log(path+"/"+currentPath+"/"+$("#nameFile"+nro).val());
        $("#path"+nro).val(path+"/"+currentPath+"/"+$("#nameFile"+nro).val());
        document.getElementById('btnSubmit'+nro).click();
    }

    function getFiles(path) {
        var arch = "";
        var cont = 0;
        
        for (i in path) {
            if (typeof path[i] != "object") {
                arch += '<div style="float: left; margin-left: 10px; margin-bottom: 10px;"><form action="<?= base_url(); ?>/subject/downloadFile/'+cont+'" method="POST"><div class="card" style="width: 8rem; min-height: 160px !important" onclick="downloadFile('+cont+')">' +
                    '<img class="card-img-top" src="' + site_url + '../assets/file_icon.png" style="width: 70px; margin-left: 30px; margin-top:8px">' +
                    '<div class="card-body">' +
                    '<p class="card-text" style="text-align: center">' + path[i].trim().replace('\\', "") + '</p>' +
                    '</div></div>'
                    +'<input hidden type="text" id="nameFile'+cont+'" name="nameFile'+cont+'" value="'+path[i].trim().replace('\\', "")+'"><input hidden type="text" id="path'+cont+'" name="pathFile'+cont+'"> <input hidden type="submit" id="btnSubmit'+ cont+'"></form></div>';
                cont ++;
            }
        }
        if (cont == 0) {
            return "No hay archivos";
        }
        return arch;
    }

    $(function() {
        $('#test')
            // listen for event
            .on('changed.jstree', function(e, data) {
                var pathView = data.instance.get_path(data.node, '⯈ ');
                currentPath = data.instance.get_path(data.node, '/');
                
                $.post(site_url + "subject/getInfo", {
                    subPath: data.instance.get_path(data.node, '/'),
                    path: path
                }, function(data) {
                    var json = JSON.parse(data);
                    $('#info').html(getFiles(json));
                });

                $('#title').html(pathView);
                $('#pathInput').val(currentPath);
            })
            // create the instance
            .jstree()
    });
</script>