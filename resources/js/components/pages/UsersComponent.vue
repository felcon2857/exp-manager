<template>
  <div class="" id="wrapper">
    <top-bar-component></top-bar-component>
    <sidebar-component></sidebar-component>
    <div class="container-fluid py-3 px-4">
      <div class="page-container">
        <div class="b-crumbs">
          <a class="inactive-crumbs">Users Management</a>
          <i class="bx bx-chevrons-right"></i>
          <a class="active-crumbs">Users</a>
        </div>
        <div class="box-container">
          <div
            class="d-flex justify-content-between align-items-center mx-2 my-3"
          >
            <div class="box-title">User Info</div>
            <button
              class="
                btn btn-seamless btn-sm
                d-flex
                align-items-center
                justify-content-center
              "
              data-toggle="modal"
              data-target="#addUserModal"
            >
              <i class="bx bx-plus"></i>&nbsp;Add User
            </button>
          </div>
          <!-- table data -->
          <div class="row">
            <div class="col-lg-12">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email Address</th>
                      <th>Role</th>
                      <th>Created At</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="users in user_info"
                      :key="users.id"
                      data-toggle="modal"
                      data-target="#updateUserModal"
                      @click="getOneUser(users.id)"
                    >
                      <td>{{ users.name }}</td>
                      <td>{{ users.email }}</td>
                      <td>{{ users.roles }}</td>
                      <td>{{ users.created_at | moment("YYYY-MM-DD") }}</td>
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
      id="addUserModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addUserLabel"
      aria-hidden="true"
    >
      <form action="" @submit.prevent="addUser()">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addUserLabel">Add User</h5>
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
                <label for="" class="label-modal">Name:</label>
                <input
                  type="text"
                  class="form-control form-contorl-sm"
                  name="user-name"
                  id="user-name"
                  placeholder="User's Name..."
                  v-model="user_data.name"
                  @keyup="errors.name = null"
                />
                <small
                  class="text-error d-flex align-items-center"
                  v-if="errors && errors.name"
                >
                  <i class="bx bx-info-circle"></i>&nbsp;{{ errors.name[0] }}
                </small>
              </div>
              <div class="form-group">
                <label for="" class="label-modal">Email Address:</label>
                <input
                  type="text"
                  class="form-control form-contorl-sm"
                  name="user-email"
                  id="user-email"
                  placeholder="User's Email Address"
                  v-model="user_data.email"
                  @keyup="errors.email = null"
                />
                <small
                  class="text-error d-flex align-items-center"
                  v-if="errors && errors.email"
                >
                  <i class="bx bx-info-circle"></i>&nbsp;{{ errors.email[0] }}
                </small>
              </div>
              <div class="form-group">
                <label for="" class="label-modal">Role:</label>
                <select
                  name="user-role"
                  id="user-role"
                  class="form-control"
                  @change="errors.roles = null"
                  v-model="user_data.roles"
                >
                  <option value="">Select User Role</option>
                  <option
                    v-for="roles in selectedRole"
                    :key="roles.id"
                    v-bind:value="{ id: roles.id, data: roles.display_name }"
                  >
                    {{ roles.display_name }}
                  </option>
                </select>
                <small
                  class="text-error d-flex align-items-center"
                  v-if="errors && errors.roles"
                >
                  <i class="bx bx-info-circle"></i>&nbsp;{{ errors.roles[0] }}
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
      id="updateUserModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="updateUserLabel"
      aria-hidden="true"
    >
      <form action="" @submit.prevent="updateUser(selectedUser.id)">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="updateUserLabel">
                {{
                  selectedUser.id === 1
                    ? "Administrator Details"
                    : "Update User"
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
                <label for="" class="label-modal">Name:</label>
                <input
                  type="text"
                  class="form-control form-contorl-sm"
                  name="u-user-name"
                  id="u-user-name"
                  placeholder="User's Name..."
                  v-model="selectedUser.name"
                  @keyup="errors.name = null"
                  :disabled="selectedUser.roles_id === '1'"
                />
                <small
                  class="text-error d-flex align-items-center"
                  v-if="errors && errors.name"
                >
                  <i class="bx bx-info-circle"></i>&nbsp;{{ errors.name[0] }}
                </small>
              </div>
              <div class="form-group">
                <label for="" class="label-modal">Email Address:</label>
                <input
                  type="text"
                  class="form-control form-contorl-sm"
                  name="u-user-email"
                  id="u-user-email"
                  placeholder="User's Email Address"
                  v-model="selectedUser.email"
                  @keyup="errors.email = null"
                  :disabled="selectedUser.roles_id == '1'"
                />
                <small
                  class="text-error d-flex align-items-center"
                  v-if="errors && errors.email"
                >
                  <i class="bx bx-info-circle"></i>&nbsp;{{ errors.email[0] }}
                </small>
              </div>
              <div class="form-group">
                <label for="" class="label-modal">Role:</label>
                <select
                  name="u-user-role"
                  id="u-user-role"
                  class="form-control"
                  @change="errors.roles = null"
                  v-model="selectedUser.roles"
                  :disabled="selectedUser.roles_id == '1'"
                >
                  <option value="">Select User Role</option>
                  <option v-bind:value="selectedUser.roles">
                    {{ selectedUser.roles }}
                  </option>
                </select>
                <small
                  class="text-error d-flex align-items-center"
                  v-if="errors && errors.roles"
                >
                  <i class="bx bx-info-circle"></i>&nbsp;{{ errors.roles[0] }}
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
                  v-if="selectedUser.roles_id != 1"
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
                  v-if="selectedUser.roles_id != 1"
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
  name: "Users",
  mounted() {
    document.title = "Expense Manage | Users Management | Users Info";
  },
  created() {
    this.getRole();
    this.getAllUsers();
  },
  data() {
    return {
      user_data: {
        name: "",
        email: "",
        roles_id: "",
        roles: "",
        password: "user123",
      },
      selectedUser: [],
      selectedRole: {},
      successMsg: "",
      successStatus: false,
      errors: {},
      user_info: [],
    };
  },
  components: {
    SidebarComponent,
    TopBarComponent,
  },
  methods: {
    // get and selecting role
    getRole() {
      axios
        .get("/role/getall")
        .then((res) => {
          this.selectedRole = res.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    //get all users
    getAllUsers() {
      axios
        .get("/users/getall")
        .then((res) => {
          this.user_info = res.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    // get one user
    getOneUser(id) {
      axios
        .post("/users/getone/" + id)
        .then((res) => {
          if (res) {
            this.selectedUser = res.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    //add users
    addUser() {
      axios
        .post("/users/save", {
          name: this.user_data.name,
          email: this.user_data.email,
          password: this.user_data.password,
          roles: this.user_data.roles.data,
          roles_id: this.user_data.roles.id,
        })
        .then((res) => {
          if (res.status == 200) {
            this.resetField();
            this.getAllUsers();
            this.successMsg = "New user added!";
            this.successStatus = true;
            setTimeout(() => {
              this.successStatus = false;
              $("#addUserModal").modal("hide");
            }, 3000);
          }
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.errors = error.response.data.errors;
          }
          console.log(error);
        });
    },
    // update users
    updateUser(id) {
      axios.post("/users/update" + id);
    },
    // reset field
    resetField() {
      this.user_data.name = "";
      this.user_data.email = "";
      this.user_data.roles = "";
      this.user_data.roles_id = "";
      this.errors = {};
    },
  },
  computed: {
    getNameSelected() {
      const el = this.selectedRole.find(
        (e) => e.id == this.selectedUser.roles_id
      );
      if (el) {
        // return el.role;
        console.log(el.roles);
      }
    },
  },
};
</script>