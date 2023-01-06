<template>
    <div>
        <div class="modal fade"
             :id="_uid" tabindex="-1" role="dialog" aria-labelledby="Title" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content modal-card">
                    <div class="card-header">
                        <slot name="header">
                            <h3 class="card-header-title">{{ title || 'Are you sure' }}</h3>
                            <button type="button" class="close" @click="hide" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </slot>
                    </div>
                    <div class="card-body">
                        <slot></slot>
                    </div>
                    <div class="card-footer">
                        <app-button class="btn btn-white" @click="confirm" :loading="loading">Yes</app-button>
                        <app-button class="btn btn-white" @click="hide">Cancel</app-button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: 'ModalConfirmation',
        props: {
            title: String,
            size: String,
            onConfirm: Function,
            hasHeader: { type: Boolean, default: true },
            keyboard: { type: Boolean, default: true },
            backdrop: { default: true },
        },

        data(){
            return {
                loading: false,
            }
        },

        methods: {
            hide() {
                $(`#${this._uid}`).modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                this.$emit('hidden');
            },
            show() {
                $(`#${this._uid}`).modal({ keyboard: this.keyboard, backdrop: this.backdrop });
                this.$emit('opened');
            },
            confirm()
            {
                this.loading = true;
                this.onConfirm()
                .then(() => {
                    this.hide();
                })
                .finally(() => {
                    this.loading = false;
                })
            }
        },

    }
</script>
