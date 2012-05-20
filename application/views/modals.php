<div id="registerModal" class="modal hide fade in">
  <div class="modal-header">
    <button class="close" data-dismiss="modal">×</button>
    <h3>Create a New Account</h3>
  </div>
  <div class="modal-body">
    <form id="registerForm" class="form-horizontal" action="<?=base_url()?>register" method="post" onsubmit="return false;">
      <fieldset>
        <div class="control-group">
          <label class="control-label" for="registerName">Name</label>
          <div class="controls">
            <input type="text" class="input-xlarge" id="registerName" name="name">
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="registerName">Email</label>
          <div class="controls">
            <input type="text" class="input-xlarge" id="registerEmail" name="email">
            <p class="help-block">We'll never share your email with anyone</p>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="registerName">Password</label>
          <div class="controls">
            <input type="password" class="input-xlarge" id="registerPassword" name="password">
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="registerName">Confirm Password</label>
          <div class="controls">
            <input type="password" class="input-xlarge" id="registerPasswordConfirmation" name="passwordConfirmation">
            <p class="help-block">Password must be at least 8 characters</p>
          </div>
        </div>
        <div class="control-group">
          <button type="submit" class="btn btn-primary pull-right registerSubmit">Register</button>
        </div>
        <div id="registerAlert" class="alert alert-error" style="margin:10px 40px; display:none;"></div>
      </fieldset>
    </form>
  </div>
</div>
