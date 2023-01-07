<template>
    <div>
        <div class="frame-container">
            <div class="frame-container-inner">
                <app-button
                    class="btn btn-sm btn-outline-danger close-btn"
                    @click="closeWindow"
                > <i class="fe fe-x"></i> close</app-button>
                <iframe :src="transaction.redirect">
                </iframe>
            </div>
        </div>
        <div class="py-5 text-center text-muted">
            <h4>Kindly complete the transaction in the window</h4>
        </div>
    </div>
</template>

<script>

export default {
    name: "Redirect",
    computed: {
        transaction() {
            return this.$page.props.transaction
        },
        allowedDomains() {
            return this.$page.props.config.allowed_cross_origin_domains
        }
    },
    data() {
        return {
            open: true
        }
    },
    methods: {
       closeWindow() {
           this.$emit('close');
       }
    },
    created() {
        const instance = this;
        const eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
        const eventer = window[eventMethod];
        const messageEvent = "attachEvent" == eventMethod ? "onmessage" : "message";
        eventer(messageEvent, function(e) {
            if(instance.allowedDomains.includes(e.origin)) {
                instance.$emit("callback", e.data)
            }
        }, false);
    },
}
</script>

<style scoped>
    .frame-container {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: rgba(0,0,0,.5);
        z-index: 99999999;
    }
    .frame-container .frame-container-inner {
        position: relative;
        background: #FFFFFF;
        width: 98%;
        height: 98vh;
    }
    .frame-container .close-btn {
        position: absolute;
        z-index: 99999999;
        top: 2px;
        right: 2px;
    }
    .frame-container iframe {
        border: none;
        width: 100%;
        height: 100%;
    }

    @media screen and (min-width: 768px){
        .frame-container .frame-container-inner {
            width: 80%;
            height: 80vh;
        }
    }
</style>

