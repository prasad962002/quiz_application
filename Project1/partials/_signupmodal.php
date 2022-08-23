<!-- Signup Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModal"><b>Sign Up</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="partials/_signuphandle.php" class="needs-validation m-3" novalidate>
          <div class="form-group row">
            <div class="col-md-6">
              <label for="signupemail">First Name</label>
              <input type="text" class="form-control" id="signupemail" name="firstname" required>
              <div class="valid-feedback">
                Looks good!
              </div>
            </div>
            <div class="col-md-6">
              <label for="signupemail">Last Name</label>
              <input type="text" class="form-control" id="signupemail" name="lastname" required>
              <div class="valid-feedback">
                Looks good!
              </div>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-3">Gender :</div>
            <div class="form-group col-md-2 custom-control custom-radio custom-control-inline">
              <input type="radio" id="customRadioInline1" value="male" name="gender" class="custom-control-input" required>
              <label class="custom-control-label" for="customRadioInline1">Male</label>
            </div>
            <div class="custom-control col-md-2 form-group custom-radio custom-control-inline">
              <input type="radio" id="customRadioInline2" value="female" name="gender" class="custom-control-input" required>
              <label class="custom-control-label" for="customRadioInline2">Female</label>
              <div class="invalid-feedback col">Please select gender.</div>
            </div>
          </div>

          <div class="form-group">
            <label for="signupemail">Email address</label>
            <input type="email" class="form-control" id="signupemail" name="signupemail" aria-describedby="emailHelp" required>
            <div class="invalid-feedback">Please enter valid email address.</div>
          </div>
          
          <div class="form-group">
            <label for="signuppassword">Password</label>
            <div class="input-group">
              <input type="password" class="form-control" id="password" name="signuppassword" min="6" required pattern="(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter and one special character, and at least 8 or more characters">
              <div class="input-group-append">
                <span class="show-pass input-group-text" onclick="toggle(this)" role="button">
                  <i class="fa fa-eye" onclick="myFunction(this)"></i>
                </span>
                <div class="invalid-feedback">Please enter valid password.</div>
              </div>
            </div>
          </div>
          <ul class="list-unstyled" style="display: none; transition: 2s" id="passins" >
                        <li>
                            <span class="low-upper-case">
                                <i class="fa fa-circle" aria-hidden="true"></i>
                                Lowercase &amp; Uppercase
                            </span>
                        </li>
                        <li>
                            <span class="one-number">
                                <i class="fa fa-circle" aria-hidden="true"></i>
                                Number (0-9)
                            </span>
                        </li>
                        <li>
                            <span class="one-special-char">
                                <i class="fa fa-circle" aria-hidden="true"></i>
                                Special Character (!@#$^*)
                            </span>
                        </li>
                        <li>
                            <span class="eight-character">
                                <i class="fa fa-circle" aria-hidden="true"></i>
                                Atleast 8 characters
                            </span>
                        </li>
                    </ul>


            <div class="form-group">
            <label for="csignuppassword">Confirm Password</label>            
            <div class="input-group">
            <input type="password" class="form-control" id="csignuppassword" name="csignuppassword" min="6" required>  
              <div class="input-group-append">
                <span class="show-pass input-group-text" onclick="toggle(this)" role="button">
                  <i class="fa fa-eye" onclick="myFunction(this)"></i>
                </span>
                <div class="invalid-feedback">Please enter valid password.</div>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>