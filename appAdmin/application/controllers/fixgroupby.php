<?php
// ONLY_FULL_GROUP_BY
			$this->db->query('SET SESSION sql_mode =
                  REPLACE(REPLACE(REPLACE(
                  @@sql_mode,
                  "ONLY_FULL_GROUP_BY,", ""),
                  ",ONLY_FULL_GROUP_BY", ""),
                  "ONLY_FULL_GROUP_BY", "")');
?>				  
