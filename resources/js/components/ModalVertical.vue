<template>
        <div class="modal fade" :class="`${direction === 'right' ? 'fixed-right' : ''}${size ? ` modal-vertical-${size}` : ''}`"
             :id="_uid" tabindex="-1" role="dialog" aria-labelledby="Title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-vertical" role="document">
                <div class="modal-content">
                    <div class="modal-header align-items-center" v-if="hasHeader">
                        <slot name="header">
                            <h3 class="modal-title mb-0">{{ title }}</h3>
                            <button type="button" class="close" @click="$emit('close')" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </slot>
                    </div>
                    <div class="modal-body">
                        <slot v-bind:hide="hide"></slot>
                    </div>
                    <div class="modal-footer" v-if="hasFooter">
                        <slot name="footer"/>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    export default {
        name: 'ModalVertical',
        props: {
            title: String,
            size: String, // lg, xl
            large: Boolean,
            hasFooter: Boolean,
            hasHeader: { type: Boolean, default: true },
            keyboard: { type: Boolean, default: true },
            backdrop: { default: true },
            direction: String, // right, left
        },
        methods: {
            hide() {
                $(`#${this._uid}`).modal('hide');
                this.$emit('closed');
            },
            show() {
                $(`#${this._uid}`).modal({ keyboard: this.keyboard, backdrop: this.backdrop });
                this.$emit('opened');
            },
        },
    }
</script>

<style lang="scss">
    .modal{
        &.modal-vertical-lg {
            .modal-dialog-vertical {
                max-width: 450px;
            }
        }
    }
</style>
