<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <card-component title="Buscar de marcas">
                    <template v-slot:body>
                        <div class="row">
                            <div class="mb-3 col-sm">
                                <input-container-component id="brand-id" title="id da marca"
                                    helptext="opcional, informe o id da marca">
                                    <input type="number" class="form-control" id="brand-id"
                                        aria-describedby="brand-id-help" placeholder="id da marca"
                                        v-model="search.id" />
                                </input-container-component>
                            </div>
                            <div class="mb-3 col-sm">
                                <input-container-component id="brand-name" title="nome da marca"
                                    helptext="opcional, informe o nome da marca">
                                    <input type="text" class="form-control" id="brand-name"
                                        aria-describedby="brand-name-help" placeholder="nome da marca"
                                        v-model="search.name" />
                                </input-container-component>
                            </div>
                        </div>
                    </template>
                    <template v-slot:footer>
                        <button type="submit" class="btn btn-primary btn-sm float-end" @click="findBrand()">
                            Pesquisar
                        </button>
                    </template>
                </card-component>

                <!-- table -->
                <card-component title="Relação das marcas">
                    <template v-slot:body>
                        <template v-if="brands.data.length > 0">
                            <table-component :thead="[
                                '#',
                                'name',
                                'image',
                                'criado',
                                'ações',
                            ]">
                                <template>
                                    <tr v-for="key in brands.data">
                                        <th scope="row">{{ key.id }}</th>
                                        <td class="text-uppercase">
                                            {{ key.name }}
                                        </td>
                                        <td>
                                            <img :src="'/storage/' + key.image" width="25" />
                                        </td>
                                        <td>
                                            {{ new Date(key.created_at).toLocaleDateString("pt-BR") }}
                                        </td>
                                        <td>
                                            <a data-bs-toggle="modal" data-bs-target="#brand-show" href="#"><i
                                                    class="bi bi-eye"></i></a>
                                            <a href="#"><i class="bi bi-pencil"></i></a>
                                            <a @click="brandDestroy(key.id)" href="#"><i class="bi bi-trash"></i></a>
                                        </td>
                                    </tr>
                                </template>
                            </table-component>
                        </template>
                        <template v-else>
                            <div>nenhum registro encontrado</div>
                        </template>

                        <alerts-component :data="alert_destroy" v-if="alert_destroy.message" />
                    </template>
                    <template v-slot:footer>
                        <div class="d-flex justify-content-between align-items-center">
                            <paginate-component>
                                <li :class="!!l.active ? 'page-item active' : 'page-itemx'"
                                    v-for="l, key in brands.links" @click="paginate(l)">
                                    <a class="page-link">
                                        {{ l.label.includes('prev') ? 'voltar' :
                                        l.label.includes('next') ? 'próximo' :
                                        l.label
                                        }}</a>
                                </li>
                            </paginate-component>
                            <div>
                                <button type="submit" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal"
                                    data-bs-target="#brand-add">
                                    Adicionar
                                </button>
                            </div>
                        </div>
                    </template>
                </card-component>
            </div>
        </div>
        <!-- modal adicionar -->
        <modal-component id="brand-add" title="Adicionar Marca">
            <template v-slot:body>
                <div class="d-flex flex-column flex-sm-row justify-content-center">
                    <label for="brand-image" class="align-items-center align-self-center p-2 border rounded me-4">
                        <img src="https://evidenceencadernacao.com.br/wp-content/themes/claue/assets/images/placeholder.png"
                            class="img-fluid btn" alt="logo" id="brand-logo" width="100" />
                        <input class="form-control d-none" type="file" id="brand-image" @change="readImage($event)" />
                    </label>
                    <input-container-component id="add-brand-name" title="nome da marca"
                        helptext="informe o nome da marca" class="flex-grow-1">
                        <input type="text" class="form-control" id="add-brand-name"
                            aria-describedby="add-brand-name-help" placeholder="nome da nova marca"
                            v-model="brandName" />
                    </input-container-component>
                </div>
            </template>
            <template v-slot:alerts v-if="alert_save.message" class="mt-4">
                <alerts-component :data="alert_save" />
            </template>
            <template v-slot:footer>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Fechar
                </button>
                <button type="button" class="btn btn-primary" @click="brandSave()">
                    Salvar
                </button>
            </template>
        </modal-component>
        <!-- modal visualizar -->
        <modal-component id="brand-show" title="Visualizar Marca">
            <template v-slot:body>
                <div class="d-flex flex-column flex-sm-row justify-content-center">
                    teste
                </div>
            </template>
            <!-- <template v-slot:alerts v-if="alert_save.message" class="mt-4">
                <alerts-component :data="alert_save" />
            </template> -->
            <template v-slot:footer>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Fechar
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
            brands: {
                data: [],
            },
            search: {
                id: '',
                name: '',
            },
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

    methods: {
        loadImage(e) {
            const image = e.target.files[0];
            this.brandImage = image;
        },
        readImage({ target }) {
            if (target.files && target.files[0]) {
                var file = new FileReader();
                file.onload = function (e) {
                    document.getElementById("brand-logo").src = e.target.result;
                };
                file.readAsDataURL(target.files[0]);
            }
            this.brandImage = target.files[0];
        },
        findBrand() {
            const s = this.search;
            let params = '';
            for (let key in s) {
                if (s[key]) {
                    if (params !== '') params += ';';
                    params += `${key},LIKE,${s[key]}%`;
                }
            }

            params ? this.getBrands(null, params) : this.getBrands();

        },
        getBrands(page = 1, search = '') {
            let url = `/brand?page=${page ? page : 1}`;
            search ? url += `&search=${search}` : false;
            api.get(url)
                .then(({ data }) => this.brands = data)
                .catch((e) => console.log(e));
        },
        paginate(item) {
            if (item.url) {
                const page = item.url.split('?')[1].split('=')[1];
                this.getBrands(page);
            }
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
                        message: `novo registro inserido ID: ${res.data.id}`,
                    };
                    // this.brands.push(res.data);
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
    mounted() {
        this.getBrands();
    },
};
</script>
