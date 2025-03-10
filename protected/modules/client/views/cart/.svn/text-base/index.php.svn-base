<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;?>

<?php


	  $html='';
	  if(isset($ids_orders)){
	  	$html.='<input type=hidden id="ids" value="'.implode(',',$ids_orders).'">';
	  }

      $but_delete=SITE_PATH.'images/'.Yii::app()->theme->name.'/but_delete.jpg';
      $but_order=SITE_PATH.'images/'.Yii::app()->theme->name.'/but_order.jpg';
	
	
     $html.="<h1>Корзина товаров</h1>
                <!--form action='".SITE_PATH.$this->module->id.'/cart/order'."' method='post' onsubmit='validate_basket(this.action);return false;'-->
                <form action='".SITE_PATH.$this->module->id.'/cart/preorder'."' method='post' onsubmit='validate_basket(this.action);return false;'>
                <!--form action='".SITE_PATH.$this->module->id.'/cart/order'."' method='post' id='form_basket'-->
				
				<table class='tcart'>
                	<thead>
                	<tr>
                           	<th width='' style='text-align:left'>Товар</th>
                            <th width='120'>Цена,руб.</th>
                            <th width='100'>Кол-во</th>
                            <th width='150'>Сумма,руб.</th>
                            <th width='100'>Кол-во <br>на складе</th>
                            <th width='150'>Комментарий</th>
                            <th width='80'>Действия</th>
                            
							
                        </tr>
                    </thead><tbody>
                	";



				if(count($orders) > 0):
                     foreach($orders as $row){
					if(UserIdentity::getProperty('role')){
						$header=$row->info.' '.$row->manufacturer.' '.$row->number;
                	  	$id=$row->id;
                	  	$quantity=$row->quantity;
                	  	$quantity_on_store=$row->quantity_on_store;
                	  	$price=$row->price_client;
                	  	$sum=$row->sum_client;		
					}
					else{
						$header=$row['info'].' '.$row['manufacturer'].' '.$row['number'];
                	  	$id=$row['id'];
                	  	$quantity=$row['quantity'];
                	  	$quantity_on_store=$row['quantity_on_store'];
                	  	$price=$row['price_client'];
                	  	$sum=$row['sum_client'];		
					}
                	 

                	  $quant="quantity_$id";
                	  $comment="comment_$id";
					  $plus="plus_$id";
					  $minus="minus_$id";
					  $sum_client="sum_$id";
					  $show_sum_client="tdsum_$id";
					  $price_client="price_$id";
					  $check="check_$id";
					  $del="del_$id";
					  $quant_on_store="quantitystore_$id";
					  
					  $arrow_up=SITE_PATH.'images/'.Yii::app()->theme->name.'/up.gif';
					  $arrow_down=SITE_PATH.'images/'.Yii::app()->theme->name.'/down.gif';

 $html.="
<tr valign='middle' id='row_$id'>
                        	<td><font color='0053C3'><strong>$header</strong></font></td>
                        	<td align='center' class='price' >$price</td>
                        	<input type=hidden id='$price_client' value='$price'>
                        	<td align='center'>
							
							
							<input type='text' name='quantity[$id]' value='$quantity' id='$quant' onchange='change_sum(this.id,\"".SITE_PATH.$this->module->id.'/'.$this->id.'/changequantity'."\")' style='float:left;'>
							
						
						
							
						<a href='#plus' id='$plus' onclick='operation(this.id,\"plus\",\"".SITE_PATH.$this->module->id.'/'.$this->id.'/changequantity'."\");'><img src='$arrow_up' style='padding-right:32px;padding-top:2px;'></a><br>
						
											
						<a href='#minus' id='$minus' onclick='operation(this.id,\"minus\",\"".SITE_PATH.$this->module->id.'/'.$this->id.'/changequantity'."\")' ><img src='$arrow_down' style='padding-top:4px;padding-right:32px;'></a>
						</div>
																		
							</td>
                        	<td class='price' align='center' id='$show_sum_client'>$sum</td>
                        	<input type=hidden id='$sum_client' value='$sum'>
                        	<td class='price' align='center'>$quantity_on_store</td>
							<td class='price' align='center'><textarea cols='10' rows='1' name='comment[$id]' id='$comment'></textarea></td>
							<input type=hidden id='$quant_on_store' value='$quantity_on_store'>
							<td align=center id='$del'>
							<a href='".SITE_PATH.'autoparts/basket/delete?id='.$id."' onclick=\"delete_from_basket(this,'".$id."');return false;\" title='Удалить'><img src=\"".SITE_PATH.'images/'.Yii::app()->theme->name."/icon_delete.png\" width=10 height=12/></a>";
							if(UserIdentity::getProperty('role'))
                        		$html.="<input type='checkbox' id='$check' name='check[$id]' value='1' onclick='get_totally()' title='Заказать'/>";
                        $html.="</td></tr>";
                      }
				endif;
				if(UserIdentity::getProperty('role')){
					$html.="<tr class='last_tr'>";
							$html.="<td class='total_cost' align='left'>&nbsp;Итого к оплате</td>";  
                        	
                           $html.=" <td class='price big' align='center' id='totally'>0 руб</td>
                            <td>
							
							</td>
                        </tr>";
				}	
				else{
					$html.="<tr class='last_tr'>";
							$html.="<td cols=2>Заказ возможен только после регистрации.</td></tr>";  

				}  
				

                 $html.="   </tbody>
                </table>
                <div class='line_buttons'>
                <input type=hidden id='summa' name='summa'>
                <input type=hidden name=list value=basket>";
				if(UserIdentity::getProperty('role')){
					$html.="<input type=hidden name=do id=do value=''><input type='image' src='$but_delete' alt='Удалить отмеченные' onclick='del()' id='basket_delete'/>";
				 	$html.="<input type='image' src='$but_order' alt='Оформить заказ' id='basket_order'/>";
				}
                	
				 $html.="
				 </div>
                </form>
            ";
			
			echo $html;

?>