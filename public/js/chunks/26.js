(window.webpackJsonp=window.webpackJsonp||[]).push([[26],{"+BXu":function(t,n,e){(n=e("JPst")(!1)).push([t.i,".misc-wrapper {\n  display: flex;\n  flex-basis: 100%;\n  min-height: 100vh;\n  width: 100%;\n  align-items: center;\n  justify-content: center;\n}\n.misc-wrapper .misc-inner {\n  position: relative;\n  max-width: 750px;\n}\n.misc-wrapper .brand-logo {\n  display: flex;\n  justify-content: center;\n  position: absolute;\n  top: 2rem;\n}\n[dir] .misc-wrapper .brand-logo {\n  margin: 0;\n}\n[dir=ltr] .misc-wrapper .brand-logo {\n  left: 2rem;\n}\n[dir=rtl] .misc-wrapper .brand-logo {\n  right: 2rem;\n}\n.misc-wrapper .brand-logo .brand-text {\n  font-weight: 600;\n}\n.brand-logo svg {\n  height: 28px;\n  width: 40.95px;\n}",""]),t.exports=n},"1lUy":function(t,n){t.exports="/images/pages/error.svg"},C1tz:function(t,n,e){var r=e("+BXu");"string"==typeof r&&(r=[[t.i,r,""]]);var i={hmr:!0,transform:void 0,insertInto:void 0};e("aET+")(r,i);r.locals&&(t.exports=r.locals)},"F+Kf":function(t,n,e){"use strict";e("C1tz")},SRip:function(t,n,e){"use strict";e.d(n,"b",(function(){return f})),e.d(n,"a",(function(){return m}));var r=e("XuX8"),i=e.n(r),s=e("tC49"),c=e("xjcK"),a=e("pyNs"),o=e("Iyau"),l=e("bAY6"),u=e("ex6f"),b=e("OljW"),p=e("z3V6"),d=e("+nMp");function g(t,n,e){return n in t?Object.defineProperty(t,n,{value:e,enumerable:!0,configurable:!0,writable:!0}):t[n]=e,t}var h='<svg width="%{w}" height="%{h}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 %{w} %{h}" preserveAspectRatio="none"><rect width="100%" height="100%" style="fill:%{f};"></rect></svg>',f=Object(p.d)({alt:Object(p.c)(a.t),blank:Object(p.c)(a.g,!1),blankColor:Object(p.c)(a.t,"transparent"),block:Object(p.c)(a.g,!1),center:Object(p.c)(a.g,!1),fluid:Object(p.c)(a.g,!1),fluidGrow:Object(p.c)(a.g,!1),height:Object(p.c)(a.o),left:Object(p.c)(a.g,!1),right:Object(p.c)(a.g,!1),rounded:Object(p.c)(a.j,!1),sizes:Object(p.c)(a.f),src:Object(p.c)(a.t),srcset:Object(p.c)(a.f),thumbnail:Object(p.c)(a.g,!1),width:Object(p.c)(a.o)},c.M),m=i.a.extend({name:c.M,functional:!0,props:f,render:function(t,n){var e,r=n.props,i=n.data,c=r.alt,a=r.src,p=r.block,f=r.fluidGrow,m=r.rounded,w=Object(b.b)(r.width)||null,j=Object(b.b)(r.height)||null,v=null,O=Object(o.b)(r.srcset).filter(l.a).join(","),x=Object(o.b)(r.sizes).filter(l.a).join(",");return r.blank&&(!j&&w?j=w:!w&&j&&(w=j),w||j||(w=1,j=1),a=function(t,n,e){var r=encodeURIComponent(h.replace("%{w}",Object(d.g)(t)).replace("%{h}",Object(d.g)(n)).replace("%{f}",e));return"data:image/svg+xml;charset=UTF-8,".concat(r)}(w,j,r.blankColor||"transparent"),O=null,x=null),r.left?v="float-left":r.right?v="float-right":r.center&&(v="mx-auto",p=!0),t("img",Object(s.a)(i,{attrs:{src:a,alt:c,width:w?Object(d.g)(w):null,height:j?Object(d.g)(j):null,srcset:O||null,sizes:x||null},class:(e={"img-thumbnail":r.thumbnail,"img-fluid":r.fluid||f,"w-100":f,rounded:""===m||!0===m},g(e,"rounded-".concat(m),Object(u.n)(m)&&""!==m),g(e,v,v),g(e,"d-block",p),e)}))}})},TiO6:function(t,n,e){"use strict";e.r(n);var r=e("GUe+"),i=e("SRip"),s=e("tvh2"),c={components:{BButton:r.a,BImg:i.a},data:function(){return{downImg:e("1lUy")}},computed:{imgUrl:function(){return"dark"===s.a.state.appConfig.layout.skin?(this.downImg=e("ZBCI"),this.downImg):this.downImg}}},a=(e("F+Kf"),e("KHd+")),o=Object(a.a)(c,(function(){var t=this.$createElement,n=this._self._c||t;return n("div",{staticClass:"misc-wrapper"},[n("div",{staticClass:"misc-inner p-2 p-sm-3"},[n("div",{staticClass:"w-100 text-center"},[n("h2",{staticClass:"mb-1"},[this._v("\n          Page Not Found 🕵🏻‍♀️\n        ")]),this._v(" "),n("p",{staticClass:"mb-2"},[this._v("\n          Oops! 😖 The requested URL was not found on this server.\n        ")]),this._v(" "),n("b-button",{staticClass:"mb-2 btn-sm-block",attrs:{variant:"primary",to:{path:"/"}}},[this._v("\n          Back to home\n        ")]),this._v(" "),n("b-img",{attrs:{fluid:"",src:this.imgUrl,alt:"Error page"}})],1)])])}),[],!1,null,null,null);n.default=o.exports},ZBCI:function(t,n){t.exports="/images/pages/error-dark.svg"}}]);