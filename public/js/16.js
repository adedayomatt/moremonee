(window.webpackJsonp=window.webpackJsonp||[]).push([[16],{20:function(e,r,a){"use strict";a.r(r);var t={name:"CreditCard",computed:{errors:function(){return this.$page.props.errors}},props:{loading:Boolean},data:function(){return{form:{name_on_card:"",card_number:"",expiry:"",cvv:""}}},methods:{submit:function(){var e=this.$refs.form;e.checkValidity()?this.$emit("input",this.form):e.classList.add("was-validated")}}},o=a(0),n=Object(o.a)(t,(function(){var e=this,r=e.$createElement,a=e._self._c||r;return a("form",{ref:"form",staticClass:"needs-validation",attrs:{novalidate:""},on:{submit:function(r){return r.preventDefault(),e.submit(r)}}},[a("p",[e._v("Enter your card details below")]),e._v(" "),a("div",{staticClass:"row"},[a("div",{staticClass:"col-12"},[a("label",{attrs:{for:"cc-name"}},[e._v("Name on card")]),e._v(" "),a("app-input",{attrs:{type:"text",id:"cc-name",placeholder:"John Doe",name:"name_on_card",errors:e.errors,"prepend-icon":"fe fe-user",required:""},model:{value:e.form.name_on_card,callback:function(r){e.$set(e.form,"name_on_card",r)},expression:"form.name_on_card"}})],1),e._v(" "),a("div",{staticClass:"col-12"},[a("label",{attrs:{for:"cc-number"}},[e._v("Card number")]),e._v(" "),a("app-input",{attrs:{type:"text",id:"cc-number",placeholder:"1234567890",name:"card_number",errors:e.errors,"prepend-icon":"fe fe-hash",required:""},model:{value:e.form.card_number,callback:function(r){e.$set(e.form,"card_number",r)},expression:"form.card_number"}})],1)]),e._v(" "),a("div",{staticClass:"row"},[a("div",{staticClass:"col-6"},[a("label",{attrs:{for:"cc-expiry"}},[e._v("Expiry")]),e._v(" "),a("app-input",{attrs:{type:"text",id:"cc-expiry",placeholder:"01/25",name:"expiry",errors:e.errors,"prepend-icon":"fe fe-calendar",required:""},model:{value:e.form.expiry,callback:function(r){e.$set(e.form,"expiry",r)},expression:"form.expiry"}})],1),e._v(" "),a("div",{staticClass:"col-6"},[a("label",{attrs:{for:"cc-cvv"}},[e._v("CVV")]),e._v(" "),a("app-input",{attrs:{type:"text",id:"cc-cvv",placeholder:"123",name:"cvv",errors:e.errors,"prepend-icon":"fe fe-lock",required:""},model:{value:e.form.cvv,callback:function(r){e.$set(e.form,"cvv",r)},expression:"form.cvv"}})],1)]),e._v(" "),a("app-button",{staticClass:"btn btn-primary btn-block",attrs:{loading:e.loading,type:"submit"}},[e._v("Make Payment")])],1)}),[],!1,null,null,null);r.default=n.exports}}]);