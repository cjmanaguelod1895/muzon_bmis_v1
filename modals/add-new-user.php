<div id="addNewUser" class="modal modal-fixed-footer">
<div class="modal-content modal-lg">
    <h4>Add New User</h4>
      <!-- Form with validation -->
      <div class="col s12 m12 l12">
            <div class="card-content">
                <!-- <h4 class="card-title">Inline form</h4> -->
                <form id="addNewUserForm">
                <div class="row">
                        <div class="input-field col m6 s12">
                            <label for="username" class="active">Barangay Official Name </label>
                            <div class="input-field">
                                <select class="error" id="official_ID" name="official_ID" data-error=".errorTxt1">

                                <?php
                                require_once('./database/db_config.php');
            $rp=mysqli_query($conn,"SELECT * FROM `brgy_official_detail` bod 
INNER JOIN resident_detail rd ON rd.res_ID = bod.res_ID
LEFT JOIN ref_suffixname rs ON rs.suffix_ID = rd.suffix_ID
LEFT JOIN ref_position rp ON rp.position_ID = bod.commitee_assignID
WHERE  visibility = 1");
            while ($row=mysqli_fetch_array($rp))
            {
               $suffix = $row['suffix'];
            if ($suffix == "N/A") {
              $suffix = "";
            }
            else{
               $suffix = $row['suffix'];
            }
              ?><option value="<?php echo  $row['res_ID']?>"><?php echo $row[8]." ".$row[9]." ".$row[10]." ".$suffix;?></option>
            <?php
            }
            ?>


                                </select>
                                <small class="errorTxt1"></small>
                            </div>
                        </div>
                        <div class="input-field col m6 s12">
                            <label for="position" class="active">Position </label>
                            <div class="input-field">
                                <select class="error" id="mySelect" name="position" data-error=".errorTxt2">

                                
            <?php
             require_once('./database/db_config.php');
            $rp=mysqli_query($conn,"SELECT * FROM ref_position WHERE position_ID != 1 AND position_Name NOT LIKE 'Barangay Official in %'");
            while ($row=mysqli_fetch_array($rp))
            {
              ?><option value="<?php echo $row[0] ?>"><?php echo $row[1];?></option>
            <?php
            }
            ?>
                                </select>
                                <small class="errorTxt2"></small>
                            </div>
                        </div>

        </div>
        <br>
                    <div class="row" id="official">
                    <div class="input-field col m12 s12">
                            <label for="commitee" class="active">Committee </label>
                            <div class="input-field">
                                <select class="error" id="commitee" name="commitee" data-error=".errorTxt3">

                                <?php
                                 require_once('./database/db_config.php');
            $rp=mysqli_query($conn,"SELECT * FROM ref_position WHERE position_ID != 1 AND position_Name LIKE 'Barangay Official in %'");
            while ($row=mysqli_fetch_array($rp))
            {
              ?><option value="<?php echo $row[0] ?>"><?php echo $row[1];?></option>
            <?php
            }
            ?>
                                </select>
                                <small class="errorTxt3"></small>
                            </div>
                        </div>
                    
                    </div>
                    <br><br>

                    <div class="row">
                        <div class="input-field col m4 s12">
                            <input placeholder = "Username" id="username" name="username" type="text" class="validate" data-error=".errorTxt4" required>
                            <label for="username" class="active">Username</label>
                            <small class="errorTxt4"></small>
                        </div>
                        <div class="input-field col m4 s12">
                            <input placeholder = "Password" id="password" name="password" type="password" data-error=".errorTxt5" >
                            <label for="password">Password</label>
                            <small class="errorTxt5"></small>
                        </div>
                        <div class="input-field col m4 s12">
                            <input placeholder="Confirm Password" id="conpassword" name="conpassword" type="password" class="validate" data-error=".errorTxt6">
                            <label for="conpassword">Confirm Password</label>
                            <small class="errorTxt6"></small>
                        </div>
                    </div>
            </div>
 
    </div>
</div>
<div class="modal-footer">
<!-- <div class="loader" style="display:block;margin-left: 188px;"></div> -->
<button type="submit" name="submit" id="addNewUserButton" class="mb-6 btn waves-effect waves-light gradient-45deg-light-blue-cyan" >
<i class="material-icons right">save</i>
Save</button>
</form>
    <button type="submit" id="canelButton" class="mb-6 btn waves-effect waves-light gradient-45deg-red-pink" >
<i class="material-icons right">cancel</i>
Cancel</button>
    </button>
</div>

</div>

