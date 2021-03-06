if(typeof Object.create!=="function"){
	Object.create=function(e)
		{function t(){}t.prototype=e;return new t}}
		(function(e){var t={init:function(t,n){
			var r=this;
			r.elem=n;
			r.$elem=e(n);
			r.options=e.extend({},e.fn.colorPicker.options,t);
			r.construct()},getHtmlData:function(){
				var t=this;
				var n=false;
				var r=e(".colorpickerClass").length;n='<div style="z-index: '+t.options.zindex+';position: relative; display: block; background-color: white; border: 1px solid #CCC;" class="colorpickerClass">';
				var i=0;
					for(var s=t.options.rows;s>0;s--){
						for(var o=t.options.cols;o>0;o--){
							n+='<div  class="color_cell" title="'+t.options.colorData[i]+'"  style="background-color:'+t.options.colorData[i]+';float: left;"></div>';
							if(i==t.options.colorData.length)i=0;i++}n+='<div class="no-space" style="clear: both;"></div>'}if(t.options.showCode){n+='<div class="show_code" style="text-align: center;font-size: 12px;border-top: 1px solid #ccc;"></div>'}n+="</div>";return n},attachToElem:function(t){var n=this;e(".colorpickerClass").remove();e("#colpic").append(t);e(".colorpickerClass div.color_cell").css("width",n.options.cellWidth).css("height",n.options.cellHeight).css("margin",n.options.cellSpacing).css("outline","1px solid #CCC");e(".colorpickerClass div.no-space").css("width","0px").css("height","0px").css("border","none")},enableClick:function(){var t=this;t.$elem.on("click",function(n){n.stopPropagation();e(".colorpickerClass").show();var r=t.$elem.offset();var i=r.top+t.options.top;var s=r.left+t.options.left;e(".colorpickerClass").show().css({top:i,left:s})});e(document).bind("click",function(){/*e(".colorpickerClass").hide()*/});e("div.color_cell").on("mouseover",function(){if(t.options.showCode===1){e("div.show_code").html(e(this).attr("title"))}})},createColorCodes:function(e){var t=this;var n=[];if(t.options.colorData.length===0){var r=["A","0","B","1","2","C","3","D","4","E","5","F","6","7","8","9"];for(var i=0,s=r.length;i<s;i++){for(var o=i,u=r.length;o<u;o++){for(var a=o,f=r.length;a<f;a++){if(n.length<e){n.push("#"+r[i]+r[o]+r[a])}else{break}}}}}else{var l=t.options.rows*t.options.cols;var c=t.options.colorData.length;var h=0;for(var i=0,s=l;i<s;i++){n.push(t.options.colorData[h]);if(c-1<=h){h=0}else{h++}}}return n},getonSelect:function(){var t=this;if(typeof t.options.onSelect==="function"){e("div.color_cell").on("click",function(n){n.preventDefault();n.stopPropagation();t.selectedColorCode=e(this).attr("title");t.options.onSelect.call(this,t.selectedColorCode)})}if(typeof t.options.onmouseover==="function"){e("div.color_cell").on("mouseover",function(n){n.preventDefault();n.stopPropagation();t.selectedColorCode=e(this).attr("title");t.options.onmouseover.call(this,t.selectedColorCode)})}},construct:function(){var e=this;e.options.colorData=e.createColorCodes(e.options.rows*e.options.cols);e.attachToElem(e.getHtmlData());e.enableClick();e.getonSelect()}};e.fn.colorPicker=function(e){return this.each(function(){var n=Object.create(t);n.init(e,this)})};e.fn.colorPicker.options={rows:4,cols:4,cellWidth:20,cellHeight:20,cellSpacing:5,zindex:200,top:10,left:10,showCode:0,colorData:[],onSelect:null}})(jQuery)
