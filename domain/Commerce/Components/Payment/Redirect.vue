<template>
    <div>
        <div class="frame-container">
            <div class="frame-container-inner">
                <iframe :src="transaction.redirect">
                </iframe>
            </div>
        </div>
        <h4 class="text-center">Kindly complete the transaction in pop up</h4>
    </div>
</template>

<script>

export default {
    name: "Redirect",
    computed: {
        transaction() {
            return this.$page.props.transaction
        }
    },
    data() {
        return {
            open: true
        }
    },
    created() {
        const instance = this;
        const eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
        const eventer = window[eventMethod];
        const messageEvent = "attachEvent" == eventMethod ? "onmessage" : "message";
        eventer(messageEvent, function(e) {
            if([
                "https://ravesandboxapi.flutterwave.com",
                "https://api.flutterwave.com",
            ].includes(e.origin)) {
                instance.open = false;
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
        background: #FFFFFF;
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

