<?php
	
   $search_code=$_REQUEST['search_code'];

    $html='<h2>Результат поиска</h2>';
	if(UserIdentity::getProperty('role'))
		$html.='<div style="padding-left:7px;"><font size="1.5px;"><b>Цены и сроки поставки указаны до г.Омутнинска.</b></font></div><br>';
	else
		$html.='<div style="padding-left:7px;"><font size="1.5px;"><b>Данная ценовая категория <a href="/client/finance/categories" style="color:green;">Бизнес</a> без учета доставки</b></font></div><br>';
	$html.='<div style="padding-left:7px;margin-top:-10px;"><font size="1.5px;"><a href="/autoparts/search?submit=1&cash=1&search_code='.$search_code.'&CrossType=on&filter=1" style="text-decoration:underline;" onclick="ajax_link(this.href);return false;">Вернуться к выбору брендов</a></font></div><br>';
    $html.='<div class="tableBox"><table cellspacing=1 cellspacing=4>';
   $html.=' <tr>
                            	<th class="cell1">Фирма</th>
                                   <th class="cell2">Артикул</th>
                                   <th class="cell4">Описание</th>
                                   <th class="cell5">Кол-во</th>
                                   <th class="cell6">Ожидаемый срок, дн.</th>
                                   <th class="cell7"><p>Цена</p></th>
                                   <th class="cell8"></th>
                            </tr>';

                $last=count($search_result)-1;
				
				
                  if(count($search_result)>0)
                        $html.= '<tr>
                            	<td class="tabletitle" colspan="8"><p>Запрошенный артикул</p></td>
                            </tr>';
                  else
                        $html.= '<tr>
                            	<td class="tabletitle" colspan="8"><p>Запрошенный артикул отсутствует</p></td>
                            </tr>';

                for($i=0;$i<count($search_result);$i++):



                     $html.='<tr class="tv">';


                     
                    $info=$search_result[$i]['info'].' '.$search_result[$i]['manufacturer'].' '.$search_result[$i]['number'];
                    $price=$search_result[$i]['price_client'];




$uniq_id=$search_result[$i]['uniq_id'];
					 

$id=$search_result[$i]['id'];


                    	$html.= "
							
                            <td class='cell1'><p>".$search_result[$i]['manufacturer']."</p></td>
                                   <td class='cell2'><p>".$search_result[$i]['number']."</p></td>
                                   <td class='cell4'><p>".$search_result[$i]['info']."</p></td>
                                   <td class='cell5'><p>".$search_result[$i]['quantity']."</p></td>";
								   
                                   
								   if($site_distributors[$search_result[$i]['distributor_id']]==SITE_DOMAIN){
								   		
										$html.="<td class='cell6' nowrap><p style='color:red;'><strong>".$client_name_distributors[$search_result[$i]['distributor_id']]."</strong></p></td>";
								   }
								   else{
								         $html.="<td class='cell6'><p><strong>".$search_result[$i]['period']."</strong></p></td>";
								   }
								   
                                   $html.="<td class='cell7'><p><strong>".CPrice::getMoneyFormat($search_result[$i]['price_client'])."р.</strong></p></td>";
								   
								 
								 $href=SITE_PATH.$this->module->id.'/basket/add?id='.$id;
								   	
									 $html.="
                                   <td class='cell8' id='basket_$id'><a class='inbasket' href='$href'  onclick=\"add_to_basket(this.href,'$id');return false;\"></a></td>";
								  
               $html.='</tr>';

             endfor;



             if(isset($cross_result[0]['number'])):


              $html.= '<tr>
                            	<td class="tabletitle" colspan="8"><p>Аналоги (заменители для запрошенного артикула)</p></td>
                            </tr>';
							
				$html.= '<tr>
                            	<td class="tabletitle" colspan="8"><p><font color="red">Внимание!</font> Напоминаем, что как покупатель, Вы несете ответственность за применимость заказываемой детали к Вашему автомобилю</p></td>
                            </tr>';

                for($i=0;$i<count($cross_result);$i++):


                     $html.='<tr class="tv">';

                     $id=$cross_result[$i]['id'];

					$href=SITE_PATH.$this->module->id.'/basket/add?id='.$id;
                    $info=$cross_result[$i]['info'].' '.$cross_result[$i]['manufacturer'].' '.$cross_result[$i]['number'];
                    $price=$cross_result[$i]['price_client'];
				 
					$uniq_id=$cross_result[$i]['uniq_id'];
						
                    $html.= "


                            <td class='cell1'><p>".$cross_result[$i]['manufacturer']."</p></td>
                                   <td class='cell2'><p>".$cross_result[$i]['number']."</p></td>
                                   <td class='cell4'><p>".$cross_result[$i]['info']."</p></td>
                                   <td class='cell5'><p>".$cross_result[$i]['quantity']."</p></td>
                                  ";
						
						 if($site_distributors[$cross_result[$i]['distributor_id']]==SITE_DOMAIN){
								   		
										$html.="<td class='cell6' nowrap><p style='color:red;'><strong>".$client_name_distributors[$cross_result[$i]['distributor_id']]."</strong></p></td>";
								   }
								   else{
								         $html.="<td class='cell6'><p><strong>".$cross_result[$i]['period']."</strong></p></td>";
								   }
                		   
                        $html.="<td class='cell7'><p><strong>".CPrice::getMoneyFormat($cross_result[$i]['price_client'])."р.</strong></p></td>";
								   
								   
					
				
			   
								   
								   
                                  
								  
								   	 $html.="
                                   <td class='cell8' id='basket_$id'><a class='inbasket' href='$href'  onclick=\"add_to_basket(this.href,'$id');return false;\"></a></td>";
								   
								   


               $html.='</tr>';

             endfor;


             endif;


             $html.= '</table>';
			 
			 echo $html;


?>