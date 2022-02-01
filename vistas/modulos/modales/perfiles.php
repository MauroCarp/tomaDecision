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

                                    <tr>
                                
                                        <td>1.</td>
                                    
                                        <td>Perfil 1</td>
                                    
                                        <td>                                       
                                            
                                            <div class="btn-group">
                                                
                                                <button class="btn btn-warning btnEditarPerfil" idPerfil=""><i class="fa fa-pencil"></i></button>
                        
                                                <button class="btn btn-danger btnEliminarPerfil" idPerfil=""><i class="fa fa-times"></i></button>
                                    
                                            </div>
                                        
                                        </td>
                                    
                                    </tr>
                                
                                    <tr>
                                    
                                        <td>2.</td>
                                    
                                        <td>Perfil 2</td>
                                    
                                        <td>          
                                            
                                            <div class="btn-group">
                                                
                                                <button class="btn btn-warning btnEditarPerfil" idPerfil=""><i class="fa fa-pencil"></i></button>
                        
                                                <button class="btn btn-danger btnEliminarPerfil" idPerfil=""><i class="fa fa-times"></i></button>
                                    
                                            </div>
                                        
                                        </td>
                                    
                                    </tr>
                                
                                    <tr>
                                
                                        <td>3.</td>
                                    
                                        <td>Perfil 3</td>
                                    
                                        <td>
                                            
                                            <div class="btn-group">
                                                
                                                <button class="btn btn-warning btnEditarPerfil" idPerfil=""><i class="fa fa-pencil"></i></button>
                        
                                                <button class="btn btn-danger btnEliminarPerfil" idPerfil=""><i class="fa fa-times"></i></button>
                                    
                                            </div>
                                        
                                        </td>
                                    
                                    </tr>
                                
                                    <tr>
                                    
                                        <td>4.</td>
                                    
                                        <td>Perfil 4</td>
                                    
                                        <td>
                                            
                                            <div class="btn-group">
                                                
                                                <button class="btn btn-warning btnEditarPerfil" idPerfil=""><i class="fa fa-pencil"></i></button>
                        
                                                <button class="btn btn-danger btnEliminarPerfil" idPerfil=""><i class="fa fa-times"></i></button>
                                    
                                            </div>

                                        </td>
                                    
                                    </tr>
                                
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
                        
                            <input type="text" class="form-control" id="nombrePerfil" name="nombrePerfil" placeholder="Nuevo perfil">
                        
                        </div>

                        <?php

                            $flacas = 'flacasConf';
                    
                            $buenas = 'buenasConf';
                            
                            $buenasPlus = 'buenasPlusConf';
                            
                            $muyBuenas = 'muyBuenasConf';
                            
                            $apenasGordas = 'apenasGordasConf';
                            
                            $gordas = 'gordasConf';

                            include "vistas/modulos/inicio/sliders.php";
                            
                        ?>

                        <button type="submit" form="newPerfilForm" class="btn btn-block btn-success" id="btnCargarPerfil">Cargar Perfil</button>
                        
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
                        
                        <div class="form-group">
                            
                            <label for="nombrePerfil">Perfil</label>
                        
                            <input type="text" class="form-control" id="nombrePerfilEdit" value="Nombre Perfil a Editar" readOnly>
                        
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

                </div>

            </div>

        </div>

    </div>
                
</div>



        <!--=====================================
        EDITAR PERFIL
        ======================================-->
<!-- 
        <div class="modal-body" id="editarPerfil" style="display:none;">
                
                <div class="box-body">

                    <div class="box">
                        
                        <div class="box-body no-padding">
                            
                            <h4>Editar Perfil</h4>

                            <div class="form-group">
                                
                                <label for="nombrePerfil">Perfil</label>
                            
                                <input type="text" class="form-control" id="nombrePerfilEdit" value="Nombre Perfil a Editar" readOnly>
                            
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

                        </div>

                    </div>

                </div>

        </div> -->