(window.MIP=window.MIP||[]).push({name:"mip-ychlyxgs-data",func:function(){define("mip-ychlyxgs-data/mip-ychlyxgs-data",["require","zepto","util","customElement","fetch-jsonp"],function(e){var t=e("zepto"),i=e("util"),n=i.platform,a=e("customElement").create(),r=e("fetch-jsonp");return a.prototype.build=function(){function e(e){var t=0;for(t=0;t<e.length;t++)if(f.indexOf(e[t])>-1)p=!0;if(1===u.ismoney)p=!0}function i(e){if(t(d).find(".f-tags-box").length>0)if(n.isIos())if(t(d).find(".f-tags-box .f-tags-ios li").length>0)a(t(d).find(".f-tags-box .f-tags-ios").html(),t(d).find(".f-tags-box .f-tags-ios li").first().attr("data-system"),t(d).find(".f-tags-box .f-tags-ios li").first().attr("data-id"),t(d).find(".f-tags-box .f-tags-ios li a p").first().text(),"IOS",e);else t(d).find(".f-tags-box").remove();else if(t(d).find(".f-tags-box .f-tags-android li").length>0)a(t(d).find(".f-tags-box .f-tags-android").html(),t(d).find(".f-tags-box .f-tags-android li").first().attr("data-system"),t(d).find(".f-tags-box .f-tags-android li").first().attr("data-id"),t(d).find(".f-tags-box .f-tags-android li a p").first().text(),"ANDROID",e);else t(d).find(".f-tags-box").remove();else t(d).find(".f-tags-box").remove()}function a(e,i,n,a,r,o){if(e='<div class="'+t(d).find(".f-tags-box").attr("class")+'"><ul>'+e+"</ul></div>",t(d).find(".f-tags-box").remove(),t(d).find(".f-tags-position").after(e),t(d).find(".f-tags-box").show(),-1===u.system.indexOf(r)){var s=o,l=window.location.href,c=0;for(c=0;c<s.length;c++)if(-1!==l.indexOf(s[c]))h.attr("href","http://m."+s[c]+"/down.asp?id="+n).attr("data-add","add")}t(d).find(".f-tags-box ul li a p").each(function(){var e=t(this).text(),i="(官方最新版|官网最新版|官方正式版|官方安卓版|官方版|修改版|无限金币版";i+="|中文版|日服版|九游版|最新版|360版|百度版|uc版|九游版|安峰版|草花版|益玩版|破解版)",i=RegExp(i),e=e.replace(i,"<font color='red'>$1</font>"),t(d).find(this).html(e)})}function o(e,i,a,r,o){if(n.isIos()){var s=t.inArray(f,e),l=t.inArray(u.categroyId,i),c=t(d).find(".f-tags-box ul li").length;if(-1===l&&c<=0&&-1===s)h.attr({href:"javascript:;",ispc:!0});else h.attr("issw",!0)}else{var p=[];if(p=f.split("."),-1!==f.indexOf("mo.L5645.net")&&t(d).find(".f-tags-box ul li").length<=0){var m=a,g=window.location.href,v=0;for(v=0;v<m.length;v++)if(-1!==g.indexOf(m[v]))h.attr("href","http://m."+m[v]+"/down.asp?id="+p[4]).attr("data-add","add")}else{var w=t.inArray(f,r);if(-1===t.inArray(u.categroyId,o)&&t(d).find(".f-tags-box ul li").length<=0&&-1===w)h.attr({href:"javascript:;",ispc:!0});else h.attr("issw",!0)}if(h.attr("ispc"))t(d).find(".g-show-title p").html("该软件无安卓版，大家<span>还下载了</span>这些：");else t(d).find(".g-show-title p").html("大家<span>还下载了</span>这些：")}}function s(e,i){if(!p){var n=0,a=t(d).find("h1").text()||"";if(a=a.split(/(\s|\()/)[0],"false"===e)h.click(function(){if(n<=0){var e=i[0].replace(/\&amp;/g,"&");return window.top.location=e,n++,!1}})}}function l(e,i,n,a){var r=e,o=t("title").html(),s=r.length,l=0;for(l=0;l<s;l++)if(-1!==o.indexOf(r[l])){t("title").html(i[0]),t(d).find(".f-game-h1").html("<i></i>"+i[1]),t(d).find(".f-game-img").each(function(){t(d).find(this).find("img").attr("src",i[2])}),t(d).find(".f-previmg-cont").html(i[3]),t(d).find(".f-maincms-cont").html(i[4]);var c=a,u=n;if(-1!==t.inArray(c,u))t(d).find(".f-downbtn-url").each(function(){t(d).find(this).find("a").attr("href",i[5])});var p=Math.ceil(i.length);if(p>6){var f=6;for(f=6;f<p;f++)t(d).find(".f-replace-html"+f).html(i[f])}t(d).find(".f-hide-box").each(function(){t(this).hide()}),t(d).find(".f-remove-box").each(function(){t(this).remove()})}}function c(e,i,n,a){var r=a,o=n;if(-1!==t.inArray(r,o))for(var s=0;s<e.length;s++)if(f===e[s]){t("title").html(i[0]),t(d).find(".f-game-h1").html("<i></i>"+i[1]),t(d).find(".f-game-img").each(function(){t(d).find(this).find("img").attr("src",i[2])}),t(d).find(".f-previmg-cont").html(i[3]),t(d).find(".f-maincms-cont").html(i[4]),t(d).find(".f-downbtn-url").each(function(){t(d).find(this).find("a").attr("href",i[5])});var l=Math.ceil(i.length);if(l>6){var c=6;for(c=6;c<l;c++)t(d).find(".f-replace-html"+c).html(i[c])}t(d).find(".f-hide-box").each(function(){t(this).hide()}),t(d).find(".f-remove-box").each(function(){t(this).remove()})}}var d=this.element,u={id:t(d).find(".f-information").attr("data-id"),categroyId:Math.ceil(t(d).find(".f-information").attr("data-categroyId")),ismoney:t(d).find(".f-information").attr("data-ismoney"),system:t(d).find(".f-information").attr("data-system").toUpperCase(),phpUrl:t(d).find(".f-information").attr("data-phpurl")},p=!1,f=t(d).find(".f-downbtn-url a").first().attr("href"),h=t(d).find(".f-downbtn-url").find("a");r("https://ca.6071.com/web/index/c/"+u.phpUrl,{jsonpCallback:"callback"}).then(function(e){return e.json()}).then(function(n){var a=n["iossp-url"],r=n["ios-classid"],u=n.webUrl,p=n["azsp-url"],h=n["android-classid"],m=n.ipok,g=n.hzurl,v=n.openZs,w=n.ifSwbOk,y=n.tagSpOk,b=n.adaptationOk,x=n.mgcFilterOk,_=n.nodownopen,k=n.nodownsize,I=n.swnotagurl,T=n.ipInfo.city,S=n.mgDownUrl;if(!0===n.mgUrlOpen)c(S,n.mgUrlReplace,n["eject-city"],T);if("true"===w)e(n["f-noAdf-hide"]);if("true"===y){var M=0;if(I.length>0)for(var C=0;C<I.length;C++)if(f===I[C]){M++;break}if(0===M)i(n.webUrl)}if("true"===b)o(a,r,u,p,h);if("true"===x)l(n["f-mg-gl"],n.replaceHtml,n["eject-city"],T);if("true"===v)s(m,g);if(!0===_){if(t(d).find(".f-nodown").length<=0)return!1;for(var E=t(d).find(".f-nodown").text().toUpperCase(),A=0;A<k.length;A++)if(E===k[A])t(".f-downbtn-url").html('<li class="f-nodown-btn">暂无下载</li>')}})},a}),define("mip-ychlyxgs-data",["mip-ychlyxgs-data/mip-ychlyxgs-data"],function(e){return e}),function(){function e(e,t){e.registerMipElement("mip-ychlyxgs-data",t)}if(window.MIP)require(["mip-ychlyxgs-data"],function(t){e(window.MIP,t)});else require(["mip","mip-ychlyxgs-data"],e)}()}});