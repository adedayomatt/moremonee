import CartService from '../Services/cart';

const actions = {
    addCartItem: ({ commit }, { quantity, product }) => {
        return new Promise((resolve) => {
            const item = CartService.addCartItem({quantity, product});
            commit('SET_CART', CartService.getCart())
            resolve(item);
        })
    },

    updateCartItem: ({ commit }, item) => {
        return new Promise((resolve) => {
            const item = CartService.updateCartItem(item);
            commit('SET_CART', CartService.getCart())
            resolve(item);
        })

    },

    removeCartItem: ({ commit }, item) => {
        return new Promise((resolve) => {
            CartService.removeCartItem(item);
            commit('SET_CART', CartService.getCart())
            resolve();
        })
    },

    clearCartItem: ({ commit }) => {
        return new Promise((resolve) => {
            CartService.clearCart();
            commit('SET_CART', CartService.getCart())
            resolve();
        })
    },

    setCheckoutData: ({ commit }, data) => {
        return new Promise((resolve) => {
            CartService.setCheckoutData(data);
            commit('SET_CHECKOUT', CartService.getCheckout());
            resolve();
        })
    }
}

export default actions;
