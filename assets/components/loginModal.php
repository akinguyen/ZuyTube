<script src='<?=strpos($_SERVER['REQUEST_URI'], 'index.php') > 0 || strlen($_SERVER["REQUEST_URI"]) === 11 ? "assets/js/loginFunction.js" : "../js/loginFunction.js"?>'></script>

<div id="loginForm" class="modal">
  <form method="POST" class="modal-content animate" action=<?=strpos($_SERVER['REQUEST_URI'], 'index.php') > 0 || strlen($_SERVER["REQUEST_URI"]) === 11 ? "" : "../../index.php"?>>
    <div class="imgcontainer">
      <span onclick="document.getElementById('loginForm').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>

    <div class="container">
      <input name="login" type="hidden" value="1">
      <input type="email" placeholder="Email" name="email" required>
      <label for="email" class="errorMessage"></label>

      <input type="password" placeholder="Password" name="pwd" required>
      <label for="pwd" class="errorMessage"></label>

      <button class="btn btn-primary userFormButton" type="submit">Login</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button class="btn btn-danger cancelbtn" type="button" onclick="document.getElementById('loginForm').style.display='none'">Cancel</button>
      <span class="psw">Haven't signed up yet? <a style="color: #428bca; cursor: pointer" id="signupLink">Sign Up</a></span>
    </div>
  </form>
</div>

<div id="signUpForm" class="modal">
  <form method="POST" class="modal-content animate" action=<?=strpos($_SERVER['REQUEST_URI'], 'index.php') > 0 || strlen($_SERVER["REQUEST_URI"]) === 11 ? "" : "../../index.php"?>>
    <div class="imgcontainer">
      <span onclick="document.getElementById('signUpForm').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>

    <div class="container">
     <input name="login" type="hidden" value="1">
      <input type="text" placeholder="First Name" name="fname" required>
      <label for="fname" class="errorMessage"></label>

      <input type="text" placeholder="Last Name" name="lname" required>
      <label for="lname" class="errorMessage"></label>

      <input type="email" placeholder="Email" name="email" required>
      <label for="email" class="errorMessage"></label>

      <input type="text" placeholder="Username" name="uname" required>
      <label for="uname" class="errorMessage"></label>

      <input type="password" placeholder="Password" name="pwd" required>
      <label for="pwd" class="errorMessage"></label>

      <button class="btn btn-primary userFormButton" type="submit">Sign Up</button>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button class="btn btn-danger cancelbtn" type="button" onclick="document.getElementById('signUpForm').style.display='none'">Cancel</button>
      <span class="psw loginLink">Already have an account? <a style="color: #428bca; cursor: pointer">Login</a></span>
    </div>
  </form>
</div>
