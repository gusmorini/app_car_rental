<template>
    <div class="modal fade" :id="id" tabindex="-1" :aria-labelledby="id + 'Label'" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{ title }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <slot name="body"></slot>
                    <slot name="alerts"></slot>
                </div>
                <div class="modal-footer">
                    <div class="col-12 text-end">
                        <slot name="footer"></slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["id", "title"],
    methods: {
        resetSelected() {
            this.$store.state.selected = {};
            this.$store.state.alert = {};
        }
    },
    mounted() {
        document.getElementById(this.id).addEventListener('hide.bs.modal', this.resetSelected);
    }

};
</script>
