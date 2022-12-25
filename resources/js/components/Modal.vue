<template>
    <div>
        <div class="modal fade"
             :id="_uid" tabindex="-1" role="dialog" aria-labelledby="Title" aria-hidden="true">
            <div class="modal-dialog"
                 :class="dialogClass" role="document">
                <div class="modal-content modal-card">
                    <div class="card-header">
                        <slot name="header">
                            <h3 class="card-header-title">{{ title }}</h3>
                            <button type="button" class="close" @click="hide" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </slot>
                    </div>
                    <div class="card-body" style="max-height: 80vh">
                        <slot v-bind:hide="hide"></slot>
                    </div>
                    <div class="modal-footer" v-if="$slots.footer">
                        <slot name="footer"/>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: 'Modal',
        props: {
            title: String,
            size: String,
            direction: String,
            hasHeader: { type: Boolean, default: true },
            keyboard: { type: Boolean, default: true },
            backdrop: { default: true },
        },
        computed: {
            dialogClass() {
                const _class = {
                    'modal-dialog-bottom': this.direction === 'bottom',
                };
                const size = `modal-${this.size}`;

                _class[size] = true;
                return _class;
            },
        },
        methods: {
            hide() {
                $(`#${this._uid}`).modal('hide');
                this.$emit('hidden');
            },
            show() {
                $(`#${this._uid}`).modal({ keyboard: this.keyboard, backdrop: this.backdrop });
                this.$emit('opened');
            },
        },
    }
</script>

<style lang="scss">
.modal-dialog-bottom {
    position: fixed;
    top: auto;
    right: auto;
    left: 50%;
    transform: translateX(-50%) !important;
    width: 100%;
    margin: auto;
    max-width: 600px;
    bottom: 0;

.modal-content {
    border-radius: 0.5rem 0.5rem 0 0;
}
}
</style>
