import Vue from "vue";
import Vuex from "vuex";

import { toast } from "./toast";
import api from "../../services/api";

import token from "../../services/token";

Vue.use(Vuex);

const initialState = {
    api,
    token,
    selected: {},
    alert: {},
    toast,
};

export const store = new Vuex.Store({ state: initialState });
