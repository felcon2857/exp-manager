<template>
  <div class="" id="wrapper">
    <top-bar-component></top-bar-component>
    <sidebar-component></sidebar-component>
    <div class="container-fluid py-3 px-4">
      <div class="page-container">
        <div class="b-crumbs">
          <a class="inactive-crumbs">Expenses Management</a>
          <i class="bx bx-chevrons-right"></i>
          <a class="active-crumbs">Expense Category</a>
        </div>
        <div class="box-container">
          <div
            class="d-flex justify-content-between align-items-center mx-2 my-3"
          >
            <div class="box-title">Expense Categories</div>
            <button
              class="
                btn btn-seamless btn-sm
                d-flex
                align-items-center
                justify-content-center
              "
              data-toggle="modal"
              data-target="#addCategoryModal"
            >
              <i class="bx bx-plus"></i>&nbsp;Add Category
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
                      v-for="category in categories"
                      :key="category.id"
                      data-toggle="modal"
                      data-target="#updateCategoryModal"
                      @click="getOneCategory(category.id)"
                    >
                      <td>{{ category.display_name }}</td>
                      <td>{{ category.descriptions }}</td>
                      <td>{{ category.created_at | moment("YYYY-MM-DD") }}</td>
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
    <!-- modal add Category -->
    <div
      class="modal fade"
      id="addCategoryModal"
      tabindex="-1"
      Category="dialog"
      aria-labelledby="addCategoryLabel"
      aria-hidden="true"
    >
      <form action="" @submit.prevent="saveCategories()">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addCategoryLabel">Add Category</h5>
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
                  name="Category-name"
                  id="Category-name"
                  placeholder="Category name..."
                  v-model="category_data.display_name"
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
                  name="Category-desc"
                  id="Category-desc"
                  placeholder="Category Description"
                  v-model="category_data.descriptions"
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
    <!--end modal add Category -->

    <!-- modal update Category -->
    <div
      class="modal fade"
      id="updateCategoryModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="updateCategoryLabel"
      aria-hidden="true"
    >
      <form action="" @submit.prevent="updateCategories(selectedCategories.id)">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="updateCategoryLabel">
                Update Category
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
                  name="u-Category-name"
                  id="u-Category-name"
                  placeholder="Category name..."
                  v-model="selectedCategories.display_name"
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
                  name="u-Category-desc"
                  id="u-Category-desc"
                  placeholder="Category Description"
                  v-model="selectedCategories.descriptions"
                  :disabled="selectedCategories.id === 1"
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
                  @click="deleteCategories(selectedCategories.id)"
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
                <button type="submit" class="btn btn-save">Update</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
    <!-- end modal update Category -->
  </div>
</template>
<script>
import SidebarComponent from "../static/SidebarComponent.vue";
import TopBarComponent from "../static/TopBarComponent.vue";
export default {
  name: "Category",
  mounted() {
    document.title = "Expense Manager | Expense Management | Category";
  },
  created() {
    this.getAllCategories();
  },
  data() {
    return {
      category_data: {
        display_name: "",
        descriptions: "",
      },
      selectedCategories: [],
      successMsg: "",
      successStatus: false,
      errors: {},
      categories: [],
    };
  },
  components: {
    SidebarComponent,
    TopBarComponent,
  },

  methods: {
    // get All Categorys
    getAllCategories() {
      axios
        .get("/category/getall")
        .then((res) => {
          this.categories = res.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    // get specifi Category into modal
    getOneCategory(id) {
      axios
        .post("/category/getone/" + id)
        .then((res) => {
          this.selectedCategories = res.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    // saving new Category
    saveCategories() {
      axios
        .post("/category/save", {
          display_name: this.category_data.display_name,
          descriptions: this.category_data.descriptions,
        })
        .then((res) => {
          if (res.status == 200) {
            this.category_data.display_name = "";
            this.category_data.descriptions = "";
            this.getAllCategories();
            this.successMsg = "New Category added";
            this.successStatus = true;
            setTimeout(() => {
              this.successStatus = false;
              $("#addCategoryModal").modal("hide");
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
    //updateing specific Category
    updateCategories(id) {
      axios
        .post("/category/update/" + id, {
          display_name: this.selectedCategories.display_name,
          descriptions: this.selectedCategories.descriptions,
        })
        .then((res) => {
          if (res.status == 200) {
            this.getAllCategories();
            this.successMsg = "Category updated";
            this.successStatus = true;
            setTimeout(() => {
              this.successStatus = false;
              $("#updateCategoryModal").modal("hide");
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
    // deleteing Category
    deleteCategories(id) {
      axios
        .post("/category/delete/" + id)
        .then((res) => {
          if (res) {
            this.successMsg = res.data;
            this.successStatus = true;
            setTimeout(() => {
              this.successStatus = false;
              $("#updateCategoryModal").modal("hide");
            }, 3000);
            this.getAllCategories();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    resetField() {
      this.category_data.display_name = "";
      this.category_data.descriptions = "";
      this.errors = {};
    },
  },
};
</script>
