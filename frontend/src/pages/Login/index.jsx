import React from 'react'

export default function LoginPage() {
  return (
    <div class="container" id="container">
      <div class="form-container sign-up-container">
        <form>
          <h1>Create Account</h1>
          <input id='suUsername' type="text" name="username" placeholder="Username" />
          <input id='suPassword' type="password" name="password" placeholder="Password" />
          <input id='suEmail' type="email" name="email" placeholder="Email" />
          <input id='suFirstname' type="text" name="fname" placeholder="First Name" />
          <input id='suLastname' type="text" name="lname" placeholder="Last Name" />
          <input id='suContact' type="tel" name="contact" placeholder="Contact No."
            pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" />
          <button type='button' id="signup">Sign Up</button>
        </form>
      </div>
      
      <div class="form-container sign-in-container">
        <form method='get' action='/api/login'>
          <h1>Sign in</h1>
          <input id='siUsername' type="text" name="username" placeholder="Username" />
          <input id='siPassword' type="password" name="password" placeholder="Password" />
          <a href="#">Forgot your password?</a>
          <button type='submit' id="signin">Sign In</button>
        </form>
      </div>
      <div class="overlay-container">
        <div class="overlay">
          <div class="overlay-panel overlay-left">
            <h1>Welcome Back!</h1>
            <p>
              To keep connected with us please login with your personal info
            </p>
            <button class="ghost" id="signIn">Sign In</button>
          </div>
          <div class="overlay-panel overlay-right">
            <h1>Hello, Friend!</h1>
            <p>Enter your personal details and start journey with us</p>
            <button class="ghost" id="signUp">Sign Up</button>
          </div>
        </div>
      </div>
    </div>
  )
}
