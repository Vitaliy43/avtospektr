<style type="text/css">
code { white-space: pre; }
.nowr { white-space: nowrap; }
td { padding: 0; border: 0;}
table { border: none; }
img { border: none; }
form { margin: 0px; padding: 0px; }
sup { font-size: 66%; line-height: .5; }
li { list-style: square outside; padding: 0px; margin: 0px; }
ul { list-style: square outside; padding: 0em 0em 0em 0em; margin: 0em 0em 0em 1.5em; }
.fakelink { cursor: pointer; }
.centered { margin-left: auto; margin-right: auto; }
.zerosize { font-size: 1px; }
.underlined { text-decoration: underline; }
.bolded { font-weight: bold; }
.vbottom { vertical-align: bottom; }
.vsub { vertical-align: sub; }
.h_left { text-align: left; }
.h_right { text-align: right; }
.h_center { text-align: center; }
.v_top { vertical-align: top; }
.v_bottom { vertical-align: bottom; }
.v_middle { vertical-align: middle; }
.w100, .full_w, .full { width: 100%; }
.h100, .full_h, .full { height: 100%; }
.cramp, .cramp_w { width: 1px; }
.cramp, .cramp_h { height: 1px; }
.ucfirst:first-letter { text-transform: uppercase; }
.clean { clear: both; }
</style>
<style type="text/css">
body { background-color: white; margin: 0px; text-align: center; }
.ramka { border-top: black 1px dashed; border-bottom: black 1px dashed; border-left: black 1px dashed; border-right: black 1px dashed; margin: 0 auto 12mm auto; height: 145mm; }
.kassir { font-weight: bold; font-size: 10pt; font-family: "Times New Roman", serif; padding: 7mm 0 7mm 0; text-align: center; }
.cell { font-family: Arial, sans-serif; border-left: black 1px solid; border-bottom: black 1px solid; border-top: black 1px solid; font-weight: bold; font-size: 8pt; line-height: 1.1; height: 4mm; vertical-align: bottom; text-align: center; }
.cells { border-right: black 1px solid; width: 100%; }
.subscript { font-size: 6pt; font-family: "Times New Roman", serif; line-height: 1; vertical-align: top; text-align: center; }
.string, .dstring { font-weight: bold; font-size: 8pt; font-family: Arial, sans-serif; border-bottom: black 1px solid; text-align: center; vertical-align: bottom; }
.dstring { font-size: 9pt; letter-spacing: 1pt; }
.floor { vertical-align: bottom; padding-top: 0.5mm; }
.stext { font-size: 8.5pt; font-family: "Times New Roman", serif; vertical-align: bottom; }
.stext7 { font-size: 7.5pt; font-family: "Times New Roman", serif; vertical-align: bottom; }
</style>
<style type="text/css">
input { font-family: Arial, sans-serif; font-size: 9pt; color: black; background-color: white; border: 1px solid #333; margin: 8pt 8pt 8pt 0; }
a { text-decoration: none; color: #555; }
a:hover { text-decoration: underline; }
#toolbox { font-family: Arial, sans-serif; font-size: 9pt; border-bottom: dashed 1pt black; margin-bottom: 0; padding: 2mm 0 0 0; text-align: justify; }
p { margin: 2pt 0 2pt 0; }
</style>
<style type="text/css" media="print">
#toolbox { display: none; }
</style>
<style type="text/css">
#toolbox { width: 180mm; margin-left: auto; margin-right: auto; }
.topmargin { height: 12mm; }
</style>

<div class="topmargin"></div>
<table class="ramka" cellspacing="0" style="width: 180mm;">
  <tr>
    <td style="width: 50mm; height: 65mm; border-bottom: black 1.5px solid;">
      <table style="width: 50mm; height: 100%;" cellspacing="0">
	<tr><td class="kassir" style="vertical-align: top; letter-spacing: 0.2em;">Извещение</td></tr>
        <tr><td class="kassir" style="vertical-align: bottom;">Кассир</td></tr>
      </table>  
    </td>
    <td style="width: 130mm; height: 65mm; padding: 0mm 4mm 0mm 3mm; border-left: black 1.5px solid; border-bottom: black 1.5px solid;"> 

<table cellspacing="0" style="width: 123mm; height: 100%;"><tr><td><table width="100%" cellspacing="0"><tr><td class="stext" style="height: 5mm;">
 

 </td><td class="stext7" style="text-align: right; vertical-align: middle;"><i>Форма &#8470; ПД-4</i></td></tr></table></td></tr><tr><td style="vertical-align: bottom;"><table style="width: 100%;" cellspacing="0"><tr><td class="string"><?php echo $this->recipient_full;?></td></td></tr></table></td></tr>
 <tr><td class="subscript nowr">(наименование получателя платежа)</td></tr>
 <tr><td>
 <table cellspacing="0" width="100%"><tr><td width="30%" class="floor">

 <?php echo CString::get_cells($this->inn,10);?>
 
 </td><td width="10%" class="stext7">&nbsp;</td><td width="60%" class="floor">

  <?php echo CString::get_cells($this->current_account,5);?>

 </td></tr><tr><td class="subscript nowr">(ИНН получателя платежа)</td><td class="subscript">&nbsp;</td><td class="subscript nowr">(номер счета получателя платежа)</td></tr></table></td></tr><tr><td>
 <table cellspacing="0" width="100%"><tr><td width="2%" class="stext">в</td><td width="64%" class="string"><?php echo $this->bank_recipient;?></td>
 <td width="7%" class="stext" align="right">БИК&nbsp;</td><td width="27%" class="floor">

  <?php echo CString::get_cells($this->bik,11);?>

 
 </td></tr><tr><td class="subscript">&nbsp;</td><td class="subscript nowr">(наименование банка получателя платежа)</td></tr></table></td></tr><tr><td><table cellspacing="0" width="100%"><tr><td class="stext7 nowr" width="40%">Номер кор./сч. банка получателя платежа</td><td width="60%" class="floor">

    <?php echo CString::get_cells($this->correspondence_account,5);?>

 </td></tr></table>

 
 </td></tr><tr><td><table cellspacing="0" width="100%"><tr><td class="string" width="55%">&nbsp;</td><td class="stext7" width="5%">&nbsp;</td><td class="string" width="40%">&nbsp;</td></tr><tr>
 <td class="subscript nowr">(наименование платежа)</td><td class="subscript">&nbsp;</td><td class="subscript nowr">(номер лицевого счета (код) плательщика)</td>
 </tr></table></td></tr>
 <tr><td><table cellspacing="0" width="100%"><tr><td class="stext" width="1%">Ф.И.О&nbsp;плательщика&nbsp;</td><td class="string"><?php if(isset($payer)) echo $payer;?></td></tr></table></td></tr>
 <tr><td><table cellspacing="0" width="100%"><tr><td class="stext" width="1%">Адрес&nbsp;плательщика&nbsp;</td><td class="string"><?php if(isset($address)) echo $address;?></td></tr></table></td></tr>
 <tr><td><table cellspacing="0" width="100%"><tr><td class="stext" width="1%">Сумма&nbsp;платежа&nbsp;</td><td class="string" width="8%">&nbsp;<?php if(isset($rub)) echo $rub;?></td><td class="stext" width="1%">&nbsp;руб.&nbsp;</td><td class="string" width="8%"><?php if(isset($kop)) echo $kop;?></td><td class="stext" width="1%">&nbsp;коп.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Сумма&nbsp;платы&nbsp;за&nbsp;услуги&nbsp;</td><td class="string" width="8%">&nbsp;</td><td class="stext" width="1%">&nbsp;руб.&nbsp;</td><td class="string" width="8%">&nbsp;</td><td class="stext" width="1%">&nbsp;коп.</td></tr></table></td></tr>
 <tr><td><table cellspacing="0" width="100%"><tr><td class="stext" width="5%">Итого&nbsp;</td><td class="string" width="8%">&nbsp;<?php if(isset($rub)) echo $rub;?></td><td class="stext" width="5%">&nbsp;руб.&nbsp;</td><td class="string" width="8%"><?php if (isset($kop)) echo $kop;?></td><td class="stext" width="5%">&nbsp;коп.&nbsp;</td><td class="stext" width="20%" align="right">&laquo;&nbsp;</td><td class="string" width="8%">&nbsp;</td><td class="stext" width="1%">&nbsp;&raquo;&nbsp;</td><td class="string" width="20%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td class="stext" width="3%">&nbsp;20&nbsp;</td><td class="string" width="5%">&nbsp;</td><td class="stext" width="1%">&nbsp;г.</td></tr></table></td></tr><tr><td class="stext7" style="text-align: justify">С условиями приема указанной в платежном документе суммы, в т.ч. с суммой взимаемой платы за&nbsp;услуги банка,&nbsp;ознакомлен&nbsp;и&nbsp;согласен.</td></tr><tr><td style="padding-bottom: 0.5mm;"><table cellspacing="0" width="100%"><tr><td class="stext7" width="50%">&nbsp;</td><td class="stext7" width="1%"><b>Подпись&nbsp;плательщика&nbsp;</b></td><td class="string" width="40%">&nbsp;</td></tr></table></td></tr></table>
    </td>
  </tr>
  <tr>
    <td style="width: 50mm; height: 80mm; vertical-align: bottom;" class="kassir">Квитанция<br><br>Кассир</td>
    <td style="width: 130mm; height: 80mm; padding: 0mm 4mm 0mm 3mm; border-left: black 1.5px solid;"> 

<table cellspacing="0" style="width: 123mm; height: 100%;"><tr><td><table width="100%" cellspacing="0"><tr><td class="stext" style="height: 5mm;">
 

 </td><td class="stext7" style="text-align: right; vertical-align: middle;"><i>Форма &#8470; ПД-4</i></td></tr></table></td></tr><tr><td style="vertical-align: bottom;"><table style="width: 100%;" cellspacing="0"><tr><td class="string"><?php echo $this->recipient_full;?></td></td></tr></table></td></tr>
 <tr><td class="subscript nowr">(наименование получателя платежа)</td></tr>
 <tr><td>
 <table cellspacing="0" width="100%"><tr><td width="30%" class="floor">

 <?php echo CString::get_cells($this->inn,10);?>
 
 </td><td width="10%" class="stext7">&nbsp;</td><td width="60%" class="floor">

  <?php echo CString::get_cells($this->current_account,5);?>

 </td></tr><tr><td class="subscript nowr">(ИНН получателя платежа)</td><td class="subscript">&nbsp;</td><td class="subscript nowr">(номер счета получателя платежа)</td></tr></table></td></tr><tr><td>
 <table cellspacing="0" width="100%"><tr><td width="2%" class="stext">в</td><td width="64%" class="string"><?php echo $this->bank_recipient;?></td>
 <td width="7%" class="stext" align="right">БИК&nbsp;</td><td width="27%" class="floor">

  <?php echo CString::get_cells($this->bik,11);?>

 
 </td></tr><tr><td class="subscript">&nbsp;</td><td class="subscript nowr">(наименование банка получателя платежа)</td></tr></table></td></tr><tr><td><table cellspacing="0" width="100%"><tr><td class="stext7 nowr" width="40%">Номер кор./сч. банка получателя платежа</td><td width="60%" class="floor">

    <?php echo CString::get_cells($this->correspondence_account,5);?>

 </td></tr></table>

 
  </td></tr><tr><td><table cellspacing="0" width="100%"><tr><td class="string" width="55%">&nbsp;</td><td class="stext7" width="5%">&nbsp;</td><td class="string" width="40%">&nbsp;</td></tr><tr>
 <td class="subscript nowr">(наименование платежа)</td><td class="subscript">&nbsp;</td><td class="subscript nowr">(номер лицевого счета (код) плательщика)</td>
 </tr></table></td></tr>
 <tr><td><table cellspacing="0" width="100%"><tr><td class="stext" width="1%">Ф.И.О&nbsp;плательщика&nbsp;</td><td class="string"><?php if(isset($payer)) echo $payer;?></td></tr></table></td></tr>
 <tr><td><table cellspacing="0" width="100%"><tr><td class="stext" width="1%">Адрес&nbsp;плательщика&nbsp;</td><td class="string"><?php if(isset($address)) echo $address;?></td></tr></table></td></tr>
 <tr><td><table cellspacing="0" width="100%"><tr><td class="stext" width="1%">Сумма&nbsp;платежа&nbsp;</td><td class="string" width="8%">&nbsp;<?php if(isset($rub)) echo $rub;?></td><td class="stext" width="1%">&nbsp;руб.&nbsp;</td><td class="string" width="8%"><?php if(isset($kop)) echo $kop;?></td><td class="stext" width="1%">&nbsp;коп.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Сумма&nbsp;платы&nbsp;за&nbsp;услуги&nbsp;</td><td class="string" width="8%">&nbsp;</td><td class="stext" width="1%">&nbsp;руб.&nbsp;</td><td class="string" width="8%">&nbsp;</td><td class="stext" width="1%">&nbsp;коп.</td></tr></table></td></tr>
 <tr><td><table cellspacing="0" width="100%"><tr><td class="stext" width="5%">Итого&nbsp;</td><td class="string" width="8%">&nbsp;<?php if(isset($rub)) echo $rub;?></td><td class="stext" width="5%">&nbsp;руб.&nbsp;</td><td class="string" width="8%"><?php if (isset($kop)) echo $kop;?></td><td class="stext" width="5%">&nbsp;коп.&nbsp;</td><td class="stext" width="20%" align="right">&laquo;&nbsp;</td><td class="string" width="8%">&nbsp;</td><td class="stext" width="1%">&nbsp;&raquo;&nbsp;</td><td class="string" width="20%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td class="stext" width="3%">&nbsp;20&nbsp;</td><td class="string" width="5%">&nbsp;</td><td class="stext" width="1%">&nbsp;г.</td></tr></table></td></tr><tr><td class="stext7" style="text-align: justify">С условиями приема указанной в платежном документе суммы, в т.ч. с суммой взимаемой платы за&nbsp;услуги банка,&nbsp;ознакомлен&nbsp;и&nbsp;согласен.</td></tr><tr><td style="padding-bottom: 0.5mm;"><table cellspacing="0" width="100%"><tr><td class="stext7" width="50%">&nbsp;</td><td class="stext7" width="1%"><b>Подпись&nbsp;плательщика&nbsp;</b></td><td class="string" width="40%">&nbsp;</td></tr></table></td></tr></table>
    </td>
  </tr>
</table>
