<div id="add-barangay" class="modal modal-fixed-footer">
<div class="modal-content modal-lg">
    <h4>Add New Barangay Official</h4>
      <!-- Form with validation -->
      <div class="col s12 m12 l12">
            <div class="card-content">
                <!-- <h4 class="card-title">Inline form</h4> -->
                <form id="addNewBarangayOfficial">
                    <div class="row">
                        <div class="input-field col m4 s6">
                            <input placeholder = "First Name" id="firstName" name="firstName" type="text" class="validate" data-error=".errorTxt1">
                            <label for="firstName" class="active">First Name</label>
                            <small class="errorTxt1"></small>
                        </div>
                        <div class="input-field col m4 s6">
                            <input placeholder = "Middle Name" id="middleName" name="middleName" type="text">
                            <label for="middleName">Middle Name</label>
                        </div>
                        <div class="input-field col m4 s6">
                            <input placeholder="Last Name" id="lastName" name="lastName" type="text" class="validate" data-error=".errorTxt3">
                            <label for="lastName">Last Name</label>
                            <small class="errorTxt3"></small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col m12 s12">
                            <label for="sPosition" class="active">Position </label>
                            <div class="input-field">
                                <select class="error" id="sPosition" name="sPosition" data-error=".errorTxt4" required>
                                    <option value="">Choose Position</option>
                                    <option value="Captain">Barangay Captain</option>
                                    <option value="Kagawad(Ordinance)">Barangay Kagawad(Ordinance)</option>
                                    <option value="Kagawad(Public Safety)">Barangay Kagawad(Public Safety)</option>
                                    <option value="Kagawad(Tourism)">Barangay Kagawad(Tourism)</option>
                                    <option value="Kagawad(Budget & Finance)">Barangay Kagawad(Budget & Finance)</option>
                                    <option value="Kagawad(Agriculture)">Barangay Kagawad(Agriculture)</option>
                                    <option value="Kagawad(Education)">Barangay Kagawad(Education)</option>
                                    <option value="Kagawad(Infrastracture)">Barangay Kagawad(Infrastracture)</option>
                                    <option value="SK Chairman">SK Chairman</option>
                                    <option value="Secretary">Barangay Secretary</option>
                                    <option value="Treasurer">Barangay Treasurer</option>
                                </select>
                                <small class="errorTxt4"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="input-field col m6 s12">
                        <input id="pcontact" type="text"  name="pcontact" data-error=".errorTxt5" placeholder="XXXXXXXXXXX">
                        <label for="pcontact" id="phoneNumberLabel"  class="active">Contact Number</label>
                        <small class="errorTxt5"></small>
                        </div>

                        <div class="input-field col m6 s12">
                            <label for="paddress" class="">Address</label>
                            <input id="paddress" name="paddress" type="text" data-error=".errorTxt6">
                            <small class="errorTxt6"></small>
                        </div>
                    </div>
                    <div class="row">
                    <div class="input-field col m6 s12">
                    <div class="input-field">
                        <input id="termStart" name="termStart" type="text" class="birthdate-picker datepicker" data-error=".errorTxt7">
                        <label for="termStart">Start Term</label>
                        <small class="errorTxt7"></small>
                    </div>
                    </div>
                    <div class="input-field col m6 s12">
                    <div class="input-field">
                        <input id="termEnd" name="termEnd" type="text" class="birthdate-picker datepicker" data-error=".errorTxt8">
                        <label for="termEnd">Start Term</label>
                        <small class="errorTxt8"></small>
                    </div>
                    </div>
                    </div>
            </div>
 
    </div>
</div>
<div class="modal-footer">
<button type="submit" name="submit" id="addNewBarangayOfficialButton" class="mb-6 btn waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow" >Submit</button>
    </button>
</div>
</form>
</div>

