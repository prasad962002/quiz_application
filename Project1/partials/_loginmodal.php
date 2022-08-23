<!--Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModal">Log In</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" action="partials/_loginhandle.php"  class="needs-validation" novalidate>
  <div class="form-group">
    <label for="loginemail">Email address</label>
    <input type="email" class="form-control" id="loginemail" name="loginemail" required>
    <div class="invalid-feedback">Please enter valid email address.</div>
    <span id="etext"></span>
  </div>

  <div class="form-group">
    <label for="loginpassword">Password</label>            
            <div class="input-group">
              <!-- <input type="password" class="form-control" id="loginpassword" name="loginpassword" required pattern="(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter and one special character, and at least 8 or more characters"> -->
              <input type="password" class="form-control" id="loginpassword" name="loginpassword" required >
              <div class="input-group-append">
                <span class="show-pass input-group-text" onclick="toggle(this)" role="button">
                  <i class="fa fa-eye" onclick="myFunction(this)"></i>
                </span>
              <div class="invalid-feedback">Please enter password.</div>
              </div>
            </div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Log in</button>
      </div>
      </form>
    </div>
  </div>
</div>