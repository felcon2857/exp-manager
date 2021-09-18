<template>
  <div class="">
    <div class="container">
      <div class="d-flex justify-content-center align-items-center min-vh-90">
        <div class="card-login shadow-sm">
          <div class="px-2 d-flex align-items-center justify-content-between">
            <div class="text-section">
              <h2 class="d-flex align-items-center">
                <div class="icon-container">
                  <i class="bx bx-lock-open"></i>
                </div>
                Login
              </h2>
              <div class="app-title">Expense Manager</div>
            </div>
            <div class="image-section">
              <img :src="'/images/logo_72_px.png'" />
            </div>
          </div>
          <hr />
          <div
            class="
              my-3
              form-input-group
              d-flex
              align-content-center align-items-center
            "
          >
            <i class="bx bx-user"></i>
            <input
              type="email"
              placeholder="Given email address..."
              class="form-control"
            />
          </div>

          <div
            class="
              my-3
              form-input-group
              d-flex
              align-content-center align-items-center
            "
          >
            <i class="bx bx-lock"></i>
            <input
              type="password"
              placeholder="Password..."
              class="form-control"
            />
          </div>
          <button class="btn btn-theme w-100">Login</button>
          <div class="copyright text-center my-3">
            &copy; Expense Manager App 2021
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  mounted() {
    document.title = "Expense Manager | Login";
  },
};
</script>