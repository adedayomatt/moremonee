(window.webpackJsonp=window.webpackJsonp||[]).push([[18],{22:function(t,e,n){"use strict";n.r(e);var s={name:"Transaction",components:{},props:{transaction:Object},data:function(){return{}},computed:{items:function(){return[{label:"Reference",value:this.transaction.reference},{label:"Amount",value:this.$options.filters.money(this.transaction.amount,this.transaction.currency)},{label:"Status",value:this.transaction.status},{label:"Time",value:this.$options.filters.datetime(this.transaction.created_at)}]}}},a=n(0),i=Object(a.a)(s,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("ul",{staticClass:"list-group mb-3"},t._l(t.items,(function(e){return n("li",{staticClass:"list-group-item"},[n("small",{staticClass:"text-muted"},[t._v(t._s(e.label))]),t._v(" "),n("div",[n("strong",[t._v(t._s(e.value))])])])})),0)}),[],!1,null,null,null);e.default=i.exports}}]);