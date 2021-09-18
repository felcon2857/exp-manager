<template>
  <div class="" id="wrapper">
    <top-bar-component></top-bar-component>
    <sidebar-component></sidebar-component>
    <div class="container-fluid py-3 px-5">
      <div class="page-container">
        <div class="b-crumbs">
          <a class="active-crumbs">Home</a>
          <i class="bx bx-chevrons-right"></i>
          <a class="inactive-crumbs">Dashboard</a>
        </div>
        <div class="box-container"></div>
        <div class="row"></div>
      </div>
    </div>
  </div>
</template>
<script>
import SidebarComponent from "../static/SidebarComponent.vue";
import TopBarComponent from "../static/TopBarComponent.vue";
export default {
  mounted() {
    document.title = "Expense Manager | User Dashboard";
  },
  data() {
    return {
      //
    };
  },
  components: {
    SidebarComponent,
    TopBarComponent,
  },
};
</script>
