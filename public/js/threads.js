(window.webpackJsonp=window.webpackJsonp||[]).push([[4],{"/LVl":function(e,t,n){window.Vue=n("XuX8"),Vue.component("threads-component",n("yLca").default);new Vue({el:"#app"})},1:function(e,t,n){e.exports=n("/LVl")},"8oxB":function(e,t){var n,o,i=e.exports={};function r(){throw new Error("setTimeout has not been defined")}function a(){throw new Error("clearTimeout has not been defined")}function s(e){if(n===setTimeout)return setTimeout(e,0);if((n===r||!n)&&setTimeout)return n=setTimeout,setTimeout(e,0);try{return n(e,0)}catch(t){try{return n.call(null,e,0)}catch(t){return n.call(this,e,0)}}}!function(){try{n="function"==typeof setTimeout?setTimeout:r}catch(e){n=r}try{o="function"==typeof clearTimeout?clearTimeout:a}catch(e){o=a}}();var c,l=[],d=!1,u=-1;function f(){d&&c&&(d=!1,c.length?l=c.concat(l):u=-1,l.length&&h())}function h(){if(!d){var e=s(f);d=!0;for(var t=l.length;t;){for(c=l,l=[];++u<t;)c&&c[u].run();u=-1,t=l.length}c=null,d=!1,function(e){if(o===clearTimeout)return clearTimeout(e);if((o===a||!o)&&clearTimeout)return o=clearTimeout,clearTimeout(e);try{o(e)}catch(t){try{return o.call(null,e)}catch(t){return o.call(this,e)}}}(e)}}function p(e,t){this.fun=e,this.array=t}function m(){}i.nextTick=function(e){var t=new Array(arguments.length-1);if(arguments.length>1)for(var n=1;n<arguments.length;n++)t[n-1]=arguments[n];l.push(new p(e,t)),1!==l.length||d||s(h)},p.prototype.run=function(){this.fun.apply(null,this.array)},i.title="browser",i.browser=!0,i.env={},i.argv=[],i.version="",i.versions={},i.on=m,i.addListener=m,i.once=m,i.off=m,i.removeListener=m,i.removeAllListeners=m,i.emit=m,i.prependListener=m,i.prependOnceListener=m,i.listeners=function(e){return[]},i.binding=function(e){throw new Error("process.binding is not supported")},i.cwd=function(){return"/"},i.chdir=function(e){throw new Error("process.chdir is not supported")},i.umask=function(){return 0}},"KHd+":function(e,t,n){"use strict";function o(e,t,n,o,i,r,a,s){var c,l="function"==typeof e?e.options:e;if(t&&(l.render=t,l.staticRenderFns=n,l._compiled=!0),o&&(l.functional=!0),r&&(l._scopeId="data-v-"+r),a?(c=function(e){(e=e||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(e=__VUE_SSR_CONTEXT__),i&&i.call(this,e),e&&e._registeredComponents&&e._registeredComponents.add(a)},l._ssrRegister=c):i&&(c=s?function(){i.call(this,(l.functional?this.parent:this).$root.$options.shadowRoot)}:i),c)if(l.functional){l._injectStyles=c;var d=l.render;l.render=function(e,t){return c.call(t),d(e,t)}}else{var u=l.beforeCreate;l.beforeCreate=u?[].concat(u,c):[c]}return{exports:e,options:l}}n.d(t,"a",(function(){return o}))},URgk:function(e,t,n){(function(e){var o=void 0!==e&&e||"undefined"!=typeof self&&self||window,i=Function.prototype.apply;function r(e,t){this._id=e,this._clearFn=t}t.setTimeout=function(){return new r(i.call(setTimeout,o,arguments),clearTimeout)},t.setInterval=function(){return new r(i.call(setInterval,o,arguments),clearInterval)},t.clearTimeout=t.clearInterval=function(e){e&&e.close()},r.prototype.unref=r.prototype.ref=function(){},r.prototype.close=function(){this._clearFn.call(o,this._id)},t.enroll=function(e,t){clearTimeout(e._idleTimeoutId),e._idleTimeout=t},t.unenroll=function(e){clearTimeout(e._idleTimeoutId),e._idleTimeout=-1},t._unrefActive=t.active=function(e){clearTimeout(e._idleTimeoutId);var t=e._idleTimeout;t>=0&&(e._idleTimeoutId=setTimeout((function(){e._onTimeout&&e._onTimeout()}),t))},n("YBdB"),t.setImmediate="undefined"!=typeof self&&self.setImmediate||void 0!==e&&e.setImmediate||this&&this.setImmediate,t.clearImmediate="undefined"!=typeof self&&self.clearImmediate||void 0!==e&&e.clearImmediate||this&&this.clearImmediate}).call(this,n("yLpj"))},YBdB:function(e,t,n){(function(e,t){!function(e,n){"use strict";if(!e.setImmediate){var o,i,r,a,s,c=1,l={},d=!1,u=e.document,f=Object.getPrototypeOf&&Object.getPrototypeOf(e);f=f&&f.setTimeout?f:e,"[object process]"==={}.toString.call(e.process)?o=function(e){t.nextTick((function(){p(e)}))}:!function(){if(e.postMessage&&!e.importScripts){var t=!0,n=e.onmessage;return e.onmessage=function(){t=!1},e.postMessage("","*"),e.onmessage=n,t}}()?e.MessageChannel?((r=new MessageChannel).port1.onmessage=function(e){p(e.data)},o=function(e){r.port2.postMessage(e)}):u&&"onreadystatechange"in u.createElement("script")?(i=u.documentElement,o=function(e){var t=u.createElement("script");t.onreadystatechange=function(){p(e),t.onreadystatechange=null,i.removeChild(t),t=null},i.appendChild(t)}):o=function(e){setTimeout(p,0,e)}:(a="setImmediate$"+Math.random()+"$",s=function(t){t.source===e&&"string"==typeof t.data&&0===t.data.indexOf(a)&&p(+t.data.slice(a.length))},e.addEventListener?e.addEventListener("message",s,!1):e.attachEvent("onmessage",s),o=function(t){e.postMessage(a+t,"*")}),f.setImmediate=function(e){"function"!=typeof e&&(e=new Function(""+e));for(var t=new Array(arguments.length-1),n=0;n<t.length;n++)t[n]=arguments[n+1];var i={callback:e,args:t};return l[c]=i,o(c),c++},f.clearImmediate=h}function h(e){delete l[e]}function p(e){if(d)setTimeout(p,0,e);else{var t=l[e];if(t){d=!0;try{!function(e){var t=e.callback,n=e.args;switch(n.length){case 0:t();break;case 1:t(n[0]);break;case 2:t(n[0],n[1]);break;case 3:t(n[0],n[1],n[2]);break;default:t.apply(void 0,n)}}(t)}finally{h(e),d=!1}}}}}("undefined"==typeof self?void 0===e?this:e:self)}).call(this,n("yLpj"),n("8oxB"))},yLca:function(e,t,n){"use strict";n.r(t);var o={props:["title","thread","reply","open","new_thread","thread_title","thread_body","send","fixed","closed","reopen"],data:function(){return{threads_response:[],logged:window.user||{},form:{title:"",body:""}}},mounted:function(){var e=this;this.getThreads(),Echo.channel("new.thread").listen("NewThreadEvent",(function(t){console.log(t),t.thread&&e.threads_response.data.splice(0,0,t.thread)}))},methods:{getThreads:function(){var e=this;window.axios.get("/api/threads").then((function(t){e.threads_response=t.data}))},save:function(){var e=this;window.axios.post("/api/threads",this.form).then((function(t){e.getThreads(),e.form={}}))},actionFixed:function(e){var t=this;window.axios.post("/api/threads/".concat(e,"/fixed")).then((function(e){t.getThreads()}))},actionClosed:function(e){var t=this;window.swal.fire({title:"Atenção",text:"Você tem certeza que deseja finalizar esse tópico.",icon:"warning",showCancelButton:!0,confirmButtonText:"Sim!",cancelButtonText:"Não!"}).then((function(n){window.axios.delete("/api/threads/".concat(e,"/closed")).then((function(e){t.getThreads()}))}))},actionReopen:function(e){var t=this;window.swal.fire({title:"Atenção",text:"Você tem certeza que deseja reabrir esse tópico.",icon:"warning",showCancelButton:!0,confirmButtonText:"Sim!",cancelButtonText:"Não!"}).then((function(n){window.axios.post("/api/threads/".concat(e,"/reopen")).then((function(e){t.getThreads()}))}))}}},i=n("KHd+"),r=Object(i.a)(o,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("div",{staticClass:"card"},[n("div",{staticClass:"card-content"},[n("div",{staticClass:"card-title"},[e._v(e._s(e.title))]),e._v(" "),n("table",[n("thead",[n("tr",[n("th",{staticStyle:{width:"1px"}},[e._v("#")]),e._v(" "),n("th",[e._v(e._s(e.thread))]),e._v(" "),n("th",[e._v(e._s(e.reply))]),e._v(" "),n("th",{style:{"width:310px":"admin"===e.logged.role,"width:1px":"admin"!==e.logged.role}})])]),e._v(" "),n("tbody",e._l(e.threads_response.data,(function(t,o){return n("tr",{key:o,class:{"lime lighen-4":t.fixed}},[n("td",[e._v(e._s(t.id))]),e._v(" "),n("td",[e._v(e._s(t.title))]),e._v(" "),n("td",[e._v(e._s(t.reply_count||0)+" ")]),e._v(" "),n("td",{staticClass:"right-align"},[n("a",{staticClass:"btn",attrs:{href:"/threads/"+t.id}},[e._v(e._s(e.open))]),e._v(" "),n("a",{directives:[{name:"show",rawName:"v-show",value:"admin"===e.logged.role,expression:"logged.role === 'admin'"}],staticClass:"btn orange",attrs:{href:"#"},on:{click:function(n){return n.preventDefault(),e.actionFixed(t.id)}}},[e._v(e._s(e.fixed))]),e._v(" "),n("a",{directives:[{name:"show",rawName:"v-show",value:"admin"===e.logged.role&&!t.closed_at,expression:"logged.role === 'admin' && !thread.closed_at"}],staticClass:"btn red",attrs:{href:"#"},on:{click:function(n){return n.preventDefault(),e.actionClosed(t.id)}}},[e._v(e._s(e.closed))]),e._v(" "),n("a",{directives:[{name:"show",rawName:"v-show",value:"admin"===e.logged.role&&t.closed_at,expression:"logged.role === 'admin' && thread.closed_at"}],staticClass:"btn red",attrs:{href:"#"},on:{click:function(n){return n.preventDefault(),e.actionReopen(t.id)}}},[e._v(e._s(e.reopen))])])])})),0)])])]),e._v(" "),n("div",{staticClass:"card"},[n("div",{staticClass:"card-content"},[n("div",{staticClass:"card-title"},[e._v(e._s(e.new_thread))]),e._v(" "),n("form",{on:{submit:function(t){return t.preventDefault(),e.save()}}},[n("div",{staticClass:"input-field"},[n("input",{directives:[{name:"model",rawName:"v-model",value:e.form.title,expression:"form.title"}],attrs:{type:"text",required:"",placeholder:e.thread_title},domProps:{value:e.form.title},on:{input:function(t){t.target.composing||e.$set(e.form,"title",t.target.value)}}})]),e._v(" "),n("div",{staticClass:"input-field"},[n("textarea",{directives:[{name:"model",rawName:"v-model",value:e.form.body,expression:"form.body"}],staticClass:"materialize-textarea",attrs:{type:"text",required:"",placeholder:e.thread_body},domProps:{value:e.form.body},on:{input:function(t){t.target.composing||e.$set(e.form,"body",t.target.value)}}})]),e._v(" "),n("button",{staticClass:"btn red aceent-2",attrs:{type:"submit"}},[e._v(e._s(e.send))])])])])])}),[],!1,null,null,null);t.default=r.exports},yLpj:function(e,t){var n;n=function(){return this}();try{n=n||new Function("return this")()}catch(e){"object"==typeof window&&(n=window)}e.exports=n}},[[1,0,1]]]);