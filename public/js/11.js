(window.webpackJsonp=window.webpackJsonp||[]).push([[11,13,15],{10:function(t,e,r){"use strict";r.r(e);var s={name:"CartItem",components:{},props:{item:Object},data:function(){return{}},computed:{product:function(){return this.item.product}}},a=r(0),n=Object(a.a)(s,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"row"},[r("div",{staticClass:"col-4"},[r("img",{staticClass:"w-100",attrs:{src:t.product.preview.url}})]),t._v(" "),r("div",{staticClass:"col-8"},[r("div",{staticClass:"d-flex justify-content-between"},[r("h4",[t._v(t._s(t.product.name))]),t._v(" "),r("strong",[t._v(t._s(t._f("money")(t.product.price,t.product.currency)))])]),t._v(" "),r("div",{staticClass:"text-muter"},[r("div",{staticClass:"d-flex justify-content-between align-content-center text-muted "},[r("span",{staticClass:"font-size-sm"},[t._v("Quantity:")]),t._v(" "),r("span",[t._v(t._s(t.item.quantity))])]),t._v(" "),r("div",{staticClass:"d-flex justify-content-between align-content-center text-muted"},[r("span",{staticClass:"font-size-sm"},[t._v("Total:")]),t._v(" "),r("span",[t._v(t._s(t._f("money")(t.item.quantity*t.product.price,t.product.currency)))])])])])])}),[],!1,null,null,null);e.default=n.exports},15:function(t,e,r){"use strict";r.r(e);var s=r(1);function a(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var s=Object.getOwnPropertySymbols(t);e&&(s=s.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,s)}return r}function n(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}var i={name:"Cart",components:{CartItem:r(10).default},data:function(){return{}},computed:function(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?a(Object(r),!0).forEach((function(e){n(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):a(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}({},Object(s.c)(["cart"])),methods:{hide:function(){this.$refs.modal.hide()},show:function(){this.$refs.modal.show()}}},c=r(0),o=Object(c.a)(i,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("modal-vertical",{ref:"modal",attrs:{title:"Your Cart",backdrop:"static",keyboard:!1,direction:"right",size:"sm","has-footer":!0},on:{close:t.hide}},[t.cart.length?[t._l(t.cart,(function(e,s){return[r("cart-item",{key:e.id,attrs:{item:e}}),t._v(" "),s<t.cart.length-1?r("hr",{staticClass:"my-3"}):t._e()]}))]:[r("div",{staticClass:"text-center text-muted"},[r("h3",[t._v("No item added yet")])])]],2)}),[],!1,null,null,null);e.default=o.exports},4:function(t,e,r){"use strict";r.r(e);var s=r(1),a=r(15);function n(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var s=Object.getOwnPropertySymbols(t);e&&(s=s.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,s)}return r}function i(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?n(Object(r),!0).forEach((function(e){c(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):n(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}function c(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}var o={name:"CommerceApp",components:{CartCheckout:r(16).default,CartModal:a.default},data:function(){return{}},computed:i(i({},Object(s.c)(["cart","toast"])),{},{config:function(){return this.$page.props.config}}),methods:i(i(i({},Object(s.b)(["clearCartItem"])),Object(s.d)(["SET_TOAST","SET_TEMP_USER","SET_CURRENCY"])),{},{currencyChange:function(t){var e=this;t?(this.SET_CURRENCY(t),this.$inertia.visit(route("commerce",{currency:t}),{onSuccess:function(){e.clearCartItem()}})):this.SET_TOAST({show:!0,type:"danger",message:"You need to select a currency"})}}),watch:{$page:{immediate:!0,handler:function(t){var e,r=this,s=t.props.toast,a=t.props.transaction;if(s.message&&this.SET_TOAST({show:!0,type:s.type?"error"===s.type?"danger":s.type:"primary",message:s.message,stick:s.stick}),a)switch(a.action_required){case"clear_cart":this.clearCartItem()}t.props.tempUser&&this.SET_TEMP_USER(t.props.tempUser),this.SET_CURRENCY((null===(e=t.props.tempUser)||void 0===e?void 0:e.currency)||t.props.config.default_currency),this.cart.length&&!this.cart.every((function(t){return t.product.currency===r.$store.getters.currency}))&&this.clearCartItem()}}}},l=r(0),u=Object(l.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("cart-modal",{ref:"cart"}),t._v(" "),r("nav",{staticClass:"navbar navbar-expand-lg navbar-light fixed-top",attrs:{id:"topnav"}},[r("div",{staticClass:"container px-2"},[r("inertia-link",{staticClass:"navbar-brand mr-auto",attrs:{href:t.route("commerce",[t.$store.getters.currency])}},[r("div",{staticClass:"d-flex"},[r("img",{staticClass:"navbar-brand-img",attrs:{src:t.config.logo_url,alt:t.config.business_name}}),t._v(" "),r("h3",{staticClass:"text-primary ml-2"},[t._v(t._s(t.config.business_name))])])]),t._v(" "),t.config.enable_multiple_currency?r("div",{staticClass:"mx-2",staticStyle:{width:"180px"}},[r("x-select",{staticClass:"mr-2 w-100",attrs:{options:t.config.currencies||[],value:t.$store.getters.currency},on:{input:t.currencyChange}})],1):t._e(),t._v(" "),r("div",{staticClass:"navbar-user position-relative"},[r("inertia-link",{staticClass:"navbar-user-link",attrs:{href:"#",role:"button"},on:{click:function(e){return e.preventDefault(),t.$refs.cart.show()}}},[r("span",{staticClass:"position-absolute text-center bg-primary text-white d-flex justify-content-center align-items-center",staticStyle:{height:"30px",width:"30px","border-radius":"50%",right:"-15px",top:"-10px"}},[t._v("\n                        "+t._s(t.$store.getters.cartItemsTotal>=100?"99+":t.$store.getters.cartItemsTotal)+"\n                    ")]),t._v(" "),r("i",{staticClass:"fe fe-shopping-cart",staticStyle:{"font-size":"28px"}})])],1)],1)]),t._v(" "),r("main",{staticClass:"main-content pt-6 mx-2",staticStyle:{"min-height":"90vh"}},[t._t("default")],2),t._v(" "),t.toast.show?r("div",{staticClass:"d-flex justify-content-center position-fixed w-100",staticStyle:{"z-index":"99999",bottom:"10px"}},[r("div",{class:"alert alert-"+t.toast.type+" alert-dismissible fade show mx-2",attrs:{role:"alert"}},[r("div",{domProps:{innerHTML:t._s(t.toast.message)}}),t._v(" "),t._m(0)])]):t._e(),t._v(" "),r("footer",{staticClass:"my-5 pt-5 pb-3 text-muted text-center"},[r("p",{staticClass:"mb-1"},[t._v("© "+t._s((new Date).getFullYear())+" MoreMonee")]),t._v(" "),r("ul",{staticClass:"mt-4 list-inline font-size-lg"},[t.config.facebook_url?r("li",{staticClass:"list-inline-item"},[r("a",{attrs:{href:t.config.facebook_url,target:"_blank"}},[r("i",{staticClass:"fe fe-facebook"})])]):t._e(),t._v(" "),t.config.instagram_url?r("li",{staticClass:"list-inline-item"},[r("a",{attrs:{href:t.config.instagram_url,target:"_blank"}},[r("i",{staticClass:"fe fe-instagram"})])]):t._e(),t._v(" "),t.config.whatsapp_url?r("li",{staticClass:"list-inline-item"},[r("a",{attrs:{href:t.config.whatsapp_url,target:"_blank"}},[r("i",{staticClass:"fe fe-phone"})])]):t._e()])]),t._v(" "),t.route().current("commerce")||t.route().current("orders")?r("div",{staticClass:"pb-4"}):t._e(),t._v(" "),t.route().current("commerce")||t.route().current("orders")?r("nav",{staticClass:"navbar fixed-bottom bg-light"},[r("div",{staticClass:"container-fluid"},[r("cart-checkout")],1)]):t._e()],1)}),[function(){var t=this.$createElement,e=this._self._c||t;return e("button",{staticClass:"close",attrs:{type:"button","data-dismiss":"alert","aria-label":"Close"}},[e("span",{attrs:{"aria-hidden":"true"}},[this._v("×")])])}],!1,null,null,null);e.default=u.exports}}]);