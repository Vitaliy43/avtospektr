
<tr id="author">	

<td><div id="head-left-menu"><h1>Вход на сайт</h1></div>
			</td>
		</tr>
		<tr>
		<td class="authorization">
			<form action="<?php echo SITE_PATH.'user/login';?>" method="POST">

<div>Логин:</div>
			<div>
				<input type="text" name="login" class="auth_input" id="login"/>
			</div>
			<div>Пароль:</div>
			<div>
				<input type="password" name="password" class="auth_input" id="password"/>
			</div>
			<div>
				<table cellpadding="0" cellpadding="0" id="block_subsmit" width="100%">
					<tr>
					
						<td valign="top" align="left" width="130">
							
							<div class="reg_forget">
								<div><a href="/user/registration" onclick="ajax_link(this.href);return false;">Регистрация</a></div>
								<div><a href="/user/remind" onclick="ajax_link(this.href);return false;">Забыли пароль?</a></div>
							</div>
							
						</td>
						<td>
							<!--input type="image" name="enter" src="/images/avtospektr/enter.gif" style="border: 0px;"/-->
							<?php
							
							if(Browser::get_browser()=='Firefox' or Browser::get_browser()=='Chrome')
								$style='style="margin-left:0px;border: 0px;"';
							else
								$style='style="margin-left:2px;border: 0px;"';
							
							?>
							
							<!--input type="image" name="enter" src="/images/<?php echo Yii::app()->theme->name;?>/enter2.png" <?php echo $style;?> onclick="login();"/-->						
							<button type="submit">Войти</button>
							</td>
					
						
						
						
					</tr>
					
					
			
				</table>
		
			</div>
			</form>
			</td>
					</tr>
