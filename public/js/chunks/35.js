(window.webpackJsonp=window.webpackJsonp||[]).push([[35],{Oins:function(t,e,n){"use strict";n.r(e);n("07d7"),n("PKPk"),n("3bBZ"),n("SYor"),n("qePV"),n("+2oP");var o=n("+r6/"),a=n("BLC3"),i=n("7Ql6"),u=n("W51F"),c=n("Fs6k"),r=n("tvh2"),s={components:{LayoutVertical:function(){return Promise.all([n.e(0),n.e(3),n.e(5),n.e(10),n.e(22)]).then(n.bind(null,"o/Oa"))},LayoutHorizontal:function(){return Promise.all([n.e(0),n.e(3),n.e(5),n.e(10),n.e(14)]).then(n.bind(null,"a91S"))},LayoutFull:function(){return n.e(36).then(n.bind(null,"nkCL"))}},computed:{layout:function(){return"full"===this.$route.meta.layout?"layout-full":"layout-".concat(this.contentLayoutType)},contentLayoutType:function(){return this.$store.state.appConfig.layout.type}},beforeCreate:function(){for(var t=["primary","secondary","success","info","warning","danger","light","dark"],e=0,n=t.length;e<n;e++)o.b[t[e]]=Object(c.a)("--".concat(t[e]),document.documentElement).value.trim();for(var a=["xs","sm","md","lg","xl"],i=0,u=a.length;i<u;i++)o.a[a[i]]=Number(Object(c.a)("--breakpoint-".concat(a[i]),document.documentElement).value.slice(0,-2));var r=o.c.layout.isRTL;document.documentElement.setAttribute("dir",r?"rtl":"ltr")},setup:function(){var t=Object(u.a)(),e=t.skin,n=t.skinClasses;"dark"===e.value&&document.body.classList.add("dark-layout"),Object(a.provideToast)({hideProgressBar:!0,closeOnClick:!1,closeButton:!1,icon:!1,timeout:3e3,transition:"Vue-Toastification__fade"}),r.a.commit("app/UPDATE_WINDOW_WIDTH",window.innerWidth);var o=Object(c.b)().width;return Object(i.watch)(o,(function(t){r.a.commit("app/UPDATE_WINDOW_WIDTH",t)})),{skinClasses:n}}},l=n("KHd+"),p=Object(l.a)(s,(function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"h-100",class:[this.skinClasses],attrs:{id:"app"}},[e(this.layout,{tag:"component"})],1)}),[],!1,null,null,null);e.default=p.exports},W51F:function(t,e,n){"use strict";n.d(e,"a",(function(){return i}));var o=n("7Ql6"),a=n("tvh2");function i(){var t=Object(o.computed)({get:function(){return a.a.state.verticalMenu.isVerticalMenuCollapsed},set:function(t){a.a.commit("verticalMenu/UPDATE_VERTICAL_MENU_COLLAPSED",t)}}),e=Object(o.computed)({get:function(){return a.a.state.appConfig.layout.isRTL},set:function(t){a.a.commit("appConfig/TOGGLE_RTL",t)}}),n=Object(o.computed)({get:function(){return a.a.state.appConfig.layout.skin},set:function(t){a.a.commit("appConfig/UPDATE_SKIN",t)}}),i=Object(o.computed)((function(){return"bordered"===n.value?"bordered-layout":"semi-dark"===n.value?"semi-dark-layout":null})),u=Object(o.computed)({get:function(){return a.a.state.appConfig.layout.routerTransition},set:function(t){a.a.commit("appConfig/UPDATE_ROUTER_TRANSITION",t)}}),c=Object(o.computed)({get:function(){return a.a.state.appConfig.layout.type},set:function(t){a.a.commit("appConfig/UPDATE_LAYOUT_TYPE",t)}});Object(o.watch)(c,(function(t){"horizontal"===t&&"semi-dark"===n.value&&(n.value="light")}));var r=Object(o.computed)({get:function(){return a.a.state.appConfig.layout.contentWidth},set:function(t){a.a.commit("appConfig/UPDATE_CONTENT_WIDTH",t)}}),s=Object(o.computed)({get:function(){return a.a.state.appConfig.layout.menu.hidden},set:function(t){a.a.commit("appConfig/UPDATE_NAV_MENU_HIDDEN",t)}}),l=Object(o.computed)({get:function(){return a.a.state.appConfig.layout.navbar.backgroundColor},set:function(t){a.a.commit("appConfig/UPDATE_NAVBAR_CONFIG",{backgroundColor:t})}}),p=Object(o.computed)({get:function(){return a.a.state.appConfig.layout.navbar.type},set:function(t){a.a.commit("appConfig/UPDATE_NAVBAR_CONFIG",{type:t})}}),f=Object(o.computed)({get:function(){return a.a.state.appConfig.layout.footer.type},set:function(t){a.a.commit("appConfig/UPDATE_FOOTER_CONFIG",{type:t})}});return{isVerticalMenuCollapsed:t,isRTL:e,skin:n,skinClasses:i,routerTransition:u,navbarBackgroundColor:l,navbarType:p,footerType:f,layoutType:c,contentWidth:r,isNavMenuHidden:s}}}}]);