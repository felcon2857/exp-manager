<template>
  <div class="sidebar" id="sidebar-id">
    <div class="user-info">
      <img :src="'/images/profile-placeholder.png'" alt="profile-img" />
      <div class="user-info-name">
        John Deo Mae
        <small>User</small>
      </div>
    </div>
    <div class="navigation-link">
      <ul>
        <li>
          <a href="/dashboard">
            <i class="bx bx-tachometer"></i>
            Dashboard
          </a>
        </li>
      </ul>
      <ul>
        <div class="link-title">Users Management</div>
        <li>
          <a href="user-info">
            <i class="bx bx-user bg-box"></i>
            Users
          </a>
        </li>
        <li>
          <a href="/user-roles">
            <i class="bx bx-user-pin bg-success"></i>
            Roles
          </a>
        </li>
      </ul>
      <ul>
        <div class="link-title">Expenses Management</div>
        <li>
          <a href="expense-category">
            <i class="bx bx-category-alt bg-warning text-dark"></i>
            Expense Category
          </a>
        </li>
        <li>
          <a href="expenses">
            <i class="bx bx-user-pin bg-primary"></i>
            Expenses
          </a>
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
export default {};
</script>