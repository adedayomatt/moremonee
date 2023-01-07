(window.webpackJsonp=window.webpackJsonp||[]).push([[4,11,12,13,15,18,19],{10:function(t,e,r){"use strict";r.r(e);var i={name:"CartItem",components:{},props:{item:Object},data:function(){return{}},computed:{product:function(){return this.item.product}}},s=r(0),a=Object(s.a)(i,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"row"},[r("div",{staticClass:"col-4"},[r("img",{staticClass:"w-100",attrs:{src:t.product.preview.url}})]),t._v(" "),r("div",{staticClass:"col-8"},[r("div",{staticClass:"d-flex justify-content-between"},[r("h4",[t._v(t._s(t.product.name))]),t._v(" "),r("strong",[t._v(t._s(t._f("money")(t.product.price,t.product.currency)))])]),t._v(" "),r("div",{staticClass:"text-muter"},[r("div",{staticClass:"d-flex justify-content-between align-content-center text-muted "},[r("span",{staticClass:"font-size-sm"},[t._v("Quantity:")]),t._v(" "),r("span",[t._v(t._s(t.item.quantity))])]),t._v(" "),r("div",{staticClass:"d-flex justify-content-between align-content-center text-muted"},[r("span",{staticClass:"font-size-sm"},[t._v("Total:")]),t._v(" "),r("span",[t._v(t._s(t._f("money")(t.item.quantity*t.product.price,t.product.currency)))])])])])])}),[],!1,null,null,null);e.default=a.exports},15:function(t,e,r){"use strict";r.r(e);var i=r(1);function s(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);e&&(i=i.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,i)}return r}function a(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}var n={name:"Cart",components:{CartItem:r(10).default},data:function(){return{}},computed:function(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?s(Object(r),!0).forEach((function(e){a(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):s(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}({},Object(i.c)(["cart"])),methods:{hide:function(){this.$refs.modal.hide()},show:function(){this.$refs.modal.show()}}},c=r(0),o=Object(c.a)(n,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("modal-vertical",{ref:"modal",attrs:{title:"Your Cart",backdrop:"static",keyboard:!1,direction:"right",size:"sm","has-footer":!0},on:{close:t.hide}},[t.cart.length?[t._l(t.cart,(function(e,i){return[r("cart-item",{key:e.id,attrs:{item:e}}),t._v(" "),i<t.cart.length-1?r("hr",{staticClass:"my-3"}):t._e()]}))]:[r("div",{staticClass:"text-center text-muted"},[r("h3",[t._v("No item added yet")])])]],2)}),[],!1,null,null,null);e.default=o.exports},17:function(t,e,r){"use strict";r.r(e);var i=r(1);function s(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);e&&(i=i.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,i)}return r}function a(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?s(Object(r),!0).forEach((function(e){n(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):s(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}function n(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}var c={name:"ProductCartItemQuantity",props:{product:Object},data:function(){return{item:{}}},computed:a(a({},Object(i.c)(["cart"])),{},{maxLimit:function(){return this.product.in_stock},inStock:function(){return this.product.in_stock>0},quantity:function(){return parseInt(this.item.quantity)},limitReached:function(){return this.quantity>=this.maxLimit}}),methods:{addToCart:function(){var t=this;!isNaN(this.quantity)&&this.quantity>0?this.$store.dispatch("addCartItem",{quantity:this.quantity>=this.maxLimit?this.maxLimit:this.quantity,product:this.product}).then((function(e){t.item=e})):this.item.id&&this.$store.dispatch("removeCartItem",this.item)},increaseCartQuantity:function(){this.item.quantity++,this.limitReached&&(this.item.quantity=this.maxLimit),this.addToCart()},decreaseCartQuantity:function(){this.quantity>0&&(this.item.quantity--,this.addToCart())}},watch:{cart:{immediate:!0,handler:function(){var t=this,e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[],r=e.find((function(e){return e.product.id===t.product.id}));this.item=r||{quantity:0}}}}},o=r(0),u=Object(o.a)(c,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("app-input",{attrs:{placeholder:"Quantity",min:"0",max:t.product.in_stock,type:"number",disabled:!t.inStock,"append-icon":"fe fe-plus","prepend-icon":"fe fe-minus","on-append-click":t.increaseCartQuantity,"on-prepend-click":t.decreaseCartQuantity},on:{input:t.addToCart},model:{value:t.item.quantity,callback:function(e){t.$set(t.item,"quantity",e)},expression:"item.quantity"}}),t._v(" "),t.inStock&&t.limitReached?r("small",{staticClass:"text-danger mt-n3"},[t._v("Stock limit of "+t._s(t.product.in_stock)+" reached")]):t._e(),t._v(" "),r("div",{staticClass:"text-right"},[r("small",{staticClass:"text-muted"},[t._v("Total: "+t._s(t._f("money")(t.item.quantity*t.product.price,t.product.currency)))])])],1)}),[],!1,null,null,null);e.default=u.exports},18:function(t,e,r){"use strict";r.r(e);var i={name:"ProductMedia",components:{},props:{product:Object},computed:{},data:function(){return{}},methods:{}},s=r(0),a=Object(s.a)(i,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",t._l(t.product.media,(function(e,i){return r("div",{key:i,staticClass:"my-2"},["image"===e.type?r("img",{staticClass:"d-block mx-auto",attrs:{src:e.url,height:"500px",width:"auto",alt:t.product.name}}):"video"===e.type?r("video",{staticClass:"d-block w-100 mx-auto",attrs:{src:e.url,controls:""}}):t._e()])})),0)}),[],!1,null,null,null);e.default=a.exports},24:function(t,e,r){"use strict";r.r(e);var i=r(17),s={name:"Product",components:{ProductMedia:r(18).default,ProductCartItemQuantity:i.default},props:{product:Object},computed:{inStock:function(){return this.product.in_stock>0},preview:function(){return this.product.preview&&this.product.preview.url?this.product.preview.url:null}},data:function(){return{}},methods:{}},a=r(0),n=Object(a.a)(s,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("modal",{ref:"modal",attrs:{title:t.product.name,size:"lg"}},[r("p",[t._v(t._s(t.product.description))]),t._v(" "),r("product-media",{attrs:{product:t.product}})],1),t._v(" "),r("div",{staticClass:"row bg-white rounded-lg shadow-lg"},[r("div",{staticClass:"col-md-4 px-0 mx-0 text-center"},[r("div",{staticClass:"p-2"},[r("img",{staticClass:"w-100 rounded-start rounded-lg cursor-pointer",attrs:{src:t.preview},on:{click:function(e){return t.$refs.modal.show()}}}),t._v(" "),r("span",{class:"my-1 translate-middle badge rounded-pill text-white "+(t.inStock?"bg-success":"bg-danger")},[t._v("\n                "+t._s(t.inStock?"In stock":"Out of stock")+"\n                ")])])]),t._v(" "),r("div",{staticClass:"col-md-8"},[r("div",{staticClass:"p-3 mt-4"},[r("div",{staticClass:"d-flex justify-content-between"},[r("a",{attrs:{href:"#"},on:{click:function(e){return e.preventDefault(),t.$refs.modal.show()}}},[r("h2",{staticClass:"text-primary"},[t._v(t._s(t.product.name))])]),t._v(" "),r("h4",{staticClass:"strong"},[t._v(t._s(t._f("money")(t.product.price,t.product.currency)))])]),t._v(" "),r("p",{staticClass:"text-truncate"},[t._v(t._s(t.product.short_description))]),t._v(" "),r("small",{staticClass:"text-muted"},[t._v("Enter quantity to purchase")]),t._v(" "),r("product-cart-item-quantity",{attrs:{product:t.product}})],1)])])],1)}),[],!1,null,null,null);e.default=n.exports},4:function(t,e,r){"use strict";r.r(e);var i=r(1),s=r(15);function a(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);e&&(i=i.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,i)}return r}function n(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?a(Object(r),!0).forEach((function(e){c(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):a(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}function c(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}var o={name:"CommerceApp",components:{CartCheckout:r(16).default,CartModal:s.default},data:function(){return{}},computed:n(n({},Object(i.c)(["cart","toast"])),{},{config:function(){return this.$page.props.config}}),methods:n(n(n({},Object(i.b)(["clearCartItem"])),Object(i.d)(["SET_TOAST","SET_TEMP_USER","SET_CURRENCY"])),{},{currencyChange:function(t){var e=this;t?(this.SET_CURRENCY(t),this.$inertia.visit(route("commerce",{currency:t}),{onSuccess:function(){e.clearCartItem()}})):this.SET_TOAST({show:!0,type:"danger",message:"You need to select a currency"})}}),watch:{$page:{immediate:!0,handler:function(t){var e,r=this,i=t.props.toast,s=t.props.transaction;if(i.message&&this.SET_TOAST({show:!0,type:i.type?"error"===i.type?"danger":i.type:"primary",message:i.message,stick:i.stick}),s)switch(s.action_required){case"clear_cart":this.clearCartItem()}t.props.tempUser&&this.SET_TEMP_USER(t.props.tempUser),this.SET_CURRENCY((null===(e=t.props.tempUser)||void 0===e?void 0:e.currency)||t.props.config.default_currency),this.cart.length&&!this.cart.every((function(t){return t.product.currency===r.$store.getters.currency}))&&this.clearCartItem()}}}},u=r(0),l=Object(u.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("cart-modal",{ref:"cart"}),t._v(" "),r("nav",{staticClass:"navbar navbar-expand-lg navbar-light fixed-top",attrs:{id:"topnav"}},[r("div",{staticClass:"container px-2 align-items-center"},[r("inertia-link",{staticClass:"navbar-brand mr-auto",attrs:{href:t.route("commerce",[t.$store.getters.currency])}},[r("div",{staticClass:"d-flex align-items-center"},[r("img",{staticClass:"navbar-brand-img",attrs:{src:t.config.logo_url,alt:t.config.business_name}}),t._v(" "),r("h3",{staticClass:"text-primary ml-2"},[t._v(t._s(t.config.business_name))])])]),t._v(" "),t.config.enable_multiple_currency?r("div",{staticClass:"mx-2",staticStyle:{width:"180px"}},[r("x-select",{staticClass:"mr-2 w-100",attrs:{options:t.config.currencies||[],value:t.$store.getters.currency},on:{input:t.currencyChange}})],1):t._e(),t._v(" "),r("div",{staticClass:"navbar-user position-relative"},[r("inertia-link",{staticClass:"navbar-user-link",attrs:{href:"#",role:"button"},on:{click:function(e){return e.preventDefault(),t.$refs.cart.show()}}},[r("span",{staticClass:"position-absolute text-center bg-primary text-white d-flex justify-content-center align-items-center",staticStyle:{height:"30px",width:"30px","border-radius":"50%",right:"-15px",top:"-10px"}},[t._v("\n                        "+t._s(t.$store.getters.cartItemsTotal>=100?"99+":t.$store.getters.cartItemsTotal)+"\n                    ")]),t._v(" "),r("i",{staticClass:"fe fe-shopping-cart",staticStyle:{"font-size":"28px"}})])],1)],1)]),t._v(" "),r("main",{staticClass:"main-content pt-6 mx-2",staticStyle:{"min-height":"90vh"}},[t._t("default")],2),t._v(" "),t.toast.show?r("div",{staticClass:"d-flex justify-content-center position-fixed w-100",staticStyle:{"z-index":"99999",bottom:"10px"}},[r("div",{class:"alert alert-"+t.toast.type+" alert-dismissible fade show mx-2",attrs:{role:"alert"}},[r("div",{domProps:{innerHTML:t._s(t.toast.message)}}),t._v(" "),t._m(0)])]):t._e(),t._v(" "),r("footer",{staticClass:"my-5 pt-5 pb-3 text-muted text-center"},[r("p",{staticClass:"mb-1"},[t._v("© "+t._s((new Date).getFullYear())+" MoreMonee")]),t._v(" "),r("ul",{staticClass:"mt-4 list-inline font-size-lg"},[t.config.facebook_url?r("li",{staticClass:"list-inline-item"},[r("a",{attrs:{href:t.config.facebook_url,target:"_blank"}},[r("i",{staticClass:"fe fe-facebook"})])]):t._e(),t._v(" "),t.config.instagram_url?r("li",{staticClass:"list-inline-item"},[r("a",{attrs:{href:t.config.instagram_url,target:"_blank"}},[r("i",{staticClass:"fe fe-instagram"})])]):t._e(),t._v(" "),t.config.whatsapp_url?r("li",{staticClass:"list-inline-item"},[r("a",{attrs:{href:t.config.whatsapp_url,target:"_blank"}},[r("i",{staticClass:"fe fe-phone"})])]):t._e()])]),t._v(" "),t.route().current("commerce")||t.route().current("orders")?r("div",{staticClass:"pb-5"}):t._e(),t._v(" "),t.route().current("commerce")||t.route().current("orders")?r("nav",{staticClass:"navbar fixed-bottom bg-light"},[r("div",{staticClass:"container-fluid"},[r("cart-checkout")],1)]):t._e()],1)}),[function(){var t=this.$createElement,e=this._self._c||t;return e("button",{staticClass:"close",attrs:{type:"button","data-dismiss":"alert","aria-label":"Close"}},[e("span",{attrs:{"aria-hidden":"true"}},[this._v("×")])])}],!1,null,null,null);e.default=l.exports},55:function(t,e,r){"use strict";r.r(e);var i=r(4),s=r(24),a=r(1);function n(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);e&&(i=i.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,i)}return r}function c(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}var o={name:"Products",components:{Product:s.default},layout:function(t,e){return t(i.default,[e])},props:{products:Object},computed:function(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?n(Object(r),!0).forEach((function(e){c(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):n(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}({},Object(a.c)(["cart","cartItemsTotal"]))},u=r(0),l=Object(u.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"container py-4"},[t._m(0),t._v(" "),r("hr",{staticClass:"my-5"}),t._v(" "),r("h2",{staticClass:"text-center"},[t._v("Available POS")]),t._v(" "),t.products.total?r("div",[r("div",{staticClass:"row justify-content-center"},t._l(t.products.data,(function(t){return r("div",{staticClass:"col-lg-4 col-md-6"},[r("product",{key:t.id,staticClass:"m-2",attrs:{product:t}})],1)})),0),t._v(" "),r("div",{staticClass:"d-flex justify-content-center mt-5"},[r("pagination",{attrs:{links:t.products}})],1)]):r("div",{staticClass:"text-muted text-center"},[r("h2",[t._v("No POS available for purchase at the moment")]),t._v(" "),r("p",[t._v("You can check back later")])])])}),[function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"text-center"},[e("h1",{staticClass:"text-primary strong"},[this._v("Establish and build your business with MoreMonee.")]),this._v(" "),e("p",[this._v("Moremonee provides banking solutions that give you the freedom to make quick and easy payments, access loans, make more Profits and help you grow faster financially.")]),this._v(" "),e("a",{staticClass:"btn btn-primary",attrs:{href:"https://moremoneegroup.com/",target:"_blank"}},[this._v("Get to know more")])])}],!1,null,null,null);e.default=l.exports}}]);