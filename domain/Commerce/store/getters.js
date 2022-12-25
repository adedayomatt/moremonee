const getters = {
    cart: state => state.cart,
    cartItemsTotal: state => state.cart.map(item => item.quantity).reduce((a,b) => a + b , 0),
    cartTotal: state => state.cart.map(item => item.quantity * item.product.price).reduce((a,b) => a+b, 0),
    checkout: state => state.checkout
};

export default getters;
