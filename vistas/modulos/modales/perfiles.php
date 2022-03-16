<div id="ventanaModalPerfiles" class="modal fade" role="dialog">
        
    <div class="modal-dialog modalPerfil" id="modalPerfil">
    
        <!--=====================================
         PERFILES
        ======================================-->

        <div class="modal-content perfilesList" id="perfilesList">

            <!--=====================================
            CABEZA DEL MODAL
            ======================================-->

            <div class="modal-header" style="background:#3c8dbc; color:white">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Perfiles</h4>

            </div>

            <!--=====================================
            CUERPO DEL MODAL
            ======================================-->

            <div class="modal-body">

                <button class="btn btn-primary" id="btnNuevoPerfil"><b>Nuevo Perfil</b></button>

                <div class="box-body">

                    <div class="box">
                        
                        <div class="box-body no-padding">
                        
                            <table class="table">
                            
                                <thead>
                                    
                                    <th style="width: 10px">#</th>
                                
                                    <th>Perfil</th>
                                
                                    <th></th>                            

                                </thead>

                                <tbody>

                                <?php

                                    $item = null;
                                    $valor = null;

                                    $perfiles = ControladorPerfiles::ctrMostrarPerfiles($item,$valor);
                                
                                    for ($i=0; $i < sizeof($perfiles) ; $i++) { 
                                    
                                        $confgActivo = ($perfiles[$i]['activo'] == 1) ? $activo = array('icon'=>'check','btn'=>'success') : $activo = array('icon'=>'ban','btn'=>'danger');

                                       echo " 
                                        <tr>
                                
                                            <td>".($i+1)."</td>
                                        
                                            <td>".$perfiles[$i]['nombre']."</td>
                                        
                                            <td>                                       
                                                
                                                <div class='btn-group' style='float:right;'>
                                                    
                                                    <button class='btn btn-warning btnEditarPerfil' idPerfil='".$perfiles[$i]['id']."'><i class='fa fa-pencil'></i></button>
                            
                                                    <button class='btn btn-".$confgActivo['btn']." btnActDesacPerfil' idPerfil='".$perfiles[$i]['id']."'><i class='fa fa-".$confgActivo['icon']."'></i></button>
                                                    
                                                    <button class='btn btn-danger btnEliminarPerfil' idPerfil='".$perfiles[$i]['id']."'><i class='fa fa-times'></i></button>
                                        
                                                </div>
                                            
                                            </td>
                                        
                                        </tr>";

                                    }

                                ?>
                                
                                </tbody>
                            
                            </table>
                        
                        </div>

                    </div>

                </div>

            </div>
        
        </div>

            
        <!--=====================================
         NUEVO PERFIL
        ======================================-->

        <div class="modal-content hideElement" id="modalNuevoPerfil">
    
            <!--=====================================
            CABEZA DEL MODAL
            ======================================-->
    
            <div class="modal-header" style="background:#3c8dbc; color:white">
    
                <h4 class="modal-title">Nuevo Perfil</h4>
    
            </div>
    
            <div class="modal-body">
                
                <div class="box" style="border-top:none;">

                    <form method='post' id="newPerfilForm">
                    
                        <div class="form-group">
                            
                            <label for="nombrePerfil">Perfil</label>
                        
                            <input type="text" class="form-control" id="nombrePerfil" name="nombrePerfil" placeholder="Nuevo perfil" required>
                        
                        </div>

                        <?php

                            $flacas = 'flacasConf';
                    
                            $buenas = 'buenasConf';
                            
                            $buenasPlus = 'buenasPlusConf';
                            
                            $muyBuenas = 'muyBuenasConf';
                            
                            $apenasGordas = 'apenasGordasConf';
   
                            include "vistas/modulos/inicio/sliders.php";
                            
                        ?>

                        <button type="submit" form="newPerfilForm" class="btn btn-block btn-success" id="btnCargarPerfil" name="btnCargarPerfil">Cargar Perfil</button>
                        
                    </form>

                </div>

            </div>
            
        </div>

        <!--=====================================
        EDITAR PERFIL
        ======================================-->

        <div class="modal-content hideElement" id="modalEditarPerfil">

            <div class="modal-header" style="background:#3c8dbc; color:white">

                <h4 class="modal-title">Editar Perfil</h4>

            </div>

            <div class="modal-body">
                
                <div class="box"  style="border-top:none;">

                        <form method="post">
                            
                            <div class="form-group">
                                
                                <label for="nombrePerfil">Perfil</label>
                            
                                <input type="text" class="form-control" id="nombrePerfilEdit" name="nombrePerfilEdit" value="Nombre Perfil a Editar" readOnly>
                                <input type="hidden" class="form-control" id="idPerfilEdit" name="idPerfilEdit">
                            
                            </div>

                            <?php

                            $flacas = 'flacasConfEdit';
                    
                            $buenas = 'buenasConfEdit';
                            
                            $buenasPlus = 'buenasPlusConfEdit';
                            
                            $muyBuenas = 'muyBuenasConfEdit';
                            
                            $apenasGordas = 'apenasGordasConfEdit';
                            
                            $gordas = 'gordasConfEdit';

                            include "vistas/modulos/inicio/sliders.php";
                            
                            ?>

                            <button type="submit" name="editarPerfil" id="editarPerfil" class="btn btn-block btn-success"><b>Editar Perfil</b></button>

                        </form>

                </div>

            </div>

        </div>

    </div>
                
</div>


<?php

$cargarPerfil = new ControladorPerfiles();
$cargarPerfil -> ctrNuevoPerfil();

$editarPerfil = new ControladorPerfiles();
$editarPerfil -> ctrEditarPerfil();

$eliminarPerfil = new ControladorPerfiles();
$eliminarPerfil -> ctrEliminarPerfil();

?>