<footer class="footer footer-inner"><p>Copyright © 2022 OrgInsights. All rights reserved | Developed by <a href="#"><img src="<?php echo SITEURL;?>/assets/images/copyright-logo.png" alt=""></a></p></footer>
</div>
<!-- Bootstrap core JavaScript================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo SITEURL;?>/assets/js/jquery.min.js" ></script>
<script src="<?php echo SITEURL;?>/assets/js/popper.min.js"></script>
<script src="<?php echo SITEURL;?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo SITEURL;?>/assets/js/custom.js"></script>
<script src="<?php echo SITEURL;?>/assets/js/jquery.matchHeight-min.js"></script>
<script src="<?php echo SITEURL;?>/assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo SITEURL;?>/assets/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo SITEURL;?>/assets/js/dataTables.responsive.min.js"></script>
<script type="text/javascript">
jQuery('.coleql_height').matchHeight();

jQuery(document).ready( function () {
jQuery('#dataTable')
.addClass('nowrap')
.dataTable( {
responsive: true,
searching: false,
ordering: false,
bLengthChange: false,
paging: false,
});
});

jQuery("#dataTable tbody").sortable({
helper: fixHelperModified,
stop: function(event,ui) {renumber_table('#dataTable')}
}).disableSelection();
</script>
</body>
</html>