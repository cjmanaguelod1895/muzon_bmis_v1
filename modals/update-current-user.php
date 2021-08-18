<div id="updateCurrentUser_<?php echo $row['acc_ID']; ?>" class="modal modal-fixed-footer">
<div class="modal-content modal-lg">
    <h4>Update User</h4>
      <!-- Form with validation -->
      <div class="col s12 m12 l12">
            <div class="card-content">
                <!-- <h4 class="card-title">Inline form</h4> -->
                <form>

                <div class="row">
                        <div class="input-field col m6 s12">
                            <label for="username" class="active">Barangay Official Name </label>
                            <div class="input-field">
                                <select class="error" name="official_ID" data-error=".errorTxt1">
 
                  

                                </select>
                                <small class="errorTxt1"></small>
                            </div>
                        </div>
                        <div class="input-field col m6 s12">
                            <label for="position" class="active">Position </label>
                            <div class="input-field">
                                <select class="error" name="position" data-error=".errorTxt2">

                                <option value="<?php echo $row['position_ID'] ?>"><?php echo $row['position_Name'];?></option>
            <?php
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
                                <select class="error" name="commitee" data-error=".errorTxt3">

                                <?php
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
                            <input placeholder = "Username"  value="<?php echo $row['acc_ID']; ?>" name="editUsername" type="text" class="validate" data-error=".errorTxt4" required>
                            <label for="username" class="active">Username</label>
                            <small class="errorTxt4"></small>
                        </div>
                        <div class="input-field col m4 s12">
                            <input placeholder = "Password" value="<?php echo $row['password']; ?>" name="editPassword" type="password" data-error=".errorTxt5" >
                            <label for="password">Password</label>
                            <small class="errorTxt5"></small>
                        </div>
                        <div class="input-field col m4 s12">
                            <input placeholder="Confirm Password" value="<?php echo $row['password']; ?>" name="editconfPassword" type="password" class="validate" data-error=".errorTxt6">
                            <label for="conpassword">Confirm Password</label>
                            <small class="errorTxt6"></small>
                        </div>
                    </div>
            </div>
 
    </div>
</div>
<div class="modal-footer">
<!-- <div class="loader" style="display:block;margin-left: 188px;"></div> -->
<button type="submit" name="submit" class="mb-6 btn waves-effect waves-light gradient-45deg-light-blue-cyan" >
<i class="material-icons right">save</i>
Save</button>
</form>
    <button type="submit"  onClick="closeModal()" class="mb-6 btn waves-effect waves-light gradient-45deg-red-pink" >
<i class="material-icons right">cancel</i>
Cancel</button>
    </button>
</div>

</div>

