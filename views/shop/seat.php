<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$url_place = 'site/list';
$url_show_time = 'about/about';
$order = Yii::$app->session->get('order');

$cultural_place_id = $order->getCulturalPlaceId();
$cultural_place_category = $order->getCulturalPlaceCategory();
$show_id = $order->getShowId();
$show_name = $order->getShowName();
$show_time = $order->getShowTime();
$show_date = Yii::$app->formatter->asDate($order->getShowDate(), 'php:d.m.Y');
$place_name = $order->getPlaceName();
$regular_price = $order->getRegularPrice();
$vip_price = $order->getVipPrice();
$seat_id = $order->getSeatId();
$seat_row = $order->getSeatRow();
$seat_col =$order->getSeatCol();
$auditorium_id = $order->getAuditoriumId();

?>

<!-- main body contents starts here-->
<div class="container" id="seatContainer">
    <div class="row" style="margin-top: 5%;">
        <!--Left Column *********************************************-->
        <div class="col-md-3">
            <div class="col-md-12" style="background-color: whitesmoke;
                 padding-top: 5%;padding-bottom: 15%;">
                <div class="col-md-12 img-rounded" 
                     style="background-color: white;padding-top: 5%;padding-bottom: 15%;">
                    <h4 class="text-center"><?= \Yii::t('app', 'SHOW'); ?></h4>
					<u><a href="<?= Url::to([$url_show_time, 'id' => $cultural_place_id])?>"><?= $show_name; ?></a></u><br><br>
                </div>

                <a href="<?= Url::to([$url_place, 'id' => $cultural_place_category]); ?>">
                    <div class="col-md-12 text-center ticketRightCol img-rounded"><?= $place_name; ?></div>
                </a>
                <a href="<?= Url::to([$url_show_time, 'id' => $cultural_place_id]); ?>">
					
                    <div class="col-md-12 text-center ticketRightCol img-rounded">
						<?= $show_date; ?><br />
						<?= $show_time; ?>
					</div>
                </a>
                <div class="col-md-12 text-center ticketRightCol img-rounded" 
                     style="background-color: black;"><?= \Yii::t('app', 'Seat'); ?></div>
					 
                <div class="col-md-12 text-center ticketRightCol img-rounded" 
                     style="background-color: black;"><?= \Yii::t('app', 'Price'); ?></div>
            </div>
        </div>
		
        <!--Right Column *********************************************-->
		<div class="col-md-9">
		
			<?php if($cultural_place_category !== 4): ?>
			
            <div class="col-md-12" style="background-color: whitesmoke;">
                <h3 class="text-center"><?= \Yii::t('app', 'Please Choose a seat'); ?></h3>
                <!--Stage********************************************************************-->
                <div class="row">
                    <div class="col-md-offset-1 col-md-10 img-rounded" style="background-color: white;">
                        <div class="col-md-offset-2 col-md-8 text-center" 
                             style="background-color: whitesmoke;margin-top: 5%;
                             padding-top: 2%;padding-bottom: 2%;">
                            <?= \Yii::t('app', 'Stage'); ?>
                        </div>
                        <div class="col-md-offset-3 col-md-6" 
                             style="background-color: black;margin-top: 0.5%;margin-bottom: 5%;
                             padding-top: 0.5%;padding-bottom: 0.5%;border-radius: 4px;">
                        </div>
                        <!--Seat selection***************************-->
                        <div class="col-md-offset-2 col-md-8 fuselage">
                            <div class="plane">
                                <div class="col-md-12">
                                    <ol>
										<?php
											$form = ActiveForm::begin(['id' => 'seat-form']);
												for($row = 0; $row < $seat_row; $row++):
										?>
													<li class="row">
														<ol class="seats" type="1">
															<?php
																for($col = 0; $col < $seat_col; $col++):
																$label = 'row'.($row + 1) .'_col'.($col + 1).'';
															?>
															<?= $form->field($model, 'seats')->checkboxList(['seats' => $label])->label(false); ?>
															<li class="seat">
																 <!-- $form->field($model, 'seats')->checkboxList(['seats' => $label])->label($label); -->
															</li>
															<?php endfor; ?>
														</ol>
													</li>
												<?php endfor; ?>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Seats explanation *******************************-->
                <div class="row" style="background-color: white;margin-top: 2%;">
                    <div class="col-md-3" >
                        <div class=" seats seat">
                            <input type="checkbox" checked id="selected" />
                            <label for="selected"><?= \Yii::t('app', 'selected'); ?></label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class=" seats seat">
                            <input type="checkbox" id="regular" />
                            <label for="regular"><?= \Yii::t('app', 'regular'); ?></label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class=" seats seat">
                            <input type="checkbox" id="vips" />
                            <label class="vip" for="vips"><?= \Yii::t('app', 'vip'); ?></label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class=" seats seat">
                            <input type="checkbox" disabled id="occupied">
                            <label for="occupied"><?= \Yii::t('app', 'occupied'); ?></label>
                        </div>
                    </div>
                </div>

                <!--Pricing ******************************************-->
                <div class="col-md-offset-1 col-md-10" style="padding-top: 5%;">
                    <div class="col-md-3">
                        <div class=" seats seat">
                            <input type="checkbox" id="regPrice" />
                            <label for="regPrice"><?= \Yii::t('app', 'regular'); ?></label>
                        </div>
                        <center><b><?= $regular_price; ?> <i></i></b></center>
                    </div>
                    <div class="col-md-3">
                        <div class=" seats seat">
                            <input type="checkbox" id="VipPrice" />
                            <label class="vip" for="VipPrice"><?= \Yii::t('app', 'vip'); ?></label>
                        </div>
                        <center><b><?= $vip_price; ?> <i></i></b></center>
                    </div>
                </div>
            </div>

			<!--Buttons "NEXT" and "BACK"-->
            <div class="col-md-12" style="margin-top: 5%;padding-right: 0;">
					<?= Html::submitButton('Next', ['class' => 'btn btn-primary', 'name' => 'seat-button']) ?>
					<?= Html::a(\Yii::t('app', 'Next'), ['shop/checkout'], ['class'=>'btn btn-default pull-right', 'style' => 'margin-left: 4%;']); ?>
				<?php ActiveForm::end(); ?>
					<?= Html::a(\Yii::t('app', 'Back'), ['shop/buy-ticket', 'id' => $show_id], ['class'=>'btn btn-default pull-right']); ?>
				
            </div>
			<?php endif; ?>
			
			<?php if($seat_id === 0): ?>
			
				<div class="col-md-12" style="background-color: whitesmoke;">
					<h3 class="text-center"><?= \Yii::t('app', 'You do not need to choose any seat for exhibition, just go ahad and click next'); ?></h3>
				</div>
				
				<!--Buttons "NEXT" and "BACK"-->
            <div class="col-md-12" style="margin-top: 5%;padding-right: 0;">
			
					<?= Html::a(\Yii::t('app', 'Next'), ['shop/checkout'], ['class'=>'btn btn-default pull-right', 'style' => 'margin-left: 4%;']); ?>
					<?= Html::a(\Yii::t('app', 'Back'), ['shop/buy-ticket', 'id' => $show_id], ['class'=>'btn btn-default pull-right']); ?>
				
            </div>
			
			<?php endif; ?>
        </div>
    </div>

    <hr>
</div> 
<!-- /END OF container ******************************************************-->