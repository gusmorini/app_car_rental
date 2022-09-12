<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Encontrar marcas</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-sm">
                                <input-container-component id="brand-id" title="id da marca" idhelp="brand-id-help"
                                    helptext="opcional, informe o id da marca">
                                    <input type="number" class="form-control" id="brand-id"
                                        aria-describedby="brand-id-help" placeholder="id da marca" />
                                </input-container-component>

                            </div>
                            <div class="mb-3 col-sm">
                                <input-container-component id="brand-name" title="nome da marca"
                                    idhelp="brand-name-help" helptext="opcional, informe o nome da marca">
                                    <input type="text" class="form-control" id="brand-name"
                                        aria-describedby="brand-name-help" placeholder="nome da marca" />
                                </input-container-component>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm float-end">Pesquisar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script></script>
