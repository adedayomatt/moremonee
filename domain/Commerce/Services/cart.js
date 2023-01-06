export default class{

    static storageKey(){
        return 'cart';
    }

    static getCart(){
        const cart = window.localStorage.getItem(this.storageKey()) ? JSON.parse(window.localStorage.getItem(this.storageKey())) : [];
        return cart.map(item => {
            return {
                ...item,
                quantity: parseInt(item.quantity)
            }
        });
    }

    static setCart(cart){
        return window.localStorage.setItem(this.storageKey(), JSON.stringify(cart))
    }

    static clearCart(){
        return this.setCart([]);
    }

    static addCartItem(item){
        const cart = this.getCart();
        let existingItem = cart.find(i => i.product.id == item.product.id);
        if(!existingItem){
            item.id = cart.length+1;
            cart.push(item)
            this.setCart(cart);
            return item;
        }else{
            existingItem = {...item,id: existingItem.id};
            if(existingItem.quantity <= 0) this.removeCartItem(existingItem)
            else this.updateCartItem(existingItem);
            return existingItem;
        }
    }

    static updateCartItem(item){
        const cart = this.getCart();
        const index = cart.findIndex(i => i.id == item.id)
        cart[index] = item;
        this.setCart(cart);
        return item;
    }

    static removeCartItem(item){
        const cart = this.getCart();
        const index = cart.findIndex(i => i.id == item.id)
        if(index < 0) return;
        cart.splice(index, 1)
        this.setCart(cart);
    }

    static findProductInCart(product){
        const cart = this.getCart();
        return cart.find(item => item.product.id == product.id);
    }

    static checkoutKey(){
        return 'checkout';
    }

    static getCheckout(){
        return window.localStorage.getItem(this.checkoutKey()) ? JSON.parse(window.localStorage.getItem(this.checkoutKey())) : {};
    }

    static setCheckout(checkout){
        return window.localStorage.setItem(this.checkoutKey(), JSON.stringify(checkout))
    }

    static setCheckoutData(data){
        return this.setCheckout({
            ...this.getCheckout(),
            ...data
        })
    }

}
