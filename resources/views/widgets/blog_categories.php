<div class="s-widget">
    <!-- Heading -->

    <h5><i class="fa fa-building color"></i> Blog Categories</h5>
    <!-- Widgets Content -->
    <div class="widget-content hot-properties">

        <ul class="list-unstyled">






            <?php
            $conn3 = new mysqli('localhost', 'funnewjersey_database_new', '?VS#%!Wy-X7+', 'funnewjersey_database_new');
            // Check connection
            if ($conn3->connect_error) {
                die("Connection failed: " . $conn3->connect_error);
            }
            ?>




            <?php




            $sql9 = "SELECT * FROM dbc_post_categories";

            $result9 = $conn3->query($sql9);

            if ($result9->num_rows > 0) {
                // output data of each row

                while ($row9 = $result9->fetch_assoc()) { ?>


                    <li class="col-xs-12 col-sm-6 col-md-12 col-lg-12">
                        <!-- Image -->
                        <a style="font-size:16px;" href="https://www.funnewjersey.com/en/microblog?catid=<?php echo $row9["id"]; ?>&<?php echo $row9["caturl"]; ?>"><?php echo $row9["title"]; ?></a>
                        <!-- Heading -->




                        <div class="clearfix"></div>
                    </li>






            <?php }
            } ?>














        </ul>

    </div>
</div>
<div style="clear:both"></div>