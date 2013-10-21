<?php 
App::import('Vendor','PHPExcel',array('file' => 'excel/PHPExcel.php'));
App::import('Vendor','PHPExcelWriter',array('file' => 'excel/PHPExcel/Writer/Excel2007.php'));

class ExcelHelper extends AppHelper {
    
    var $xls;
    var $sheet;
    var $data;
    var $blacklist        = array();
    var $column           = 0;
    var $row              = 1;
    var $auto_size        = false;
    var $wrap             = true;
    var $vertical         = 'center';
    var $coordinate       = 'A1';
    var $columns          = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",
                                  "AA", "AB", "AC", "AD", "AE", "AF", "AG", "AH", "AI", "AJ", "AK", "AL", "AM", "AN", "AO", "AP", "AQ", "AR", "AS", "AT", "AU", "AV", "AW", "AX", "AY", "AZ",
                                  "BA", "BB", "BC", "BD", "BE", "BF", "BG", "BH", "BI", "BJ", "BK", "BL", "BM", "BN", "BO", "BP", "BQ", "BR", "BS", "BT", "BU", "BV", "BW", "BX", "BY", "BZ");
    var $d_style          = null;
    var $d_style_true     = true;
    var $d_border         = 'none';
    var $d_border_side    = 'all';
    var $d_bgcolor        = null;
    var $d_bgcolor_type   = 'solid';
    var $d_align          = 'general';
    var $d_color          = '000000';           
    
    /*
     * Construtora
     */
    function excelHelper() {
        $this->xls = new PHPExcel();
        $this->sheet = $this->xls->getActiveSheet();
        $this->sheet->getDefaultStyle()->getFont()->setName('Verdana')->setSize(9);;
        $this->xls->getProperties()
                ->setCreator("Frames Software")
                ->setLastModifiedBy("Frames Software")
                ->setTitle("Relatórios Frames Software")
                ->setSubject("Relatórios Frames Software")
                ->setDescription("Relatórios Frames Software")
                ->setKeywords("Relatório, Frames")
                ->setCategory("Relatórios");
    }
    
    /*
     * Método que gera as linhas e colunos automaticamente
     * $data = $list = array();  
     *         $list[0]['Nome'] = 'Jorge';
     *         $list[1]['Nome'] = 'Juliana';
     *         $list[0]['Idade'] = '31';
     *         $list[1]['Idade'] = '29';
     */
    function generate(&$data, $title = 'Relatório') {
         $this->data =& $data;
         $this->_title($title);
         $this->_headers();
         $this->_rows();
         $this->output($title);
         return true;
    }
    
    /*
     * Insere um valor na celula
     */
    function value($value=null) {
        $this->sheet->getColumnDimension($this->getY($this->coordinate))->setAutoSize($this->auto_size);
        $this->sheet->getStyle($this->coordinate)->getAlignment()->setVertical($this->vertical);
        $this->sheet->getStyle($this->coordinate)->getAlignment()->setWrapText($this->wrap);
        $this->sheet->setCellValue($this->coordinate, $value);
        $this->border($this->d_border, $this->d_border_side);
        $this->nextX($this->coordinate);
    }
    
    /*
     * Insere um estilo na celula
     */
    function style($style=null, $true=true) {
        if(strpos($style, 'B')!==false) {
            $this->sheet->getStyle($this->coordinate)->getFont()->setBold($true);
            $this->sheet->getDefaultStyle()->getFont()->setBold($true);
        } if(strpos($style, 'I')!==false) {
            $this->sheet->getStyle($this->coordinate)->getFont()->setItalic($true);
            $this->sheet->getDefaultStyle()->getFont()->setItalic($true);
        }
        $this->d_style = $style;
        $this->d_style_true = $true;
    }
    
    /*
     * Alinhamento horizontal
     * $align = general, left, right, center, justify
     */
    function align($align='general') {
        $this->sheet->getStyle($this->coordinate)->getAlignment()->setHorizontal($align);
        $this->sheet->getDefaultStyle()->getAlignment()->setHorizontal($align);
        $this->d_align = $align;
    }
    
    /*
     * Insere uma cor na fonte da celula
     */
    function color($color='000000') {
        $this->sheet->getStyle($this->coordinate)->getFont()->getColor()->setARGB(str_replace('#','',$color));
        $this->sheet->getDefaultStyle()->getFont()->getColor()->setARGB(str_replace('#','',$color));
        $this->d_color = $color;
    }
    
    /*
     * Insere uma cor no fundo da celula
     * $type   = 'none, solid'
     */
    function bgcolor($color='FF0000', $type='solid') {
        $this->sheet->getStyle($this->coordinate)->getFill()->setFillType($type);
        $this->sheet->getStyle($this->coordinate)->getFill()->getStartColor()->setRGB(str_replace('#','',$color));
        $this->sheet->getDefaultStyle()->getFill()->setFillType($type);
        $this->sheet->getDefaultStyle()->getFill()->getStartColor()->setRGB(str_replace('#','',$color));
        $this->d_bgcolor = $color;
        $this->d_bgcolor_type = $type;
    }
    
    /*
     * Insere uma borda
     * $border = none, thin, thick, dashed, dotted, double, hair, medium, dashDot, dashDotDot
     *           mediumDashDot, mediumDashDotDot, mediumDashed, slantDashDot
     * $side   = 'all, LTRB, L, T, R, B'
     */
    function border($border='thin',$side='all') {
        if($side=='all') {
            $this->sheet->getStyle($this->coordinate)->getBorders()->getAllBorders()->setBorderStyle($border);
        } if(strpos($side, 'L')!==false) {
            $this->sheet->getStyle($this->coordinate)->getBorders()->getLeft()->setBorderStyle($border);
        } if(strpos($side, 'T')!==false) {
            $this->sheet->getStyle($this->coordinate)->getBorders()->getTop()->setBorderStyle($border);
        } if(strpos($side, 'R')!==false) {
            $this->sheet->getStyle($this->coordinate)->getBorders()->getRight()->setBorderStyle($border);
        } if(strpos($side, 'B')!==false) {
            $this->sheet->getStyle($this->coordinate)->getBorders()->getBottom()->setBorderStyle($border);
        }
        $this->d_border = $border;
        $this->d_border_side = $side;
    }
    
    /*
     * Mescla celulas
     */
    function merge($coordinate) {
        $this->sheet->mergeCells($coordinate);
    }
    
    /*
     * Seta as coordenadas
     */
    function XY($coordinate=null, $column=null, $row=null, $return=false) {
        if(!empty($column) && !empty($row) && empty($coordinate)) {
            $column = $this->alpha_column($column);
            $coordinate = $column.$row;
        }  
        if($return)
            return $coordinate;
        $this->coordinate = $coordinate;
    }
    
    /*
     * Seta a proxima coluna
     */
    function nextX($coordinate=null, $return=false) {
        if(empty($coordinate)) $coordinate = $this->coordinate;
        $column    = $this->getY($coordinate);
        $row       = $this->getX($coordinate);
        $invertido = array_flip($this->columns);
        if($return)
            return $this->columns[(++$invertido[$column])].$row;
        $this->coordinate = $this->columns[(++$invertido[$column])].$row;
    }
    
    /*
     * Seta a proxima linha
     */
    function nextY($coordinate=null, $return=false) {
        if(empty($coordinate)) $coordinate = $this->coordinate;
        $column    = $this->getY($coordinate);
        $row       = $this->getX($coordinate);
        if($return)
            return $column.(++$row);
        $this->coordinate = $column.(++$row);
    }
    
    /*
     * Retorna as Coordenadas
     */
    function getXY() {
        return $this->getY($this->coordinate).$this->getX($this->coordinate);
    }
    
    /*
     * Retorna a Coluna
     */
    function getX($coordinate=null) {
        if(empty($coordinate)) $coordinate = $this->coordinate;
        return preg_replace("/[^0-9]/", "", $coordinate);
    }

    /*
     * Retorna a Linha
     */
    function getY($coordinate=null) {
        if(empty($coordinate)) $coordinate = $this->coordinate;
        return preg_replace("/[^A-Z]/", "", $coordinate);
    }
    
    /*
     * Retorna a Coluna pelo Numero
     */
    function alpha_column($column) {
        if(isset($this->columns[$column]))
            return $this->columns[$column];
        return $column;
    } 
    
    /*
     * PRIVADOS
     */

    private function _title($title) {
        $this->sheet->setCellValue('A2', $title);
        $this->sheet->getStyle('A2')->getFont()->setSize(14);
        $this->sheet->getRowDimension('2')->setRowHeight(23);
    }

    private function _headers() {
        $i=0;
        foreach ($this->data[0] as $field => $value) {
            if (!in_array($field,$this->blacklist)) {
                $columnName = Inflector::humanize($field);
                $this->sheet->setCellValueByColumnAndRow($i++, 4, $columnName);
            }
        }
        $this->sheet->getStyle('A4')->getFont()->setBold(true);
        $this->sheet->getStyle('A4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $this->sheet->getStyle('A4')->getFill()->getStartColor()->setRGB('969696');
        $this->sheet->duplicateStyle( $this->sheet->getStyle('A4'), 'B4:'.$this->sheet->getHighestColumn().'4');
        for ($j=1; $j<$i; $j++) {
            $this->sheet->getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($j))->setAutoSize(true);
        }
    }
        
    private function _rows() {
        $i=5;
        foreach ($this->data as $row) {
            $j=0;
            foreach ($row as $field => $value) {
                if(!in_array($field,$this->blacklist)) {
                    $this->sheet->setCellValueByColumnAndRow($j++,$i, $value);
                }
            }
            $i++;
        }
    }
    
     function _name($title=null, $ext='.xlsx') {
        if(!isset($this->data['name']) && $title) {
            $name = str_replace(' ','_',strtolower($title)).'_'.date('d-m-Y_H-i').$ext;
        } elseif(!isset($this->data['name'])) {
            $name = 'documento_'.date('d-m-Y_H-i').$ext;
        } elseif(isset($this->data['name'])) {
            $name = $this->data['name'].'__'.date('d-m-Y_H-i').$ext;
        } elseif(strtolower(substr($name, -4))!=$ext) {
            $name .= $ext;
        }
        return $name;
    }
            
    function output($title) {
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");;
        header("Content-Disposition: attachment;filename=". $this->_name($title) .".xlsx");
        header("Content-Transfer-Encoding: binary ");
        $objWriter = new PHPExcel_Writer_Excel2007($this->xls);
        $objWriter->save('php://output');                 
    }
}