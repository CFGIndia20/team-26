import Index from "views/Index.js";
import Login from "views/Login.js";
import Icons from "views/Icons.js";
import Donors from "views/Donor.js";
import Contributions from "views/Contributions.js";
import Questionnaire from "views/Questionnaire.js";
import Insights from "views/Insights.js";

var routes = [
    {
        path: "/insights",
        name: "Insights",
        icon: "ni ni-tv-2 text-primary",
        component: Insights,
        layout: "/admin",
    },
    {
        path: "/donors",
        name: "Verify Donors",
        icon: "ni ni-tv-2 text-primary",
        component: Donors,
        layout: "/admin",
    },
    {
        path: "/contributions",
        name: "Contributions",
        icon: "ni ni-tv-2 text-primary",
        component: Contributions,
        layout: "/admin",
    },
    {
        path: "/questions",
        name: "Questionnaire",
        icon: "ni ni-tv-2 text-primary",
        component: Questionnaire,
        layout: "/admin",
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
