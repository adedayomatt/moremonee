import CartService from '../services/cart'

const state = {
    cart: CartService.getCart(),
    checkout: CartService.getCheckout(),
}

export default state;
