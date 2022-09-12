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
                        <table-component></table-component>
                    </template>
                    <template v-slot:footer>
                        <button type="submit" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal"
                            data-bs-target="#addBrand">Adicionar</button>
                    </template>
                </card-component>
            </div>
        </div>

        <modal-component id="addBrand" title="Adicionar Marca">
            <template v-slot:body>
                <input-container-component id="add-brand-name" title="nome da marca" helptext="informe o nome da marca">
                    <input type="text" class="form-control" id="add-brand-name" aria-describedby="add-brand-name-help"
                        placeholder="nome da nova marca" />
                </input-container-component>
                <input-container-component id="add-brand-image" title="imagem da marca"
                    helptext="escolha uma imagem no formato png">
                    <input class="form-control" type="file" id="formFile">
                </input-container-component>
            </template>
            <template v-slot:footer>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary">Salvar</button>
            </template>
        </modal-component>
    </div>
</template>

<script></script>
