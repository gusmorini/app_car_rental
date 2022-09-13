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
                                        aria-describedby="brand-id-help" placeholder="id da marca" />
                                </input-container-component>
                            </div>
                            <div class="mb-3 col-sm">
                                <input-container-component id="brand-name" title="nome da marca"
                                    helptext="opcional, informe o nome da marca">
                                    <input type="text" class="form-control" id="brand-name"
                                        aria-describedby="brand-name-help" placeholder="nome da marca" />
                                </input-container-component>
                            </div>
                        </div>
                    </template>
                    <template v-slot:footer>
                        <button type="submit" class="btn btn-primary btn-sm float-end">Pesquisar</button>
                    </template>
                </card-component>

                <!-- table -->
                <card-component title="Relação das marcas">
                    <template v-slot:body>
                        <table-component :thead="['#', 'name', 'image']">
                            <template>
                                <tr v-for="key in brands">
                                    <th scope="row">{{ key.id }}</th>
                                    <td class="text-uppercase">{{ key.name }}</td>
                                    <td><img :src="'http://localhost:8000/storage/'+key.image" width="30" /></td>
                                    <td width="140">
                                        <a class="btn btn-sm btn-light" href="#">editar</a>
                                        <button class="btn btn-sm btn-light"
                                            @click="brandDestroy(key.id)">deletar</button>
                                    </td>
                                </tr>
                            </template>
                        </table-component>
                    </template>
                    <template v-slot:footer>
                        <button type="submit" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal"
                            data-bs-target="#addBrand">Adicionar</button>
                    </template>
                </card-component>
            </div>
        </div>
        <!-- modal -->
        <modal-component id="addBrand" title="Adicionar Marca">
            <template v-slot:body>
                <input-container-component id="add-brand-name" title="nome da marca" helptext="informe o nome da marca">
                    <input type="text" class="form-control" id="add-brand-name" aria-describedby="add-brand-name-help"
                        placeholder="nome da nova marca" v-model="brandName" />
                </input-container-component>
                <input-container-component id="add-brand-image" title="imagem da marca"
                    helptext="escolha uma imagem no formato png">
                    <input class="form-control" type="file" id="formFile" @change="loadImage($event)">
                </input-container-component>
            </template>
            <template v-slot:alerts v-if="type">
                <alerts-component :type="type" :text="text" />
            </template>
            <template v-slot:footer>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" @click="brandSave()">Salvar</button>
            </template>
        </modal-component>
    </div>
</template>

<script>
import api from '../../../../services/api';

export default {
    data() {
        return {
            brandName: '',
            brandImage: [],
            brands: [],
            type: null,
            text: '',
        }
    },
    mounted() {
        api.get('/brand')
            .then(({ data }) => this.brands = data)
            .catch(e => console.log(e))
    },
    methods: {
        loadImage(e) {
            this.brandImage = e.target.files
        },
        brandSave() {
            let formData = new FormData();
            formData.append('name', this.brandName);
            formData.append('image', this.brandImage[0]);

            api.post('/brand', formData, { headers: { 'Content-Type': 'multipart/form-data' } })
                .then(res => {
                    this.type = 'success';
                    this.text = 'a marca foi registrada com sucesso';
                    this.brands.push(res.data);
                })
                .catch(e => {
                    this.type = 'danger';
                    this.text = e.response.data.errors;
                    console.log(e.response.data.errors)
                })
        },
        brandDestroy(id) {
            this.brands = this.brands.filter(e => e.id != id);
            api.delete(`/brand/${id}`)
                .then(res => {
                    console.log(res.data);
                })
                .catch(e => console.log(e))
        }
    }
}
</script>
