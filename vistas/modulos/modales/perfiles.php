<div id="ventanaModalPerfiles" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width:400px;">

    <div class="modal-content">

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

            <button class="btn btn-primary" id="btnNuevoPerfil">Nuevo Perfil</button>

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
                                
                                    <td>Update software</td>
                                
                                    <td>                                       
                                        
                                        <div class="btn-group">
                                            
                                            <button class="btn btn-warning btnEditarPerfil" idPerfil=""><i class="fa fa-pencil"></i></button>
                    
                                            <button class="btn btn-danger btnEliminarPerfil" idPerfil=""><i class="fa fa-times"></i></button>
                                 
                                        </div>
                                    
                                    </td>
                                
                                </tr>
                            
                                <tr>
                                
                                    <td>2.</td>
                                
                                    <td>Clean database</td>
                                
                                    <td>          
                                        
                                        <div class="btn-group">
                                            
                                            <button class="btn btn-warning btnEditarPerfil" data-toggle="modal" data-target="#modalEditarPerfil" idPerfil=""><i class="fa fa-pencil"></i></button>
                    
                                            <button class="btn btn-danger btnEliminarPerfil" idPerfil=""><i class="fa fa-times"></i></button>
                                 
                                        </div>
                                    
                                    </td>
                                
                                </tr>
                            
                                <tr>
                            
                                    <td>3.</td>
                                
                                    <td>Cron job running</td>
                                
                                    <td>
                                        
                                        <div class="btn-group">
                                            
                                            <button class="btn btn-warning btnEditarPerfil" data-toggle="modal" data-target="#modalEditarPerfil" idPerfil=""><i class="fa fa-pencil"></i></button>
                    
                                            <button class="btn btn-danger btnEliminarPerfil" idPerfil=""><i class="fa fa-times"></i></button>
                                 
                                        </div>
                                    
                                    </td>
                                
                                </tr>
                            
                                <tr>
                                
                                    <td>4.</td>
                                
                                    <td>Fix and squish bugs</td>
                                
                                    <td>
                                        
                                        <div class="btn-group">
                                            
                                            <button class="btn btn-warning btnEditarPerfil" data-toggle="modal" data-target="#modalEditarPerfil" idPerfil=""><i class="fa fa-pencil"></i></button>
                    
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
        
        <!--=====================================
        NUEVO PERFIL
        ======================================-->

        <div class="modal-body" id="nuevoPerfil" style="display:none">
                
                <div class="box-body">

                    <div class="box">
                        
                        <div class="box-body no-padding">
                        <h1>Nuevo Perfil</h1>
                        </div>

                    </div>

                </div>

        </div>
        
        <!--=====================================
        EDITAR PERFIL
        ======================================-->

        <div class="modal-body" id="editarPerfil" style="display:none;">
                
                <div class="box-body">

                    <div class="box">
                        
                        <div class="box-body no-padding">
                        <h1>Editar Perfil</h1>
                        </div>

                    </div>

                </div>

        </div>

    </div>

  </div>

</div>