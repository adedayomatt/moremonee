import CartService from '../Services/cart'

const state = {
    cart: CartService.getCart(),
    checkout: CartService.getCheckout(),
    toast: {},
    tempUser: null,
    currency: null,
}

export default state;
