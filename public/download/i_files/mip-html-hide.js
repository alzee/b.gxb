(window.MIP=window.MIP||[]).push({name:"mip-html-hide",func:function(){define("mip-html-hide/mip-html-hide",["require","zepto","customElement"],function(e){var t=e("zepto"),i=e("customElement").create();return i.prototype.firstInviewCallback=function(){var e=this.element,i=t(e).find(".g-down-information p a").length;t(e).find(".g-down-information").each(function(){if(i<=0)t(".g-down-information p").hide()})},i}),define("mip-html-hide",["mip-html-hide/mip-html-hide"],function(e){return e}),function(){function e(e,t){e.registerMipElement("mip-html-hide",t)}if(window.MIP)require(["mip-html-hide"],function(t){e(window.MIP,t)});else require(["mip","mip-html-hide"],e)}()}});