<template>
  <div class="login-page">
    <!-- Left Blue Section -->
    <div class="left-section">
      <h1 style="margin-right: 15px;">VUESTIC</h1>
      <p style="margin-top: 2px;">ADMIN</p>
    </div>

    <!-- Right White Section -->
    <div class="right-section">
      <div class="login-container">
        <h2>Log in</h2>
        <p>
          New to Vuestic? <a href="#">Sign up</a>
        </p>
        <form @submit.prevent="login">
          <div class="form-group">
            <label for="email">EMAIL</label>
            <input
              type="email"
              id="email"
              v-model="email"
              placeholder="Enter your email"
              required
            />
          </div>
          <div class="form-group">
            <label for="password">PASSWORD</label>
            <div class="password-container">
              <input
                type="password"
                id="password"
                v-model="password"
                placeholder="Enter your password"
                required
              />
              <button type="button" @click="togglePasswordVisibility">
                <span v-if="showPassword">👁️</span>
                <span v-else>🙈</span>
              </button>
            </div>
          </div>
          <div class="form-footer">
            <label>
              <input type="checkbox" v-model="rememberMe" />
              Keep me signed in on this device
            </label>
            <a href="#">Forgot password?</a>
          </div>
          <button type="submit" class="btn">Login</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: "",
      password: "",
      rememberMe: false,
      showPassword: false,
    };
  },
  methods: {
    togglePasswordVisibility() {
      this.showPassword = !this.showPassword;
      const passwordInput = document.getElementById("password");
      passwordInput.type = this.showPassword ? "text" : "password";
    },
    login() {
      if (this.email && this.password) {
        console.log("Email:", this.email);
        console.log("Password:", this.password);
        console.log("Remember Me:", this.rememberMe);

        // Redirect to Dashboard
        this.$router.push("/Dashboard");
      } else {
        alert("Please fill in all fields.");
      }
    },
  },
};
</script>

<style scoped>
.login-page {
  display: flex;
  height: 97.5vh;
  font-family: 'Inter', sans-serif;
  
}

/* Left Section */
.left-section {
  background-color: #0033a0;
  color: white;
  flex: 0.5;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
  
}

.left-section h1 {
  font-size: 2.5rem;
}

.left-section span {
  font-weight: lighter;
}

/* Right Section */
.right-section {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
}

.login-container {
  width: 70%;
  max-width: 400px;
  text-align: center;
}

.login-container h2 {
  margin-bottom: 10px;
}

.login-container p {
  color: gray;
  margin-bottom: 20px;
}

.login-container a {
  color: #0033a0;
  text-decoration: none;
}

.form-group {
  margin-bottom: 15px;
  text-align: left;
}

.form-group label {
  display: block;
  font-size: 0.9rem;
  margin-bottom: 5px;
}

.form-group input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.password-container {
  display: flex;
  align-items: center;
}

.password-container button {
  background: none;
  border: none;
  cursor: pointer;
  margin-left: 10px;
}

.form-footer {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
  font-size: 0.8rem;
}

.btn {
  width: 100%;
  padding: 10px;
  background-color: #0033a0;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.btn:hover {
  background-color: #002580;
}
</style>