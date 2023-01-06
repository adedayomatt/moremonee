(window.webpackJsonp=window.webpackJsonp||[]).push([[16],{16:function(t,e,i){"use strict";i.r(e);var n=i(1);function r(t,e){var i=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),i.push.apply(i,n)}return i}function a(t){for(var e=1;e<arguments.length;e++){var i=null!=arguments[e]?arguments[e]:{};e%2?r(Object(i),!0).forEach((function(e){c(t,e,i[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(i)):r(Object(i)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(i,e))}))}return t}function c(t,e,i){return e in t?Object.defineProperty(t,e,{value:i,enumerable:!0,configurable:!0,writable:!0}):t[e]=i,t}var u={name:"ProductCartItemQuantity",props:{product:Object},data:function(){return{item:{}}},computed:a(a({},Object(n.c)(["cart"])),{},{inStock:function(){return this.product.in_stock>0},quantity:function(){return parseInt(this.item.quantity)}}),methods:{addToCart:function(){var t=this;!isNaN(this.quantity)&&this.quantity>0?this.$store.dispatch("addCartItem",{quantity:this.quantity,product:this.product}).then((function(e){t.item=e})):this.item.id&&this.$store.dispatch("removeCartItem",this.item)},increaseCartQuantity:function(){this.item.quantity++,this.addToCart()},decreaseCartQuantity:function(){this.quantity>0&&(this.item.quantity--,this.addToCart())}},watch:{cart:{immediate:!0,handler:function(){var t=this,e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[],i=e.find((function(e){return e.product.id===t.product.id}));this.item=i||{quantity:0}}}}},o=i(0),s=Object(o.a)(u,(function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",[i("app-input",{attrs:{placeholder:"Quantity",min:"0",max:t.product.in_stock,type:"number",disabled:!t.inStock,"append-icon":"fe fe-plus","prepend-icon":"fe fe-minus","on-append-click":t.increaseCartQuantity,"on-prepend-click":t.decreaseCartQuantity},on:{input:t.addToCart},model:{value:t.item.quantity,callback:function(e){t.$set(t.item,"quantity",e)},expression:"item.quantity"}}),t._v(" "),i("div",{staticClass:"text-right"},[i("small",{staticClass:"text-muted"},[t._v("Total: "+t._s(t._f("money")(t.item.quantity*t.product.price,t.product.currency)))])])],1)}),[],!1,null,null,null);e.default=s.exports}}]);