<?php



class Pdf extends TCPDF
{

	private $export_data;
	private $properties;
	private $headers_properties;
	private $size_cols;

	function __construct( $data, $orientation, $unit, $format, $properties, $headers_properties, $size_cols) {
    parent::__construct( $orientation, $unit, $format, true, 'UTF-8', false );

    $this->export_data = $data;
	$this->properties = $properties;
	$this->headers_properties = $headers_properties;
	$this->size_cols = $size_cols;

    # Задаем отступы страницы:
    # 72 пункта слева и справа, 36 пунктов сверху иснизу.
    $this->SetMargins( 36, 36, 36, true );
    $this->SetAutoPageBreak( true, 36 );
    
    # Указываем метаданные документа
    $this->SetCreator( PDF_CREATOR );
    $this->SetAuthor( 'Chris Herborth (chrish@pobox.com)' );
    $this->SetTitle( $this->export_data['section'].' для' . $this->export_data['user'] );
    $this->SetSubject( "A simple invoice example for 'Creating PDFs on 
the fly with TCPDF' on IBM's developerWorks" );
    $this->SetKeywords( 'PHP, sample, invoice, PDF, TCPDF' );
	
	$this->setPrintFooter(false);
	$this->setPrintHeader(false);

    //задаем коэффициент масштабирования изображения
    $this->setImageScale(PDF_IMAGE_SCALE_RATIO); 
	
	$this->setPageFormat('A3');
    
    //определяем некоторые строки, зависящие от языка
    global $l;
	$l = 
    $this->setLanguageArray($l);
	
}

public function Header() {
    global $webcolor;

   # Изображение намного больше, чем текст с названием компании.
    $bigFont = 14;
    $imageScale = ( 128.0 / 26.0 ) * $bigFont;
    $smallFont = ( 16.0 / 26.0 ) * $bigFont;

    $this->ImagePngAlpha(SITE_PATH.'/images/'.Yii::app()->theme->name.'/header_for_pdf.png', 72, 36, 574, 
112, 'PNG', null, 'T', false, 72, 'L' );


    $this->SetY( 72, true );

}
      
public function Footer() {
    global $webcolor;

    $this->SetLineStyle( array( 'width' => 2, 'color' => 
array( $webcolor['black'] ) ) );
    $this->Line( 72, $this->getPageHeight() - 1.5 * 72 - 2, 
$this->getPageWidth() - 72, $this->getPageHeight() - 1.5 * 72 - 2 );
    $this->SetFont( 'times', '', 8 );
    $this->SetY( -1.5 * 72, true );
    $this->Cell( 72, 0, 'Invoice prepared for ' . 
$this->export_data['user'] . ' on ' . $this->export_data['date'] );
}

public function ExportContent() {
    $this->AddPage();
    $this->SetFont( 'freesans', '', 16 );
  if(count($this->size_cols)==6)
  		$this->ImagePngAlpha(SITE_PATH.'/images/'.Yii::app()->theme->name.'/header_for_pdf.png', 72, 36, 574, 
112, 'PNG', null, 'T', false, 72, 'L' );	
  else
  	$this->ImagePngAlpha(SITE_PATH.'/images/'.Yii::app()->theme->name.'/header_for_pdf.png', 72, 36, 674, 
112, 'PNG', null, 'T', false, 72, 'L' );	
	$this->Ln();
	$this->SetY( 160, true );
    $this->SetX( 72, true );
 
 
    # Параметры таблицы
    #
    # Размер, ширина (описание) столбца, отступ таблицы, высота строки.
    $col = 72;
    $wideCol = 2 * $col;
    $indent = ( $this->getPageWidth() - 2 * 72 - $wideCol - 3 * $col ) / 2;
    $line = 18;

    # Заголовок таблицы
    	$this->SetFont( 'freesans', 'b',9);
	
//    $this->Cell( $indent );
	/*
    $this->Cell( $wideCol, $line, 'Item', 1, 0, 'L' );
    $this->Cell( $col, $line, 'Quantity', 1, 0, 'R' );
    $this->Cell( $col, $line, 'Price', 1, 0, 'R' );
    $this->Cell( $col, $line, 'Cost', 1, 0, 'R' );
	*/
//	$this->Cell( $wideCol, $line, ucfirst($this->headers_properties[0]), 1, 0, 'L' );
	for($i=0;$i<count($this->properties);$i++){
		
		$this->Cell( $this->size_cols[$i], $line, ucfirst($this->headers_properties[$i]), 1, 0, 'C' );
	}

    $this->Ln();
    $this->SetX( 72, true );

    # Строки с содержимым таблицы
	
    	$this->SetFont( 'freesans', '8' );
	
	
	
    foreach( $this->export_data['items'] as $item ) {

		for($i=0;$i<count($this->properties);$i++){
			$property = $this->properties[$i];
			if($property == 'type_operation'){
				if($item->$property == '1')
					$value = 'Зачисление средств';
				else
					$value = 'Снятие средств';
			}
			elseif($property == 'type_payment'){
				$value = $item->$property->show_type;
			}
			elseif($property == 'distributor'){
				$value = $item->$property->name;
			}
			else{
				$value = $item->$property;

			}
			$this->Cell( $this->size_cols[$i], $line, $value, 1, 0, 'C' );

		}
		 $this->Ln();
   		 $this->SetX( 72, true );
		
    }


}


public function Output($name='doc.pdf', $dest='I') {
			//Output PDF to some destination
			//Finish document if necessary
			if ($this->state < 3) {
				$this->Close();
			}
			//Normalize parameters
			if (is_bool($dest)) {
				$dest = $dest ? 'D' : 'F';
			}
			$dest = strtoupper($dest);
			if ($dest != 'F') {
				$name = preg_replace('/[\s]+/', '_', $name);
				//$name = preg_replace('/[^a-zA-Z0-9_\.-]/', '', $name);
			}
			if ($this->sign) {
				// *** apply digital signature to the document ***
				// get the document content
				$pdfdoc = $this->getBuffer();
				// remove last newline
				$pdfdoc = substr($pdfdoc, 0, -1);
				// Remove the original buffer
				if (isset($this->diskcache) AND $this->diskcache) {
					// remove buffer file from cache
					unlink($this->buffer);
				}
				unset($this->buffer);
				// remove filler space
				$byterange_string_len = strlen($this->byterange_string);
				// define the ByteRange
				$byte_range = array();
				$byte_range[0] = 0;
				$byte_range[1] = strpos($pdfdoc, $this->byterange_string) + $byterange_string_len + 10;
				$byte_range[2] = $byte_range[1] + $this->signature_max_lenght + 2;
				$byte_range[3] = strlen($pdfdoc) - $byte_range[2];
				$pdfdoc = substr($pdfdoc, 0, $byte_range[1]).substr($pdfdoc, $byte_range[2]);
				// replace the ByteRange
				$byterange = sprintf('/ByteRange[0 %u %u %u]', $byte_range[1], $byte_range[2], $byte_range[3]);
				$byterange .= str_repeat(' ', ($byterange_string_len - strlen($byterange)));
				$pdfdoc = str_replace($this->byterange_string, $byterange, $pdfdoc);
				// write the document to a temporary folder
				$tempdoc = tempnam(K_PATH_CACHE, 'tmppdf_');
				$f = fopen($tempdoc, 'wb');
				if (!$f) {
					$this->Error('Unable to create temporary file: '.$tempdoc);
				}
				$pdfdoc_lenght = strlen($pdfdoc);
				fwrite($f, $pdfdoc, $pdfdoc_lenght);
				fclose($f);
				// get digital signature via openssl library
				$tempsign = tempnam(K_PATH_CACHE, 'tmpsig_');
				if (empty($this->signature_data['extracerts'])) {
					openssl_pkcs7_sign($tempdoc, $tempsign, $this->signature_data['signcert'], array($this->signature_data['privkey'], $this->signature_data['password']), array(), PKCS7_BINARY | PKCS7_DETACHED);
				} else {
					openssl_pkcs7_sign($tempdoc, $tempsign, $this->signature_data['signcert'], array($this->signature_data['privkey'], $this->signature_data['password']), array(), PKCS7_BINARY | PKCS7_DETACHED, $this->signature_data['extracerts']);
				}	
				unlink($tempdoc);
				// read signature
				$signature = file_get_contents($tempsign, false, null, $pdfdoc_lenght);
				unlink($tempsign);
				// extract signature
				$signature = substr($signature, (strpos($signature, "%%EOF\n\n------") + 13));
				$tmparr = explode("\n\n", $signature);
				$signature = $tmparr[1];
				unset($tmparr);
				// decode signature
				$signature = base64_decode(trim($signature));
				// convert signature to hex
				$signature = current(unpack('H*', $signature));
				$signature = str_pad($signature, $this->signature_max_lenght, '0');
				// Add signature to the document
				$pdfdoc = substr($pdfdoc, 0, $byte_range[1]).'<'.$signature.'>'.substr($pdfdoc, ($byte_range[1]));
				$this->diskcache = false;
				$this->buffer = &$pdfdoc;
				$this->bufferlen = strlen($pdfdoc);
			}
			switch($dest) {
				case 'I': {
					// Send PDF to the standard output
					if (ob_get_contents()) {
						$this->Error('Some data has already been output, can\'t send PDF file');
					}
					if (php_sapi_name() != 'cli') {
						//We send to a browser
						header('Content-Type: application/pdf');
						if (headers_sent()) {
							$this->Error('Some data has already been output to browser, can\'t send PDF file');
						}
						header('Cache-Control: public, must-revalidate, max-age=0'); // HTTP/1.1
						header('Pragma: public');
						header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Date in the past
						header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');	
						header('Content-Length: '.$this->bufferlen);
						header('Content-Disposition: inline; filename="'.basename($name).'";');
					}
					echo $this->getBuffer();
					break;
				}
				case 'D': {
					// Download PDF as file
// dirty hack from Tataurov Roman 11.10.2009
//					if (ob_get_contents()) {
//						$this->Error('Some data has already been output, can\'t send PDF file');
//					}
					//echo 'name '.$name.'<br>';
					//die();
					header('Content-Description: File Transfer');
					if (headers_sent()) {
						$this->Error('Some data has already been output to browser, can\'t send PDF file');
					}
					header('Cache-Control: public, must-revalidate, max-age=0'); // HTTP/1.1
					header('Pragma: public');
					header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Date in the past
					header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
					// force download dialog
					header('Content-Type: application/force-download');
					header('Content-Type: application/octet-stream', false);
					header('Content-Type: application/download', false);
					header('Content-Type: application/pdf', false);
					// use the Content-Disposition header to supply a recommended filename
					header('Content-Disposition: attachment; filename="'.basename($name).'";');
					header('Content-Transfer-Encoding: binary');
					header('Content-Length: '.$this->bufferlen);
					echo $this->getBuffer();
					break;
				}
				case 'F': {
					// Save PDF to a local file
					if ($this->diskcache) {
						copy($this->buffer, $name);
					} else {
						$f = fopen($name, 'wb');
						if (!$f) {
							$this->Error('Unable to create output file: '.$name);
						}
						fwrite($f, $this->getBuffer(), $this->bufferlen);
						fclose($f);
					}
					break;
				}
				case 'S': {
					// Returns PDF as a string
					return $this->getBuffer();
				}
				default: {
					$this->Error('Incorrect output destination: '.$dest);
				}
			}
			return '';
		}

}

?>