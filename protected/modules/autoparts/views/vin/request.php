<style type="text/css">

#form-zapros select {
	text-decoration:none;
}

</style>
<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;?>
<h2>Запрос по Vin коду</h2>
<div class="user-content">     
	<form id="form-zapros" method="POST" action="<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/request';?>" onsubmit="validate_vin(this.action);return false;">
	<!--form id="form-zapros" method="POST" action="<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/request';?>"-->
	<!--div onclick="validate_vin('<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/request';?>');return false;">Test</div-->
	<p>
				<label for="numberVin">Номер VIN или номер кузова:<font color="red">*</font></label>
				<input name="numberVin" type="text" id="numberVin">
				<?php if(isset($errors['numberVin'])):?>
				&nbsp;&nbsp;<span><?php echo $errors['numberVin'];?></span>
				<?php endif;?>
				</p>
				<p>
				<label for="year">Год выпуска:<font color="red">*</font></label>
				<?php
				echo CHtml::dropDownList('year','',$years,array('id'=>'year'));
				?>
				<?php if(isset($errors['year'])):?>
				&nbsp;&nbsp;<span><?php echo $errors['year'];?></span>
				<?php endif;?>
				</p>
				<p>
				<label for="brands">Марка:<font color="red">*</font></label>
				<?php
				echo CHtml::dropDownList('brands','--',$brands,array('id'=>'brands'));
				?>
				<?php if(isset($errors['brands'])):?>
				&nbsp;&nbsp;<span><?php echo $errors['brands'];?></span>
				<?php endif;?>
				</p>
				<p>
				<label for="model">Модель:<font color="red">*</font></label>
				<input name="model" type="text" id="model" value="">
				<?php if(isset($errors['model'])):?>
				&nbsp;&nbsp;<span><?php echo $errors['model'];?></span>
				<?php endif;?>
				
				</p>
				
				<p>
				<label for="type_engine">Тип двигателя:</label>
				<?php
				echo CHtml::dropDownList('type_engine','--',$type_engine,array('id'=>'type_engine'));
				?>
				</p>
				<p>
				<label for="engine-capacity">Объем двигателя:</label>
				<input name="engine-capacity" type="text" id="engine-capacity">
				</p>
				<p>
				<label for="gear">Привод:</label>
				<?php
				echo CHtml::dropDownList('gear','--',$gear,array('id'=>'gear'));
				?>
				</p>
				<p>
				<label for="car_bodies">Тип кузова:</label>
				<?php
				echo CHtml::dropDownList('car_bodies','--',$car_bodies,array('id'=>'car_bodies'));
				?>
				</p>
				<p>
				<label for="transmission">Тип КПП:</label>
				<?php
				echo CHtml::dropDownList('transmission','--',$transmission,array('id'=>'transmission'));
				?>
				</p>
				<label for="air">Кондиционер:</label>
				<select name="air" id="air">
					<option value="0"/>
					<option value="3">Да</option>
					<option value="1">Нет</option>
				</select>
				</p>
				<p>
				<label for="abs">ABS:</label>
				<select name="abs" id="abs">
					<option value="0"/>
					<option value="3">Да</option>
					<option value="1">Нет</option>
				</select>
				</p>
				<p>
				<label for="gur">ГУР:</label>
				<select name="gur" id="gur">
					<option value="0"/>
					<option value="3">Да</option>
					<option value="1">Нет</option>
				</select>
				</p>
				<p>
				<label for="additional_info">Дополнительная информация по автомобилю:</label>
				<textarea name="additional_info" cols="40" rows="3" size="150" id="additional_info"></textarea>
				</p>
				<p>
				<label for="necessary_parts">Необходимая запчасть:<font color="red">*</font></label>
				<textarea name="necessary_parts" cols="40" rows="3" size="150" id="necessary_parts"></textarea>
				<?php if(isset($errors['necessary_parts'])):?>
				&nbsp;&nbsp;<div><?php echo $errors['necessary_parts'];?></div>
				<?php endif;?>
				</p>


				<p>
					<div id="form-submit"><input value="Отправить" type="submit" name="submit"/></div>
					<div id="form-submit"><input value="Сброс" type="reset"/></div>
				</p>
	</form>
</div>