import Index from "views/Index.js";
import Profile from "views/Profile.js";
import Register from "views/Register.js";
import Login from "views/Login.js";
import Tables from "views/Tables.js";
import Icons from "views/Icons.js";
import TripSearch from "views/TripSearch.js";

var routes = [
    {
        path: "/index",
        name: "Dashboard",
        icon: "ni ni-tv-2 text-primary",
        component: Index,
        layout: "/admin",
    },
    {
        path: "/tables",
        name: "Tables",
        icon: "ni ni-tv-2 text-primary",
        component: Tables,
        layout: "/admin",
    },
    {
        path: "/profile",
        name: "Profile",
        icon: "ni ni-tv-2 text-primary",
        component: Profile,
        layout: "/admin",
    },

    {
        path: "/icons",
        name: "Icons",
        icon: "ni ni-tv-2 text-primary",
        component: Icons,
        layout: "/admin",
    },



    {
        path: "/trip/search",
        name: "Trip Search",
        icon: "ni ni-single-02 text-yellow",
        component: TripSearch,
        layout: "/admin",
    },
    {
        path: "/register",
        name: "Register",
        icon: "ni ni-tv-2 text-primary",
        component: Register,
        layout: "/auth",
    },

    {
        path: "/login",
        name: "Login",
        icon: "ni ni-bullet-list-67 text-red",
        component: Login,
        layout: "/auth",
    },
];
export default routes;
