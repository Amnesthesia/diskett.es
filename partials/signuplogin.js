<script id="signuplogin-template" type="text/x-handlebars-template">
<div id="container">
    <!-- hidden anchor to stop jump  -->
      <a class="hiddenanchor" id="toregister"></a>
      <a class="hiddenanchor" id="tologin"></a>
        <div id="wrapper">
          <div id="login" class="animate form">
            <form action="#" method="post" autocomplete="on"> 
              <h1>Log in</h1> 
              <p> 
              <label for="email" class="uname" data-icon="u" > Your email address </label>
              <input id="email" name="email" required="required" type="email" placeholder="mymail@mail.com"/>
              </p>
              <p> 
              <label for="password" class="youpasswd" data-icon="p"> Your password </label>
              <input id="password" name="password" required="required" type="password" placeholder="eg. X8df!90EO" /> 
              </p>
              <p class="keeplogin"> 
              <input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" /> 
              <label for="loginkeeping">Keep me logged in</label>
              </p>
              <input type="submit" name="login" value="Login">
              <p class="change_link">
              Not a member yet ?
              <a href="#toregister" class="to_register">Join us</a>
              </p>
            </form>
          </div>

        <div id="register" class="animate form">
          <form action="#" method="post" autocomplete="on"> 
            <h1> Sign up </h1> 
            <p> 
            <label for="emailsignup" class="youmail" data-icon="e" > Your email</label>
            <input id="emailsignup" name="emailsignup" required="required" type="email" placeholder="mysupermail@mail.com"/> 
            </p>
            <p> 
            <label for="passwordsignup" class="youpasswd" data-icon="p">Your password </label>
            <input id="passwordsignup" name="passwordsignup" required="required" type="password" placeholder="eg. X8df!90EO"/>
            </p>
            <p> 
            <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Please confirm your password </label>
            <input id="passwordsignup_confirm" name="passwordsignup_confirm" required="required" type="password" placeholder="eg. X8df!90EO"/>
            </p>
            <input type="submit" name="register" value="Register account">
            <p class="change_link">  
            Already a member ?
            <a href="#tologin" class="to_register"> Go and log in </a>
            </p>
          </form>
        </div>
    </div>
    </div>
    </script>