<?php
$abcd='<style type="text/css">
.aligncenter,.gallery-item a{display:block}
.alignleft{float:left; margin-right:15px; margin-bottom:10px}
.alignright{float:right; margin-left:15px; margin-bottom:10px}
.aligncenter{margin-left:auto; margin-right:auto}
.wp-caption{max-width:100%;padding:4px}
.entry-caption, .gallery-caption, .wp-caption .wp-caption-text{font-style:italic; font-size:12px; font-size:.857142857rem; line-height:2; color:#757575}
ul:before, ul:after{ content:\'\'; display:table;}
ul:after{ clear:both;}
.full-img img{ width:100%; height:auto;}
img.img-crop { display: block; max-width: none }
.table-cell {display: table-cell; vertical-align: middle; padding:0;}
.table-div{ display:table; height:100%; width:100%; }

.owl-carousel, .owl-carousel .owl-item{-webkit-tap-highlight-color:transparent; position:relative}
.owl-carousel{display:none; width:100%; z-index:1}
.owl-carousel .owl-stage{position:relative; -ms-touch-action:pan-Y}
.owl-carousel .owl-stage:after{content:"."; display:block; clear:both; visibility:hidden; line-height:0; height:0}
.owl-carousel .owl-stage-outer{position:relative; overflow:hidden; -webkit-transform:translate3d(226,22,209)}
.owl-carousel .owl-item{min-height:1px; float:left; -webkit-backface-visibility:hidden; -webkit-touch-callout:none}
.owl-carousel .owl-dots.disabled, .owl-carousel .owl-nav.disabled{display:none}
.no-js .owl-carousel, .owl-carousel.owl-loaded{display:block}
.owl-carousel .owl-dot, .owl-carousel .owl-nav .owl-next, .owl-carousel .owl-nav .owl-prev{cursor:pointer; -webkit-user-select:none; -khtml-user-select:none; -moz-user-select:none; -ms-user-select:none; user-select:none}
.owl-carousel.owl-loading{opacity:0; display:block}
.owl-carousel.owl-hidden{opacity:0}
.owl-carousel.owl-refresh .owl-item{visibility:hidden}
.owl-carousel.owl-drag .owl-item{-webkit-user-select:none; -moz-user-select:none; -ms-user-select:none; user-select:none}
.owl-carousel.owl-grab{cursor:move; cursor:grab}
.owl-carousel.owl-rtl{direction:rtl}
.owl-carousel.owl-rtl .owl-item{float:right}
.owl-carousel .animated{-webkit-animation-duration:1s; animation-duration:1s; -webkit-animation-fill-mode:both; animation-fill-mode:both}
.owl-carousel .owl-animated-in{z-index:0}
.owl-carousel .owl-animated-out{z-index:1}
.owl-carousel .fadeOut{-webkit-animation-name:fadeOut; animation-name:fadeOut}@-webkit-keyframes fadeOut{0%{opacity:1}100%{opacity:0}}@keyframes fadeOut{0%{opacity:1}100%{opacity:0}}
.owl-height{transition:height .5s ease-in-out}
.owl-carousel .owl-item .owl-lazy{opacity:0; transition:opacity .4s ease}
.owl-carousel .owl-item img.owl-lazy{-webkit-transform-style:preserve-3d; transform-style:preserve-3d}
.owl-carousel .owl-video-wrapper{position:relative; height:100%; background:#000}
.owl-carousel .owl-video-play-icon{position:absolute; height:80px; width:80px; left:50%; top:50%; margin-left:-40px; margin-top:-40px; background:url(owl.video.play.png) no-repeat; cursor:pointer; z-index:1; -webkit-backface-visibility:hidden; transition:-webkit-transform .1s ease; transition:transform .1s ease}
.owl-carousel .owl-video-play-icon:hover{-webkit-transform:scale(1.3,1.3); -ms-transform:scale(1.3,1.3); transform:scale(1.3,1.3)}
.owl-carousel .owl-video-playing .owl-video-play-icon, .owl-carousel .owl-video-playing .owl-video-tn{display:none}
.owl-carousel .owl-video-tn{opacity:0; height:100%; background-position:center center; background-repeat:no-repeat; background-size:contain; transition:opacity .4s ease}
.owl-next, .owl-prev{background-position:0 0}
.owl-carousel .owl-video-frame{position:relative; z-index:1; height:100%; width:100%}
.owl-nav{text-align:center; margin-top:15px;}
.owl-next, .owl-prev{ border-radius:0; height:40px; width:40px; background-size:24px; background-position:center; background-repeat:no-repeat; -webkit-transition:0.4s; -moz-transition:0.4s; -o-transition:0.4s; transition:0.4s; color:#fff; display:inline-block; margin:0;}
.owl-next{ right:0; background-image:url(C:/xampp/htdocs/orginsightapp/asset/report_images/next.svg)}
.owl-prev{ left:0;  background-image:url(C:/xampp/htdocs/orginsightapp/asset/report_images/prev.svg)}


body{
		font-family: \'Roboto\', sans-serif;
		margin: 0;
		padding: 0;
		font-size:16px !important;
}
a:hover{
	 text-decoration: none !important;
}


/*home page*/
.homebrand{
	padding: 75px 0;
	text-align: center;
}
.homebrand img{
	height: 135px;
}
.banner img{
	width: 850px;
}

.hometext{
	text-align: center;
	font-family: \'Roboto\', sans-serif;
}
/*
.heading h1{
	font-size: 84px;
    font-weight: 300;
    text-transform: uppercase;
    color: #125c98;
	padding-top: 80px;
}*/
.heading h1{
	font-size: 50px;
    font-weight: 300;
    text-transform: uppercase;
    color: #125c98;
	padding-top: 8px;
	line-height: 1.2;
}
.reportsection{
	padding: 60px 0;
}

.reportmian{
    padding: 0 10px;
    font-size: 45px;
    color: #2da828;
    border: solid 3px #2da828;
    display: inline-block;
    border-radius: 5px;
    font-family: \'Oswald\', sans-serif;
    font-weight: 300;
    line-height: 65px;
    position: relative;
}
.reportmian:hover{
	    color: #2da828;
    text-decoration: none;
}
.reportmian::after{
	position: absolute;
    content: \'\';
    width: 30px;
    height: 2.5px;
    background: #2da828;
    top: 50%;
    transform: translate(-50%);
    right: -65px;
    border-radius: 50px;
}
.reportmian::before{
	position: absolute;
    content: \'\';
    width: 30px;
    height: 2.5px;
    background: #2da828;
    top: 50%;
    transform: translate(-50%);
    left: -35px;
    border-radius: 50px;
}

.homegreensection{
	text-align: center;
    padding: 20px 0;
    color: #fff;
    font-size: 50px;
    font-weight: 500;
    background: rgba(45,168,40,1);
    background: linear-gradient(90deg, rgba(193,245,190,1) 0%, rgba(42,167,36,1) 20%, rgba(45,168,40,1) 80%, rgba(193,245,190,1) 100%);
    font-family: \'Oswald\', sans-serif;
}
.homegreensection1{
	text-align: center;
    padding: 20px 0;
	margin-top:20px;
    
}
.homebluesection1{
	text-align: center;
    padding: 20px 0;
	margin-top:50px;
    
}

.homebluesection{
	background: rgb(210,239,255);
    background: linear-gradient(90deg, rgba(210,239,255,1) 0%, rgba(29,130,185,1) 20%, rgba(29,130,185,1) 80%, rgba(210,239,255,1) 100%);
    text-align: center;
    font-size: 30px;
    color: #fff;
    padding: 10px 0;
    font-family: \'Montserrat\', sans-serif;
    font-weight: 600;
    margin-top: 5px;
}

.homewhitesection{
	padding: 25px 0 50px 0;
    font-family: \'Montserrat\', sans-serif;
    font-size: 30px;
    font-weight: 500;
    text-align: center;
}

/*home end*/


/*about start*/

.headertop{
	display: flex;
	align-items: center;
	justify-content: space-between;
	padding: 50px 0;
}

.headerlogo img{
	height: 100px;
    margin-left: 47px;
}
.emailidtext a{
	font-size: 22px;
    color: #333;
    font-weight: 400;
   /* position: relative;*/
    padding:0;
}
.green-space{
     width: 28px;
    height: 18px;
    background: #1e9954;
    display: inline-block;
    margin-left: 8px; 
}
/*.emailidtext a:after{
	position: absolute;
    content: \'\';
    width: 28px;
    height: 18px;
    background: #1e9954;
    right: 0;
    top: 55%;
    transform: translateY(-50%);
}
*/
.text-banner{
	background-image: url(C:/xampp/htdocs/orginsightapp/asset/report_images/about-banner.jpg);
    background-size: cover;
    padding: 60px 0;
    text-align: center;
        background-position: center;
		margin-top:0px;
}

.text-banner h2{
	font-size: 75px; 
	color: #fff;
	margin: 0;
}

.text-banner h3{
	font-family: \'Montserrat\', sans-serif;
    font-size: 35px;
    font-weight: 300;
    color: #fff;
    margin: 0;
    margin-top: 5px;
}
.text-banner h5{
	font-size: 29px;
    font-weight: 400;
    color: #fff;
    margin-top: 32px;
    margin-bottom: 10px;
}

.reportpoints{
	background: #fff;
	 padding: 60px 0;
	 margin-top:170px;
}

.reportpoints ul{
	margin: 0;
	padding: 0;
}
.reportpoints ul li{
    position: relative;
    padding-left: 55px;
    /*font-size: 20px;*/
    font-family: \'Montserrat\', sans-serif;
    font-weight: 500;
    line-height: 30px;
    margin-bottom: 30px;
    list-style: none;
}
.reportpoints .check{
	position: absolute;
	height: 30px;
    width: 30px;
    text-align: center;
    background: #1e9a51;
    align-items: center;
    display: flex;
    justify-content: center;
    border-radius: 3px;
    left: 0;
    top: 5px;
    /*background: url(C:/xampp/htdocs/orginsightapp/asset/report_images/check-mark-green.png);*/
}
.reportpoints .check img{
	height: 12px;
}
.ancer{
	text-decoration: underline;
    color: #1d82b9;
}

.report-summary{
	background-image: url(C:/xampp/htdocs/orginsightapp/asset/report_images/about-bg-2.jpg);
    background-size: cover;
    padding: 60px 0;
    background-position: bottom;
}

.report-summary h2{
	text-align: center;
    font-family: \'Montserrat\', sans-serif;
    font-size: 28px;
    margin-bottom: 35px;
}

.report-summary ul{
	margin: 0;
	padding: 0;
}

.report-summary ul li{
	list-style: none;
    position: relative;
    padding-left: 55px;
    /*font-size: 17px;*/
    font-family: \'Montserrat\', sans-serif;
    font-weight: 500;
    line-height: 30px;
    margin-bottom: 30px;
}
.report-summary ul li .numberpoint{
	    position: absolute;
	    height: 30px;
	    width: 30px;
	    text-align: center;
	    background: #1d82b9;
	    align-items: center;
	    display: flex;
	    justify-content: center;
	    border-radius: 50%;
	    left: 0;
	    top: 5px;
	    color: #fff;
}

/*about end*/


/*CONCLUSION START*/
.conclusionlatter{
	padding: 60px 0;
}

.conclusionlatter p{
	font-size: 20px;
    font-family: \'Montserrat\', sans-serif;
    font-weight: 500;
    line-height: 30px;
    margin-bottom: 30px;
}

.segnater{
	text-align: right;
}
.signature{
	height: 90px;
}
.segnater p{
	margin-bottom: 0; 
}


.quickteps{
	background: #e2edf5 !important;
	padding: 60px 0;
}
.quickteps h2{
	font-family: \'Montserrat\', sans-serif;
    font-size: 28px;
    margin-bottom: 40px;
}

.quickteps ul{
	margin: 0;
	padding: 0;
}

.quickteps ul li{
	list-style: none;
    position: relative;
    padding-left: 55px;
    font-size: 18px;
    font-family: \'Montserrat\', sans-serif;
    font-weight: 500;
    line-height: 30px;
    margin-bottom: 30px;
}
.quickteps ul li .numberpoint{
    position: absolute;
    height: 30px;
    width: 30px;
    text-align: center;
    background: #20a449;
    align-items: center;
    display: flex;
    justify-content: center;
    border-radius: 50%;
    left: 0;
    top: 5px;
    color: #fff;
}

.text-banner h4{
	font-size: 45px;
    color: #fff;
    margin: 0;
    font-weight: 300;
    margin-bottom: 20px;
}
.text-banner p{
	color: #fff;
    font-size: 20px;
    font-family: \'Montserrat\',sans-serif;
    line-height: 30px;
}

/*CREATING PURPOSE start*/
.categoryscoremain{
	padding: 60px 0;
}
.categoryscore{
    border: solid 1px #a1aaae;
    border-radius: 15px;
}
.catagoryicon{
	padding: 30px;
	text-align: center;
}
.catagoryicon img{ 
	/*height: 160px;*/
}
.catagoryicon h4{
	font-size: 18px;
	margin-top: 30px;
	font-weight: 400;
}

.creatoingpurposetext{
	    padding: 30px 30px 30px 0;
    font-family: \'Montserrat\', sans-serif;
}
.creatoingpurposetext h4{
	margin-bottom: 20px;
}
.creatoingpurposetext p{
	font-size: 15px;
    line-height: 22px;
    font-weight: 500;
}
.flagsmain{
	padding: 30px;
    background: #f3f8fa;
    font-family: \'Montserrat\', sans-serif;
    border-radius: 0 15px 15px 0;
}
.flagsmain h4{
	margin-bottom: 20px;
	font-size: 18px;
}
.flagsmain p{
	font-size: 14px;
    line-height: 20px;
    font-weight: 500;
        margin-bottom: 4px;
}

.flagtext{
	position: relative;
    padding-left: 65px;
    margin-bottom: 22px;
    font-size: 14px;
    line-height: 20px;
}
.flgicon{
	position: absolute;
    left: 0;
} 
.flgicon img{
	height: 50px;
}
.scorebordreport{
	padding:0 0 60px 0;
	    font-family: \'Montserrat\', sans-serif;
}

.scorebordbox{
	position: relative;
    padding-left: 90px;
    font-size: 20px;
    font-weight: 500;
    line-height: 30px;
    margin-bottom: 30px;
}
.scorebordbox h2{
	margin-top: 0;
    margin-bottom: 15px;
    font-size: 26px;
    text-transform: uppercase;
}
.scorebordbox p{ 
	font-size: 16px;
    line-height: 24px;
    margin: 0;
    margin-bottom: 20px;
}
.scordbordnumber{
	position: absolute;
    height: 50px;
    width: 50px;
    border: solid 5px #dddddd;
    align-items: center;
    display: flex;
    justify-content: center;
    border-radius: 50%;
    left: 0;
    top: 0px;
    font-size: 30px;
    font-weight: 600;
    color: #dddddd;
    font-family: \'Roboto\', sans-serif;
}
.scorecolorbord img{
	width: 100%;
	margin-bottom: 10px;
}
.scorecolorbord h3{
	margin-top: 0px;
    font-size: 14px;
}
.gapmain{
	padding: 20px 40px;border: solid 2px #dddddd;border-radius: 5px;text-align: center;font-size: 14px;line-height: 20px;
}
.gapmain b{
font-size: 25px;
}
.scorerightflag{
	height: 70px;
}

.bannertitle{
	    font-size: 40px;
    color: #fff;
    margin: 0;
    font-weight: 300;
    text-align: left;
    text-transform: uppercase;
}
.scorebordmainbanner{
	display: flex;
	justify-content: space-between;
}

.bannerscorebord-box{
	border: solid 1px #fff;
    border-radius: 15px;
   padding: 28px 20px;
    background: #135782;
    color: #fff;
    text-align: center;
    font-size: 16px;
    font-weight: 300;
    width: 48%;
    margin-bottom: 15px;
}
.bannerscorebord-box span{
	    font-size: 45px;
    font-family: \'Montserrat\', sans-serif;
    font-weight: 400;
    display: block;
    line-height: 45px;

}
.bggreenbox{
	    background: #07b051;
}
.textbanner-padding{
	padding: 40px 0 30px 0;
}

.topscore-main{
	padding: 40px 0 0 0;
}

.topscore-box{
	    margin-bottom: 40px;
    border: solid 1px #a1aaae;
    border-radius: 15px;
    padding: 25px;
    margin-right: 15px;
	min-height:600px;
}
.topscore-box h2{
	font-size: 22px;
	margin: 0; 
}
.topscore-box p{
	font-size: 14px;
    font-family: \'Montserrat\', sans-serif;
    font-weight: 500;
    padding: 15px 0;
   
}
.topscore-circle{
	height: 130px;
	width: 130px;
}
.topscore-text{
	position: relative;
    margin-left: 30px;
    font-family: \'Montserrat\', sans-serif;
    background: #e4eff4;
    border-radius: 0 20px 20px 20px;
    padding: 20px;
    font-size: 14px;
    line-height: 20px;
    font-weight: 500;
}
.topscore-text::before{
	position: absolute;
    content: \'\';
    border-bottom: 34px solid #0082d600;
    border-right: 35px solid #e4eff4;
    left: -28px;
    top: 0;
}
.scoretextbox{
	border: solid 1px #a1aaae;
    border-radius: 5px;
    padding: 12px;
    margin-top: 15px;
    background: #fafafa;
}

.score-chart h5{
	font-size: 12px;
	font-weight: 500;
	margin-bottom: 0;
	padding: 8px 0;
}
.three-capbilities{
	    padding-right: 20px;
}
.border-rightcustom{
    padding-left: 20px !important;
    border-left: solid 1px #a1aaae;
}
.three-capbilities h2{
	text-transform: uppercase;
    margin: 0;
    margin-bottom: 10px;
    font-size: 22px;
}
.three-capbilities p{
	    margin: 0;
    margin-bottom: 20px;
    font-family: \'Montserrat\', sans-serif;
}
.threereport-cercle{
	text-align: center;
}
.threereport-cercle img{
	height: 80px;
	width: 80px;
}
.threereport-cercle h6{
	font-size: 14px;
	font-weight: 500;
	margin-top: 15px;
}
.respondant-score-man{
	padding: 50px 0;
}

.score-boxmain{
	display: flex;
	justify-content: space-between;
	flex-wrap: wrap;
}
.score-boxex{
	    background: rgb(31,157,76);
    background: linear-gradient(0deg, rgba(31,157,76,1) 0%, rgba(19,107,171,1) 100%);
    padding: 20px 0;
    color: #fff;
    text-align: center;
    margin: 0 5px;
    border-radius: 20px;
    width: 19%;
    width: 212px;
    margin-bottom: 15px; 
}
.score-boxex h2{
	font-size: 16px;
    font-weight: 400;
    border-bottom: solid 1px #fff;
    padding: 10px 0;
}
.score-boxex h3{
	    font-size: 15px;
    font-weight: 400;
    margin-bottom: 10px;
    margin-top: 10px;
}
.score-boxex h4{
	font-size: 40px;
    line-height: 35px;
    font-weight: 400;
}

.score-boxex hr{
	margin: 0 auto;
	border-color: #fff;
}
.banner-customtext h2{
	font-size: 55px !important;
}
.information-box{
	background: #f8f8f8;
	padding: 40px 25px 90px 25px;
    font-family: \'Montserrat\', sans-serif;
    position: relative;
    font-size: 14px;
    font-weight: 500;
    line-height: 20px;
    height: 75px;
    margin-bottom: 30px;
    margin-right: 20px;
}
.boxtitle {
    position: absolute;
    background: rgb(58,161,227);
    background: linear-gradient(90deg, rgba(58,161,227,1) 0%, rgba(58,161,227,1) 62%, rgb(255 255 255 / 40%) 100%);
    color: #fff;
    height: 30px;
    width: 254px;
    left: -18px;
    top: -10px;
    padding-left: 13px;
    line-height: 30px;
}
.boxtitle::before {
    position: absolute;
    content: \'\';
    border-bottom: 18px solid #0082d600;
    border-right: 18px solid #0f649a;
    left: 0px;
    bottom: -18px;
}
.inportantinfomain{
	padding: 60px 0 30px 0;
}
.footerbanner img{
	width: 820px;
}

/*capabilities-model-v5*/
.full-logo{
	padding: 30px 0;
    text-align: center;
}

.full-logo img{
	max-height: 55px;

}
.modelheadingbox{
	position: relative;
    color: #fff;
    padding: 15px 0;
    padding-left: 100px;
}
.clheding-icon{
	    position: absolute;
    left: 0;
}
.clheding-icon img{
	height: 70px;
}
.modelheadingbox h2{
	font-size: 22px;
}
.modelheadingbox p{
	margin: 0;
    font-family: \'Montserrat\', sans-serif;
    font-size: 14px;
	line-height: 18px
}
.perpose-heading{
	    background: #ffc100;
    border-top: solid 4px #fff;
}


.perpose-description{
	background: #fcf6e0;
    border-top: solid 5px #fff;
	padding: 15px 0 10px 0;
}

.box-main{
    position: relative;
    padding-left: 38px;
    font-family: \'Montserrat\', sans-serif;
    margin-bottom: 15px;
    margin-right: 15px;
}
.box-main::before{
	position: absolute;
	content: \'\';
	height: 18px;
    width: 25px;
	background: url(C:/xampp/htdocs/orginsightapp/asset/report_images/check-mark-green.png);
	background-size: cover;
	left: 0;
	top: 7px;
}
.box-main h2{
	font-size: 16px;
}
.box-main p{
	font-size: 13px;
	font-weight: 500;
}

.bg-blue{
	background: #01b0ef;
}
.bg-lightblue{
 background: #daf2fc;
}
.bg-purple{
	background: #6f2fa1;
}
.bg-light-purple{
	background: #f4ebfe;
}
.bg-green{
	    background: #01ae54;
}
.bg-light-green{
	       background: #dbf5e8;
}
.bg-red{
    background: #c10003;
}
.bg-light-red{
	background: #fcd8d8;
}

.score1style{left:32%;}
.score2style{left:35%;}
.score3style{left:38%;}
.score4style{left:38%;}
.score5style{left:38%;}
</style>';
?>