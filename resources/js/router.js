import VueRouter from "vue-router";

//pages
import LoginAuth from "./components/auth/LoginAuthComponent";
import Dashboard from "./components/pages/DashboardComponent";
import Roles from "./components/pages/RolesComponent";
import ExpenseCategory from "./components/pages/ExpenseCategoryComponent";
import Users from "./components/pages/UsersComponent";

//path route
const routes = [
    { name: "Login", path: "/", component: LoginAuth },
    { name: "Dashboard", path: "/dashboard", component: Dashboard },
    { name: "Roles", path: "/user-roles", component: Roles },
    { name: "Users", path: "/user-info", component: Users },
    {
        name: "Category",
        path: "/expense-category",
        component: ExpenseCategory
    }
];

//state declaration
const router = new VueRouter({
    history: true,
    mode: "history",
    routes
});

export default router;
