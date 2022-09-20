<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <card-component title="Buscar de marcas">
                    <template v-slot:body>
                        <input-container-component id="brand-name" title="marca"
                            helptext="opcional, informe o nome da marca">
                            <input type="text" class="form-control" id="brand-name" aria-describedby="brand-name-help"
                                placeholder="nome da marca" v-model="search" />
                        </input-container-component>
                    </template>
                    <template v-slot:footer>
                        <button type="submit" class="btn btn-outline-primary btn-sm float-end" @click="findBrand()">
                            <i class="bi bi-search"></i>
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
                                ' ',
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
                                            {{ brand.created_at | formatDate }}
                                        </td>
                                        <td width="120">
                                            <a class="btn btn-sm btn-light" @click="setItem(brand)" href="#"
                                                data-bs-toggle="modal" data-bs-target="#brand-modal">
                                                <i class="bi bi-eye"></i>
                                                visualizar
                                            </a>
                                        </td>
                                    </tr>
                                </template>
                            </table-component>
                        </template>
                        <template v-else>
                            <div>nenhum registro encontrado</div>
                        </template>

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

                    <div class="align-items-center align-self-center p-2 border rounded">
                        <img :src="selected.image ? 'storage/'+selected.image : '/storage/image.png'" class="img-fluid"
                            alt="logo" id="brand-logo" width="120" />
                    </div>

                    <input-container-component id="add-brand-name" title="nome da marca"
                        helptext="informe o nome da marca" class="flex-grow-1">
                        <input type="text" class="form-control" id="add-brand-name"
                            aria-describedby="add-brand-name-help" placeholder="nome da nova marca"
                            v-model="selected.name" />
                    </input-container-component>

                    <input-container-component id="add-brand-image" title="logo da marca"
                        helptext="informe o logo da marca" class="flex-grow-1">
                        <input class="form-control" type="file" id="brand-image" @change="readImage($event)" />
                    </input-container-component>

                </div>
            </template>

            <template v-slot:alerts class="mt-4" v-if="selected.feedback">
                <alerts-component :message="selected.feedback.message" :title="selected.feedback.title"
                    :type="selected.feedback.type" />
            </template>

            <template v-slot:footer>
                <button v-if="selected.id" type="button" class="btn btn-outline-danger"
                    @click="brandDestroy(selected.id)">
                    <i class="bi bi-trash"></i>
                    apagar
                </button>
                <button type="button" class="btn btn-outline-primary" @click="brandSave()">
                    <i class="bi bi-check-all"></i>
                    {{ selected.id ? 'atualizar' : 'salvar' }}
                </button>
            </template>

        </modal-component>

    </div>
</template>

<script>
export default {
    data() {
        return {
            brands: [],
            links: [],
            page: 1,
            search: '',
        };
    },
    computed: {
        api() {
            return this.$store.state.api;
        },
        selected() {
            return this.$store.state.selected;
        },
        alert() {
            return this.$store.state.alert;
        },
        toast() {
            return this.$store.state.toast;
        },
    },
    methods: {
        setItem(item) {
            if (!item) return this.$store.state.selected = { name: '', image: '', title: 'adicionar marca', edit: true }
            item.title = 'visualizar marca';
            this.$store.state.selected = { ...this.$store.state.selected, ...item };
        },
        readImage({ target }) {
            if (target.files && target.files[0]) {
                var file = new FileReader();
                file.onload = function (e) {
                    document.getElementById("brand-logo").src = e.target.result;
                };
                file.readAsDataURL(target.files[0]);
            }
            this.$store.state.selected.image_file = target.files[0];
        },
        findBrand() {
            let params = '';
            if (this.search) {
                params = `name,LIKE,${this.search}%`;
            }
            params ? this.getBrands(null, params) : this.getBrands();
        },
        getBrands(page = this.page, search = '') {
            let url = `/brand?page=${page ? page : 1}`;
            search ? url += `&search=${search}` : false;
            this.api.get(url)
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
            if (data.image_file) formData.append("image", data.image_file);
            if (data.id) {
                url += '/' + data.id;
                formData.append("_method", "patch");
            }

            this.api.post(url, formData, {
                headers: { "Content-Type": "multipart/form-data" },
            })
                .then((res) => {
                    let temp = {
                        ...this.selected,
                        image_file: '',
                        feedback: {
                            title: 'registro adicionado',
                            message: `registro ID ${res.data.id} adicionado com sucesso`,
                        }
                    }
                    this.setItem(temp);
                    this.getBrands()
                })
                .catch((e) => {
                    console.log(e);
                    const temp = {
                        ...this.selected,
                        edit: true,
                        feedback: {
                            type: 'danger',
                            title: 'erro ao adicionar registro',
                            message: '...'
                        }
                    };
                    console.log(temp)
                    this.setItem(temp)
                });
        },
        brandDestroy(id) {
            if (!confirm("Realmente apagar o regitro?")) return;

            this.api.delete(`/brand/${id}`)
                .then((res) => {
                    this.toast({ title: 'sucesso', message: 'o item foi deletado' })
                    this.getBrands();
                })
                .catch((e) => {
                    this.$store.state.alert = {
                        type: 'danger',
                        message: 'erro ao deletar registro'
                    }
                    console.log(e.response);
                });
        },

    },
    mounted() {
        // recupera lista de marcas ao carregar a tela
        this.getBrands();
    },
};
</script>
