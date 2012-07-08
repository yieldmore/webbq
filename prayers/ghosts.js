 /**
  ** Ghosts - Halloween -  JavaScript 
  ** This script and many more are free at
  ** http://rainbow.arch.scriptmania.com/scripts/
  */
if(!window.Halloween) Halloween=new Object();
Halloween.ghostImages = new Array( 
	"<b>Lorem </b>",
	"<b>ipsum </b>",
	"<b>dolor </b>",
	"<b>sit </b>",
	"<b>amet</b>"
);
Halloween.interval = 40;
var ns4 = document.layers;
var ie4 = document.all;
Halloween.makeLayer = function(id)
{
	var el = 	document.getElementById	? document.getElementById(id) :
			document.all 		? document.all[id] :
							  document.layers[id];
	if(ns4) el.style=el;
	el.sP=function(x,y){this.style.left = x;this.style.top=y;};
	el.show=function(){ this.style.visibility = "visible"; } 
	el.hide=function(){ this.style.visibility = "hidden"; } 
	if(ns4 || window.opera) 
		el.sO = function(pc){return 0;};
	else if(ie4)
		el.sO = function(pc)
		{
			if(this.style.filter=="")
				this.style.filter="alpha(opacity=100);";
			this.filters.alpha.opacity=pc;
		}
	else
		el.sO = function(pc){this.style.MozOpacity=pc/100;}

	return el;
}

if(window.innerWidth)
{
	gX=function(){return innerWidth;};
	gY=function(){return innerHeight;};
}
else
{
	gX=function(){return document.body.clientWidth-30;};
	gY=function(){return document.body.clientHeight-30;};
}
Halloween.ghostOutput=function()
{
	for(var i=0 ; i<Halloween.ghostImages.length ; i++)
		document.write(ns4 ? "<LAYER  NAME='gh"+i+"'>"+Halloween.ghostImages[i]+"</LAYER>" : 
					   "<DIV id='gh"+i+"' style='position:absolute'>"+Halloween.ghostImages[i]+"</DIV>" );
	
}
Halloween.ghostSprites = new Array();
Halloween.ghostStartAni = function()
{
	for(var i=0 ;i<Halloween.ghostImages.length;i++)
	{
		var el=Halloween.makeLayer("gh"+i);
		el.x=Math.random()*gX();
		el.y=Math.random()*gY();
		el.tx=Math.random()*gX();
		el.ty=Math.random()*gY();
		el.dx=-5+Math.random()*10;
		el.dy=-5+Math.random()*10;
		el.state="down";
		el.op=0;
		el.sO(el.op);
		//el.hide();
		Halloween.ghostSprites[i] = el;
	}
	setInterval("Halloween.ghostAni()", Halloween.interval);
}
Halloween.ghostAni = function()
{
	for(var i=0 ;i<Halloween.ghostSprites.length;i++)
	{
		el=Halloween.ghostSprites[i];

		if(el.state == "off")
		{
			if(Math.random() > .99)
			{
				el.state="up";
				el.show();
			}
		}
		else if(el.state == "on")
		{
			if(Math.random() > .98)
				el.state="down";
		}
		else if(el.state == "up")
		{
			el.op += 2;
			el.sO(el.op);
			if(el.op==100)
				el.state = "on";
		}
		else if(el.state == "down")
		{
			el.op -= 2;
			if(el.op==0)
			{
				el.op = 100;
				el.state = "up";
			}
			else
				el.sO(el.op);
		}

		var X = (el.tx - el.x);
		var Y = (el.ty - el.y);
		var len = Math.sqrt(X*X+Y*Y);
		if(len < 1) len = 1;
		var dx = 20 * (X/len);
		var dy = 20 * (Y/len);
		var ddx = (dx - el.dx)/10;
		var ddy = (dy - el.dy)/10;
		el.dx += ddx;
		el.dy += ddy;
		el.sP(el.x+=el.dx,el.y+=el.dy);

		if(Math.random() >.95 )
		{
			el.tx = Math.random()*gX();
			el.ty = Math.random()*gY();
		}

	}
}
Halloween.ghostStart = function()
{
	if(Halloween.ghostLoad)Halloween.ghostLoad();
	Halloween.ghostStartAni();
}
