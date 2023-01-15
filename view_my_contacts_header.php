    <div class="col col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Contacts list</h4>
                <div style="align: right"><button type="button" class="btn btn-primary"
                    data-toggle="modal" data-target="#exampleModal">Add new</button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <form action="submit_new_number.php" id="form_add_new_contact" method="POST">
                                <h5 class="modal-title" id="exampleModalLabel">Add new contact number</h5>
                                <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span></div>
                                <div class="modal-body">
                                    <label>Name</label>
                                    <input class="form-control" name="contact_name" ></input>
                                    <label>Email</label>
                                    <input class="form-control" name="email" ></input>                    
                                    <label>Phone number</label>
                                    <input class="form-control" name="phone_number" ></input>
                                    <label>Address</label>
                                    <select name="address_id" form="form_add_new_contact" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                                        <?php
                                        $address_query = $pdo->query("SELECT address_table.id AS `address_id`, address_table.*, evacuation.* FROM address_table INNER JOIN evacuation ON address_table.evacuation_id = evacuation.id");
                                        $addresses = $address_query->fetchAll();
                                        foreach($addresses as $address){
                                            ?>
                                            <option value="<?php echo $address->address_id; ?>"data-subtext="<?php echo $address->evacuation_center_name; ?>"><?php echo $address->barangay . ' ' . $address->municipality . ' ' . $address->province;?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>


                                    <br/>
                                    <div id='result'></div>

                                </form>

                            </div>
                            <div class="modal-footer">
                               <button type="button" class="btn btn-secondary"
                               data-dismiss="modal">Close</button>
                               <input type="submit" class="btn btn-primary" form="form_add_new_contact" value="Save changes" name="">
                           </div>
                       </div>
                   </div>
                   <!-- end of modal -->

               </div>
           </div>
       </div>
       <div class="card-body">
