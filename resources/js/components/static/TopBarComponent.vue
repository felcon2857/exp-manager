<template>
  <div class="top-nav">
    <nav class="navbar navbar-light">
      <div class="container-fluid">
        <div class="flex-container">
          <div class="icon-bar-btn">
            <div id="sidebarToggle" class="burger-menu">
              <i class="bx bx-menu"></i>
            </div>
          </div>
          <div class="app-title d-flex align-items-center">
            <img :src="'./images/logo_36_px.png'" alt="logo_36_px" />
            <div>Expense Manager</div>
          </div>
          <label for="dropdown-settings" class="user-profile-settings">
            <input
              type="checkbox"
              id="dropdown-settings"
              class="checkbox-drp"
            />
            <div class="d-flex align-items-center">
              <img :src="'./images/profile-placeholder.png'" alt="logo_36_px" />
              <div class="user-profile-name">John Doe Mae</div>
              <i class="bx bx-chevron-down"></i>
            </div>
            <div class="card-settings">
              <a href="http://" class="d-flex align-items-center">
                <i class="bx bx-cog"></i>
                &nbsp;Profile Settings
              </a>
              <a href="http://" class="d-flex align-items-center">
                <i class="bx bx-log-out"></i>
                &nbsp;Logout
              </a>
            </div>
          </label>
        </div>
      </div>
    </nav>
  </div>
</template>
<script>
</script>