(window.webpackJsonp=window.webpackJsonp||[]).push([[9],{20:function(t,e,n){"use strict";n.r(e);var a={name:"Redirect",computed:{transaction:function(){return this.$page.props.transaction}},data:function(){return{open:!0}},created:function(){var t=this,e=window.addEventListener?"addEventListener":"attachEvent";(0,window[e])("attachEvent"==e?"onmessage":"message",(function(e){["https://ravesandboxapi.flutterwave.com","https://api.flutterwave.com"].includes(e.origin)&&(t.open=!1,t.$emit("callback",e.data))}),!1)}},i=(n(39),n(0)),r=Object(i.a)(a,(function(){var t=this.$createElement,e=this._self._c||t;return e("div",[e("div",{staticClass:"frame-container"},[e("div",{staticClass:"frame-container-inner"},[e("iframe",{attrs:{src:this.transaction.redirect}})])]),this._v(" "),e("h4",{staticClass:"text-center"},[this._v("Kindly complete the transaction in pop up")])])}),[],!1,null,"98383cb8",null);e.default=r.exports},28:function(t,e,n){var a=n(40);"string"==typeof a&&(a=[[t.i,a,""]]);var i={hmr:!0,transform:void 0,insertInto:void 0};n(12)(a,i);a.locals&&(t.exports=a.locals)},39:function(t,e,n){"use strict";n(28)},40:function(t,e,n){(t.exports=n(11)(!1)).push([t.i,".frame-container[data-v-98383cb8]{position:fixed;top:0;bottom:0;left:0;right:0;height:100vh;display:flex;justify-content:center;align-items:center;background:rgba(0,0,0,.5);z-index:99999999}.frame-container .frame-container-inner[data-v-98383cb8]{background:#fff}.frame-container iframe[data-v-98383cb8]{border:none;width:100%;height:100%}@media screen and (min-width:768px){.frame-container .frame-container-inner[data-v-98383cb8]{width:80%;height:80vh}}",""])}}]);