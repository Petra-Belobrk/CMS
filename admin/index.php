<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">

        <?php



        ?>



        <!-- Navigation -->

        <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">

                            <?php
                           echo "Welcome " . $_SESSION['username'];
                            ?>

                            <small>to your data</small>
                        </h1>

                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->


                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

            <?php
           $post_counts = count_records(get_all_user_posts());
            echo "<div class='huge'>$post_counts</div>";
            ?>


                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                        <?php
                                        $comments_counts = count_records(get_all_user_approved_posts_comments());
                                        echo "<div class='huge'>$comments_counts</div>";
                                        ?>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        $category_counts = count_records(get_all_user_categories());
                                        echo "<div class='huge'>$category_counts</div>";
                                        ?>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <?php
                $post_published_counts = count_records(get_all_user_published_posts());
                $post_draft_counts = count_records(get_all_user_draft_posts());
                $comments_denied_counts = count_records(get_all_user_denied_posts_comments());
                $approved_comments_count = count_records(get_all_user_approved_posts_comments());
                ?>

                <div class="row">
                    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
                    <script type="text/javascript">
                        google.charts.load('current', {'packages':['bar']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Data', 'Count'],

            <?php

                $element_text = ['All Posts', 'Active Posts','Draft Posts', 'Comments', 'Approved comments', 'Pending Comments', 'Categories'];
                $element_count = [$post_counts, $post_published_counts, $post_draft_counts, $comments_counts, $approved_comments_count, $comments_denied_counts, $category_counts];

                for($i = 0; $i < 7; $i++) {
                  echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                }


            ?>

                            ]);

                            var options = {
                                chart: {
                                    title: '',
                                    subtitle: '',
                                }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        }
                    </script>


                    <div id="columnchart_material" style="width: auto; height: 500px;"></div>



                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include "includes/admin_footer.php"; ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha256-ENFZrbVzylNbgnXx0n3I1g//2WeO47XxoPe0vkp3NC8=" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha256-3blsJd4Hli/7wCQ+bmgXfOdK7p/ZUMtPXY08jmxSSgk=" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script>
        $(document).ready(function(){
            Pusher.logToConsole = true;
            var pusher = new Pusher('6eacfd06b368769c8af8', {
                cluster: 'eu',
                forceTLS: true
           });
            var notificationChannel = pusher.subscribe('notifications');
            notificationChannel.bind('new_user', function(notification) {

                var message = notification.message;

                toastr.success(`${message} just registered`);


            });



        });
</script>
