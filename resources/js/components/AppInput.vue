<template>
    <div class="input-group app-input" :class="{'input-group-merge': $slots.hasOwnProperty('append') || $slots.hasOwnProperty('prepend') }">

        <!-- Icon -->
        <div class="input-group-prepend" v-if="$slots.hasOwnProperty('prepend')">
            <slot name="prepend" />
        </div>

        <!-- Textarea -->
        <textarea v-if="$attrs.type === `textarea`" class="form-control" v-bind="$attrs" v-on="listeners"
                  :class="{
            'form-control-appended': $slots.hasOwnProperty('append'),
             'form-control-prepended': $slots.hasOwnProperty('prepend')
        }">
      </textarea>

        <!-- Input -->
        <input v-else class="form-control" v-bind="$attrs" v-on="listeners"
               :class="{
            'form-control-appended': $slots.hasOwnProperty('append') || $slots.hasOwnProperty('default'),
             'form-control-prepended': $slots.hasOwnProperty('prepend')
        }">

        <slot />

        <!-- Icon -->
        <div class="input-group-append" v-if="$slots.hasOwnProperty('append')">
            <slot name="append" />
        </div>

    </div>
</template>

<script>
export default {
    name: 'AppInput',
    computed: {
        listeners() {
            const vm = this;
            return {
                ...this.$listeners,
                input(event) {
                    vm.$emit('input', event.target.value);
                    return event.target.value;
                },
            };
        },
    },
}
</script>

<style scoped>
.app-input .input-group-text, .app-input .form-control::placeholder {
  color: #83928c;
}
.app-input .input-group-text, .app-input .form-control {
    background: #DFFFE2;
    border: none;
}

.input-group-lg > .form-control:not(.form-control-appended) {
  padding-right: 1.25rem;
}
</style>
