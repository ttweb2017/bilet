<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = \Yii::t('app', 'ABOUT THEATRE');
$this->params['breadcrumbs'][] = ['label' => \Yii::t('app', 'THEATRE'), 'url' => ['site/theatre']];
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- main body contents starts here-->
<div class="container" style="margin-top: 2%;">
    <div class="row">
        <div class="col-md-8">
            <div class="col-md-12" style="padding-left: 0;">
                <center><img class="img-responsive" src="img/sep.png" alt="">
                    <h4 ><?= $cultural_place_translation[0]->place_name ?></h4>
                    <img class="img-responsive" src="img/sep.png" alt="">
                </center>
                <div class="col-md-12" style="margin-top: 1%;">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                            <li data-target="#myCarousel" data-slide-to="3"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <center>
                                    <img src="img/400x150_pic1.png" 
                                         class="img-thumbnail" alt="SportPhoto" style="width: 100%;">
                                </center>
                                <div class="carousel-caption">
                                    <h3>Tennis</h3>
                                    <p>here is little bit about the tennis.</p>
                                </div>
                            </div>

                            <div class="item">
                                <center>
                                    <img src="img/400x150_pic1.png" 
                                         class="img-thumbnail" alt="SportPhoto" style="width: 100%;">
                                </center>
                                <div class="carousel-caption">
                                    <h3>Basketball</h3>
                                    <p>here is little bit about the basketball.</p>
                                </div>
                            </div>

                            <div class="item">
                                <center>
                                    <img src="img/400x150_pic1.png" 
                                         class="img-thumbnail" alt="SportPhoto" style="width: 100%;">
                                </center>
                                <div class="carousel-caption">
                                    <h3>Football</h3>
                                    <p>here is little bit about the football.</p>
                                </div>
                            </div>

                            <div class="item">
                                <center>
                                    <img src="img/400x150_pic1.png" 
                                         class="img-thumbnail" alt="SportPhoto" style="width: 100%;">
                                </center>
                                <div class="carousel-caption">
                                    <h3>Baseball</h3>
                                    <p>here is little bit about the baseball.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-12" style="margin-top: 5%;">
                <div class="col-md-12"  style="background-color: white;">
                    <p class="theatreInfoText" style="text-align: justify; text-indent: 4%;">
                        <?= $cultural_place_translation[0]->cultural_place_description ?>
                    </p>
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 5%;padding-left: 0;">
                <div class="col-md-12" style="margin-bottom: 3%;">
                    <div class="col-md-6 img-rounded" style="background-color: #e4b9b9;">
                        <h4 class="text-center"><?=\Yii::t('app', 'Games for today'); ?></h4>
                    </div>
                </div>

				<!-- here is for loop to populate shows for day-->
				<?php 
					$today = Yii::$app->formatter->asDate('now', 'php:Y-m-d');
					
					$showSize = sizeof($show);
					for($i = 0; $i < $showSize; $i++):
					$date = Yii::$app->formatter->asDate($show[$i]->begin_date, 'php:Y-m-d');
				?>
				<?php if ($today === $date): ?>
					<div class="col-md-4">
						<div class="col-sm-12 thumbnail text-center removePadding">
							<img class="img-responsive img-rounded" 
								 src="img/200x150_pic22.png" alt="photoSport" 
								 style="width: 100%;">
							<div class="caption img-rounded" 
								 style="background: transparent;top: 0.3rem;">
								<h4 style="color: black;"><b><?= $show_translation[$i]->show_name; ?></b></h4>
							</div>
							<div class="caption img-rounded" style="padding-left: 60%;">
								<form action="../onlineSale/buyOnline.html" method="get">
									<button class="btn btn-danger"><?=\Yii::t('app', 'Buy'); ?></button>
								</form>
							</div>
						</div>
					</div>
				<?php endif ?>
				
				<!--if we dont have a show for today, we will display a message about it-->
				<?php if ($today !== $date): ?>
					<div class="col-md-12 text-center">
						<h5 style="color: red;"><b><?=\Yii::t('app', 'We do not have any show for today'); ?></b></h5>
						<i style="color: aqua;" class="fa fa-4x fa-smile-o"></i>
					</div>
				<?php endif ?>
				<?php endfor;?>
            </div>

            <div class="col-md-12" style="margin-top: 5%;padding-left: 0;">
                <div class="col-md-12" style="margin-bottom: 3%;">
                    <div class="col-md-6 img-rounded" style="background-color: #e4b9b9;">
                        <h4 class="text-center"><?=\Yii::t('app', 'Games for week'); ?></h4>
                    </div>
                </div>

				<!-- here is for loop to populate shows for tomorrow-->
				<?php 
					$today = Yii::$app->formatter->asDate('now', 'php:Y-m-d');
					
					$showSize = sizeof($show);
					for($i = 0; $i < $showSize; $i++):
					$date = Yii::$app->formatter->asDate($show[$i]->begin_date, 'php:Y-m-d');
					
				?>
				<?php if ($today < $date): ?>
				
                <div class="col-md-4">
                    <div class="col-sm-12 thumbnail text-center removePadding">
                        <img class="img-responsive img-rounded" 
                             src="img/200x150_pic22.png" alt="photoSport" 
                             style="width: 100%;">
                        <div class="caption img-rounded" 
                             style="background: transparent;top: 0.3rem;">
                            <h4 style="color: black;"><b><?= $show_translation[$i]->show_name; ?></b></h4>
                        </div>
                        <div class="caption img-rounded" style="padding-left: 60%;">
                            <form action="../onlineSale/buyOnline.html" method="get">
                                <button class="btn btn-danger"><?=\Yii::t('app', 'Buy'); ?></button>
                            </form>
                        </div>
                    </div>
                </div>
				
				<?php endif ?>
				
				<!--if we dont have a show for today, we will display a message about it-->
				<?php if ($today > $date): ?>
					<div class="col-md-12 text-center">
						<h5 style="color: red;"><b><?=\Yii::t('app', 'We do not have any show for this week'); ?></b></h5>
						<i style="color: aqua;" class="fa fa-4x fa-smile-o"></i>
					</div>
				<?php endif ?>
				
				<?php endfor;?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="col-md-12">
                <h5 class="text-center"><b>FIFA</b></h5>
                <div class="col-md-12">
                    <div class="col-md-4">
                        <img class="img-responsive img-rounded" 
                             src="img/100x100_pic33.png" alt="photo">
                    </div>
                    <div class="col-md-8">
                        <p class="theatreInfoText">
                            <b>dhdab hhbcdjh dbchbc hdcbcchdv dcv </b><br>
                            sadsd sadsad sdasd sdasd sdsad sadad
                        </p>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-4">
                        <img class="img-responsive img-rounded" 
                             src="img/100x100_pic33.png" alt="photo">
                    </div>
                    <div class="col-md-8">
                        <p class="theatreInfoText">
                            <b>dhdab hhbcdjh dbchbc hdcbcchdv dcv </b><br>
                            sadsd sadsad sdasd sdasd sdsad sadad
                        </p>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-4">
                        <img class="img-responsive img-rounded" 
                             src="../img/100x100_pic33.png" alt="photo">
                    </div>
                    <div class="col-md-8">
                        <p class="theatreInfoText">
                            <b>dhdab hhbcdjh dbchbc hdcbcchdv dcv </b><br>
                            sadsd sadsad sdasd sdasd sdsad sadad
                        </p>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-4">
                        <img class="img-responsive img-rounded" 
                             src="../img/100x100_pic33.png" alt="photo">
                    </div>
                    <div class="col-md-8">
                        <p class="theatreInfoText">
                            <b>dhdab hhbcdjh dbchbc hdcbcchdv dcv </b><br>
                            sadsd sadsad sdasd sdasd sdsad sadad
                        </p>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-4">
                        <img class="img-responsive img-rounded" 
                             src="../img/100x100_pic33.png" alt="photo">
                    </div>
                    <div class="col-md-8">
                        <p class="theatreInfoText">
                            <b>dhdab hhbcdjh dbchbc hdcbcchdv dcv </b><br>
                            sadsd sadsad sdasd sdasd sdsad sadad
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-offset-1 col-md-10" style="margin-top: 3%;">
                <a href="#">
                    <div class="col-sm-12 thumbnail text-center">
                        <img class="img-responsive img-rounded" 
                             src="../img/200x150_pic22.png" alt="photoTheatre" style="width: 100%;">
                        <div class="caption img-rounded" 
                             style="background: transparent;top: 0.3rem;padding-left: 75%;">

                            <i class="glyphicon glyphicon-eye-open">123</i>
                        </div>
                    </div>
                </a>
                <p class="theatreInfoText">
                    <b>dhdab hhbcdjh dbchbc hdcbc</b>
                    chdv dcv djvcsvdc dhcvsvcd dvcsgd 
                    chdv dcv djvcsvdc dhcvsvcd dvcsgd 
                    chdv dcv djvcsvdc dhcvsvcd dvcsgd 
                    chdv dcv djvcsvdc dhcvsvcd dvcsgd
                </p><br>
                <p class="theatreInfoText">
                    <i class="fa fa-map-marker"></i>
                    sport club<br>
                    <i class="fa fa-calendar"></i>
                    April 15, 18:00-20:00
                    <span class="pull-right">
                        <a href='#'>
                            <i class="fa fa-heart-o"></i>
                        </a>
                        <b class='theatreInfoText'>523</b>
                    </span>
                </p>
            </div>

            <div class="col-md-offset-1 col-md-10" style="margin-top: 3%;">
                <div class="col-md-12 thumbnail text-center">
                    <img class="img-responsive img-rounded" 
                         src="../img/200x150_pic33.png" 
                         alt="photoSport" style="width: 100%;">

                    <div class="caption img-rounded">
                        <h4>International festival</h4>
                    </div>
                </div>

                <div class="col-md-12 thumbnail text-center">
                    <img class="img-responsive img-rounded" 
                         src="../img/200x150_pic44.png" 
                         alt="photoSport" style="width: 100%;">

                    <div class="caption img-rounded">
                        <h4>International festival</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>
</div> <!-- /container -->