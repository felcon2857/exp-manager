<template>
  <div class="" id="wrapper">
    <top-bar-component></top-bar-component>
    <sidebar-component></sidebar-component>
    <div class="container-fluid py-3 px-4">
      <div class="page-container">
        <div class="b-crumbs">
          <a class="inactive-crumbs">Users Management</a>
          <i class="bx bx-chevrons-right"></i>
          <a class="active-crumbs">Roles</a>
        </div>
        <div class="box-container">
          <div
            class="d-flex justify-content-between align-items-center mx-2 my-3"
          >
            <div class="box-title">User Roles</div>
            <button
              class="
                btn btn-seamless btn-sm
                d-flex
                align-items-center
                justify-content-center
              "
              data-toggle="modal"
              data-target="#addRoleModal"
            >
              <i class="bx bx-plus"></i>&nbsp;Add Role
            </button>
          </div>
          <!-- table data -->
          <div class="row">
            <div class="col-lg-12">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Display Name</th>
                      <th>Description</th>
                      <th>Created At</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="user_role in user_roles"
                      :key="user_role.id"
                      data-toggle="modal"
                      data-target="#updateRoleModal"
                      @click="getOneRole(user_role.id)"
                    >
                      <td>{{ user_role.display_name }}</td>
                      <td>{{ user_role.descriptions }}</td>
                      <td>{{ user_role.created_at | moment("YYYY-MM-DD") }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- end table data -->
        </div>
      </div>
    </div>
    <!-- modal add role -->
    <div
      class="modal fade"
      id="addRoleModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addRoleLabel"
      aria-hidden="true"
    >
      <form action="" @submit.prevent="saveRole()">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addRoleLabel">Add Role</h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
                @click="resetField()"
              >
                <i class="bx bx-x"></i>
              </button>
            </div>
            <div class="modal-body px-4">
              <div
                class="success-msg d-flex align-items-center"
                v-if="successStatus === true"
              >
                {{ successMsg }}
              </div>
              <div class="form-group">
                <label for="" class="label-modal">Display Name:</label>
                <input
                  type="text"
                  class="form-control form-contorl-sm"
                  name="role-name"
                  id="role-name"
                  placeholder="Role name..."
                  v-model="role_data.display_name"
                  @keyup="errors.display_name = null"
                />
                <small
                  class="text-error d-flex align-items-center"
                  v-if="errors && errors.display_name"
                >
                  <i class="bx bx-info-circle"></i>&nbsp;{{
                    errors.display_name[0]
                  }}
                </small>
              </div>
              <div class="form-group">
                <label for="" class="label-modal">Description:</label>
                <input
                  type="text"
                  class="form-control form-contorl-sm"
                  name="role-desc"
                  id="role-desc"
                  placeholder="Role Description"
                  v-model="role_data.descriptions"
                  @keyup="errors.descriptions = null"
                />
                <small
                  class="text-error d-flex align-items-center"
                  v-if="errors && errors.descriptions"
                >
                  <i class="bx bx-info-circle"></i>&nbsp;{{
                    errors.descriptions[0]
                  }}
                </small>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-cancel"
                data-dismiss="modal"
                @click="resetField()"
              >
                Cancel</button
              >&nbsp;
              <button type="submit" class="btn btn-save">Save</button>
            </div>
          </div>
        </div>
      </form>
    </div>
    <!--end modal add role -->

    <!-- modal update role -->
    <div
      class="modal fade"
      id="updateRoleModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="updateRoleLabel"
      aria-hidden="true"
    >
      <form action="" @submit.prevent="updateRole(selectedUser.id)">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="updateRoleLabel">
                {{
                  selectedUser.id === 1
                    ? "Administrator Details"
                    : "Update Role"
                }}
              </h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <i class="bx bx-x"></i>
              </button>
            </div>
            <div class="modal-body px-4">
              <div
                class="success-msg d-flex align-items-center"
                v-if="successStatus === true"
              >
                {{ successMsg }}
              </div>
              <div class="form-group">
                <label for="" class="label-modal">Display Name:</label>
                <input
                  type="text"
                  class="form-control form-contorl-sm"
                  name="u-role-name"
                  id="u-role-name"
                  placeholder="Role name..."
                  v-model="selectedUser.display_name"
                  :disabled="selectedUser.id === 1"
                  @keyup="errors.display_name = null"
                />
                <small
                  class="text-error d-flex align-items-center"
                  v-if="errors && errors.display_name"
                >
                  <i class="bx bx-info-circle"></i>&nbsp;{{
                    errors.display_name[0]
                  }}
                </small>
              </div>
              <div class="form-group">
                <label for="" class="label-modal">Description:</label>
                <input
                  type="text"
                  class="form-control form-contorl-sm"
                  name="u-role-desc"
                  id="u-role-desc"
                  placeholder="Role Description"
                  v-model="selectedUser.descriptions"
                  :disabled="selectedUser.id === 1"
                  @keyup="errors.descriptions = null"
                />
                <small
                  class="text-error d-flex align-items-center"
                  v-if="errors && errors.descriptions"
                >
                  <i class="bx bx-info-circle"></i>&nbsp;{{
                    errors.descriptions[0]
                  }}
                </small>
              </div>
            </div>
            <div
              class="
                modal-footer
                d-flex
                justify-content-between
                align-items-center
              "
            >
              <div class="form-group">
                <button
                  type="button"
                  class="btn btn-delete"
                  @click="deleteRole(selectedUser.id)"
                  v-if="selectedUser.id != 1"
                >
                  Delete
                </button>
              </div>
              <div class="form-group">
                <button
                  type="button"
                  class="btn btn-cancel"
                  data-dismiss="modal"
                  @click="resetField()"
                >
                  Cancel
                </button>
                &nbsp;
                <button
                  type="submit"
                  class="btn btn-save"
                  v-if="selectedUser.id != 1"
                >
                  Update
                </button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
    <!-- end modal update role -->
  </div>
</template>
<script>
import SidebarComponent from "../static/SidebarComponent.vue";
import TopBarComponent from "../static/TopBarComponent.vue";
export default {
  name: "Roles",
  mounted() {
    document.title = "Expense Manager | Users Management | Roles";
  },
  created() {
    this.getAllRole();
  },
  data() {
    return {
      role_data: {
        display_name: "",
        descriptions: "",
      },
      selectedUser: [],
      successMsg: "",
      successStatus: false,
      errors: {},
      user_roles: [],
    };
  },
  components: {
    SidebarComponent,
    TopBarComponent,
  },

  methods: {
    // get All Roles
    getAllRole() {
      axios
        .get("/role/getall")
        .then((res) => {
          this.user_roles = res.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    // get specifi role into modal
    getOneRole(id) {
      axios
        .post("/role/getone/" + id)
        .then((res) => {
          this.selectedUser = res.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    // saving new role
    saveRole() {
      axios
        .post("/role/save", {
          display_name: this.role_data.display_name,
          descriptions: this.role_data.descriptions,
        })
        .then((res) => {
          if (res.status == 200) {
            this.resetField();
            this.getAllRole();
            this.successMsg = "New Role added";
            this.successStatus = true;
            setTimeout(() => {
              this.successStatus = false;
              $("#addRoleModal").modal("hide");
            }, 3000);
          }
        })
        .catch((error) => {
          console.log(error);
          if (error.response.status == 422) {
            this.errors = error.response.data.errors;
          }
        });
    },
    //updateing specific role
    updateRole(id) {
      axios
        .post("/role/update/" + id, {
          display_name: this.selectedUser.display_name,
          descriptions: this.selectedUser.descriptions,
        })
        .then((res) => {
          if (res.status == 200) {
            this.getAllRole();
            this.successMsg = "Role updated";
            this.successStatus = true;
            setTimeout(() => {
              this.successStatus = false;
              $("#updateRoleModal").modal("hide");
            }, 3000);
          }
        })
        .catch((error) => {
          console.log(error);
          if (error.response.status == 422) {
            this.errors = error.response.data.errors;
          }
        });
    },
    // deleteing role
    deleteRole(id) {
      axios
        .post("/role/delete/" + id)
        .then((res) => {
          if (res) {
            this.successMsg = res.data;
            this.successStatus = true;
            setTimeout(() => {
              this.successStatus = false;
              $("#updateRoleModal").modal("hide");
            }, 3000);
            this.getAllRole();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    resetField() {
      this.role_data.display_name = "";
      this.role_data.descriptions = "";
      this.errors = {};
    },
  },
};
</script>
