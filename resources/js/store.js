import Vue from "vue";
import Vuex from "vuex";

import { toast } from "./toast";
import api from "../../services/api";

Vue.use(Vuex);

const initialState = {
    api,
    selected: {},
    alert: {},
    toast,
};

export const store = new Vuex.Store({ state: initialState });
