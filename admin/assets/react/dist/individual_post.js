(()=>{"use strict";var e={540:e=>{e.exports=function(e){var t=document.createElement("style");return e.setAttributes(t,e.attributes),e.insert(t,e.options),t}},1113:e=>{e.exports=function(e,t){if(t.styleSheet)t.styleSheet.cssText=e;else{for(;t.firstChild;)t.removeChild(t.firstChild);t.appendChild(document.createTextNode(e))}}},1333:(e,t,n)=>{n.d(t,{A:()=>i});var a=n(1601),r=n.n(a),l=n(6314),o=n.n(l)()(r());o.push([e.id,".smpg-repeater-panel-body{\n    padding: 15px;\n    border: 1px solid darkgrey;\n    margin-bottom: 10px;\n    position: relative;\n}\n.smpg-trash-repeater{\n    position: absolute;\n    right: 20px;\n    cursor: pointer;\n}\n.smpg-repeater-i{\n    position: absolute;\n    left: 0px;\n    top: 0px;\n    padding: 2px;\n    background: #cccccc;\n}\n.smpg-repeater-panel{\n    border:0px solid #fff;\n    border-right: 1px solid #e0e0e0;\n    border-left: 1px solid #e0e0e0;\n}\n\n/* groups elements css starts here */\n.smpg-groups-elements {\n\tdisplay: flex;\n\tflex-wrap: wrap;\n\tgap: 5px; /* Space between items */\n}\n\n.smpg-groups-elements .smpg-form-group {\n\tdisplay: flex;\n\talign-items: center;\n\tgap: 5px;\t\n\tpadding: 8px 10px;\t\t\n}\n\n.smpg-groups-elements .smpg-form-group label {\n\tmargin: 0;\t\n}\n",""]);const i=o},1601:e=>{e.exports=function(e){return e[1]}},2745:(e,t,n)=>{n.d(t,{A:()=>i});var a=n(1601),r=n.n(a),l=n(6314),o=n.n(l)()(r());o.push([e.id,".smpg-individual-schema-list li{\n    padding: 10px;\n    padding-bottom: 1px;\n    overflow: auto;\n    margin-bottom: 10px;\n    border-radius: 4px;\n    border: 1px solid#990000;\n    background: #f7f0f0;\n}\n.smpg-individual-item-actions{\n    float: right;\n    display: flex;    \n    position: relative;\n}\n.smpg-individual-item-actions .components-base-control{\n    margin-top: 2px;\n    margin-right: -5px;\n}\n.smpg-individual-item-actions button{\n    height: auto !important;\n    padding: 6px 3px !important;\n}\n.smpg-i-warning-icon::before{\n    color: #ffc107 !important;\n}\n.smpg-i-warning-icon{\n    margin-right: 5px;\n}\n.smpg-add-to-list-table{\n    width: 100%;\n}\n.smpg-description{\n    margin-top: auto;\n    font-size: 14px;\n    padding-top: 5px;\n    font-style: normal;    \n    color: #000;\n}\n.smpg-add-schema-action{ \n    padding-top: 15px;        \n}\n.smpg-add-schema-select{\n    display: flex;\n}\n.smpg-select{\n    float: left;\n    width: 60%;\n    padding-right: 20px;\n}\n.smpg-delete-popover{            \n    background: #ffffff;\n    width: 150px;\n    right: 47px;        \n    border-radius: 3px;\n    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);\n    text-align: center;\n    font-size: 15px;\n    color: #000;\n    position: absolute;\n    z-index: 999;\n    margin-top: -3px;    \n\n}\n.smpg-form-group{\n    margin-bottom: 15px;\n    background: #f0f0f0;\n    padding: 12px;    \n\n}\n.smpg-form-group label{\n    display: inline-block;    \n    margin-bottom: 5px;\n    font-weight: 700;\n}\ntextarea.smpg-form-control {\n    height: auto;\n}\n.smpg-clear{\n    clear: both;\n}\n.smpg-form-control{\n    display: block;\n    width: 100%;\n    max-width: 100% !important;\n    height: 34px;\n    padding: 6px 12px;\n    font-size: 14px;\n    line-height: 1.42857143;\n    color: #000;\n    background-color: #fff;\n    background-image: none;\n    border: 1px solid #ccc;\n    border-radius: 4px;    \n}\n.smpg-image-preview {\n    width: 150px;  \n    height: 150px;    \n    position: relative;\n    margin-top: 8px;\n    border: 2px solid #f7f0f0;\n\n}\n.smpg-image-preview img{\n    width: 100%;\n    height: 100%;\n    padding:8px;    \n}\n.smpg-media-upload{\n    margin-bottom: 10px;\n}\n.smpg-upload-img-btn{\n    margin-bottom: 10px;\n}\n.smpg-image-preview a{\n    position: absolute;\n    font-size: 20px;\n    margin-top: -2px;\n    padding-left: 1px;\n    cursor: pointer;\n    border: 2px solid #f7f0f0;\n    background: #f7f0f0;\n}\n.smpg-i-schema-setup{\n    width: 700px;\n}\n.smpg-item-box{\n    padding: 10px;\n    border: 1px solid #dadfe4;\n    border-radius: 4px;\n    background: #f8f9fa;\n    text-align: center;\n    cursor: pointer;\n}\n.smpg-item-box-selected{\n    border: 2px solid #990000;\n}\n.smpg-schema-list{\n    width: 800px;\n}\n.smpg-choose-ok{\n    margin-top: 25px;\n    text-align: center;\n}\n.smpg-list-grid{\n    display: grid;\n    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));\n    grid-gap: 1em;\n}\n.smpg-tooltip {\n    position: relative;\n    display: inline-block;    \n    cursor: pointer;\n}  \n.smpg-tooltip .smpg-tooltiptext {\n    visibility: hidden;\n    max-width: 250px;\n    background-color: black;\n    color: #fff;\n    text-align: center;\n    border-radius: 6px;\n    padding: 5px 0;  \n    /* Position the tooltip */\n    position: absolute;\n    z-index: 1;\n}  \n.smpg-tooltip:hover .smpg-tooltiptext {\n    visibility: visible;\n}\n.smpg_individual_taxonomy #smpg_individual_post_container{\n    background: #fff;\n    padding: 15px;\n}\n\n.smpg_spg_author_page{\n    background: #fff;\n    padding: 20px;\n    width: 55%;\n}\n\n@media (max-width: 600px) {\n    .smpg-i-schema-setup{\n        width: auto;\n    }\n}",""]);const i=o},5056:(e,t,n)=>{e.exports=function(e){var t=n.nc;t&&e.setAttribute("nonce",t)}},5072:e=>{var t=[];function n(e){for(var n=-1,a=0;a<t.length;a++)if(t[a].identifier===e){n=a;break}return n}function a(e,a){for(var l={},o=[],i=0;i<e.length;i++){var s=e[i],c=a.base?s[0]+a.base:s[0],p=l[c]||0,u="".concat(c," ").concat(p);l[c]=p+1;var m=n(u),d={css:s[1],media:s[2],sourceMap:s[3],supports:s[4],layer:s[5]};if(-1!==m)t[m].references++,t[m].updater(d);else{var g=r(d,a);a.byIndex=i,t.splice(i,0,{identifier:u,updater:g,references:1})}o.push(u)}return o}function r(e,t){var n=t.domAPI(t);return n.update(e),function(t){if(t){if(t.css===e.css&&t.media===e.media&&t.sourceMap===e.sourceMap&&t.supports===e.supports&&t.layer===e.layer)return;n.update(e=t)}else n.remove()}}e.exports=function(e,r){var l=a(e=e||[],r=r||{});return function(e){e=e||[];for(var o=0;o<l.length;o++){var i=n(l[o]);t[i].references--}for(var s=a(e,r),c=0;c<l.length;c++){var p=n(l[c]);0===t[p].references&&(t[p].updater(),t.splice(p,1))}l=s}}},6314:e=>{e.exports=function(e){var t=[];return t.toString=function(){return this.map((function(t){var n="",a=void 0!==t[5];return t[4]&&(n+="@supports (".concat(t[4],") {")),t[2]&&(n+="@media ".concat(t[2]," {")),a&&(n+="@layer".concat(t[5].length>0?" ".concat(t[5]):""," {")),n+=e(t),a&&(n+="}"),t[2]&&(n+="}"),t[4]&&(n+="}"),n})).join("")},t.i=function(e,n,a,r,l){"string"==typeof e&&(e=[[null,e,void 0]]);var o={};if(a)for(var i=0;i<this.length;i++){var s=this[i][0];null!=s&&(o[s]=!0)}for(var c=0;c<e.length;c++){var p=[].concat(e[c]);a&&o[p[0]]||(void 0!==l&&(void 0===p[5]||(p[1]="@layer".concat(p[5].length>0?" ".concat(p[5]):""," {").concat(p[1],"}")),p[5]=l),n&&(p[2]?(p[1]="@media ".concat(p[2]," {").concat(p[1],"}"),p[2]=n):p[2]=n),r&&(p[4]?(p[1]="@supports (".concat(p[4],") {").concat(p[1],"}"),p[4]=r):p[4]="".concat(r)),t.push(p))}},t}},7659:e=>{var t={};e.exports=function(e,n){var a=function(e){if(void 0===t[e]){var n=document.querySelector(e);if(window.HTMLIFrameElement&&n instanceof window.HTMLIFrameElement)try{n=n.contentDocument.head}catch(e){n=null}t[e]=n}return t[e]}(e);if(!a)throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");a.appendChild(n)}},7825:e=>{e.exports=function(e){if("undefined"==typeof document)return{update:function(){},remove:function(){}};var t=e.insertStyleElement(e);return{update:function(n){!function(e,t,n){var a="";n.supports&&(a+="@supports (".concat(n.supports,") {")),n.media&&(a+="@media ".concat(n.media," {"));var r=void 0!==n.layer;r&&(a+="@layer".concat(n.layer.length>0?" ".concat(n.layer):""," {")),a+=n.css,r&&(a+="}"),n.media&&(a+="}"),n.supports&&(a+="}");var l=n.sourceMap;l&&"undefined"!=typeof btoa&&(a+="\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(l))))," */")),t.styleTagTransform(a,e,t.options)}(t,e,n)},remove:function(){!function(e){if(null===e.parentNode)return!1;e.parentNode.removeChild(e)}(t)}}}}},t={};function n(a){var r=t[a];if(void 0!==r)return r.exports;var l=t[a]={id:a,exports:{}};return e[a](l,l.exports,n),l.exports}n.n=e=>{var t=e&&e.__esModule?()=>e.default:()=>e;return n.d(t,{a:t}),t},n.d=(e,t)=>{for(var a in t)n.o(t,a)&&!n.o(e,a)&&Object.defineProperty(e,a,{enumerable:!0,get:t[a]})},n.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),n.nc=void 0;var a=n(5072),r=n.n(a),l=n(7825),o=n.n(l),i=n(7659),s=n.n(i),c=n(5056),p=n.n(c),u=n(540),m=n.n(u),d=n(1113),g=n.n(d),f=n(2745),v={};v.styleTagTransform=g(),v.setAttributes=p(),v.insert=s().bind(null,"head"),v.domAPI=o(),v.insertStyleElement=m(),r()(f.A,v),f.A&&f.A.locals&&f.A.locals;var h=[{key:0,value:"article",text:"Article"},{key:1,value:"techarticle",text:"TechArticle"},{key:2,value:"newsarticle",text:"NewsArticle"},{key:3,value:"advertisercontentarticle",text:"AdvertiserContentArticle"},{key:4,value:"satiricalarticle",text:"SatiricalArticle"},{key:5,value:"scholarlyarticle",text:"ScholarlyArticle"},{key:6,value:"socialmediaposting",text:"SocialMediaPosting"},{key:7,value:"product",text:"Product"},{key:8,value:"softwareapplication",text:"SoftwareApplication"},{key:9,value:"book",text:"Book"},{key:10,value:"faqpage",text:"FAQs"},{key:11,value:"howto",text:"HowTo"},{key:12,value:"qna",text:"Q&A"},{key:13,value:"event",text:"Event"},{key:14,value:"recipe",text:"Recipe"},{key:15,value:"videoobject",text:"VideoObject"},{key:16,value:"course",text:"Course"},{key:17,value:"jobposting",text:"JobPosting"},{key:18,value:"localbusiness",text:"LocalBusiness"},{key:19,value:"store",text:"Store"},{key:20,value:"bakery",text:"Bakery"},{key:21,value:"barorpub",text:"BarOrPub"},{key:22,value:"cafeorcoffeeshop",text:"CafeOrCoffeeShop"},{key:23,value:"fastfoodrestaurant",text:"FastFoodRestaurant"},{key:24,value:"icecreamshop",text:"IceCreamShop"},{key:25,value:"restaurant",text:"Restaurant"},{key:26,value:"service",text:"Service"},{key:27,value:"broadcastservice",text:"BroadcastService"},{key:28,value:"cableorsatelliteservice",text:"CableOrSatelliteService"},{key:29,value:"financialproduct",text:"FinancialProduct"},{key:30,value:"foodservice",text:"FoodService"},{key:31,value:"governmentservice",text:"GovernmentService"},{key:32,value:"taxiservice",text:"TaxiService"},{key:33,value:"webapi",text:"WebAPI"},{key:34,value:"customschema",text:"CustomSchema"},{key:35,value:"liveblogposting",text:"LiveBlogPosting"},{key:36,value:"person",text:"Person"},{key:37,value:"musicalbum",text:"MusicAlbum"},{key:38,value:"musicplaylist",text:"MusicPlaylist"},{key:39,value:"audioobject",text:"AudioObject"},{key:40,value:"trip",text:"Trip"},{key:41,value:"mobileapplication",text:"MobileApplication"},{key:42,value:"singlefamilyresidence",text:"SingleFamilyResidence"},{key:43,value:"house",text:"House"},{key:44,value:"apartment",text:"Apartment"},{key:45,value:"photograph",text:"Photograph"},{key:46,value:"imageobject",text:"ImageObject"},{key:47,value:"mediagallery",text:"MediaGallery"},{key:48,value:"imagegallery",text:"ImageGallery"},{key:49,value:"creativework",text:"CreativeWork"},{key:50,value:"review",text:"Review"},{key:51,value:"profilepage",text:"ProfilePage"},{key:52,value:"webpage",text:"WebPage"}],y=n(1333),b={};function x(e,t){return function(e){if(Array.isArray(e))return e}(e)||function(e,t){var n=null==e?null:"undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(null!=n){var a,r,l,o,i=[],s=!0,c=!1;try{if(l=(n=n.call(e)).next,0===t){if(Object(n)!==n)return;s=!1}else for(;!(s=(a=l.call(n)).done)&&(i.push(a.value),i.length!==t);s=!0);}catch(e){c=!0,r=e}finally{try{if(!s&&null!=n.return&&(o=n.return(),Object(o)!==o))return}finally{if(c)throw r}}return i}}(e,t)||function(e,t){if(e){if("string"==typeof e)return k(e,t);var n={}.toString.call(e).slice(8,-1);return"Object"===n&&e.constructor&&(n=e.constructor.name),"Map"===n||"Set"===n?Array.from(e):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?k(e,t):void 0}}(e,t)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function k(e,t){(null==t||t>e.length)&&(t=e.length);for(var n=0,a=Array(t);n<t;n++)a[n]=e[n];return a}b.styleTagTransform=g(),b.setAttributes=p(),b.insert=s().bind(null,"head"),b.domAPI=o(),b.insertStyleElement=m(),r()(y.A,b),y.A&&y.A.locals&&y.A.locals,wp.i18n.__;var R=wp.components,E=(R.BaseControl,R.Button),_=(R.ExternalLink,R.Panel),w=R.PanelBody,C=(R.PanelRow,R.Placeholder,R.Spinner,R.ToggleControl,R.SelectControl,R.Modal,R.ComboboxControl,R.Tooltip,wp.element);C.render,C.Component,C.Fragment,C.useState,C.useEffect;const S=function(e){var t=e.property,n=function(t,n,a,r){return React.createElement("div",{className:"smpg-form-group"},React.createElement("label",null,t.label),React.createElement("input",{placeholder:t.placeholder,onChange:function(l){return e.handlePropertyChange(l,e.i,e.j,t.type,null,n,a,r)},type:"text",className:"smpg-form-control",value:t.value}),React.createElement("p",{className:"smpg-description"},t.tooltip))},a=function(t,n,a,r){return React.createElement("div",{className:"smpg-form-group"},React.createElement("label",null,t.label),React.createElement("br",null),t.value.length>0?React.createElement("div",{className:"smpg-media-upload"},React.createElement("div",{className:"smpg-list-grid"},t.value.map((function(t,l){return React.createElement("div",{key:l,className:"smpg-image-preview"},React.createElement("img",{src:t.url}),React.createElement("a",{href:"#",onClick:function(o){return e.handleRemoveImage(o,e.i,e.j,l,t.id,n,a,r)}},"X"))})))):"",React.createElement(E,{className:"smpg-upload-img-btn",onClick:function(l){return e.handlePropertyChange(l,e.i,e.j,t.type,t.multiple,n,a,r)},isSecondary:!0},"Upload ".concat(t.label)),React.createElement("p",{className:"smpg-description"},t.tooltip))},r=function(t,n,a,r){return React.createElement("div",{className:"smpg-form-group"},React.createElement("label",null,t.label),React.createElement("br",null),React.createElement("input",{onChange:function(l){return e.handlePropertyChange(l,e.i,e.j,t.type,null,n,a,r)},type:"checkbox",className:"smpg-form-control",checked:t.value}),React.createElement("p",{className:"smpg-description"},t.tooltip))},l=function(t,n,a,r){return React.createElement("div",{className:"smpg-form-group"},React.createElement("label",null,t.label),React.createElement("input",{placeholder:t.placeholder,onChange:function(l){return e.handlePropertyChange(l,e.i,e.j,t.type,null,n,a,r)},type:"number",className:"smpg-form-control",value:t.value}),React.createElement("p",{className:"smpg-description"},t.tooltip))},o=function(t,n,a,r){return React.createElement("div",{className:"smpg-form-group"},React.createElement("label",null,t.label),React.createElement("textarea",{placeholder:t.placeholder,className:"smpg-form-control",onChange:function(l){return e.handlePropertyChange(l,e.i,e.j,t.type,null,n,a,r)},rows:"4",value:t.value}),React.createElement("p",{className:"smpg-description"},t.tooltip))},i=function(t,n,a,r){return React.createElement("div",{className:"smpg-form-group"},React.createElement("label",null,t.label),React.createElement("select",{className:"smpg-form-control",onChange:function(l){return e.handlePropertyChange(l,e.i,e.j,t.type,null,n,a,r)},value:t.value},Object.entries(t.options).map((function(e){var t=x(e,2),n=t[0],a=t[1];return React.createElement("option",{value:n},a)}))),React.createElement("p",{className:"smpg-description"},t.tooltip))};return React.createElement(React.Fragment,null,function(){if(t.display){var s=0;switch(t.type){case"groups":return React.createElement(React.Fragment,null,React.createElement("h3",null,t.label),React.createElement("div",{className:"smpg-groups-elements"},Object.entries(t.elements).map((function(e){var t=x(e,2),s=t[0],c=t[1];if(c.display)switch(c.type){case"number":return l(c,null,s,"groups");case"textarea":return o(c,null,s,"groups");case"media":return a(c,null,s,"groups");case"select":return i(c,null,s,"groups");case"checkbox":return r(c,null,s,"groups");default:return n(c,null,s,"groups")}}))));case"repeater":return React.createElement(React.Fragment,null,React.createElement(_,{className:"smpg-repeater-panel"},React.createElement(w,{title:t.label,initialOpen:!0},t.elements.length>0?t.elements.map((function(t,c){return s++,React.createElement("div",{className:"smpg-repeater-panel-body"},React.createElement("span",{className:"smpg-repeater-i"},s),React.createElement("span",{onClick:function(t){return e.handleDeleteRepeater(t,e.i,e.j,c)},className:"dashicons dashicons-trash smpg-trash-repeater"}),Object.entries(t).map((function(e){var t=x(e,2),s=t[0],p=t[1];if(p.display)switch(p.type){case"number":return l(p,c,s,"repeater");case"textarea":return o(p,c,s,"repeater");case"media":return a(p,c,s,"repeater");case"select":return i(p,c,s,"repeater");case"checkbox":return r(p,c,s,"repeater");default:return n(p,c,s,"repeater")}})))})):"",React.createElement("div",null,React.createElement(E,{onClick:function(t){return e.handleAddMoreRepeater(t,e.i,e.j)},isSecondary:!0},t.button_text)))));case"select":return i(t,null,null,null);case"textarea":return o(t,null,null,null);case"editor":return c=t,React.createElement("div",{className:"smpg-form-group"},React.createElement("label",null,c.label),React.createElement("textarea",{placeholder:c.placeholder,className:"smpg-form-control",onChange:function(t){return e.handlePropertyChange(t,e.i,e.j,c.type,null,null,null,null)},rows:"10",value:c.value}),React.createElement("p",{className:"smpg-description"},c.tooltip));case"media":return a(t,null,null,null);case"number":return l(t,null,null,null);case"checkbox":return r(t,null,null,null);default:return n(t,null,null,null)}}var c}())};function N(e){return function(e){if(Array.isArray(e))return O(e)}(e)||function(e){if("undefined"!=typeof Symbol&&null!=e[Symbol.iterator]||null!=e["@@iterator"])return Array.from(e)}(e)||j(e)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function A(e,t){return function(e){if(Array.isArray(e))return e}(e)||function(e,t){var n=null==e?null:"undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(null!=n){var a,r,l,o,i=[],s=!0,c=!1;try{if(l=(n=n.call(e)).next,0===t){if(Object(n)!==n)return;s=!1}else for(;!(s=(a=l.call(n)).done)&&(i.push(a.value),i.length!==t);s=!0);}catch(e){c=!0,r=e}finally{try{if(!s&&null!=n.return&&(o=n.return(),Object(o)!==o))return}finally{if(c)throw r}}return i}}(e,t)||j(e,t)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function j(e,t){if(e){if("string"==typeof e)return O(e,t);var n={}.toString.call(e).slice(8,-1);return"Object"===n&&e.constructor&&(n=e.constructor.name),"Map"===n||"Set"===n?Array.from(e):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?O(e,t):void 0}}function O(e,t){(null==t||t>e.length)&&(t=e.length);for(var n=0,a=Array(t);n<t;n++)a[n]=e[n];return a}var P=wp.data,T=(P.subscribe,P.select,wp.components),I=(T.BaseControl,T.Button),M=(T.ExternalLink,T.PanelBody,T.PanelRow,T.Placeholder,T.Spinner,T.ToggleControl),F=(T.SelectControl,T.Modal),B=(T.ComboboxControl,T.Tooltip,wp.element),J=B.render,z=(B.Component,B.Fragment,B.useState),L=B.useEffect,W=B.useRef,q=function(){var e=wp.i18n.__,t=W({effect:!1}),n=A(z([]),2),a=n[0],r=n[1],l=A(z(!1),2),o=l[0],i=l[1],s=A(z([]),2),c=s[0],p=s[1],u=A(z(!1),2),m=u[0],d=u[1],g=function(e,t,n,l,o,i,s,c){e.preventDefault();var p=N(a);c?p[t].properties[n].elements[i][s].value.splice(l,1):p[t].properties[n].value.splice(l,1),r(p)},f=function(e,t,n,l,o,i,s,c){var p=N(a);if("media"==l)var u=[],m=wp.media({title:"Schema Image",button:{text:"Select Image"},multiple:o,library:{type:"image"}}).on("select",(function(){if(m.state().get("selection").map((function(e){e.toJSON();var t={};t.id=e.id,t.url=e.attributes.sizes.full.url,t.width=e.attributes.sizes.full.width,t.height=e.attributes.sizes.full.height,u.push(t)})),c){var e=p[t].properties[n].elements[i][s].value;if(o){var a=[].concat(N(e),u);p[t].properties[n].elements[i][s].value=Array.from(new Set(a.map(JSON.stringify))).map(JSON.parse)}else p[t].properties[n].elements[i][s].value=u;r(p)}else{var l=p[t].properties[n].value;if(o){var d=[].concat(N(l),u);p[t].properties[n].value=Array.from(new Set(d.map(JSON.stringify))).map(JSON.parse)}else p[t].properties[n].value=u;r(p)}})).open();else if(c){var d,g;"repeater"===c&&(d="checkbox"==p[t].properties[n].elements[i][s].type?e.target.checked:e.target.value,p[t].properties[n].elements[i][s].value=d,r(p)),"groups"===c&&(g="checkbox"==p[t].properties[n].elements[s].type?e.target.checked:e.target.value,p[t].properties[n].elements[s].value=g,r(p))}else if("checkbox"==l){var f=e.target.checked;"speakable"==n&&(p[t].properties.speakable_selectors.display=!!f),"is_paywalled"==n&&(p[t].properties.paywalled_selectors.display=!!f),"include_video"==n&&Object.keys(p[t].properties).forEach((function(e){"repeater"==p[t].properties[e].type?p[t].properties[e].elements.map((function(e,t){Object.keys(e).forEach((function(t){void 0!==e[t].class&&e[t].class.includes("smpg_common_properties")&&(e[t].display=!!f)}))})):void 0!==p[t].properties[e].class&&p[t].properties[e].class.includes("smpg_common_properties")&&(p[t].properties[e].display=!!f)})),p[t].properties[n].value=f,r(p)}else{var v=e.target.value;"offer_type"==n&&("AggregateOffer"==v?(p[t].properties.high_price.display=!0,p[t].properties.low_price.display=!0,p[t].properties.offer_count.display=!0,p[t].properties.offer_price.display=!1):(p[t].properties.high_price.display=!1,p[t].properties.low_price.display=!1,p[t].properties.offer_count.display=!1,p[t].properties.offer_price.display=!0)),p[t].properties[n].value=v,r(p)}},v=function(e,t,n,l){var o=N(a);o[t].properties[n].elements.splice(l,1),r(o)},y=function(e,t,n){var l=N(a);if(void 0!==l[t].properties[n].elements[0]){var o=l[t].properties[n].elements[0],i=[];Object.keys(o).forEach((function(e){var t=JSON.parse(JSON.stringify(o[e]));t.value="",i[e]=t}));var s=Object.assign({},i);l[t].properties[n].elements.push(JSON.parse(JSON.stringify(s))),r(l)}else{var c=smpg_local.rest_url+"smpg-route/get-repeater-element?schema_id="+l[t].id+"&element_name="+n;fetch(c,{headers:{"X-WP-Nonce":smpg_local.nonce}}).then((function(e){return e.json()})).then((function(e){"success"==e.status&&e.data&&(l[t].properties[n].elements.push(e.data),r(l))}),(function(e){}))}},b=function(e){i(!1);var t={};t.selected=c,t.post_id=smpg_local.post_id,t.tag_id=smpg_local.tag_id,t.user_id=smpg_local.user_id,t.init=e;var n=smpg_local.rest_url+"smpg-route/get-selected-schema-properties";fetch(n,{method:"post",headers:{Accept:"application/json","Content-Type":"application/json","X-WP-Nonce":smpg_local.nonce},body:JSON.stringify(t)}).then((function(e){return e.json()})).then((function(t){if("success"==t.status){var n=N(a);Object.entries(t.properties).map((function(e){var t=A(e,2),a=(t[0],t[1]);n.push(a)})),r(n),e||d((function(e){return!e}))}}),(function(e){})),p([])};return L((function(){b(!0)}),[]),L((function(){t.current.effect&&function(){var e={};e.post_id=smpg_local.post_id,e.tag_id=smpg_local.tag_id,e.user_id=smpg_local.user_id,e.post_meta=a;var t=smpg_local.rest_url+"smpg-route/save-post-meta";fetch(t,{method:"post",headers:{Accept:"application/json","Content-Type":"application/json","X-WP-Nonce":smpg_local.nonce},body:JSON.stringify(e)}).then((function(e){return e.json()})).then((function(e){}),(function(e){}))}(),t.current.effect=!0}),[m]),React.createElement(React.Fragment,null,React.createElement("div",null,React.createElement("p",{className:"smpg-description"},e("Include schema types to enhance structured data, enabling rich results in search engine listings.","schema-package"))),a.length>0?React.createElement("div",{className:"smpg-individual-schema-list"},React.createElement("ul",null,a.map((function(t,n){return React.createElement("li",{key:n},t.is_setup_popup&&React.createElement(F,{title:"Edit ".concat(t.text),shouldCloseOnClickOutside:!1,onRequestClose:function(){return function(e){var t=N(a);t[e].is_setup_popup=!1,r(t)}(n,t.id)}},React.createElement("div",{className:"smpg-i-schema-setup"},Object.entries(t.properties).map((function(e){var t=A(e,2),a=t[0],r=t[1];return React.createElement("div",{key:a,className:"smpg-property-fields"},React.createElement(S,{i:n,j:a,property:r,handlePropertyChange:f,handleRemoveImage:g,handleDeleteRepeater:v,handleAddMoreRepeater:y}))}))),React.createElement(I,{onClick:function(){return function(e){var t=N(a);t[e].is_setup_popup=!1,r(t),d((function(e){return!e}))}(n)},isPrimary:!0},e("Save For The Post","schema-package"))),t.has_warning?React.createElement("span",{className:"dashicons dashicons-warning smpg-i-warning-icon"}):"",React.createElement("strong",null,t.text),React.createElement("span",{className:"smpg-individual-item-actions"},t.is_delete_popup?React.createElement("div",{className:"smpg-delete-popover"},React.createElement("span",null,e("Delete ?","schema-package")," "),React.createElement(I,{isLink:!0,onClick:function(){return function(e){var t=N(a);t.splice(e,1),r(t),d((function(e){return!e}))}(n,t.id)}},e("Yes","schema-package"))," : ",React.createElement(I,{isLink:!0,onClick:function(){return function(e){var t=N(a);t[e].is_delete_popup=!1,r(t)}(n,t.id)}},e("No","schema-package"))):"",React.createElement(M,{checked:t.is_enable,onChange:function(){return function(e){var t=N(a);t[e].is_enable=!t[e].is_enable,r(t),d((function(e){return!e}))}(n,t.id)}}),React.createElement(I,{style:{marginTop:"-10px"},onClick:function(){return function(e){var t=N(a);t[e].is_setup_popup=!t[e].is_setup_popup,r(t)}(n,t.id)}},React.createElement("span",{className:"dashicons dashicons-edit-large"})),React.createElement(I,{style:{marginTop:"-10px"},onClick:function(){return function(e){var t=N(a);t[e].is_delete_popup=!t[e].is_delete_popup,r(t)}(n,t.id)}},React.createElement("span",{className:"dashicons dashicons-trash"}))))})))):null,React.createElement("div",{className:"smpg-add-schema-action"},React.createElement("div",{className:"smpg-add-schema-select"},o?React.createElement(F,{title:"Choose Schema Types",shouldCloseOnClickOutside:!1,onRequestClose:function(){i(!1),p([])}},React.createElement("div",{className:"smpg-schema-list"},React.createElement("div",{className:"smpg-list-grid"},h?h.map((function(e,t){return React.createElement("div",{key:t,className:"smpg-item-box ".concat(c.includes(e.value)?"smpg-item-box-selected":""),onClick:function(){return t=e.value,-1!==(a=(n=N(c)).indexOf(t))?n.splice(a,1):n.push(t),void p(n);var t,n,a}},React.createElement("strong",null,e.text))})):"")),React.createElement("div",{className:"smpg-choose-ok"},React.createElement(I,{isPrimary:!0,onClick:function(){return b(!1)}},e("Selected","schema-package")))):"",React.createElement("div",null,React.createElement(I,{onClick:function(){i(!0)},isPrimary:!0},e("Choose Schema Types","schema-package"))))))};J(React.createElement(q,null),document.getElementById("smpg_individual_post_container"))})();