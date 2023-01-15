    <div class="col col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Devices list</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display min-w850">
                        <thead>
                            <tr>
                                <th>Device name</th>
                                <th>Device type</th>
                                <th>Device Location</th>
                                <th>Device status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $device_list = $pdo->query("SELECT * FROM devices");
                            $device_obj = $device_list->fetchAll();
                            foreach($device_obj as $device_ent){
                                ?>
                                <tr>
                                    <td><?php echo $device_ent->module_name; ?></td>
                                    <td><?php echo $device_ent->module_description; ?></td>
                                    <td><?php echo $device_ent->module_location; ?></td>
                                    <td><span id="device_state<?php echo $device_ent->id; ?>"></span></td>
                                </tr>
                                <?php
                            }
                            ?>

                        </tbody>

                        <tfoot>
                            <tr>
                              <th>Device name</th>
                              <th>Device type</th>
                              <th>Device Location</th>
                              <th>Device activity</th>
                          </tr>
                      </tfoot>
                  </table>
              </div>

          </div>
      </div>
  </div>


