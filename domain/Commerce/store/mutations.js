const mutations = {
    SET_CART: (state, cart) => {
        state.cart = cart
    },

    SET_CHECKOUT: (state, checkout) => {
        state.checkout = checkout
    },

    SET_TOAST:(state, { show = false, type = "primary", message = "" , stick = false}) => {
        state.toast = { show, type, message }
        if(!stick) {
            setTimeout(() => {
                state.toast = {}
            }, 5000)
        }
    },

    SET_TEMP_USER: (state, user) => {
        state.tempUser = user
    },
};
export default mutations;
