(window.webpackJsonp=window.webpackJsonp||[]).push([[13],{8:function(t,e,s){"use strict";s.r(e);var n={name:"CartItem",components:{},props:{item:Object},data:function(){return{}},computed:{product:function(){return this.item.product}}},c=s(0),i=Object(c.a)(n,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"row"},[s("div",{staticClass:"col-4"},[s("img",{staticClass:"w-100",attrs:{src:t.product.preview.url}})]),t._v(" "),s("div",{staticClass:"col-8"},[s("div",{staticClass:"d-flex justify-content-between"},[s("h4",[t._v(t._s(t.product.name))]),t._v(" "),s("strong",[t._v(t._s(t._f("money")(t.product.price,t.product.currency)))])]),t._v(" "),s("div",{staticClass:"text-muter"},[s("div",{staticClass:"d-flex justify-content-between align-content-center text-muted "},[s("span",{staticClass:"font-size-sm"},[t._v("Quantity:")]),t._v(" "),s("span",[t._v(t._s(t.item.quantity))])]),t._v(" "),s("div",{staticClass:"d-flex justify-content-between align-content-center text-muted"},[s("span",{staticClass:"font-size-sm"},[t._v("Total:")]),t._v(" "),s("span",[t._v(t._s(t._f("money")(t.item.quantity*t.product.price,t.product.currency)))])])])])])}),[],!1,null,null,null);e.default=i.exports}}]);