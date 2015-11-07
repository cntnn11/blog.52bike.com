<style type="text/css">
/* 代码 style*/
.dp-highlighter{ font-family:"Verdana",Tahoma,Lucida Grande,Arial,sans-serif; font-size:13px; padding: 8px; background-color:#fbfbfb; word-break:break-all; white-space:normal; overflow:auto; margin:0px auto; }
.dp-highlighter .bar{ padding:2px; }
.dp-highlighter .collapsed .bar,.dp-highlighter .nogutter .bar{ padding-left:0px; }
.dp-highlighter ol{ margin:0px 0px 1px 32px; /* 1px bottom margin seems to fix occasional Firefox scrolling */
	padding:2px; color:#666; }
.dp-highlighter .nogutter ol{ list-style-type:none; margin-left:0px; }
.dp-highlighter ol li,.dp-highlighter .columns div{ /*background-color: #fff; */
	border-left:1px solid #ddd; padding-left:10px; line-height:18px; }
.dp-highlighter .nogutter ol li,.dp-highlighter .nogutter .columns div{ border:0; }
.dp-highlighter .columns{ color:gray; width:100%; }
.dp-highlighter .columns div{ padding-bottom:5px; }
.dp-highlighter ol li.alt{ /*background-color: #f8f8f8; */; }
.dp-highlighter ol li span{ color:Black; }
/* Adjust some properties when collapsed */
.dp-highlighter .collapsed ol{ margin:0px; }
.dp-highlighter .collapsed ol li{ display:none; }
/* Additional modifications when in print-view */
.dp-highlighter .printing{ border:none; }
.dp-highlighter .printing .tools{ display: none !important; }
.dp-highlighter .printing li{ display: list-item !important; }
/* Styles for the tools */
.dp-highlighter .tools{ padding:3px 8px 3px 15px; border-bottom:1px solid #2B91AF; font:9pt Verdana,Geneva,Arial,Helvetica,sans-serif; color:silver; }
.dp-highlighter .collapsed .tools{ border-bottom:0; }
.dp-highlighter .tools a{ font-size:9pt; color:gray; text-decoration:none; margin-right:10px; }
.dp-highlighter .tools a:hover{ color:red; text-decoration:underline; }
/* About dialog styles */
.dp-about{ background-color:#fff; margin:0px; padding:0px; }
.dp-about table{ width:100%; height:100%; font-size:11px; font-family: Tahoma, Verdana, Arial, sans-serif !important; }
.dp-about td{ padding:10px; vertical-align:top; }
.dp-about .copy{ border-bottom:1px solid #ACA899; height:95%; }
.dp-about .title{ color:red; font-weight:bold; }
.dp-about .para{ margin:0 0 4px 0; }
.dp-about .footer{ background-color:#ECEADB; border-top:1px solid #fff; text-align:right; }
.dp-about .close{ font-size:11px; font-family: Tahoma, Verdana, Arial, sans-serif !important; background-color:#ECEADB; width:60px; height:22px; }
/* Language specific styles */
.dp-c{ }
.dp-c .comment{ color:green; }
.dp-c .string{ color:blue; }
.dp-c .preprocessor{ color:gray; }
.dp-c .keyword{ color:blue; }
.dp-c .vars{ color:#d00; }
.dp-vb{ }
.dp-vb .comment{ color:green; }
.dp-vb .string{ color:blue; }
.dp-vb .preprocessor{ color:gray; }
.dp-vb .keyword{ color:blue; }
.dp-sql{ }
.dp-sql .comment{ color:green; }
.dp-sql .string{ color:red; }
.dp-sql .keyword{ color:rgb(127,0,85); }
.dp-sql .func{ color:#ff1493; }
.dp-sql .op{ color:blue; }
.dp-xml{ }
.dp-xml .cdata{ color:#ff1493; }
.dp-xml .comments{ color:green; }
.dp-xml .tag{ color:blue; }
.dp-xml .tag-name{ color:rgb(127,0,85); }
.dp-xml .attribute{ color:red; }
.dp-xml .attribute-value{ color:blue; }
.dp-delphi{ }
.dp-delphi .comment{ color:#008200; font-style:italic; }
.dp-delphi .string{ color:blue; }
.dp-delphi .number{ color:blue; }
.dp-delphi .directive{ color:#008284; }
.dp-delphi .keyword{ font-weight:bold; color:navy; }
.dp-delphi .vars{ color:#000; }
.dp-py{ }
.dp-py .comment{ color:green; }
.dp-py .string{ color:red; }
.dp-py .docstring{ color:green; }
.dp-py .keyword{ color:blue; font-weight:bold; }
.dp-py .builtins{ color:#ff1493; }
.dp-py .magicmethods{ color:#808080; }
.dp-py .exceptions{ color:brown; }
.dp-py .types{ color:brown; font-style:italic; }
.dp-py .commonlibs{ color:#8A2BE2; font-style:italic; }
.dp-rb{ }
.dp-rb .comment{ color:#c00; }
.dp-rb .string{ color:#f0c; }
.dp-rb .symbol{ color:#02b902; }
.dp-rb .keyword{ color:#069; }
.dp-rb .variable{ color:#6cf; }
.dp-css{ }
.dp-css .comment{ color:green; }
.dp-css .string{ color:red; }
.dp-css .keyword{ color:blue; }
.dp-css .colors{ color:darkred; }
.dp-css .vars{ color:#d00; }
.dp-j{ }
.dp-j .comment{ color:rgb(63,127,95); }
.dp-j .string{ color:rgb(42,0,255); }
.dp-j .keyword{ color:rgb(127,0,85); font-weight:bold; }
.dp-j .annotation{ color:#646464; }
.dp-j .number{ color:#C00000; }
.dp-cpp{ }
.dp-cpp .comment{ color:#e00; }
.dp-cpp .string{ color:red; }
.dp-cpp .preprocessor{ color:#CD00CD; font-weight:bold; }
.dp-cpp .keyword{ color:#5697D9; font-weight:bold; }
.dp-cpp .datatypes{ color:#2E8B57; font-weight:bold; }
.dp-perl{ }
.dp-perl .comment{ color:green; }
.dp-perl .string{ color:red; }
.dp-perl .keyword{ color:rgb(127,0,85); }
.dp-perl .func{ color:#ff1493; }
.dp-perl .declarations{ color:blue; }
.dp-css .vars{ color:#d00; }
.dp-g{ }
.dp-g .comment{ color:rgb(63,127,95); }
.dp-g .string{ color:rgb(42,0,255); }
.dp-g .keyword{ color:rgb(127,0,85); font-weight:bold; }
.dp-g .type{ color:rgb(0,127,0); font-weight:bold; }
.dp-g .modifier{ color:rgb(100,0,100); font-weight:bold; }
.dp-g .constant{ color:rgb(255,0,0); font-weight:bold; }
.dp-g .method{ color:rgb(255,96,0); font-weight:bold; }
.dp-g .number{ color:#C00000; }
</style>