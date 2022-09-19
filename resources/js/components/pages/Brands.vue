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
                        <template v-if="brands.length > 0">
                            <table-component :thead="[
                                '#',
                                'name',
                                'image',
                                'criado',
                                'ações',
                            ]">
                                <template>
                                    <tr v-for="brand, index in brands">
                                        <th scope="row">{{ brand.id }}</th>
                                        <td class="text-uppercase">
                                            {{ brand.name }}
                                        </td>
                                        <td>
                                            <img :src="'/storage/' + brand.image" width="25" />
                                        </td>
                                        <td>
                                            {{ new Date(brand.created_at).toLocaleDateString("pt-BR") }}
                                        </td>
                                        <td>
                                            <!-- <a data-bs-toggle="modal" data-bs-target="#brand-show" href="#"
                                                @click="brandShow(index)">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="#" @click="brandUpdate(brand)"><i class="bi bi-pencil"></i></a>
                                            <a @click="brandDestroy(brand.id)" href="#"><i class="bi bi-trash"></i></a> -->
                                            <a @click="setItem(brand)" href="#" data-bs-toggle="modal"
                                                data-bs-target="#brand-modal"><i class="bi bi-eye"></i>
                                                visualizar </a>
                                            <!-- <a @click="brandDestroy(brand.id)" href="#"><i class="bi bi-trash"></i>
                                                remover</a> -->
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
                                <li :class="!!l.active ? 'page-item active' : 'page-itemx'" v-for="l, key in links"
                                    @click="paginate(l)">
                                    <a class="page-link">
                                        {{ l.label.includes('prev') ? 'voltar' :
                                        l.label.includes('next') ? 'próximo' :
                                        l.label
                                        }}</a>
                                </li>
                            </paginate-component>
                            <div>
                                <button type="submit" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal"
                                    data-bs-target="#brand-modal" @click="setItem(null)">
                                    Adicionar
                                </button>
                            </div>
                        </div>
                    </template>
                </card-component>
            </div>
        </div>
        <!-- modal adicionar -->
        <modal-component id="brand-modal" :title="selected.title">
            <template v-slot:body>
                <div class="d-flex flex-column justify-content-center">
                    <label for="brand-image" class="align-items-center align-self-center p-2 border rounded me-4">
                        <img :src="selected.image ? 'storage/'+selected.image : '/storage/image.png'"
                            class="img-fluid btn" alt="logo" id="brand-logo" width="100" />
                        <input class="form-control d-none" type="file" id="brand-image" @change="readImage($event)"
                            :disabled="!selected.edit" />
                    </label>
                    <input-container-component id="add-brand-name" title="nome da marca"
                        helptext="informe o nome da marca" class="flex-grow-1">
                        <input type="text" class="form-control" id="add-brand-name"
                            aria-describedby="add-brand-name-help" placeholder="nome da nova marca"
                            v-model="selected.name" :disabled="!selected.edit" />
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
                <button type="button" class="btn btn-primary" v-if="!selected.edit" @click="selected.edit = true">
                    editar
                </button>
                <template v-else>
                    <button v-if="selected.id" type="button" class="btn btn-danger" @click="brandDestroy(selected.id)">
                        apagar
                    </button>
                    <button type="button" class="btn btn-success" @click="brandSave()">
                        {{ selected.id ? 'atualizar' : 'salvar' }}
                    </button>
                </template>

            </template>
        </modal-component>
    </div>
</template>

<script>
import api from "../../../../services/api";

export default {
    data() {
        return {
            brands: [],
            links: [],
            page: 1,
            search: {
                id: '',
                name: '',
            },
            alert_destroy: {
                type: null,
                message: "",
            },
            alert_save: {
                type: null,
                message: "",
            },
            selected: {},
        };
    },
    methods: {
        setItem(item) {
            if (!item) return this.selected = { name: '', image: '', title: 'adicionar marca', edit: true }
            item.title = 'visualizar marca';
            item.edit = false;
            this.selected = { ...this.selected, ...item };
        },
        readImage({ target }) {
            if (target.files && target.files[0]) {
                var file = new FileReader();
                file.onload = function (e) {
                    document.getElementById("brand-logo").src = e.target.result;
                };
                file.readAsDataURL(target.files[0]);
            }
            this.selected.image = target.files[0];
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
        getBrands(page = this.page, search = '') {
            let url = `/brand?page=${page ? page : 1}`;
            search ? url += `&search=${search}` : false;
            api.get(url)
                .then(({ data }) => {
                    this.brands = data.data;
                    this.links = data.links;
                    this.page = page;
                })
                .catch((e) => console.log(e));
        },
        paginate(item) {
            if (item.url) {
                const page = item.url.split('?')[1].split('=')[1];
                this.getBrands(page);
            }
        },
        brandSave() {
            const data = this.selected;
            let url = '/brand';
            let formData = new FormData();

            formData.append("name", data.name);
            formData.append("image", data.image);

            if (data.id) {
                url += '/' + data.id;
                formData.append("_method", "patch");
            }

            console.log(url, formData)

            api.post(url, formData, {
                headers: { "Content-Type": "multipart/form-data" },
            })
                .then((res) => {
                    this.alert_save = {
                        type: "success",
                        message: `novo registro inserido ID: ${res.data.id}`,
                    };
                    this.getBrands()
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
                    this.getBrands();
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
        // recupera lista de marcas
        this.getBrands();
        // reinicia valores ao fechar o modal
        document.querySelector('#brand-modal').addEventListener('hide.bs.modal', function () {
            this.selected = {};
        })
    },
};
</script>
