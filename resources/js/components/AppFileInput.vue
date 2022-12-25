<template>
    <div class="form-group">
        <label :for="`file-input-${_uid}`" class="dropzone dropzone-single" :class="{'dz-max-files-reached': file != null}">
            <span class="dz-preview dz-preview-single">
                <span class="dz-preview-cover dz-processing dz-image-preview">
                    <img class="dz-preview-img" :src="file" alt="" v-if="file && type === 'image'">
                    <span class="text-center d-block" style="padding: 3rem 1rem" v-else>
                        <i class="fe fe-file" style="font-size: 3rem"></i>
                        <span class="d-block">{{ name }}</span>
                    </span>
                </span>
            </span>
            <span class="dz-default dz-message">{{ $attrs.placeholder || 'Drop file here' }}</span>
            <input :id="`file-input-${_uid}`" :accept="$attrs.accept" type="file" style="visibility: hidden; margin-top: -30px" @change="onFileChange">
        </label>
    </div>
</template>

<script>
export default {
    name: "AppFileInput",
    props: { value: {}, preview: String },
    data() {
        return {
            file: null,
            type: null,
            name: null,
        };
    },
    computed: {
        url() {
            if (this.preview &&
                ['.png', '.gif', '.jpg', '.svg', 'jpeg'].includes(this.preview.substr(-4))) {
                this.type = 'image';
            }

            return this.preview || this.file
        },
    },
    methods: {
        onFileChange(e) {
            const files = e.target.files || e.dataTransfer.files;
            if (!files.length) {
                this.type = this.name = this.file = null;
                return;
            }
            this.createImage(files[0]);
            this.$emit('input', files[0])
        },
        createImage(file) {
            const reader = new FileReader();
            const vm = this;

            this.type = file.type.split('/')[0];
            this.name = file.name;

            reader.onload = (e) => {
                vm.file = e.target.result;
            };
            reader.readAsDataURL(file);
        },
    },

    watch: {
        value:{
            immediate: true,
            handler(url) {
                if (!url || typeof url !== 'string') return;
                this.file = url;
                this.name = this.$attrs.label;
                if (['.png', '.gif', '.jpg', '.svg', 'jpeg'].includes(url.substr(-4)))
                    this.type = 'image';
            },
        },
        preview:{
            immediate: true,
            handler(url) {
                if (!url) return;
                this.file = url;
                if (['.png', '.gif', '.jpg', '.svg', 'jpeg'].includes(url.substr(-4)))
                    this.type = 'image';
            },
        }
    },
}
</script>

<style scoped>

</style>
