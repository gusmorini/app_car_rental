import Vue from "vue";
import Vuex from "vuex";

import { toast } from "./toast";

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        selected: {},
        alert: {},
        toast,
    },
});
