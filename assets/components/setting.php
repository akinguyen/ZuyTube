<div id="signUpForm">
    <input class="unameValue" type="hidden" value='<?=isset($_SESSION["email"]) ? $user->getUserName() : ""?>'>
    <input class="currentEmail" type="hidden" value=<?=isset($_SESSION["email"]) ? $_SESSION["email"] : ""?>>
    <h2 class="mb-4">Edit User Account</h2>
  <form method="POST">
      <input type="hidden" name="editSuccess" value="1">
      <input type="text" placeholder="First Name" name="fname" value='<?=isset($_SESSION["email"]) ? $user->getFirstName() : ""?>' required>
      <label for="fname" class="errorMessage"></label>

      <input type="text" placeholder="Last Name" name="lname"  value="<?=isset($_SESSION["email"]) ? $user->getLastName() : ""?>" required>
      <label for="lname" class="errorMessage"></label>

      <input type="email" placeholder="Email" name="email"  value="<?=isset($_SESSION["email"]) ? $user->getEmail() : ""?>" required>
      <label for="email" class="errorMessage"></label>

      <input type="text" placeholder="Username" name="uname"  value='<?=isset($_SESSION["email"]) ? $user->getUserName() : ""?>' required>
      <label for="uname" class="errorMessage"></label>

      <input type="password" placeholder="Password" name="pwd" value="" required>
      <label for="pwd" class="errorMessage"></label>

      <button class="btn btn-primary userFormButtonForProfile" type="submit">Edit</button>
  </form>
</div>
<script src="../js/settingFunction.js"></script>