export const legacyReportCss = String.raw`*{margin:0;padding:0}
body,html {
    width: 100%;
    padding-right: 0;
    padding-left: 0;
    padding-bottom: 0;
    margin-right: 0;
    margin-left: 0;
    margin-bottom: 0;
    font-family: 'Roboto';
    font-size: 14px;
    line-height: 12px;
}
@page{
    padding-right: 0;
    padding-left: 0;
    padding-bottom: 0;
    margin-right: 0;
    margin-left: 0;
    margin-bottom: 0;
}
.text-center {
    text-align: center;
}
.clear-fix {
    clear: both;
}
.logo {
    text-align: center;
    padding-top: 30px;
}
.logo img{
    width: 300px;
    display: inline-block;
    margin-bottom: 50px;
}
.banner {
    padding: 0;
}
.banner img {
    width: 100%;
    display: block;
}
.main-title {
    color: #125C98;
    margin-top: 100px;
    font-size: 45px;
    font-family: 'Roboto', sans-serif;
}
.main-title__sub {
    margin-top: 120px;
    margin-bottom: 5px;
    font-size: 40px;
    font-weight: 400;
    font-family: 'Roboto', sans-serif;
}
.main-title__sub + span {
    font-family: 'Montserrat', sans-serif;
    font-size: 20px;
}
.page-logo {
    height: 80px;
    clear: both;
    padding-left: 20px;
    padding-top: 25px;
}
.page-logo .site-name {
    float: right;
    margin-top: 15px;
    width: 100px;
}
.site-name .green-box {
    width: 30px;
    height: 10px;
    background: #1E9954;
    display: inline-block;
}
.page-logo img {
    width: 250px;
    float: left;
}
.page_break { 
    page-break-before: always; 
}
.page-header {
    background-image: url('../images/page_title_bg.png');
    background-position: bottom;
    margin-top: 0px;
    width: 100%;
    text-align: center;
    color: #fff;
    padding-right: 50px;
    padding-left: 50px;
    padding-bottom: 30px;
    padding-top: 10px;
    margin-bottom: 20px;
}
.page-header .main-headline {
    font-family: 'Roboto';
    margin-bottom: 0;
    font-size: 45px;
    margin-top: 0;
    line-height: 45px;
}
.page-header .sub-headline {
    font-family: 'Montserrat', sans-serif;
    font-weight: 400;
    margin-bottom: 0;
    font-size: 20px;
    margin-top: 0;
}
.page-header p {
    margin-top: 10px;
}
.container {
    width: 600px;
    margin: 0 auto;
}
.container ul {
    margin-left: 0;
}
.container ul li {
    margin-top: 0;
    margin-bottom: 0;
    padding: 0;
    clear: both;
    display: flex;
    flex-direction: row;
    list-style: none;
    font-size: 15px;
}
.container ul li .icon-wrapper {
    width: 20px;
}
.container ul li .text {
    padding-left: 40px;
}
.container ul li img.icon {
    width: 20px;
    margin-top: 8px;
}
.report-summary-wrapper {
    position: absolute;
    bottom: 0;
}
.report-summary {
    background-color: #E2EDF5;
    padding: 0;
    margin-top: -5px;
    height: 510px;
    position: relative;
    overflow: hidden;
    bottom: 0;
}
.report-summary .hands{
    width: 100%;
    position: absolute;
    bottom: 0px;
}
.report-summary  h5 {
    text-align: center;
    font-family: 'Montserrat', sans-serif;
    font-weight: bold;
    font-size: 16px;
    margin-bottom: 10px;
    margin-top: 10px;
}
.number-icon {
    background-color: #1369ab;
    width: 25px;
    height: 25px !important;
    border-radius: 13px;
    color: #fff;
    position: relative;
    text-align: center;
    font-size: 14px;
    line-height: 16px;
}
.page3-banner {
    width: 100%;
}
.capb-model {
    width: 690px;
    margin: 10px auto;
    display: block;
    padding-top: 10px;
    float: none;
    clear: both;
}
.capb-model .left-section {
    width: 280px;
    float: left;
}
.capb-model .right-section {
    width: 430px;
    float: left;
    padding-left: 10px;
}
.capb-model .left-section .details {
    background-color: #E6DEBD;
    padding: 7px 20px;
    border-radius: 8px;
    margin-left: 60px;
    font-size: 11px;
}
.capb-model .left-section .letter {
    background-color: #C0AB5C;
    border-radius: 8px;
    font-size: 50px;
    color: #fff;
    margin-bottom: -100px;
    padding: 0;
    line-height: 45px;
    padding-left: 15px;
    font-weight: bold;
}
.capb-model .left-section .details h6 {
    font-size: 14px;
    font-weight: lighter;
    margin-bottom: 5px;
    font-weight: 500;
}
.capb-model .right-section .list-item {
    font-size: 11px;
    margin-top: 5px;
}
.capb-model .right-section .list-item .icon {
    background-color: #C0AB5C;
    width: 5px;
    height: 5px;
    display: inline-block;
    vertical-align: top;
}
.capb-model .right-section .list-item p {
    width: 410px;
    display: inline-block;
    padding-top: 0px;
    padding-left: 5px;
}
.capb-model .right-section .separator {
    background-color: #E6DEBD;
    width: 100%;
    height: 2px;
    margin-top: 5px;
}
.page4-headline {
    margin-top: 30px;
}
.page6-headline {
    margin-top: 30px;
    margin-bottom: 15px;
}
.float-left {
    float: left;
}
.float-right {
    float: right;
}
.summary-boxes {
    clear: both;
    display: flex;
    padding-top: 25px;
}
.summary-box {
    width: 45%;
    border: 1px solid #a1aaae;
    border-radius: 8px;
    font-size: 12px;
    padding: 10px 8px;
    height: 330px;
}
.summary-box .title {
    font-size: 16px;
    font-weight: bold;
    margin-top: 5px;
}
.summary-box .info {
    clear: both;
}
.summary-box .icon-text {
    padding-top: 30px;
}
.summary-box .icon-text > .icon-wrapper {
    width: 30%;
    display: inline-block;
}
.summary-box .icon-text > .text {
    width: 68%;
    display: inline-block;
    font-size: 10px;
}
.summary-box .icon-text img {
    width: 60px;
}
.radius-box-title {
    background-color: #DCCB8F;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
    padding: 4px 10px;
    margin-top: 10px;
    font-size: 16px;
}
.radius-box {
    background-color: #F0F5FA;
    border-bottom-left-radius: 8px;
    border-bottom-right-radius: 8px;
    padding: 3px 10px;
    padding-top: 10px;
    height: 150px;
}
.score-graph {
    clear: both;
    padding-top: 13px;
}
.score-graph .letter{
    width: 50px;
    height: 100px;
    color: #DDDDDD;
    font-size: 60px;
    line-height: 50px;
    float: left;
}
.score-graph .right-section{
    width: 500px;
    height: 100px;
    float: left;
    padding-top: 10px;
}
.score-graph small {
    font-size: 10px;
}
.score-graph .graph-wrapper {
    background-color: #DDDDDD;
    width: 250px;
    height: 20px;
    position: relative;
    padding-top: 5px;
}
.score-graph .graph-wrapper * {
    margin: 0;
    padding: 0;
}
.score-graph .graph-wrapper .graph-box {
    width: 50px;
    height: 25px;
    border: 1px solid #fff;
    margin: 0;
    display: inline-block;
    margin-left: -5px;
    z-index: 1;
}
.score-graph .graph-wrapper .progress {
    position: absolute;
    height: 25px;
    border-left: 1px solid #fff;
    z-index: 0;
    margin-top: -5px;
}
.score-graph .graph-wrapper.graph-wrapper-1 .progress {
    background-color: #DBCD91;
}
.score-graph .graph-wrapper.graph-wrapper-2 .progress {
    background-color: #B8AB79;
}
.score-graph .graph-wrapper .graph-box.first {
    margin-left: 0;
}
.middle-wrapper > div {
    display: inline-block;
}
.graph-rating > div {
    border: 1px solid #b5b3b3;
    display: block;
    padding: 3px 10px;
}
.graph-rating > .rate-1 {
    margin-bottom: 2px;
}
.middle-wrapper {
    padding-top: 10px;
    padding-bottom: 0;
    height: 40px;
}
.middle-wrapper .gap {
    border: 1px solid #b5b3b3;
    padding-left: 10px;
    padding-right: 10px;
    height: 48px;
    line-height: 28px;
    border-radius: 2px;
    font-size: 16px;
}
.middle-wrapper .icon {
    padding: 0 10px;
}
.middle-wrapper .icon img{
    width: 50px;
}
.chart-bottom {
    padding-top: 60px;
    width: 650px;
    margin: 0 auto;
}
.chart-bottom > div {
    float: left;
}
.chart-bottom h5 {
    font-size: 16px;
    font-weight: lighter;
    padding-bottom: 10px;
}
.chart-bottom .left {
    width: 45%;
    border-right: 1px solid #DDDDDD;
}
.chart-bottom .right {
    width: 45%;
    padding-left: 50px;
    padding-right: 50px;
}

.chart-bottom  img {
    width: 50px;
    margin-top: 10px;
    margin-left: 20px;
}
.page6-header p {
    margin-top: -10px;
    line-height: 14px;
}
.page6-header {
    margin-bottom: 0;
    line-height: 20px;
}
.creating-purpose {
    border: 1px solid #DDDDDD;
    border-radius: 10px;
    margin: 50px auto;
    margin-bottom: 20px;
    height: 200px;
    width: 650px;
    overflow: hidden;
}
.creating-purpose-wrapper {
    height: 200px;
}
.creating-purpose > div {
    display: inline-block;
}
.creating-purpose .left {
    padding: 10px 20px;
    padding-bottom: 20px;
    width: 120px;
}
.creating-purpose .left > * {
    display: block;
}
.creating-purpose .middle {
    padding: 20px 20px;
    padding-bottom: 20px;
    width: 200px;
    padding-top: 60px;
}
.creating-purpose .middle .title {
    font-size: 18px;
}
.creating-purpose .middle p {
    font-size: 12px;
    line-height: 12px;
    margin-top: 10px;
}
.creating-purpose .right {
    padding: 10px 20px;
    padding-bottom: 20px;
    width: 190px;
    background-color: #F3F8FB;
    float: right;
}
.creating-purpose .right > div {
    font-size: 10px;
    line-height: 12px;
    margin-top: 20px;
}
.creating-purpose .right > .second {
    margin-top: -30px;
}
.creating-purpose .right > div > * {
    display: inline-block;
}
.creating-purpose .right h6 {
    font-size: 15px;
    font-weight: normal;
}
.creating-purpose .right img {
    margin-top: 5px;
}
.creating-purpose .right span {
    padding-left: 10px;
    padding-right: 15px;
    font-size: 10px;
    line-height: 9px;
}
.page6-score-graph .round-wrapper {
    width: 50px;
    float: left;
}
.page6-score-graph .round {
    width: 29px;
    height: 30px;
    border: 3px solid #DDDDDD;
    font-size: 13px;
    border-radius: 16px;
    position: relative;
    text-align: center;
    color: #DDDDDD;
    line-height: 22px;
    font-size: 20px;
    font-weight: bold;
}
.page6-score-graph {
    padding-top: 40px;
}
.page6-score-graph.first {
    padding-top: 0 !important;
    margin-top: -90px;
}
.page6-score-graph .graph-wrapper.graph-wrapper-1 .progress {
    background-color: #3397DF;
}
.page6-score-graph .graph-wrapper.graph-wrapper-2 .progress {
    background-color: #1D9A40;
}
.page6-score-graph .icon img {
    width: 25px;
    margin-left: 20px;
    margin-bottom: 10px;
}
.page6-score-graph .right-section {
    padding-top: 0;
}
.page6.container {
    margin-top: -90px;
}
.page7-container {
    padding-top: 0px;
}
.page7-container p {
    margin-top: 10px;
    font-size: 13px;
}
.sig {
    margin-top: 10px;
}
.sig  img {
    float: right;
}
.sig > *{
    text-align: right;
    clear: both;
}
.page8-header {
    padding: 40px 60px;
    height: auto;
}
.page8-header .main-headline {
    font-size: 30px;
    margin-top: 0;
}
.page8-container {
    width: 720px;
    margin: 0 auto;
    padding-top: 20px;
}
.page8-container > div {
    vertical-align: top;
    display: inline-block;
}
.visual-graph-left {
    width: 350px;
}
.visual-graph-right {
    width: 366px;
    position: relative;
    float: right;
    padding-top: 5px;
}
.visual-graph-left .graph-item > div {
    float: left;
}
.visual-graph-left .graph-item {
    width: 350px;
}
.visual-graph-left .graph-item .graph-title {
    background-color: #EBDCA5;
    width: 150px;
    height: 100px;
    text-align: center;
    font-size: 14px;
    font-weight: bold;
    color: #6E6871;
}
.visual-graph-left .graph-item .graph-title div {
    line-height: 90px;
    vertical-align: middle;
    display: inline-block;
    text-align: left;
    margin: 0;
}
.visual-graph-left .graph-item .graph-title div > span {
    line-height: 13px;
}
.visual-graph-left .graph-item .graph-title .letter {
    font-size: 50px;
    margin-left: 15px;
}
.progress-names {
    width: 200px;
    height: 100px;
    background-color: #F4F2E8;
}
.progress-names .name-item {
    height: 25px;
    font-size: 11px;
    color: #6E6871;
    text-align: right;
    padding-right: 5px;
    font-weight: bold;
    border-bottom: 1px solid #fff;
    vertical-align: middle;
    line-height: 16px;
}
.graph-item {
    position: relative;
}
.progress-names .name-item.red {
    color: #C33434;
}
.visual-graph-right .flag {
    position: absolute;
    right: 0;
    top: 50px;
    width: 20px;
}
.visual-graph-right .row-item {
    height: 23px;
    border: 1px solid transparent;
    z-index: 1;
}
.visual-graph-right .row-item .green-graph {
    background-color: #669577;
    height: 7px;
    margin-top: 1px;
}
.visual-graph-right .row-item .blue-graph {
    background-color: #A8DAFE;
    height: 7px;
    margin-top: 0;
}
.draw-lines {
    position: absolute;
}
.draw-lines .box {
    width: 19.6%;
    border: 1px solid #DDDDDD;
    border-top: 0;
    height: 24px;
    z-index: 0;
    display: inline-block;
    vertical-align: middle;
    margin-left: -5px;
    border-left: 0;
}
.draw-lines .box.first {
    margin-left: 0;
}
.draw-lines .box.last {
    border-right: 0;
}
.footer {
    background-color: #F1F0F0;
    padding: 50px 0;
    text-align: center;
    position: absolute;
    bottom: 0;
}
.legends {
    text-align: center;
    padding-bottom: 10px;
}
.legends > div {
    display: inline-block;  
    font-weight: bold;
    vertical-align: middle;
    font-size: 12px;
}
.legends > div.green {
    color: #669577;
}

.legends > div.blue {
    color: #A8DAFE;
    margin-left: 50px;
}`;
