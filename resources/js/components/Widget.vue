<template>
    <div>
        <div :class="`card ${swappable ? 'swappable-widget' : ''}`">
            <div class="card-header" v-if="hasHeader">
                <div class="row align-items-center">
                    <div class="col">
                         <slot name="header" />
                    </div>
                    <div class="col-auto" v-if="toggleable">
                        <x-button :class="`m-auto btn btn-sm ${ui.show ? 'btn-white' : 'btn-primary'}`" title="Toggle widget" @click="ui.show = !ui.show">
                            <span :class="`fe ${ui.show ? 'fe-eye' : 'fe-eye-off'}`"></span>
                        </x-button>
                    </div>
                </div>
            </div>
            <div class=" scroll-bar" v-if="ui.show"
                 :class="{'table-responsive': $attrs.hasOwnProperty('table'), 'card-body': !$attrs.hasOwnProperty('table')}">
                <slot name="body" />
            </div>
            <div class="card-footer" v-if="this.$slots['footer'] && ui.show">
                <slot name="footer" />
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'WidgetTemplate',
        props:{
            hasHeader: {
                type: Boolean,
                default: () => true,
            },
            hasFooter: {
                type: Boolean,
                default: () => false,
            },
            toggleable: {
                type: Boolean,
                default: () => true,
            },
            swappable: {
                type: Boolean,
                default: () => true,
            },
        },

        data(){
            return {
                ui:{
                    show: true,
                }
            }
        }
    }
</script>

<style scoped>
    .card-body{
        max-height: 60vh;
        overflow: auto;
    }

</style>
