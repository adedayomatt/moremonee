(window.webpackJsonp=window.webpackJsonp||[]).push([[9],{22:function(t,n,e){"use strict";e.r(n);var a={name:"Redirect",computed:{transaction:function(){return this.$page.props.transaction},allowedDomains:function(){return this.$page.props.config.allowed_cross_origin_domains}},data:function(){return{open:!0}},created:function(){var t=this,n=window.addEventListener?"addEventListener":"attachEvent";(0,window[n])("attachEvent"==n?"onmessage":"message",(function(n){t.allowedDomains.includes(n.origin)&&t.$emit("callback",n.data)}),!1)}},i=(e(43),e(0)),r=Object(i.a)(a,(function(){var t=this.$createElement,n=this._self._c||t;return n("div",[n("div",{staticClass:"frame-container"},[n("div",{staticClass:"frame-container-inner"},[n("iframe",{attrs:{src:this.transaction.redirect}})])]),this._v(" "),n("h4",{staticClass:"text-center"},[this._v("Kindly complete the transaction in pop up")])])}),[],!1,null,"0253f8ca",null);n.default=r.exports},31:function(t,n,e){var a=e(44);"string"==typeof a&&(a=[[t.i,a,""]]);var i={hmr:!0,transform:void 0,insertInto:void 0};e(9)(a,i);a.locals&&(t.exports=a.locals)},43:function(t,n,e){"use strict";e(31)},44:function(t,n,e){(t.exports=e(8)(!1)).push([t.i,".frame-container[data-v-0253f8ca]{position:fixed;top:0;bottom:0;left:0;right:0;height:100vh;display:flex;justify-content:center;align-items:center;background:rgba(0,0,0,.5);z-index:99999999}.frame-container .frame-container-inner[data-v-0253f8ca]{background:#fff}.frame-container iframe[data-v-0253f8ca]{border:none;width:100%;height:100%}@media screen and (min-width:768px){.frame-container .frame-container-inner[data-v-0253f8ca]{width:80%;height:80vh}}",""])}}]);