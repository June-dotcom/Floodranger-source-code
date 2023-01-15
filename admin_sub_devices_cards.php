    
<?php
$device_list = $pdo->query("SELECT * FROM devices");
$device_obj = $device_list->fetchAll();
foreach($device_obj as $device_ent){
    ?>

    <div class="col col-lg-4 col-md-6 col-12">
        <div class="card">
          <div class="card-body">
            <div class="p-4 text-center">
                <?php 
                if ($device_ent->module_type == 'floodMon') {
                    ?>
                    <img src="icons\floodMon.svg" width="100" height="100">
                    <?php
                }
                ?>

                <?php 
                if ($device_ent->module_type == 'weatherMon') {
                    ?>
                    <img src="icons\weatherMon.svg" width="100" height="100">
                    <?php
                }
                ?>

                <?php 
                if ($device_ent->module_type == 'simMod') {
                    ?>
                    <img src="icons\simMod.svg" width="100" height="100">
                    <?php
                }
                ?>

            </div>  
            <h4 class="text-center"><span style="text-align: center !important;"><?php echo $device_ent->module_name; ?></span></h4>
            <p class="text-center">
                <span id="device_state<?php echo $device_ent->device_api_key; ?>" >
                Loading...</span>
                <br>
                <span style="text-align: center !important;"><?php echo $device_ent->module_location; ?></span>
            </p>
            <p class="text-center lead">
                <span style="text-align: center !important;"><?php echo $device_ent->module_description; ?></span>
            </p>
        </div>
    </div>
</div>


<?php
}
?>