
<!DOCTYPE html>
<html>


<head>
<title>Approach0</title>
<meta charset="utf-8"/>
<meta name="description" content="Approach Zero: A math-aware search engine. Search Mathematics Stack Exchange.">
<link rel="shortcut icon" href="images/favicon.ico">
<link rel="stylesheet" href="vendor/mathquill/mathquill.css" type="text/css"/>
<link rel="stylesheet" href="search.css" type="text/css"/>
<link rel="stylesheet" href="qry-box.css" type="text/css"/>
<link rel="stylesheet" href="font.css" type="text/css"/>
<link rel="stylesheet" href="quiz.css" type="text/css"/>

<script type="text/javascript" src="vendor/jquery/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="vendor/vue/vue.min.js"></script>

<!-- Math render vendor scripts -->
<script type="text/javascript" src="vendor/katex/katex.min.js"></script>
<link rel="stylesheet" href="vendor/katex/katex.min.css" type="text/css"/>

<script type="text/javascript" src="vendor/mathjax/MathJax.js?config=TeX-AMS-MML_SVG"></script>
<script type="text/x-mathjax-config">
mathjax_init();
</script>

<script type="text/javascript" src="tex-render.js"></script>
<script type="text/javascript" src="vendor/typed/typed.js"></script>
<script type="text/javascript" src="search.js"></script>
<script type="text/javascript" src="quiz-list.js"></script>
<script type="text/javascript" src="quiz.js"></script>
<script type="text/javascript" src="pad.js"></script>
<script type="text/javascript" src="qry-box.js"></script>
<script type="text/javascript" src="footer.js"></script>
<style>
img.social {
	height: 16px;
}
div.center-v-pad {
	height: 200px
}
div.center-horiz {
	margin: 0 auto;
	text-align: center;
}
div.stick-bottom {
	position: absolute;
	bottom: 0;
	width: 100%;
}
li.hit {
	margin-bottom: 26px;
}
</style>
</head>

<body style="margin: 0; border-top: 2px solid #46ece5;">


<!-- Quiz App -->
<div id="quiz-vue-app" v-show="!hide">
	<div id="quiz">
		<div class="center-v-pad"></div>
		<div class="center-horiz">
			<p id="quiz-question">
			<b>Question</b>: &nbsp; {{Q}}
			</p>
		</div>
		<div class="center-horiz" style="padding-top:20px;">
			<span id="quiz-hint" class="mainfont"></span>
		</div>
	</div>

	<!-- Initial Footer -->
	<div v-show="!hide" id="init-footer" class="center-horiz"
	style="font-size: small; margin-top: 40px; width: 100%;
	bottom: 0px; position: absolute; background: #fbfefe;
	padding-bottom: 15px; padding-top: 15px;
	box-shadow: 0 0 4px rgba(0,0,0,0.25);">
	<a target="_blank" href="https://twitter.com/approach0">
	<img style="vertical-align:middle"
	src="images/logo32.png"/></a>
	+
	<a target="_blank" href="http://math.stackexchange.com/">
	<img style="vertical-align:middle"
	src="images/math-stackexchange.png"/></a>
	+
	<span style="color: red;">♡ </span>
	=
	<p>A math-aware search engine for Mathematics Stack Exchange.</p>
	</div>
	<!-- Initial Footer END -->

</div>
<!-- Quiz App END -->

<!-- Search App -->
<div id="search-vue-app">

<!-- Error code -->
<div v-if="ret_code > 0">
<div class="center-v-pad"></div>
<div class="center-horiz">
	<template v-if="ret_code == 102">
	<p><span class="dots" style="color:white"></span>
	{{ret_str}}
	<span class="dots"></span></p>
	</template>
	<p v-else>Opps! {{ret_str}}. (return code #{{ret_code}})</p>
</div>
</div>
<!-- Error code END -->

<!-- Search Results -->
<div v-if="ret_code == 0">
	<ol>
	<li class="hit" v-for="hit in hits">
		<div style="display:none">docid: {{hit.docid}}</div>
		<div style="display:none">score: {{hit.score}}</div>
		<a class="title" target="_blank" v-bind:href="hit.url"
		style="text-decoration: none; font-size: 120%;">
		{{hit.title}}</a><br/>
		<span style="color:#006d21">{{hit.url}}</span>
		<div style="overflow-x: hidden;">
		<p class="snippet">{{{ surround_special_html(hit.snippet) }}}</p>
		</div>
	</li>
	</ol>
</div>
<!-- Search Results END -->

<!-- Footer -->
<div v-show="ret_code == 0"
style="padding-top: 15px; background: #fbfefe;
box-shadow: 0 0 4px rgba(0,0,0,0.25); text-align: center;">

<!-- Left Footer -->
	<div style="display: inline-block; padding-bottom: 15px;">
		<span v-if="prev != ''">
			<b style="font-size:1.5em">←</b>
			<a class="page-navi" v-bind:onclick="prev" href="#">prev</a>
		</span>
		<span class="mainfont">Page {{cur_page}}/{{tot_pages}}</span>
		<span v-if="next != ''">
			<a class="page-navi" v-bind:onclick="next" href="#">next</a>
			<b style="font-size:1.5em">→</b>
		</span>
	</div>

<!-- Right Footer -->
	<div style="float: right; margin-top: 15px;">
		<a href="https://twitter.com/intent/tweet?text=Check%20this%20out%3A%20%40Approach0%2C%20A%20math-aware%20search%20engine%3A%20http%3A%2F%2Fwww.approach0.xyz"
		target="_blank" title="Tweet" class="twitter-share-button">
		<img class="social" src="images/social/Twitter.svg"></a>

		<a href="https://plus.google.com/share?url=https%3A%2F%2Fwww.approach0.xyz"
		target="_blank" title="Share on Google+">
		<img class="social" src="images/social/Google+.svg"></a>

		<a href="http://www.reddit.com/submit?url=https%3A%2F%2Fwww.approach0.xyz&title=Check%20out%20this%20math-aware%20search%20engine!"
		target="_blank" title="Submit to Reddit">
		<img class="social" src="images/social/Reddit.svg"></a>

		<script async defer src="https://buttons.github.io/buttons.js"></script>
		<a class="github-button" href="https://github.com/approach0/search-engine"
		data-count-href="/approach0/search-engine/stargazers" data-count-api="/repos/approach0/search-engine#stargazers_count"
		data-count-aria-label="# stargazers on GitHub" aria-label="Star approach0/search-engine on GitHub">Star</a>
	</div>

</div>
<!-- Footer END -->

</div>
<!-- Search App END -->

</body>
</html>
