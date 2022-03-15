<div class="form-group sliders">

    <label for="<?php echo $flacas;?>InputId">
        
        <b>Flacas </b>

        <output name="<?php echo $flacas;?>Output" id="<?php echo $flacas;?>OutputId" style="display:inline-block"></output>

    </label>

    
    <div class="input-group">
    
        <div class="input-group-addon sliderIcon">

            <button type="button" class="btn-slider-minus">

                <i class="fa fa-minus"></i>

            </button>
        
        </div>
        
        <input type="range" class="redSlider" step="5" name="<?php echo $flacas;?>Input" id="<?php echo $flacas;?>InputId" value="230"  max="500" oninput="<?php echo $flacas;?>OutputId.value = <?php echo $flacas;?>InputId.value">

        <div class="input-group-addon sliderIcon">
    
            <button type="button" class="btn-slider-plus">

                <i class="fa fa-plus"></i>

            </button> 
                            
        </div>

    </div>
    
</div>

<div class="form-group sliders">

    <label for="<?php echo $buenas;?>InputId">
        
        <b>Buenas</b>

        <output name="<?php echo $buenas;?>Output" id="<?php echo $buenas;?>OutputId" style="display:inline-block"></output>

    </label>

    
    <div class="input-group">
    
        <div class="input-group-addon sliderIcon">

            <button type="button" class="btn-slider-minus">
                <i class="fa fa-minus"></i>
            </button>
        
        </div>
        
        <input type="range" class="ligth-greenSlider" step="5" name="<?php echo $buenas;?>Input" id="<?php echo $buenas;?>InputId" value="200"  max="500" oninput="<?php echo $buenas;?>OutputId.value = <?php echo $buenas;?>InputId.value">

        <div class="input-group-addon sliderIcon">
    
            <button type="button" class="btn-slider-plus">
                <i class="fa fa-plus"></i>
            </button> 
                            
        </div>

    </div>
    
</div>

<div class="form-group sliders">

    <label for="<?php echo $buenasPlus;?>InputId">
        
        <b>Buenas <i class="fa fa-plus-circle"></i> </b>

        <output name="<?php echo $buenasPlus;?>Output" id="<?php echo $buenasPlus;?>OutputId" style="display:inline-block"></output>

    </label>

    
    <div class="input-group">
    
        <div class="input-group-addon sliderIcon">

            <button type="button" class="btn-slider-minus">
                <i class="fa fa-minus"></i>
            </button>
    
        </div>
        
        <input type="range" class="greenSlider" step="5" name="<?php echo $buenasPlus;?>Input" id="<?php echo $buenasPlus;?>InputId" value="175"  max="500" oninput="<?php echo $buenasPlus;?>OutputId.value = <?php echo $buenasPlus;?>InputId.value">

        <div class="input-group-addon sliderIcon">
    
            <button type="button" class="btn-slider-plus">
                <i class="fa fa-plus"></i>
            </button> 
                    
        </div>
        
    </div>
    
</div>

<div class="form-group sliders">

    <label for="<?php echo $muyBuenas;?>InputId">
        
        <b>Muy Buenas</b>

        <output name="<?php echo $muyBuenas;?>Output" id="<?php echo $muyBuenas;?>OutputId" style="display:inline-block"></output>

    </label>

    
    <div class="input-group">
    
        <div class="input-group-addon sliderIcon">

            <button type="button" class="btn-slider-minus">
                <i class="fa fa-minus"></i>
            </button>
        
        </div>
        
        <input type="range" class="greenSlider" step="5" name="<?php echo $muyBuenas;?>Input" id="<?php echo $muyBuenas;?>InputId" value="125"  max="500" oninput="<?php echo $muyBuenas;?>OutputId.value = <?php echo $muyBuenas;?>InputId.value">

        <div class="input-group-addon sliderIcon">
    
            <button type="button" class="btn-slider-plus">
                <i class="fa fa-plus"></i>
            </button> 
                    
        </div>
    
    </div>
    
</div>

<div class="form-group sliders">

    <label for="<?php echo $apenasGordas;?>InputId">
        
        <b>Apenas Gordas</b>

        <output name="<?php echo $apenasGordas;?>Iutput" id="<?php echo $apenasGordas;?>IutputId" style="display:inline-block"></output>

    </label>

    
    <div class="input-group">
    
        <div class="input-group-addon sliderIcon">

            <button type="button" class="btn-slider-minus">
                <i class="fa fa-minus"></i>
            </button>
    
        </div>
        
        <input type="range" class="yellowSlider" step="5" name="<?php echo $apenasGordas;?>Input" id="<?php echo $apenasGordas;?>InputId" value="110"  max="500" oninput="<?php echo $apenasGordas;?>IutputId.value = <?php echo $apenasGordas;?>InputId.value">

        <div class="input-group-addon sliderIcon">
    
            <button type="button" class="btn-slider-plus">
                <i class="fa fa-plus"></i>
            </button> 
                    
        </div>
        
    </div>
    
</div>  

