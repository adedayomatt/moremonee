<template>
    <div class="form-group">

        <!-- Label -->
        <label :for="$attrs.id" v-if="label">{{ label }}</label>

        <!-- Input group -->
        <div class="input-group" :class="{'input-group-merge': groupMerge }">

            <!-- Icon -->
            <div :class="`input-group-prepend ${onPrependClick ? 'cursor-pointer' : ''}`" v-if="hasPrepend"
                 @click="() => onPrependClick ? onPrependClick() : null">
                  <span class="input-group-text">
                    {{ prependText }}
                    <i :class="prependIcon" v-if="prependIcon"></i>
                  </span>
            </div>

            <!-- Textarea -->
            <textarea v-if="$attrs.type === `textarea`" class="form-control" v-bind="$attrs" v-on="listeners"
                      :class="{ 'form-control-appended': hasAppend, 'form-control-prepended': hasPrepend }">
            </textarea>

            <!-- Input -->
            <input v-else class="form-control" v-bind="$attrs" v-on="listeners"
                   :class="{ 'form-control-appended': hasAppend, 'form-control-prepended': hasPrepend }">

            <!-- Icon -->
            <div :class="`input-group-append ${onAppendClick ? 'cursor-pointer' : ''}`" v-if="hasAppend"
                 @click="() => onAppendClick ? onAppendClick() : null">
              <span class="input-group-text">
                {{ appendText }}
                <i :class="appendIcon" v-if="appendIcon"></i>
              </span>
            </div>

        </div>

    <span v-if="errorString" class="text-danger">
      {{ errorString }}
    </span>
    <span v-if="$attrs.info" class="text-muted d-block">
      {{ $attrs.info }}
    </span>
    </div>
</template>

<script>
    export default {
        name: 'AppInput',
        props: {
            errors: null,
            label: String,
            rule: String,
            appendIcon: String,
            appendText: String,
            prependIcon: String,
            prependText: String,
            groupMerge: Boolean,
            onAppendClick: Function,
            onPrependClick: Function,
        },
        computed: {
            hasAppend() {
                return this.appendIcon || this.appendText;
            },
            hasPrepend() {
                return this.prependIcon || this.prependText;
            },
            errorString() {
                let error;

                if (typeof this.errors === 'string') return this.errors;
                if (
                    !((this.errors && this.errors[this.$attrs.name]) ||
                    (this.$page.props.errors && this.$page.props.errors[this.$attrs.name]))
                ) return null;

                if (this.errors && this.errors[this.$attrs.name])
                    error = this.errors[this.$attrs.name];

                if (this.$page.props.errors && this.$page.props.errors[this.$attrs.name])
                    error = this.$page.props.errors[this.$attrs.name];

                return error.constructor === Array ? error[0] : error;
            },
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
    };
</script>
