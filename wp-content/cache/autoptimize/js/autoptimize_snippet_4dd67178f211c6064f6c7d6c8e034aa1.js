(function(a){a.fn.fitVids=function(e){var f={customSelector:null,ignore:null};if(!document.getElementById("fit-vids-style")){var d=document.head||document.getElementsByTagName("head")[0];var b=".fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}";var c=document.createElement("div");c.innerHTML='<p>x</p><style id="fit-vids-style">'+b+"</style>";d.appendChild(c.childNodes[1])}if(e){a.extend(f,e)}return this.each(function(){var i=['iframe[src*="player.vimeo.com"]','iframe[src*="youtube.com"]','iframe[src*="youtube-nocookie.com"]','iframe[src*="kickstarter.com"][src*="video.html"]',"object","embed"];if(f.customSelector){i.push(f.customSelector)}var h=".fitvidsignore";if(f.ignore){h=h+", "+f.ignore}var g=a(this).find(i.join(","));g=g.not("object object");g=g.not(h);g.each(function(l){var j=a(this);if(j.parents(h).length>0){return}if(this.tagName.toLowerCase()==="embed"&&j.parent("object").length||j.parent(".fluid-width-video-wrapper").length){return}if((!j.css("height")&&!j.css("width"))&&(isNaN(j.attr("height"))||isNaN(j.attr("width")))){j.attr("height",9);j.attr("width",16)}var m=(this.tagName.toLowerCase()==="object"||(j.attr("height")&&!isNaN(parseInt(j.attr("height"),10))))?parseInt(j.attr("height"),10):j.height(),o=!isNaN(parseInt(j.attr("width"),10))?parseInt(j.attr("width"),10):j.width(),k=m/o;if(!j.attr("id")){var n="fitvid"+l;j.attr("id",n)}j.wrap('<div class="fluid-width-video-wrapper"></div>').parent(".fluid-width-video-wrapper").css("padding-top",(k*100)+"%");j.removeAttr("height").removeAttr("width")})})}})(window.jQuery||window.Zepto);