<style>
@charset "utf-8";
/* CSS Document */

body {
	background:#ffffff;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #1A0E00;
	font-weight: normal;
	line-height:18px;
	-webkit-text-size-adjust:100%;
}

img, embed, object, video {
	max-width: 100%;
	height: auto;
}
iframe {
	border: none;
}

img a { 
	border:none; 
	outline:none;
	text-decoration:none;
	}
	
a img { 
	border:none; 
	outline:none;
	text-decoration:none;
	}
	
.container {
	width: 814px;
	height:auto;
	margin:0 auto;
	padding-top:5px;
	}
a { text-decoration:none; color:#004080;}
a:hover { text-decoration:none; color:#008;}

.menu_box {
    border:solid 1px transparent;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    border-radius: 7px;
	background:url(../images/menu_bg.jpg) top left repeat-x;
	}
	
.logo {
	width:237px;
	float:left;
	margin-right:10px;
	margin-left:-1px;
	}

.menu {
	width:550px; 
	float:right;
	font:normal 13px Tahoma, Geneva, sans-serif;
	color:#fff;
	}
	
ul.main_nav {
	margin: 0;
	padding: 0;
	list-style: none;
	height: 56px;
	width: 100%;
	padding-left:100px;
}
ul.main_nav li {
	float: left;
	margin: 0;
	padding: 0;
	height: 55px;
	line-height: 55px; /*--aligns text within the tab--*/
	margin-bottom: -1px; /*--Pull the list item down 1px--*/
	overflow: hidden;
	position: relative;
	margin-right:5px;
	min-width:73px;
	text-align:center;
	
}
ul.main_nav li:first-child{ /*--Removes the left border from the first child of the list--*/
border-left:none;	
	
}
ul.main_nav li a {
	text-decoration: none;
	color: #fff;
	display: block;
	font-size: 13px;
	padding-right:5px;
	padding-left:5px;

	outline: none;
}
ul.main_nav li a:hover {
	background: #fff;
	color:#144d9a;
}
ul.main_nav li a.active { /*--Makes sure that the active tab does not listen to the hover properties--*/
	background: #fff;
	border-bottom: 1px solid #fff; 
	color:#144d9a;
}
ul.main_nav li.active a{
	background: #fff;
	border-bottom: 1px solid #fff; 
	color:#144d9a;	
}

.clear { 
	clear:both;
	}	

.top_btns { 
	padding-bottom:10px; 
	margin-top:-50px; 
	text-align:right; 
	padding-right:10px;
	}

.banner { 
	border:solid 1px #6485b1;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    border-radius: 7px;
	padding:5px;
	margin:10px 0;

}

.banner .banimg { float:left; width:320px; height:225px; margin-right:15px;} 
.banner .bantxt { float:right; width:420px; text-align:center; padding:15px;}	

.mainhead { font:bold 28px Arial, "Helvetica", sans-serif; color:#093979; padding:5px 0;}
.greentxt { font:bold 18px Arial, "Helvetica", sans-serif; color:#8fc312; padding:5px 0;}
.normtxt { font:normal 14px Arial, Helvetica, sans-serif; color:#aab2bb; padding:5px 0;}

.blubtn a{ 
	background:url(../images/bluebtn_bg.jpg) top left repeat-x; 	
	border:1px solid #6485b1;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    border-radius: 7px;
	padding: 9px 12px 8px 11px;
	margin-top: 10px;
	font-size: 12px;
	color: #ffffff !important;
	line-height: 12px;
	font-weight: normal;
	cursor: pointer;
	width: auto;
	height: auto;
	display: inline-block;
	text-decoration:none;
	}
	
.blubtn a:hover { 
	background:#134795; 	
	border:1px solid #6485b1;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    border-radius: 7px;
	padding: 9px 12px 8px 11px;
	margin-top: 10px;
	font-size: 12px;
	color: #ffffff !important;
	line-height: 12px;
	font-weight: normal;
	cursor: pointer;
	width: auto;
	height: auto;
	display: inline-block;
	text-decoration:none;
	}
	
.box_head {
	background:#fff url(../images/sepreator.jpg) 0px 20px repeat-x;
	margin:20px 0 10px 0;
	}
.box_head a{
	text-decoration:none;
	color:#093979;
}

.box_head a:hover{
	text-decoration:none;
	color:#093979;
}
	
.box_headtxt {
	font:bold 24px Arial, "Helvetica", sans-serif;
	color:#093979;
	float:left;
	display:inline-block;
	background:#ffffff;
	padding:0px 10px 0px 5px;
	}	
.box_headsmall { 
	float:right; 
	margin-bottom:-5px; 
	text-align:right;
	color:#093979;
	font-weight:bold;
	}	
	
.product_box { 
	width:240px;
	float:left;
	margin-right:40px;
	border:solid 1px #6485b1;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    border-radius: 7px;
	}	
.last { margin-right:0px;}

.product_box .thumbimg{ 
	margin-bottom:10px;
	}
	
.product_box .hedtxt { font:normal 14px Arial, "Helvetica", sans-serif; color:#061859; padding:0 10px; margin-bottom:15px; }	

.product_box .prodtxt { padding:10px 10px; }
.onlinetxt { width:auto; float:left; display:inline-block; font:normal 14px Arial, "Helvetica", sans-serif; color:#1E1E1E; padding-top:5px;}
.onlinetxt a { text-decoration:none; color:#1E1E1E;}
.onlinetxt a:hover { text-decoration:none; color:#006;}

.grbtn a{ 
	background:#67a104; 	
	border:1px solid #4f7b03;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    border-radius: 7px;
	padding: 7px 8px 6px 7px;
	font-size: 12px;
	color: #ffffff !important;
	line-height: 12px;
	font-weight: normal;
	cursor: pointer;
	width: auto;
	height: auto;
	display: inline-block;
	text-decoration:none;
	float:right;
	}
	
.grbtn a:hover {
	float:right;
	background:#466b06; 	
	border:1px solid #4f7b03;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    border-radius: 7px;
	padding: 7px 8px 6px 7px;
	font-size: 12px;
	color: #ffffff !important;
	line-height: 12px;
	font-weight: normal;
	cursor: pointer;
	width: auto;
	height: auto;
	display: inline-block;
	text-decoration:none;
	}

.footer { 
	background:url(../images/menu_bg.jpg) top left repeat-x;
    border:solid 1px transparent;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    border-radius: 7px;
	margin-top:15px;
	font:normal 12px Tahoma, Geneva, sans-serif;
	color:#ffffff;
}

.footer a:link, .footer a:visited, .footer a:active{ color:#fff; padding:0 10px; text-decoration:none; }
.footer a:hover {color:#6FF; padding:0 10px; text-decoration:none; }

.leftfot { width:350px; text-align:left; float:left; padding:10px 15px;}
.ri8fot { width:375px; text-align:right; float:right; padding:10px 15px;}

.mainhead { font:bold 24px Arial, Helvetica, sans-serif; margin:15px 0 0 0;}
.boldtxt { font:normal 18px Arial, Helvetica, sans-serif; margin:5px 0; color:#aab2bb; margin:5px 0 10px 0;}
.inner_banner { padding:15px 0;}
.inner { margin-left:71px;}
.leftpanel { width:345px; float:left; margin-right:10px; background:url(../images/arrow_bg.jpg) top left no-repeat;}
.ri8panel { width:450px; float:right; border-bottom:3px solid #d6d6d6;}

.float_btn { padding:10px 0px 23px 106px;}
.buy_btn { padding:15px 0 25px 40px; background:#cfeef5;}
.greenarea { background:#ddeacf; border-top: 1px solid #ffffff;}
.deal_on { background:url(../images/tick_imgg.jpg) top left no-repeat; font:normal 16px Tahoma, Geneva, sans-serif; color:#333333; padding-left:25px; margin:15px 85px; }

.social_butns { text-align:right; padding:7px 10px;}
.content { padding:10px 0;}
.cont_left { width:275px; float:left; margin-right:10px; padding-left:70px;}
.cont_ri8 { width:450px; float:right;}

.conthead { font:bold 14px Tahoma, Geneva, sans-serif; color:#333333;}

</style>