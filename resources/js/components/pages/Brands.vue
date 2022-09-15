<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <card-component title="Buscar de marcas">
                    <template v-slot:body>
                        <div class="row">
                            <div class="mb-3 col-sm">
                                <input-container-component
                                    id="brand-id"
                                    title="id da marca"
                                    helptext="opcional, informe o id da marca"
                                >
                                    <input
                                        type="number"
                                        class="form-control"
                                        id="brand-id"
                                        aria-describedby="brand-id-help"
                                        placeholder="id da marca"
                                    />
                                </input-container-component>
                            </div>
                            <div class="mb-3 col-sm">
                                <input-container-component
                                    id="brand-name"
                                    title="nome da marca"
                                    helptext="opcional, informe o nome da marca"
                                >
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="brand-name"
                                        aria-describedby="brand-name-help"
                                        placeholder="nome da marca"
                                    />
                                </input-container-component>
                            </div>
                        </div>
                    </template>
                    <template v-slot:footer>
                        <button
                            type="submit"
                            class="btn btn-primary btn-sm float-end"
                        >
                            Pesquisar
                        </button>
                    </template>
                </card-component>

                <!-- table -->
                <card-component title="Relação das marcas">
                    <template v-slot:body>
                        <template v-if="brands.length > 0">
                            <table-component :thead="['#', 'name', 'image']">
                                <template>
                                    <tr v-for="key in brands">
                                        <th scope="row">{{ key.id }}</th>
                                        <td class="text-uppercase">
                                            {{ key.name }}
                                        </td>
                                        <td>
                                            <img
                                                :src="'/storage/' + key.image"
                                                width="30"
                                            />
                                        </td>
                                        <td width="140">
                                            <a
                                                class="btn btn-sm btn-light"
                                                href="#"
                                                >editar</a
                                            >
                                            <button
                                                class="btn btn-sm btn-light"
                                                @click="brandDestroy(key.id)"
                                            >
                                                deletar
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                            </table-component>
                        </template>
                        <template v-else>
                            <div>nenhum registro encontrado</div>
                        </template>

                        <alerts-component
                            :data="alert_destroy"
                            v-if="alert_destroy.message"
                        />
                    </template>
                    <template v-slot:footer>
                        <button
                            type="submit"
                            class="btn btn-primary btn-sm float-end"
                            data-bs-toggle="modal"
                            data-bs-target="#addBrand"
                        >
                            Adicionar
                        </button>
                    </template>
                </card-component>
            </div>
        </div>
        <!-- modal -->
        <modal-component id="addBrand" title="Adicionar Marca">
            <template v-slot:body>
                <div
                    class="d-flex flex-column flex-sm-row justify-content-center"
                >
                    <label
                        for="brand-image"
                        class="align-items-center align-self-center p-2 border rounded me-4"
                    >
                        <img
                            src="https://evidenceencadernacao.com.br/wp-content/themes/claue/assets/images/placeholder.png"
                            class="img-fluid btn"
                            alt="logo"
                            id="brand-logo"
                            width="100"
                        />
                        <input
                            class="form-control d-none"
                            type="file"
                            id="brand-image"
                            @change="readImage($event)"
                        />
                    </label>
                    <input-container-component
                        id="add-brand-name"
                        title="nome da marca"
                        helptext="informe o nome da marca"
                        class="flex-grow-1"
                    >
                        <input
                            type="text"
                            class="form-control"
                            id="add-brand-name"
                            aria-describedby="add-brand-name-help"
                            placeholder="nome da nova marca"
                            v-model="brandName"
                        />
                    </input-container-component>
                </div>
            </template>
            <template v-slot:alerts v-if="alert_save.message" class="mt-4">
                <alerts-component :data="alert_save" />
            </template>
            <template v-slot:footer>
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Fechar
                </button>
                <button
                    type="button"
                    class="btn btn-primary"
                    @click="brandSave()"
                >
                    Salvar
                </button>
            </template>
        </modal-component>
    </div>
</template>

<script>
import api from "../../../../services/api";

export default {
    data() {
        return {
            brandName: "",
            brandImage: [],
            brands: [],
            type: null,
            text: "",
            alert_destroy: {
                type: null,
                message: "",
            },
            alert_save: {
                type: null,
                message: "",
            },
        };
    },
    mounted() {
        api.get("/brand")
            .then(({ data }) => (this.brands = data))
            .catch((e) => console.log(e));
    },
    methods: {
        loadImage(e) {
            const image = e.target.files[0];
            this.brandImage = image;
        },
        readImage({ target }) {
            if (target.files && target.files[0]) {
                console.log("rodando");
                var file = new FileReader();
                file.onload = function (e) {
                    document.getElementById("brand-logo").src = e.target.result;
                };
                file.readAsDataURL(target.files[0]);
            }
            this.brandImage = target.files[0];
        },
        brandSave() {
            let formData = new FormData();
            formData.append("name", this.brandName);
            formData.append("image", this.brandImage);

            api.post("/brand", formData, {
                headers: { "Content-Type": "multipart/form-data" },
            })
                .then((res) => {
                    this.alert_save = {
                        type: "success",
                        message: "a marca foi registrada",
                    };
                    this.brands.push(res.data);
                })
                .catch((e) => {
                    this.alert_save = {
                        type: "danger",
                        message: e.response.data.errors,
                    };
                    console.log(e.response.data.errors);
                });
        },
        brandDestroy(id) {
            if (!confirm("Realmente apagar o regitro?")) return;

            api.delete(`/brand/${id}`)
                .then((res) => {
                    this.alert_destroy = {
                        type: "success",
                        message: "item foi deletado",
                    };
                    this.brands = this.brands.filter((e) => e.id != id);
                })
                .catch((e) => {
                    this.alert_destroy = {
                        type: "danger",
                        message: "erro ao deletar registro",
                    };
                    console.log(e.response);
                });
        },
    },
};
</script>
