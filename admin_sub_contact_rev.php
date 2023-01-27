    <div class="col col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Contacts list</h4>
                <div class="btn-group">
                    <?php 
                    $device_list = $pdo->query("SELECT * FROM devices");
                    $device_obj = $device_list->fetchAll();
                    ?>
                    <a href="?category=all" type="button"
                        class='btn <?php echo (($_GET["category"] == "all") || (empty($_GET["category"]))) ? "btn-dark" : "btn-light"; ?>'>All
                        contacts</a>
                    <?php
                    foreach ($device_obj as $device_ent) {
                    ?>
                    <a href="?category=<?php echo $device_ent->device_api_key; ?>"
                        class='btn <?php echo ($_GET["category"] == $device_ent->device_api_key) ? "btn-dark" : "btn-light"; ?>'><?php echo $device_ent->module_name; ?></a>
                    <?php 
                    }
                    ?>
                </div>

                <div style="align: right"><button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#exampleModal">Add new</button>

                    <!--  add new contact number Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <form action="submit_new_number.php" id="form_add_new_contact" method="POST">

                                        <h5 class="modal-title" id="exampleModalLabel">Add new contact numbers</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                </div>
                                <div class="modal-body">
                                    <label>Name</label>
                                    <input class="form-control" name="contact_name" id="add_contact_name"></input>

                                    <label>Email</label>
                                    <input required class="form-control" name="email" id="add_contact_email"></input>
                                    <label>Phone number</label>
                                    <input required class="form-control" name="phone_number"
                                        id="add_phone_number"></input>
                                    <label>Address</label>
                                    <select name="address_id" form="form_add_new_contact" id="add_address"
                                        class="selectpicker form-control" data-show-subtext="true"
                                        data-live-search="true">
                                        <?php
                                        $address_query = $pdo->query("SELECT DISTINCT address_table.address_id as `address_id`, address_table.barangay, address_table.municipality, address_table.municipality, address_table.province, evacuation.evac_id  FROM address_table INNER JOIN evacuation ON address_table.evacuation_id = evacuation.evac_id");
                                        $addresses = $address_query->fetchAll();
                                        foreach($addresses as $address){
                                            ?>
                                        <option value="<?php echo $address->address_id; ?>">
                                            <?php echo $address->barangay . ' ' . $address->municipality . ' ' . $address->province;?>
                                        </option>
                                        <?php
                                        }
                                        ?>
                                    </select>


                                    <br />
                                    <div id='result'></div>
                                    <br>
                                    <div id="reg_status_fields"></div>
                                    </form>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button id="save_changes_add" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                        <!-- end add new contact number of modal -->

                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="contacts_tbl" class="display min-w850">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                 
                    if($_GET['category'] == "all" || empty($_GET['category'])){
                        $sql = $pdo->query("SELECT DISTINCT contacts.id as contacts_id, contacts.*, address_table_tmp.address_id as address_id ,address_table_tmp.* FROM contacts JOIN (SELECT DISTINCT address_table.address_id, address_table.barangay, address_table.municipality, address_table.province,address_table.evacuation_id FROM address_table) as address_table_tmp ON contacts.address_id = address_table_tmp.address_id WHERE contacts.is_permitted = '1'");
                        $posts = $sql->fetchAll();
                    }else if($_GET['category'] != "all" && isset($_GET['category'])){
                        $device_api_key_tmp = $_GET['category'];
                        $sql = $pdo->query("SELECT DISTINCT contacts.id as contacts_id, contacts.*, address_table_tmp.address_id as address_id ,address_table_tmp.* FROM contacts JOIN (SELECT DISTINCT address_table.address_id, address_table.barangay, address_table.municipality, address_table.province,address_table.evacuation_id, address_table.device_covered_by FROM address_table) as address_table_tmp ON contacts.address_id = address_table_tmp.address_id WHERE contacts.is_permitted = '1' AND address_table_tmp.device_covered_by = '$device_api_key_tmp'");
                        $posts = $sql->fetchAll();
                    }
                   
                   foreach($posts as $post){
                      ?>
                            <tr>
                                <td><?php echo $post->contact_name ? $post->contact_name : ''; ?> </td>
                                <td><?php echo $post->phone_number ? $post->phone_number : ''; ?></td>
                                <td><?php echo $post->email ? $post->email: ''; ?></td>
                                <td>
                                    <?php echo $post->barangay ? $post->barangay : ''; ?> ,
                                    <?php echo $post->municipality ? $post->municipality : ''; ?> ,
                                    <?php echo $post->province ? $post->province : ''; ?>

                                </td>
                                <td>

                                    <button type="button" class="btn btn-danger btn-round btn-sm" data-toggle="modal"
                                        data-target="#deleteModal<?php echo $post->contacts_id?>">Delete</button>

                                    <button type="button" class="btn btn-info btn-round btn-sm" data-toggle="modal"
                                        data-target="#editModal<?php echo $post->contacts_id?>">Edit</button>

                                </td>

                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal<?php echo $post->contacts_id?>" tabindex="-1"
                                    aria-labelledby="deleteModal<?php echo $post->contacts_id?>Label"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <h4 class="text-center lead">Do you want to delete this contact named
                                                    <?php echo $post->contact_name?> ?</h4>
                                            </div>
                                            <div class="modal-footer">
                                                <a class="btn btn-danger btn-round btn-sm"
                                                    href="delete_contact_num.php?id=<?php echo $post->contacts_id?>">Yes</a>
                                                <button type="button" class="btn btn-sm btn-secondary"
                                                    data-dismiss="modal">No</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end of modal -->


                                <!-- modal start -->
                                <div class="modal fade" id="editModal<?php echo $post->contacts_id?>" tabindex="-1"
                                    aria-labelledby="editModal<?php echo $post->contacts_id?>" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="submit_edit_contacts.php"
                                                id="form_edit_contact<?php echo $post->contacts_id;?>" method="POST">
                                                <div class="modal-header">

                                                    <h5 class="modal-title "
                                                        id="editModal<?php echo $post->contacts_id?>">Edit contact
                                                        number</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                </div>
                                                <div class="modal-body">
                                                    <label>Name</label>
                                                    <input class="form-control" name="contact_name"
                                                        value="<?php echo $post->contact_name ? $post->contact_name: ''; ?>"></input>
                                                    <label>Email</label>
                                                    <input class="form-control" name="email"
                                                        id="email_id<?php echo $post->contacts_id; ?>"
                                                        value="<?php echo $post->email ? $post->email: ''; ?>"></input>
                                                    <label>Phone number</label>
                                                    <input class="form-control" name="phone_number"
                                                        value="<?php echo $post->phone_number ? $post->phone_number: ''; ?>"></input>
                                                    <label>Address</label>
                                                    <br />
                                                    <input type="hidden" name="contact_id"
                                                        value="<?php echo $post->contacts_id;?>">
                                                    <div id='result'></div>
                                                    <select name="address_id"
                                                        form="form_edit_contact<?php echo $post->contacts_id?>"
                                                        class="selectpicker form-control" data-show-subtext="true"
                                                        data-live-search="true">

                                                        <?php
                                $address_query = $pdo->query("SELECT DISTINCT address_table.address_id as `address_id`, address_table.barangay, address_table.municipality, address_table.municipality, address_table.province, evacuation.evac_id  FROM address_table INNER JOIN evacuation ON address_table.evacuation_id = evacuation.evac_id");
                                $addresses = $address_query->fetchAll();
                                $user_address_id = $post->address_id;

                                foreach($addresses as $address){
                                    if ($user_address_id == $address->address_id) {
                                        ?>
                                                        <option value="<?php echo $address->address_id; ?>" selected>
                                                            <?php echo $address->barangay . ' ' . $address->municipality . ' ' . $address->province;?>
                                                        </option>
                                                        <?php
                                    }else{
                                        ?>
                                                        <option value="<?php echo $address->address_id; ?>">
                                                            <?php echo $address->barangay . ' ' . $address->municipality . ' ' . $address->province;?>
                                                        </option>


                                                        <?php
                                    }
                                }
                                ?>
                                                    </select>


                                                    <br />
                                                    <div id='result'></div>
                                                    <br>
                                                    <div id="reg_status_fields_id<?php echo $post->contacts_id?>"></div>
                                            </form>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button class="btn btn-primary"
                                                onclick="validateEditId('email_id<?php echo $post->contacts_id; ?>', 'form_edit_contact<?php echo $post->contacts_id;?>', 'reg_status_fields_id<?php echo $post->contacts_id?>')">Save
                                                changes</button>

                                            <input hidden type="submit" class="btn btn-primary"
                                                form="form_edit_contact<?php echo $post->contacts_id?>"
                                                value="Save changes" name="">
                                        </div>
                                    </div>
                                </div>
                                <!-- modal end -->

                            </tr>
                            <?php 
 }
 ?>

                        </tbody>

                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
    </div>