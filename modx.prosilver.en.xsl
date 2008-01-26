<?xml version="1.0" encoding="UTF-8" ?>
<!-- MODX by the phpBB MOD Team XSL file v1.0 copyright 2005-2007 the phpBB MOD Team. 
	$Id: modx.prosilver.en.xsl,v 1.1.2.3 2007/05/28 10:20:13 paulsohier Exp $ -->
<!DOCTYPE xsl:stylesheet[
	<!ENTITY nbsp "&#160;">
]>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0" xmlns:mod="http://www.phpbb.com/mods/xml/modx-1.0.xsd">
	<xsl:output method="html" omit-xml-declaration="no" indent="yes" />
<xsl:variable name="title" select="mod:mod/mod:header/mod:title" />
<xsl:variable name="version">
<xsl:for-each select="mod:mod/mod:header/mod:mod-version">
	<xsl:call-template name="give-version">
		</xsl:call-template>
	</xsl:for-each>
</xsl:variable>
	<xsl:template match="mod:mod">
		<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<meta http-equiv="Content-Language" content="en" />
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<style>

/*  phpBB 3.0 Admin Style Sheet
	------------------------------------------------------------------------
	Original author:	subBlue ( http://www.subblue.com/ )
	Copyright 2007 phpBB Group ( http://www.phpbb.com/ )
	------------------------------------------------------------------------
*/

/* General markup styles
---------------------------------------- */
* {
	/* Reset browsers default margin, padding and font sizes */
	margin: 0;
	padding: 0;
	font-size: 100%;
}

body, div, p, th, td, li, dd {
	font-size: x-small;
	voice-family: "\"}\"";
	voice-family: inherit;
	font-size: small
}

html>body, html>div, html>p, html>th, html>td, html>li, html>dd {
	font-size: small
}

html {
	color: #536482;
	background: #DBD7D1;
	/* Always show a scrollbar for short pages - stops the jump when the scrollbar appears. non-ie browsers */
	height: 100%;
	margin-bottom: 1px;
}

body {
	/* Text-Sizing with ems: http://www.clagnut.com/blog/348/ */
	font-family: "Lucida Grande", Verdana, Helvetica, Arial, sans-serif;
	color: #536482;
	background: #DBD7D1;
	font-size: 62.5%;	/* This sets the default font size to be equivalent to 10px */
	margin: 10px 15px;
}

img {
	border: 0;
}

h1 {
	font-family: "Trebuchet MS", Helvetica, sans-serif;
	font-size: 1.70em;
	font-weight: normal;
	color: #333333;
}

h2, caption {
	font-family: "Trebuchet MS", Helvetica, sans-serif;
	font-size: 1.40em;
	font-weight: normal;
	color: #115098;
	text-align: left;
	margin-top: 25px;
}

.rtl h2, .rtl caption {
	text-align: right;
}

h3, h4, h5 {
	font-family: "Trebuchet MS", Helvetica, sans-serif;
	font-size: 1.20em;
	text-decoration: none; 
	line-height: 1.20em; 
	margin-top: 10px;
}

p {
	margin-bottom: 0.7em;
	line-height: 1.40em;
	font-size: 0.90em;
}

ul {
	list-style: disc;
	margin: 0 0 1em 2em;
}

.rtl ul {
	margin: 0 2em 1em 0;
}

hr {
	border: 0 none;
	border-top: 1px dashed #999999;
	margin-bottom: 5px;
	padding-bottom: 5px;
	height: 1px;
}

.small { 
	font-size: 0.85em; 
}

/* General links  */
a:link, a:visited {
	color: #105289;
	text-decoration: none;
}

a:hover {
	color: #BC2A4D;
	text-decoration: underline;
}

a:active {
	color: #368AD2;
	text-decoration: none;
}

/* Main blocks
---------------------------------------- */
#wrap {
	padding: 0 0 15px 0;
	min-width: 615px;
}

#page-header {
	clear: both;
	text-align: right;
	background: url(data:image/gif;base64,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) top left no-repeat;
	height: 69px;
	font-size: 0.85em;
	margin-bottom: 10px;
}

.rtl #page-header {
	text-align: left;
	background: top right no-repeat;
}

#page-header h1 {
	color: #767676;
	font-family: "Trebuchet MS",Helvetica,sans-serif;
	font-size: 1.70em;
	padding-top: 10px;
}

#page-header p {
	font-size: 1.00em;
}

#page-body {
	clear: both;
	min-width: 700px;
}

#page-footer {
	clear: both;
	font-size: 0.75em;
	text-align: center;
}

#content {
	padding: 30px 10px 10px;
	position: relative;
}

#content h1 {
	color: #115098;
	line-height: 1.2em;
	margin-bottom: 0px;
}

#main {
	width: 100%;
	margin: 0;
	min-height: 350px;
}

.rtl #main {
	float: right;
	margin: 0;
}

* html #main { 
	height: 350px; 
}

/* Main Panel
---------------------------------------- */
#acp {
	margin: 4px 0;
	padding: 3px 1px;
	min-width: 550px;
	background-color: #FFFFFF;
	border: 1px #999999 solid;
}

.panel {
	background: #F3F3F3 url(data:image/gif;base64,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) repeat-x top;
	padding: 0;
}

span.corners-top, span.corners-bottom, 
span.corners-top span, span.corners-bottom span {
	font-size: 1px;
	line-height: 1px;
	display: block;
	height: 5px;
	background-repeat: no-repeat;
}

span.corners-top, span.corners-bottom {
	background-image: url(data:image/gif;base64,R0lGODlhiBMMAMQSAP///5mZmfPz89vX0cvIw9zc3PX19bKysqmopvb29pqamvn5+Z2dnLy6t62sqp+fnqCgn/T09P///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEAABIALAAAAACIEwwAAAX/4DAQDhScaKqubOu+cCzPdG3feK7vfO//wKBwSCwaj8ikcslsOp/QqHRKrVqv2Kx2y+16v+CweEwum8/otHrNbrvf8Lh8Tq/b7/i8fs/v+/+AgYKDhIWGh4hSAw0HBREAkJGSk5SVlpeYmZqbnJ2en6ChoqOkpaanqKmqq6ytrq+wsbKztLW2t7i5uru8vb6/wMHCw8TFxsfIycrLzM3Oz9DR0tPU1dbX2Nna29zd3t/g4eLj5OXm5+jp6uvs7e7v8PG7BAoCAAkCEvr7/P3+/wADChxIsKDBgwgTKlzIsKHDhxAjSpxIsaLFixgzatzIsaPHjyBDihxJsqTJkyhT/6pcybKly5cwY8qcSbOmzZs4c+rcybOnz59AgwodSrSo0aNIkypdyrSp06dQo0qdSrWq1atYs2rdShJBAQBcw4odS7as2bNo06pdy7at27dw48qdS7eu3bt48+rdy7ev37+AAwseTLiw4cOIizJYYCCx48eQI0ueTLmy5cuYM2vezLmz58+gQ4seTbq06dOoU6teHToAgHysY8ueTbu27du4c+vezbu379/AgwsfTry48ePIkyuX4Br28ufQo0ufTr269evYs2vfzr279+/gw4sfT7704sbl06tfz769+/fw48ufT7++/fv48+vfzx+vV7D9BSjggAQWaOCBCCao4JmCDDbo4IMQRijhdfTYg8+EGGao4YYcdujhhyCGKOKIJJZo4oko5rVIIwbI4+KLMMYo44w01mjjjTjmqOOOPPbo449ABinkkEQWaeSRSCap5JJMNunkk1BGKeWUVFaZjQgkPJDIllx26eWXYIYp5phklmnmmWimqeaabLbp5ptwxinnnHTWaeedeOap55589unnn4AGKigcIQAAOw==);
}

span.corners-top span, span.corners-bottom span {
	background-image: url(data:image/gif;base64,R0lGODlhBgAMAMQWAP///9vX0fPz85mZmdzc3Jqamtvb28vIw7y6t62sqsvIxPX19bKysqmop/T09Pb29pycnJ+fnp2dnKCgn/n5+fr6+v///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEAABYALAAAAAAGAAwAAAUs4DAlRxAADsEggfAAQqFYNGA0tLVQUi4AAx8w56hAcraGCyYDLFSsQYRkCgEAOw==);
}

span.corners-top {
	background-position: 0 0;
	margin: -4px -2px 0;
}

span.corners-top span {
	background-position: 100% 0;
}

span.corners-bottom {
	background-position: 0 100%;
	margin: 0 -2px -4px;
	clear: both;
}

span.corners-bottom span {
	background-position: 100% 100%;
}

/* General form styles
----------------------------------------*/
fieldset {
	margin: 15px 0;
	padding: 10px;
	border-top: 1px solid #D7D7D7;
	border-right: 1px solid #CCCCCC;
	border-bottom: 1px solid #CCCCCC;
	border-left: 1px solid #D7D7D7;
	background-color: #FFFFFF;
	/*position: relative;*/
}

.rtl fieldset {
	border-top: 1px solid #D7D7D7;
	border-right: 1px solid #D7D7D7;
	border-bottom: 1px solid #CCCCCC;
	border-left: 1px solid #CCCCCC;
}

* html fieldset {
	padding: 0 10px 5px 10px;
}

fieldset p {
	font-size: 0.85em;
}

legend {
	padding: 1px 0;
	font-family: Tahoma,arial,Verdana,Sans-serif;
	font-size: 0.85em;
	font-weight: bold;
	color: #115098;
	position: relative;
	text-transform: capitalize;
	line-height: 1.00em;
	top: 0em;
	vertical-align: middle;
}

/* Hide from macIE \*/
legend { top: -1.2em; }
/* end */

* html legend {
	margin-bottom: -10px;
	margin-left: -7px;
}

/* Holly hack, .rtl comes after html */
* html .rtl legend {
	margin: 0;
	margin-right: -7px;
}

optgroup, select {
	font-family: Verdana, Helvetica, Arial, sans-serif;
	font-size: 0.85em;
	font-weight: normal;
	font-style: normal;
	cursor: pointer;
	vertical-align: middle;
	width: auto;
}

optgroup {
	font-size: 1.00em;
	font-weight: bold;
}

option {
	padding: 0 1em 0 0;
}

.rtl option {
	padding: 0 0 0 1em;
}

fieldset.nobg {
	margin: 15px 0 0 0;
	padding: 0;
	border: none;
	background-color: transparent;
}

/* MOD-ABOUT STUFFS ~smithy_dll */

.mod-about {
	/*float: left;*/
	background-color: #CADCEB;
	/*width: 100%;*/
}

.mod-about span.corners-top, .mod-about span.corners-bottom, 
.mod-about span.corners-top span, .mod-about span.corners-bottom span {
	font-size: 1px;
	line-height: 1px;
	display: block;
	height: 5px;
	background-repeat: no-repeat;
}

.mod-about span.corners-top, .mod-about span.corners-bottom {
	background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAYAAAAMCAYAAABBV8wuAAAABGdBTUEAANbY1E9YMgAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAABVSURBVHjaYviPAD+BeDIQ2wMxGwNU8AkQGwAxAwwzQFXqIgvCJCajC8IkbLBJMIItYmD4xYAGmBhwAJCEMS6JcKxa8DkX5kFdbBKwIJkADRIGgAADAGtyotIvyqGpAAAAAElFTkSuQmCC);
}

.mod-about span.corners-top span, .mod-about span.corners-bottom span {
	background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAYAAAAMCAYAAABBV8wuAAAABGdBTUEAANbY1E9YMgAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAABbSURBVHjaYvr//z8bENsD8WQg/vkfChjQsAEQPwFJMDGgggtA7AnEv9AlQOAyEM/CJgECK3FJnMIlwYZLQheXRDg2CV0gzmTCIrgd2Q4bIJ4AxGeAWBokABBgAE4XMoXm9S+UAAAAAElFTkSuQmCC);
}

.mod-about span.corners-top {
	background-position: 0 0;
	margin: 0 0;
}

.mod-about span.corners-top span {
	background-position: 100% 0;
}

.mod-about span.corners-bottom {
	background-position: 0 100%;
	margin: 0 0;
	clear: both;
}

.mod-about span.corners-bottom span {
	background-position: 100% 100%;
}

/* END PROSILVER ADMIN PANEL STYLESHEET */
	
#language { width: 130px; }
		
.mod-about { margin: 10px 0; }
.mod-about dl, .mod-about p, .mod-about h2, .mod-about h3, .mod-about div { margin: 5px 8px; }
.mod-about div.inner { margin: 0px; }
		
#modDisclaimer .mod-about, #other-notes.mod-about { background-color: #EECCCC; }
#other-notes.mod-about strong.red { color: #DD3333; }
		
span.key { font-size: 10px; height: 14px; width: 18px; border: outset 2px #999999; background-color: #EEEECC; display: block; float: left; text-align: center; font-weight: bold; margin-right: 5px; }
		
.mod-edit { background-color: #D6E6F6; border: solid 1px #336699; margin: 10px 0; padding: 0 10px; }
.mod-inlineedit { background-color: #DDEEFF; border: solid 1px #6699CC; margin: 10px 0; padding: 0 10px; }
		
dl.author-info dd { margin-left: 100px; }

ol#file-copy { padding: 5px;  margin-left: 20px; margin-bottom: 10px; }
ol#file-copy li { margin-left: 30px; }
ol#file-copy span { font-weight: bold; }
		
/* Code block */
div.codebox {
	padding: 3px;
	background-color: #FFFFFF;
	border: 1px solid #d8d8d8;
	font-size: 1em;
}

div.codebox div.codeHead {
	text-transform: uppercase;
	border-bottom: 1px solid #CCCCCC;
	margin-bottom: 3px;
	font-size: 0.8em;
	font-weight: bold;
	display: block;
}

blockquote div.codebox {
	margin-left: 0;
}

div.codebox pre {
	/* Also see tweaks.css */
	overflow: auto;
	display: block;
	height: auto;
	max-height: 200px;
	/*white-space: normal;*/
	padding-top: 5px;
	font: 0.9em Monaco, "Andale Mono","Courier New", Courier, mono;
	line-height: 1.3em;
	color: #8b8b8b;
	margin: 2px 0;
}
</style>

<script type="text/javascript">
var i = 0;
var box = new Array();
  
/* passed from xslt */

<xsl:for-each select="mod:header">
var documentLanguages = new Array(<xsl:for-each select="mod:title">'<xsl:value-of select="@lang" />'<xsl:if test="position()!=last()">,</xsl:if></xsl:for-each>);
  <xsl:for-each select="mod:author-group">
  var authors = <xsl:value-of select="count(mod:author)"/>;
  var authors_ll = new Array();
    i = 0;
    <xsl:for-each select="mod:author">
      authors_ll[i] = '<xsl:value-of select="generate-id()"/>';
      i += 1;
    </xsl:for-each>
  </xsl:for-each>

  var mhes = 0;
  var mhes_ll = new Array();
  var mhcls = 0;
  var mhcls_ll = new Array();
  <xsl:for-each select="mod:history/mod:entry">
    mhes_ll[mhes] = '<xsl:value-of select="generate-id()"/>';
    mhes++;
    <xsl:if test="count(mod:changelog) > 1">
      mhcls_ll[mhes] = '<xsl:value-of select="generate-id()"/>';
      mhcls++;
    </xsl:if>
  </xsl:for-each>
</xsl:for-each>

var opens = 0;
var opens_ll = new Array();
<xsl:for-each select="mod:action-group/mod:open">
  opens_ll[opens] = '<xsl:value-of select="generate-id()"/>';
  opens++;
</xsl:for-each>

var codes = 0;
var codes_ll = new Array();
<xsl:for-each select="mod:action-group/mod:sql">
  box[codes] = '<xsl:value-of select="generate-id()"/>';
  codes_ll[codes] = '<xsl:value-of select="generate-id()"/>';
  codes++;
</xsl:for-each>

var finds = 0;
var finds_ll = new Array();
var regex = 0;
var regex_ll = new Array();
var ifinds = 0;
var ifinds_ll = new Array();
var iregex = 0;
var iregex_ll = new Array();
var addafters = 0;
var addafters_ll = new Array();
var iaddafters = 0;
var iaddafters_ll = new Array();
var addbefores = 0;
var addbefores_ll = new Array();
var iaddbefores = 0;
var iaddbefores_ll = new Array();
var replacewiths = 0;
var replacewiths_ll = new Array();
var ireplacewiths = 0;
var ireplacewiths_ll = new Array();
var increments = 0;
var increments_ll = new Array();
var iincrements = 0;
var iincrements_ll = new Array();

var comments = 0;
var comments_ll = new Array();
<xsl:for-each select="mod:action-group/mod:open/mod:edit">
  <xsl:for-each select="mod:find">
    finds_ll[finds] = '<xsl:value-of select="generate-id()"/>';
    finds++;
    <xsl:if test="@type = 'regex'">
      regex_ll[regex] = '<xsl:value-of select="generate-id()"/>';
      regex++;
    </xsl:if>
  </xsl:for-each>
  <xsl:if test="count(mod:comment) > 0">
    comments_ll[comments] = '<xsl:value-of select="generate-id()"/>';
    comments++;
  </xsl:if>
	<xsl:for-each select="mod:find|mod:action">
		box[codes] = '<xsl:value-of select="generate-id()"/>';
    codes_ll[codes] = '<xsl:value-of select="generate-id()"/>';
    codes++;

    <xsl:if test="name() = 'action'">
      <xsl:if test="@type = 'after-add'">
        addafters_ll[addafters] = '<xsl:value-of select="generate-id()"/>';
        addafters++;
      </xsl:if>
      <xsl:if test="@type = 'before-add'">
        addbefores_ll[addbefores] = '<xsl:value-of select="generate-id()"/>';
        addbefores++;
      </xsl:if>
      <xsl:if test="@type = 'replace-with'">
        replacewiths_ll[replacewiths] = '<xsl:value-of select="generate-id()"/>';
        replacewiths++;
      </xsl:if>
      <xsl:if test="@type = 'operation'">
        increments_ll[increments] = '<xsl:value-of select="generate-id()"/>';
        increments++;
      </xsl:if>
    </xsl:if>

  </xsl:for-each>
	<xsl:for-each select="mod:inline-edit">
    <xsl:for-each select="mod:inline-find">
      ifinds_ll[ifinds] = '<xsl:value-of select="generate-id()"/>';
      ifinds++;
      <xsl:if test="@type = 'regex'">
        iregex_ll[iregex] = '<xsl:value-of select="generate-id()"/>';
        iregex++;
      </xsl:if>
    </xsl:for-each>
		<xsl:for-each select="mod:inline-find|mod:inline-action">
			box[codes] = '<xsl:value-of select="generate-id()"/>';
      codes_ll[codes] = '<xsl:value-of select="generate-id()"/>';
      codes++;

      <xsl:if test="name() = 'inline-action'">
        <xsl:if test="@type = 'after-add'">
          iaddafters_ll[iaddafters] = '<xsl:value-of select="generate-id()"/>';
          iaddafters++;
        </xsl:if>
        <xsl:if test="@type = 'before-add'">
          iaddbefores_ll[iaddbefores] = '<xsl:value-of select="generate-id()"/>';
          iaddbefores++;
        </xsl:if>
        <xsl:if test="@type = 'replace-with'">
          ireplacewiths_ll[ireplacewiths] = '<xsl:value-of select="generate-id()"/>';
          ireplacewiths++;
        </xsl:if>
        <xsl:if test="@type = 'operation'">
          iincrements_ll[iincrements] = '<xsl:value-of select="generate-id()"/>';
          iincrements++;
        </xsl:if>
      </xsl:if>
      
      
    </xsl:for-each>
	</xsl:for-each>
</xsl:for-each>
 
 <xsl:for-each select="mod:action-group/mod:diy-instructions">
  codes_ll[codes] = '<xsl:value-of select="generate-id()"/>';
  codes++;
</xsl:for-each>
  
var copies = 0;
var copies_ll = new Array();
<xsl:for-each select="mod:action-group/mod:copy/mod:file">
  copies_ll[copies] = '<xsl:value-of select="generate-id()"/>';
  copies++;
</xsl:for-each>

  <xsl:text disable-output-escaping="yes">
<![CDATA[
// The following line from http://www.ryancooper.com/resources/keycode.asp
document.onkeydown = mod_doKeyPress;

var host = "http://www.phpbb.com/mods/modx/i18n/";

var xhr = null;
var xhr_lang = null;
var remoteData = null;

var enStrings = "h1=Installation Instructions for \n" +
"V=Version \n" +
"t=Title:\n" +
"d=Description:\n" +
"aV=Version:\n" +
"mint=minutes\n" +
"it=Installation Time:\n" +
"il=Installation Level:\n" +
"ile=Easy\n" +
"ili=Intermediate\n" +
"ilh=Hard\n" +
"au=Author\n" +
"aus=Authors\n" +
"a-un=Username:\n" +
"a-e=Email:\n" +
"a-n=Name:\n" +
"a-h=WWW:\n" +
"fte=Files to Edit\n" +
"icf=Included Files\n" +
"icfn=No files have been included with this MOD.\n" +
"dcl=Disclaimer\n" +
"dclt=For security purposes, please check: <a href=\"http://www.phpbb.com/mods/\">http://www.phpbb.com/mods/</a> for the latest version of this MOD. Downloading this MOD from other sites could cause malicious code to enter into your phpBB Forum. As such, phpBB will not offer support for MODs not offered in our MODs database, located at: <a href=\"http://www.phpbb.com/mods/\">http://www.phpbb.com/mods/</a>\n" +
"isp=English Support\n" +
"ispt=English support can be obtained at <a href=\"http://www.phpbb.com/mods/\">http://www.phpbb.com/mods/</a> for released MODs.\n" +
"ant=Author Notes\n" +
"lic=License\n" +
"lict=This MOD has been licensed under the following license:\n" +
"ont=Other Notes\n" +
"ontt1=Before adding this MOD to your forum, you should back up all files related to this MOD\n" +
"ontt2=This MOD was designed for phpBB\n" +
"ontt3= and may not function as stated on other phpBB versions. MODs for phpBB3.0 will <strong>not</strong> work on phpBB2.0 and vice versa.\n" +
"onttq=This MOD is development quality. It is not recommended that you install it on a live forum.\n" +
"sql=SQL\n" +
"fca=File Copy\n" +
"c-copy=Copy:\n" +
"c-to=To:\n" +
"cde-c=Code: \n" +
"cde-sa=Select All\n" +
"edts=Edits\n" +
"edtt=Use your keyboard to navigate the code boxes. You may also hit '<em>s</em>' on your keyboard to go to the first code box.\n" +
"opn=Open:\n" +
"cm-cmt=Comments\n" +
"fnd=Find\n" +
"fndt=<strong>Tip:</strong> This may be a partial find and not the whole line.\n" +
"rplw=Replace With\n" +
"rplwt=<strong>Tip:</strong> Replace the preceding line(s) to find with the following lines.\n" +
"aft=Add after\n" +
"aftt=<strong>Tip:</strong> Add these lines on a new blank line after the preceding line(s) to find.\n" +
"bef=Add before\n" +
"beft=<strong>Tip:</strong> Add these lines on a new blank line before the preceding line(s) to find.\n" +
"inc=Increment\n" +
"inct=<strong>Tip:</strong> This allows you to alter integers. For help on what each operator means, click here.\n" +
"ifnd=In-line Find\n" +
"ifndt=<strong>Tip:</strong> This is a partial match of a line for in-line operations.\n" +
"irplw=In-line Replace With\n" +
"irplwt=\n" +
"iaft=In-line Add after\n" +
"iaftt=\n" +
"ibef=In-line Add before\n" +
"ibeft=\n" +
"iinc=In-line Increment\n" +
"iinct=<strong>Tip:</strong> This allows you to alter integers. For help on what each operator means, click here.\n" +
"diy=DIY Instructions\n" +
"diyt=These are manual instructions that cannot be performed automatically. You should follow these instructions carefully.\n" +
"eom=Save all files. End of MOD.\n" +
"eomt=You have finished the installation for this MOD. Upload all changed files to your website. If the installation went bad, simply restore your backed up files.\n" +
"slg=Select Language:\n" +
"foot=MOD UA XSLT File Copyright &#169; 2007 The phpBB Group, this MOD is copyright to the authors listed above.\n" +
"regex=This find contains an advanced feature known as regular expressions, click here to learn more.\n" +
"mhe-v= - Version \n" +
"mh=MOD History\n" +
"atm=About this MOD";

var currentLanguage = "en";
var languagesLoaded = false;

var arrClasCnt = new Array(
  new Array('a-', authors, authors_ll),
  new Array('c-', copies, copies_ll),
  new Array('cm-', comments, comments_ll),
  new Array('opn', opens, opens_ll),
  new Array('cde-', codes, codes_ll),
  new Array('fnd', finds, finds_ll),
  new Array('regex', regex, regex_ll),
  new Array('rplw', replacewiths, replacewiths_ll),
  new Array('aft', addafters, addafters_ll),
  new Array('bef', addbefores, addbefores_ll),
  new Array('inc', increments, increments_ll),
  new Array('ifnd', ifinds, ifinds_ll),
  new Array('regex', iregex, iregex_ll),
  new Array('irplw', ireplacewiths, ireplacewiths_ll),
  new Array('iaft', iaddafters, iaddafters_ll),
  new Array('ibef', iaddbefores, iaddbefores_ll),
  new Array('iinc', iincrements, iincrements_ll),
  new Array('mhe', mhes, mhes_ll));

var languages = new Array('en');

function inArray(array, value)
// Returns true if the passed value is found in the
// array.  Returns false if it is not.
{
    var i;
    for (i=0; i < array.length; i++) {
        // Matches identical (===), not just similar (==).
        if (array[i] === value) {
            return true;
        }
    }
    return false;
};

function startup()
{
	xhr = createXHR();

	changeLanguage(currentLanguage);
	document.getElementById('lang-selector').style.display = "block";
}

function changeLanguage(langCode)
{
  langCode = langCode.toLowerCase();
	currentLanguage = langCode.split('-')[0];
	if (currentLanguage.toLowerCase() != 'en') // if change, only include up to first dash
	{
		loadLanguage();
		xslLanguage(langCode);
		return;
	}
	else
	{
		var texts = enStrings.split("\n");
		applyLanguage(texts);
		xslLanguage(langCode);
	}
}

function xslLanguage(langCode)
{
		i18nedEls = new Array('title','description','author-notes','diy');
		var c, h;
		for (c in comments_ll)
		{
			i18nedEls.push('mod-comment[' + comments_ll[c] + ']');
		}
    for (h in mhcls_ll)
		{
			i18nedEls.push('mhcl[' + mhcls_ll[h] + ']');
		}
		
		// force to english of MODX if the MOD doesn't have a translation of the selected language
		if (!inArray(documentLanguages, langCode))
		{
			langCode = 'en';
		}
		
		var i;
		for (i in i18nedEls)
		{
			xslLangEl(langCode, i18nedEls[i]);
		}
}

function xslLangEl(langCode, element)
{
		var i;
		var currentEl = document.getElementById(element);
    try
    {
		  for (i in currentEl.childNodes)
		  {
			  try
			  {
					split = currentEl.childNodes[i].lang.toLowerCase().split('-')[0];			  	
				  if (currentEl.childNodes[i].lang.toLowerCase() == langCode.toLowerCase() || split == langCode.toLowerCase())
				  {
					  currentEl.childNodes[i].style.display = 'inline';
				  }
				  else
				  {
					  currentEl.childNodes[i].style.display = 'none';
				  }
			  }
			  catch (o) {}
		  }
    } catch (o) {}
}

function loadLanguages()
{
	if (languagesLoaded) return;
	languagesLoaded = true;

	try {
		netscape.security.PrivilegeManager.enablePrivilege("UniversalBrowserRead");
	} catch (e) { }

	var langSel = document.getElementById('language');        
	var loadingItem = document.createElement('option');                            
	langSel.appendChild(loadingItem);
	loadingItem.innerHTML = 'Loading...';
	langSel.remove(0);

	cacheRnd=parseInt(Math.random()*99999999); // cache
	xhr.open("GET", host + "languages.txt?rnd=" + cacheRnd, true); 

	xhr.onreadystatechange = function()
	{ 
		if(xhr.readyState == 4)
		{
			if(xhr.status == 200)
			{   
				languages = xhr.responseText.replace("\r", "").split("\n");

				var i, l, s = 0;
				documentLanguages.sort();
				for (i in languages)
				{
					languages[i] = languages[i].replace("\r", "");
					languages[i] = languages[i].split("=");

					var langItem = document.createElement('option');                            
					langSel.appendChild(langItem);
					langItem.value = languages[i][0];
					var iso = languages[i][0].split('-');
					langItem.innerHTML = languages[i][1];
					if (iso.length == 2)
					{
						langItem.innerHTML += ' [' + iso[1].toUpperCase() + ']';
					}
					if (languages[i][0] == currentLanguage)
					{
						langSel.selectedIndex = s;
						langSel.text = languages[i][1];
					}

					s++;
				}
					
				langSel.focus();
				langSel.onchange =
				function()
				{
					changeLanguage(this.value.replace(" ", ""));
				};
				langSel.remove(0);
			}	
		} 
	}; 

	xhr.send(null);
}

function showLanguages()
{
	loadLanguages();
}

function createXHR()
{
	try {
		netscape.security.PrivilegeManager.enablePrivilege("UniversalBrowserRead");
	} catch (e) { }

	var req = null;
	if(window.XMLHttpRequest)
	{
		req = new XMLHttpRequest;
	}
	else
	{
		var cases = ["Msxml2.XMLHTTP","MSXML2.XMLHTTP.5.0","MSXML2.XMLHTTP.4.0","MSXML2.XMLHTTP.3.0","MICROSOFT.XMLHTTP.1.0","MICROSOFT.XMLHTTP.1","MICROSOFT.XMLHTTP"];
    var i = 0;
		for(i in cases)
		{
			var casei=cases[i];
			try
			{
				req = new ActiveXObject(casei);
			}
			catch(o)
			{
				req = null;
			}
			if(req)
			{
				break;
			}
		}
	}
	return req;
}
	
function loadLanguage()
{
	try {
		netscape.security.PrivilegeManager.enablePrivilege("UniversalBrowserRead");
	} catch (e) { }

	xhr_lang = createXHR();
		
	cacheRnd=parseInt(Math.random()*99999999); // cache
	xhr_lang.open("GET", host + currentLanguage + ".txt?rnd=" + cacheRnd, true);
		
	xhr_lang.onreadystatechange = function()
	{ 
		if(xhr_lang.readyState == 4)
		{
			if(xhr_lang.status == 200)
			{   
				var texts = xhr_lang.responseText.replace("\r\n", "\n").split("\n");
				applyLanguage(texts);
			}	
		} 
	}; 

	xhr_lang.send(null);
}

function applyLanguage(texts)
{
	var i = 0;
	for (i in texts)
	{
		var lang = texts[i].split("=");
		if (lang.length < 2) continue;
		try
		{
			var j;
			var jflag = false;
			for (j = 0; j < arrClasCnt.length; j++)
			{
        var sw = '-' + lang[0];
				if (sw.match('-' + arrClasCnt[j][0]))
				{
					var k;
					for (k = 0; k < arrClasCnt[j][2].length; k++)
					{
            try
            {
						document.getElementById('lang-' + lang[0] + '[' + arrClasCnt[j][2][k] + ']').innerHTML = lang[1];
            } catch (e) {}
					}
					jflag = true;
				}
			}
			if (!jflag)
			{
				var p;
				var append = '';
				for (p = 1; p < lang.length; p++)
				{
					if (p > 1) lang[p] = '=' + lang[p];
					append += lang[p];
				}
				document.getElementById('lang-' + lang[0]).innerHTML = append;
			}
		}
		catch (o) {}
	}
}

function selectCode(a)
{
	// Get ID of code block
	var e = a.parentNode.parentNode.getElementsByTagName('PRE')[0];

	select_text(e.id);
}

/* prosilver */

var selectedElement = -1;
var boxes = box.length;
var pre_count = 0;

function SXBB_IsIEMac()
{
	// Any better way to detect IEMac?
	var ua = String(navigator.userAgent).toLowerCase();
	if( document.all && ua.indexOf("mac") >= 0 )
	{
		return true;
	}
	return false;
}

function select_text(id)
{
	var o = document.getElementById(id);
	if( !o )
	{
		return;
	}
	var r, s;
	if( document.selection && !SXBB_IsIEMac() )
	{
		// Works on: IE5+
		// To be confirmed: IE4? / IEMac fails?
		r = document.body.createTextRange();
		r.moveToElementText(o);
		r.select();
	}
	else if( document.createRange && (document.getSelection || window.getSelection) )
	{
		// Works on: Netscape/Mozilla/Konqueror/Safari
		// To be confirmed: Konqueror/Safari use window.getSelection ?
		r = document.createRange();
		r.selectNodeContents(o);
		s = window.getSelection ? window.getSelection() : document.getSelection();
		s.removeAllRanges();
		s.addRange(r);
	}

	find_selected(id);
	return o;
}

function find_selected(id)
{
	for( x = 0; x < box.length; x++ )
	{
		if ( box[x] == id )
		{
			selectedElement = x;
		}
	}
}

// function findPosY taken from http://www.quirksmode.org/js/findpos.html
function findPosY(obj)
{
	var curtop = 0;
	if (obj.offsetParent)
	{
		while (obj.offsetParent)
		{
			curtop += obj.offsetTop
			obj = obj.offsetParent;
		}
	}
	else if (obj.y)
	{
		curtop += obj.y;
	}
	return curtop;
}

function selectNextBox()
{
	selectedElement += 1;
	if (selectedElement >= boxes) selectedElement = 0;
	obj = select_text(box[selectedElement]);
	window.scrollTo(0, findPosY(obj) - 100);
}

function selectPrevBox()
{
	selectedElement -= 1;
	if (selectedElement < 0) selectedElement = boxes - 1;
	obj = select_text(box[selectedElement]);
	window.scrollTo(0, findPosY(obj) - 100);
}

function selectFirstBox()
{
	selectedElement = 0;
	obj = select_text(box[selectedElement]);
	window.scrollTo(0, findPosY(obj) - 100);
}

function mod_doKeyPress(e)
{
	/* section from w3 schools starts here http://www.w3schools.com/jsref/jsref_onkeypress.asp */
	var keynum;
	/* section from w3 schools ends here */

	// The following line from http://www.ryancooper.com/resources/keycode.asp
	if (window.event) keynum = window.event.keyCode;
	else if (e) keynum = e.which;

	if (keynum == 84 || keynum == 40) // t / down keys
	{
		selectNextBox();
		return false;
	}
	if (keynum == 38) //up key
	{
		selectPrevBox();
		return false;
	}
	if (keynum == 83 || keynum == 37)
	{
		selectFirstBox();
		return false;
	}
	return true; // true allows browser to take care of any further key press combinations such as ctrl + c
}
//-->]]></xsl:text>
</script>
				<title>phpBB MOD &#187; <xsl:value-of select="$title" /></title>
			</head>
      <body class="ltr" onload="startup()">
        <div id="debug"></div>
        <div id="wrap">
          <div id="page-header">
            <h1><span id="lang-h1">Installation Instructions for </span>'<xsl:value-of select="$title" />' <span id="lang-V">Version </span><xsl:value-of select="$version" /></h1>
            <form method="post" action="" id="lang-selector" style="display: none;">
              <fieldset class="nobg">
                <label for="language">
                  <span id="lang-slg">Select Language:</span>
                </label>
                <select id="language" name="language" onclick="showLanguages()">
                  <option value="en" selected="selected">English</option>
                </select>
              </fieldset>
            </form>
          </div>
          <div id="page-body">
            <div id="acp">
              <div class="panel">
                <span class="corners-top">
                  <span></span>
                </span>
                <div id="content">
                  <div id="main">
                    <fieldset class="permissions" id="perm00">
            <xsl:for-each select="mod:header">
							<xsl:call-template name="give-header"></xsl:call-template>
						</xsl:for-each>
                    </fieldset>
                    <hr />
                    <fieldset class="permissions" id="Fieldset1">
							<xsl:for-each select="mod:action-group">
								<xsl:call-template name="give-actions"></xsl:call-template>
							</xsl:for-each>
              <hr />
              <div class="endMOD">
                <h2 id="lang-eom">Save all files. End of MOD.</h2>
                <p id="lang-eomt">You have finished the installation for this MOD. Upload all changed files to your website. If the installation went bad, simply restore your backed up files.</p>
              </div>

            </fieldset>
        </div>
      </div>
      <span class="corners-bottom">
        <span></span>
      </span>
    </div>
  </div>
</div>
<div id="page-footer">
  <p class="copyright" style="text-align: center; font-size: 10px;" id="lang-foot">MOD UA XSLT File Copyright &#169; 2007 The phpBB Group, this MOD is copyright to the authors listed above.</p>
</div>
</div>
</body>
		</html>
	</xsl:template>
	<xsl:template name="give-header">
    <h2 id="lang-atm">About this MOD</h2>
    <dl>
      <dt id="lang-t">Title:</dt>
      <dd class="mod-about">
        <div class="inner">
          <span class="corners-top"><span></span></span>
				<xsl:if test="count(mod:title) > 1">
					<dl id="title">
						<xsl:for-each select="mod:title">
								<dt>
									<xsl:value-of select="@lang" />
								</dt>
								<dd style='white-space:pre;' lang="{@lang}">
									<p><xsl:value-of select="current()" /></p>
								</dd>
						</xsl:for-each>
					</dl>
				</xsl:if>
				<xsl:if test="count(mod:title) = 1"><p lang="{@lang}" style='white-space:pre;'><xsl:value-of select="mod:title" /></p></xsl:if>
          <span class="corners-bottom"><span></span></span>
        </div>
      </dd>
	    <dt id="lang-d">Description:</dt>
		    <dd class="mod-about">
			    <div class="inner">
				    <span class="corners-top"><span></span></span>
				    <xsl:if test="count(mod:description) > 1">
					    <dl id="description">
						    <xsl:for-each select="mod:description">
								  <dt><xsl:value-of select="@lang" /></dt>
                  <dd style='white-space:pre;' lang="{@lang}"><p>
								   <xsl:call-template name="add-line-breaks">
								    <xsl:with-param name="string">
									   <xsl:value-of select="current()" />
								    </xsl:with-param>
								   </xsl:call-template>
                  </p>
                </dd>
						    </xsl:for-each>
					    </dl>
				    </xsl:if>
				    <xsl:if test="count(mod:description) = 1">
              <p lang="{@lang}" style='white-space:pre;'>
                <xsl:call-template name="add-line-breaks">
                  <xsl:with-param name="string">
                    <xsl:value-of select="mod:description" />
                  </xsl:with-param>
                </xsl:call-template>
              </p>
				    </xsl:if>
            <span class="corners-bottom"><span></span></span>
          </div>
        </dd>
			<dt id="lang-aV">Version:</dt>
			<dd class="mod-about">
				<div class="inner">
					<span class="corners-top"><span></span></span>
          <p>
            <xsl:for-each select="mod:mod-version">
              <xsl:call-template name="give-version"></xsl:call-template>
            </xsl:for-each>
          </p>
          <span class="corners-bottom"><span></span></span>
        </div>
      </dd>
			<xsl:for-each select="mod:installation">
				<xsl:call-template name="give-installation"></xsl:call-template>
			</xsl:for-each>
		</dl>
		<xsl:for-each select="mod:author-group">
      <xsl:if test="count(mod:author) > 1"><h3 id="lang-aus">Authors</h3></xsl:if>
      <xsl:if test="count(mod:author) = 1"><h3 id="lang-au">Author</h3></xsl:if>
			<xsl:call-template name="give-authors"></xsl:call-template>
		</xsl:for-each>
    <h3 id="lang-fte">Files to Edit</h3>
		<xsl:for-each select="../mod:action-group">
			<xsl:call-template name="give-files-to-edit"></xsl:call-template>
		</xsl:for-each>
    <h3 id="lang-icf">Included Files</h3>
		<xsl:if test="count(../mod:action-group/mod:copy/mod:file) = 0">
			<p id="lang-icfn">No files have been included with this MOD.</p>
		</xsl:if>
		<xsl:for-each select="../mod:action-group">
			<xsl:call-template name="give-files-included"></xsl:call-template>
		</xsl:for-each>
		<hr />
    <div id="modDisclaimer">
      <h3 id="lang-dcl">Disclaimer</h3>
      <div class="mod-about">
        <div class="inner">
          <span class="corners-top">
            <span></span>
          </span>
          <p>
            <span id="lang-dclt">For security purposes, please check: <a href="http://www.phpbb.com/mods/">http://www.phpbb.com/mods/</a> for the latest version of this MOD. Downloading this MOD from other sites could cause malicious code to enter into your phpBB Forum. As such, phpBB will not offer support for MODs not offered in our MODs database, located at: <a href="http://www.phpbb.com/mods/">http://www.phpbb.com/mods/</a></span>
          </p>
          <span class="corners-bottom">
            <span></span>
          </span>
        </div>
      </div>
    </div>
    <h3 id="lang-ant">Author Notes</h3>
    <div class="mod-about">
      <div class="inner">
        <span class="corners-top">
          <span></span>
        </span>
			<xsl:if test="count(mod:author-notes) > 1">
				<dl id="author-notes">
					<xsl:for-each select="mod:author-notes">
							<dt>
								<xsl:value-of select="@lang" />
							</dt>
							<dd lang="{@lang}">
								<xsl:call-template name="add-line-breaks">
									<xsl:with-param name="string">
										<xsl:value-of select="current()" />
									</xsl:with-param>
								</xsl:call-template>
							</dd>
					</xsl:for-each>
				</dl>
			</xsl:if>
			<xsl:if test="count(mod:author-notes) = 1">
				<xsl:call-template name="add-line-breaks">
					<xsl:with-param name="string">
						<xsl:value-of select="mod:author-notes" />
					</xsl:with-param>
				</xsl:call-template>
			</xsl:if>
        <span class="corners-bottom">
          <span></span>
        </span>
      </div>
    </div>
    <div>
      <xsl:for-each select="mod:history">
        <xsl:call-template name="give-mod-history"></xsl:call-template>
      </xsl:for-each>
      <h3 id="lang-lic">License</h3>
      <div class="mod-about">
        <div class="inner">
          <span class="corners-top"><span></span></span>
          <p><span id="lang-lict">This MOD has been licensed under the following license:</span></p>
          <p style='white-space:pre;'>
            <a href="license.txt"><xsl:value-of select="mod:license" /></a>
          </p>
          <span class="corners-bottom"><span></span></span>
        </div>
      </div>
      <h3 id="lang-ont">Other Notes</h3>
      <div class="mod-about" id="other-notes">
        <div class="inner">
          <span class="corners-top">
            <span></span>
          </span>
          <p><span id="lang-ontt1">Before adding this MOD to your forum, you should back up all files related to this MOD</span></p>
          <p>
            <span id="lang-ontt2">This MOD was designed for phpBB</span><xsl:value-of select="mod:installation/mod:target-version/mod:target-primary" /><span id="lang-ontt3"> and may not function as stated on other phpBB versions. MODs for phpBB3.0 will <strong>not</strong> work on phpBB2.0 and vice versa.</span>
          </p>
          <xsl:if test="./mod:mod-version/mod:minor mod 2 != 0 or ./mod:mod-version/mod:major = 0">
            <p>
              <strong class="red">
                <span id="lang-onttq">This MOD is development quality. It is not recommended that you install it on a live forum.</span>
              </strong>
            </p>
          </xsl:if>
          <span class="corners-bottom">
            <span></span>
          </span>
        </div>
      </div>
      <div id="mod-support">
        <h4>
          <span id="lang-isp"></span>
        </h4>
        <div class="mod-about">
          <div class="inner">
            <span class="corners-top">
              <span></span>
            </span>
            <p>
              <span id="lang-ispt"></span>
            </p>
            <span class="corners-bottom">
              <span></span>
            </span>
          </div>
        </div>
      </div>
    </div>
	</xsl:template>
	<xsl:template name="give-authors">
		<xsl:for-each select="mod:author">
      <div class="mod-about">
        <div class="inner">
          <span class="corners-top"><span></span></span>
			<xsl:call-template name="give-author"></xsl:call-template>
          <span class="corners-bottom"><span></span></span>
		</div>
	</div>
		</xsl:for-each>
	</xsl:template>
	<xsl:template name="give-author">
    <dl class="author-info">
      <dt id="lang-a-un[{generate-id()}]">Username:</dt>
			<dd>
				<a href="http://www.phpbb.com/phpBB/profile.php?mode=viewprofile&amp;un={mod:username}">
					<xsl:value-of select="mod:username" />
				</a>
			</dd>
			<xsl:if test="mod:email != 'N/A' and mod:email != 'n/a' and mod:email != ''">
        <dt id="lang-a-e[{generate-id()}]">Email:</dt>
				<dd>
					<a href="mailto:{mod:email}">
						<xsl:value-of select="mod:email" />
					</a>
				</dd>
			</xsl:if>
      <dt id="lang-a-n[{generate-id()}]">Name:</dt>
			<dd>
				<xsl:value-of select="mod:realname" />
			</dd>
			<xsl:if test="mod:homepage != 'N/A' and mod:homepage != 'n/a' and mod:homepage!=''">
        <dt id="lang-a-h[{generate-id()}]">WWW:</dt>
				<dd>
					<a href="{mod:homepage}">
						<xsl:value-of select="mod:homepage" />
					</a>
				</dd>
			</xsl:if>
		</dl>
		<br />
	</xsl:template>
	<xsl:template name="give-version"><xsl:value-of select="concat(mod:major, '.', mod:minor, '.', mod:revision, mod:release)" /></xsl:template>
	<xsl:template name="give-installation">
		<dt id="lang-il">Installation Level:</dt>
		<dd class="mod-about">
			<div class="inner">
				<span class="corners-top"><span></span></span>
			<xsl:if test="mod:level='easy'"><p id="lang-ile">Easy</p></xsl:if>
			<xsl:if test="mod:level='intermediate'"><p id="lang-ili">Intermediate</p></xsl:if>
			<xsl:if test="mod:level='hard'"><p id="lang-ilh">Hard</p></xsl:if>
        <span class="corners-bottom"><span></span></span>
      </div>
    </dd>
		<dt id="lang-it">Installation Time:</dt>
		<dd class="mod-about">
			<div class="inner">
				<span class="corners-top"><span></span></span>
        <p>~<xsl:value-of select="floor(mod:time div 60)" /> <span id="lang-mint">minutes</span></p>
        <span class="corners-bottom">
          <span></span>
        </span>
      </div>
    </dd>
	</xsl:template>
	<xsl:template name="give-mod-history">
		<xsl:if test="count(mod:entry) > 0">
			<h3 id="lang-mh">MOD History</h3>
			<dl>
				<xsl:for-each select="mod:entry">
					<xsl:call-template name="give-history-entry"></xsl:call-template>
				</xsl:for-each>
			</dl>
		</xsl:if>
	</xsl:template>
	<xsl:template name="give-history-entry">
    <div class="mod-about">
      <div class="inner"><span class="corners-top"><span></span></span>
		<dt><p><strong><xsl:value-of select="substring(mod:date,1,10)" /><span id="lang-mhe-v[{generate-id()}]"> - Version </span><xsl:for-each select="mod:rev-version"><xsl:call-template name="give-version"></xsl:call-template></xsl:for-each></strong></p></dt>
		<dd>
			<xsl:if test="count(mod:changelog) > 1">
        <dl id="mhcl[{generate-id()}]">
				<xsl:for-each select="mod:changelog">
					<xsl:call-template name="give-history-entry-changelog"></xsl:call-template>
				</xsl:for-each>
        </dl>
			</xsl:if>
			<xsl:if test="count(mod:changelog) = 1">
				<xsl:for-each select="mod:changelog">
					<xsl:call-template name="give-history-entry-changelog-single"></xsl:call-template>
				</xsl:for-each>
			</xsl:if>
		</dd>
        <span class="corners-bottom"><span></span></span></div>
      </div>
	</xsl:template>
	<xsl:template name="give-history-entry-changelog">
			<dt><xsl:value-of select="@lang" /></dt>
			<dd lang="{@lang}">
				<ul>
					<xsl:for-each select="mod:change">
						<li><p><xsl:value-of select="current()" /></p></li>
					</xsl:for-each>
				</ul>
			</dd>
	</xsl:template>
	<xsl:template name="give-history-entry-changelog-single">
		<ul>
			<xsl:for-each select="mod:change">
				<li><p><xsl:value-of select="current()" /></p></li>
			</xsl:for-each>
		</ul>
	</xsl:template>
	<xsl:template name="give-files-to-edit">
		<ul>
			<xsl:for-each select="mod:open">
				<xsl:call-template name="give-file"></xsl:call-template>
			</xsl:for-each>
		</ul>
	</xsl:template>
	<xsl:template name="give-files-included">
		<ul>
			<xsl:for-each select="mod:copy">
				<xsl:call-template name="give-file-copy"></xsl:call-template>
			</xsl:for-each>
		</ul>
	</xsl:template>
	<xsl:template name="give-file">
		<li>
			<xsl:value-of select="@src" />
			<xsl:if test="position()!=last()">,</xsl:if>
		</li>
	</xsl:template>
	<xsl:template name="give-file-copy">
		<xsl:for-each select="mod:file">
			<li>
				<xsl:value-of select="@from" />
				<xsl:if test="position()!=last()">,</xsl:if>
			</li>
		</xsl:for-each>
	</xsl:template>
	<xsl:template name="give-actions">
		<xsl:if test="count(mod:sql) > 0">
      <h2 id="lang-sql">SQL</h2>
    </xsl:if>
		<div id="sql" class="mod-about">
       <div class="inner">
				<span class="corners-top"><span></span></span>
		<xsl:for-each select="mod:sql">			
			<xsl:call-template name="give-sql"></xsl:call-template>			
		</xsl:for-each>
         </div>
				<span class="corners-bottom"><span></span></span>
		</div>
		<xsl:if test="count(mod:copy) > 0">
      <xsl:for-each select="mod:copy">
        <xsl:call-template name="give-filez"></xsl:call-template>
      </xsl:for-each>
    </xsl:if>
    <h2 id="lang-edts">Edits</h2>
		<p>
			<span class="key">s</span><span class="key">↑</span><span class="key">↓</span></p>
		<p>
			<span id="lang-edtt">Use your keyboard to navigate the code boxes. You may also hit '<em>s</em>' on your keyboard to go to the first code box.</span>
		</p>
		<div class="mod-about" id="edits">
			<div class="inner">
				<span class="corners-top"><span></span></span>
		<xsl:for-each select="mod:open">
			<xsl:call-template name="give-fileo"></xsl:call-template>
		</xsl:for-each>
        <span class="corners-bottom"><span></span></span>
			</div>
		</div>
		<xsl:call-template name="give-manual"></xsl:call-template>
	</xsl:template>
	<xsl:template name="give-sql">
		<div class="content">
					<div class="codebox">
						<div class="codeHead"><span id="lang-cde-c[{generate-id()}]">Code:</span><a href="#" onclick="selectCode(this); return false;"><span id="lang-cde-sa[{generate-id()}]">Select All</span></a></div>
						<div class="codePre"><pre id="{generate-id()}"><xsl:value-of select="current()" /></pre></div>
					</div>
      </div>
	</xsl:template>
	<xsl:template name="give-manual">
    <xsl:if test="count(mod:diy-instructions) > 0">
    <div class="mod-about">
	<div class="inner">
		<span class="corners-top"><span></span></span>
		<h2 id="lang-diy">DIY Instructions</h2>
		<p><span id="lang-diyt">These are manual instructions that cannot be performed automatically. You should follow these instructions carefully.</span></p>
		<div id="diy">
		<xsl:for-each select="mod:diy-instructions">
      <div lang="{@lang}">
				<div class="content">
				 <div class="codebox">
				  <div class="codeHead"><span id="lang-cde-c[{generate-id()}]">Code:</span><a href="#" onclick="selectCode(this); return false;"><span id="lang-cde-sa[{generate-id()}]">Select All</span></a></div>
				  <div class="codePre"><pre id="{generate-id()}"><xsl:value-of select="current()" /></pre></div>
				 </div>
        </div>
			</div>
		</xsl:for-each>
    </div>
    <span class="corners-bottom">
      <span></span>
    </span>
  </div>
</div>
</xsl:if>
	</xsl:template>
	<xsl:template name="give-fileo">
		<div class="editFile">
      <h3><span id="lang-opn[{generate-id()}]">Open:</span>&nbsp;<xsl:value-of select="@src" /></h3>
			<xsl:for-each select="mod:edit">
        <div class="mod-edit">
          <xsl:if test="count(mod:comment) > 0">
          <div class="mod-comment">
          <h4 id="lang-cm-cmt[{generate-id()}]">Comments</h4>
            <dl id="mod-comment[{generate-id()}]">
              <xsl:for-each select="mod:comment">
                <dt>
                  <span><xsl:if test="count(../mod:comment) > 1"><xsl:value-of select="@lang" /></xsl:if></span>
                </dt>
                <dd lang="{@lang}"><xsl:value-of select="current()" />
                </dd>
              </xsl:for-each>
            </dl>
            </div>
          </xsl:if>
					<xsl:for-each select="mod:find|mod:action|mod:inline-edit">
						<xsl:if test="name() = 'find'">
              <h4 id="lang-fnd[{generate-id()}]">Find</h4>
              <p><span id="lang-fndt[{generate-id()}]"><strong>Tip:</strong> This may be a partial find and not the whole line.</span>
<xsl:if test="@type = 'regex'">
									<br />
									<em id="lang-regex[{generate-id()}]">This find contains an advanced feature known as regular expressions, click here to learn more.</em>
								</xsl:if>
</p>
          <div class="codebox">
						<div class="codeHead"><span id="lang-cde-c[{generate-id()}]">Code:</span><a href="#" onclick="selectCode(this); return false;"><span id="lang-cde-sa[{generate-id()}]">Select All</span></a></div>
						<div class="codePre"><pre id="{generate-id()}"><xsl:value-of select="current()" /></pre></div>
					</div>
						</xsl:if>
						<xsl:if test="name() = 'action'">
							<xsl:if test="@type = 'after-add'">
                <h4 id="lang-aft[{generate-id()}]">Add after</h4>
                <p><span id="lang-aftt[{generate-id()}]"><strong>Tip:</strong> Add these lines on a new blank line after the preceding line(s) to find.</span></p>
							</xsl:if>
							<xsl:if test="@type = 'before-add'">
                <h4 id="lang-bef[{generate-id()}]">Add before</h4>
                <p>
                  <span id="lang-beft[{generate-id()}]"><strong>Tip:</strong> Add these lines on a new blank line before the preceding line(s) to find.</span>
                </p>
							</xsl:if>
							<xsl:if test="@type = 'replace-with'">
                <h4 id="lang-rplw[{generate-id()}]">Replace With</h4>
                <p><span id="lang-rplwt[{generate-id()}]"><strong>Tip:</strong> Replace the preceding line(s) to find with the following lines.</span></p>
							</xsl:if>
							<xsl:if test="@type = 'operation'">
                <h4 id="lang-inc[{generate-id()}]">Increment</h4>
                <p>
                  <span id="lang-inct[{generate-id()}]"><strong>Tip:</strong> This allows you to alter integers. For help on what each operator means, click here.</span>
                </p>
							</xsl:if>
					<div class="codebox">
						<div class="codeHead"><span id="lang-cde-c[{generate-id()}]">Code:</span><a href="#" onclick="selectCode(this); return false;"><span id="lang-cde-sa[{generate-id()}]">Select All</span></a></div>
						<div class="codePre"><pre id="{generate-id()}"><xsl:value-of select="current()" /></pre></div>
					</div>
						</xsl:if>
						<xsl:if test="name() = 'inline-edit'">
              <div class="mod-inlineedit">
								<xsl:for-each select="mod:inline-find|mod:inline-action|mod:inline-comment">
									<xsl:if test="name() = 'inline-find'">
                    <h5 id="lang-ifnd[{generate-id()}]">In-line Find</h5>
                    <p>
                      <span id="lang-ifndt[{generate-id()}]"><strong>Tip:</strong> This is a partial match of a line for in-line operations.</span>
<xsl:if test="@type = 'regex'">
												<br />
												<em id="lang-regex[{generate-id()}]">This find contains an advanced feature known as regular expressions, click here to learn more.</em>
											</xsl:if>
</p>
					<div class="codebox">
						<div class="codeHead"><span id="lang-cde-c[{generate-id()}]">Code:</span><a href="#" onclick="selectCode(this); return false;"><span id="lang-cde-sa[{generate-id()}]">Select All</span></a></div>
						<div class="codePre"><pre id="{generate-id()}"><xsl:value-of select="current()" /></pre></div>
					</div>
									</xsl:if>
									<xsl:if test="name() = 'inline-action'">
										<xsl:if test="@type = 'after-add'">
                      <h5 id="lang-iaft[{generate-id()}]">In-line Add after</h5>
                      <p>
                        <span id="lang-iaftt[{generate-id()}]"></span>
                      </p>
										</xsl:if>
										<xsl:if test="@type = 'before-add'">
                      <h5 id="lang-ibef[{generate-id()}]">In-line Add before</h5>
                      <p>
                        <span id="lang-ibeft[{generate-id()}]"></span>
                      </p>
										</xsl:if>
										<xsl:if test="@type = 'replace-with'">
                      <h5 id="lang-irplw[{generate-id()}]">In-line Replace With</h5>
                      <p>
                        <span id="lang-irplwt[{generate-id()}]"></span>
                      </p>
										</xsl:if>
										<xsl:if test="@type = 'operation'">
                      <h5 id="lang-iinc[{generate-id()}]">In-line Increment</h5>
                      <p>
                        <span id="lang-iinct[{generate-id()}]"><strong>Tip:</strong> This allows you to alter integers. For help on what each operator means, click here.</span>
                      </p>
										</xsl:if>
					<div class="codebox">
						<div class="codeHead"><span id="lang-cde-c[{generate-id()}]">Code:</span><a href="#" onclick="selectCode(this); return false;"><span id="lang-cde-sa[{generate-id()}]">Select All</span></a></div>
						<div class="codePre"><pre id="{generate-id()}"><xsl:value-of select="current()" /></pre></div>
					</div>
									</xsl:if>
									<xsl:if test="name() = 'inline-comment'">
          <dl id="comment[{generate-id()}]">
						<dt><span id="lang-cm-cmt[{generate-id()}]">Comments</span>&nbsp;<span><xsl:value-of select="@lang" /></span></dt>
						<dd lang="{@lang}"><xsl:value-of select="current()" /></dd>
					</dl>
									</xsl:if>
								</xsl:for-each>
							</div>
						</xsl:if>
					</xsl:for-each>
				</div>
			</xsl:for-each>
		</div>
	</xsl:template>
	<xsl:template name="give-filez">
    <h2 id="lang-fca">File Copy</h2>
    <ol id="file-copy">
			<xsl:for-each select="mod:file">
      <li>
				<dl>
				<dt><span id="lang-c-copy[{generate-id()}]">Copy:</span>&nbsp;<xsl:value-of select="@from" /></dt>
				<dd><span id="lang-c-to[{generate-id()}]">To:</span>&nbsp;<xsl:value-of select="@to" /></dd>
				</dl>
			</li>
			</xsl:for-each>
		</ol>
	</xsl:template>
	<!-- add-line-breaks borrowed from http://www.stylusstudio.com/xsllist/200103/post40180.html -->
	<xsl:template name="add-line-breaks">
		<xsl:param name="string" select="." />
		<xsl:choose>
			<xsl:when test="contains($string, '&#xA;')">
				<xsl:value-of select="substring-before($string, '&#xA;')" />
				<br />
				<xsl:call-template name="add-line-breaks">
					<xsl:with-param name="string" select="substring-after($string, '&#xA;')" />
				</xsl:call-template>
			</xsl:when>
			<xsl:otherwise>
				<xsl:value-of select="$string" />
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
</xsl:stylesheet>