<form method="post" id="formNuevoAnimal">

    <div class="row">

        <div class="col-lg-2">
            
            <div class="form-group">
                
                <label for="rfid">RFID</label>
            
                <input type="text" class="form-control" id="rfid" name="rfid" maxlength="10">
            
            </div>
        
        </div>

        <div class="col-lg-2">
            
            <div class="form-group">
                
                <label for="peso">Peso</label>
            
                <input type="text" class="form-control" id="peso" name="peso">
            
            </div>
        
        </div>

        <div class="col-lg-2">
            
            <div class="form-group">
                
                <label for="mmGrasa">mm Grasa</label>
            
                <input type="number" step="0.10" class="form-control" id="mmGrasa" name="mmGrasa">
            
            </div>
        
        </div>

        <div class="col-lg-1">
            
            <div class="form-group">
                
                <label for="aob">AOB</label>
            
                <input type="number" step="0.01" class="form-control" id="aob" name="aob">
            
            </div>
        
        </div>

        <div class="col-lg-2">

            <div class="form-group">

                <label for="sexo">Sexo</label>

                <div class="row">

                    <div class="col-md-3">

                        <div class="radio">
                            
                            <label>
                            
                            <input type="radio" name="sexo" value="M" checked>
            
                            M                
            
                            </label>
                            
                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="radio">
                        
                            <label>
                            
                            <input type="radio" name="sexo" value="H">
                            
                            H                
                            
                            </label>
                            
                        </div>

                    </div>

                </div>

            </div>
        
        </div>

        <div class="col-lg-1">
            
            <div class="form-group">
                
                <label for="refEco">Ref. Eco</label>
            
                <input type="text" class="form-control" id="refEco" name="refEco">
            
            </div>
        
        </div>

        <div class="col-lg-2">
            
            <div class="form-group">
                
                <label for=""></label>

                <button type="submit" class="btn btn-block btn-primary btn-lg" name="nuevoAnimal">Cargar</button>
            
            </div>
        
        </div>

    </div>

</form>