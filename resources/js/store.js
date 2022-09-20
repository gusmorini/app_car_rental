import Vue from "vue";
import Vuex from "vuex";

import { toast } from "./toast";
import api from "../../services/api";

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        api,
        selected: {},
        alert: {},
        toast,
    },
});
