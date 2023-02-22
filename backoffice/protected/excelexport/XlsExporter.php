<?php

class XlsExporter
{
    const CRLF = "\r\n";

    /**
     * Export and download an Active Record resultset to an XML-based xls file
     *
     * @param $filename - Name of output filename
     * @param $data - Active record data set
     * @param $title - Title displayed on top
     * @param $header - Boolean to show/hide header
     * @param $labels - Array of fields to export
     * @param $type - String that explains what's being exported for the end user (use plural)
     */

    public static function downloadXls($filename, $data, $title, $header, $labels, $fields ,$from_date, $to_date, $search_criteria)
    {
        $export = self::createXlsString($data, $title, $header, $labels, $fields, $from_date, $to_date, $search_criteria);
        self::sendHeader($filename, strlen($export), 'vnd.ms-excel');
        echo $export;
        Yii::app()->end();
    }

    /**
     * Send file header
     *
     * @param $filename - Filename for the created file
     * @param $length - Size of file
     * @param $type - Mime type of exported data
     */
    private static function sendHeader($filename, $length, $type = 'octet-stream')
    {
        if (strtolower(substr($filename, -4)) != '.xls'){
            $filename .= '.xls';
        }

        header("Content-type: application/$type");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-length: $length");
        header('Pragma: no-cache');
        header('Expires: 0');
    }

    /**
     * Private method to create xls string from active record data set
     *
     * @param $data - CActiveRecord or Array
     * Example: 1.CActiveRecord: $data = Model::model()->findAll(new CDbCriteria()->condition = "column > $param");
     *          2.Array: $data = Yii::app()->db->createCommand("SELECT * FROM t")->queryAll()
     *
     * @param $title - Title displayed on top
     * @param $header - Boolean to show/hide header
     * @param $labels - Array of fields to show in header
     *
     * @param $fields -Array of fields to export: alias, relation's names or array's index
     *  example: 1.CActiveRecord: "firstRel.secondRel.n.propertyOfLastRel"
     *           2.Array: "index1" (alias or column name) example: SELECT col as index1 FROM t;
     *
     * @param $type - String that explains what's being exported for the end user
     */
    private static function createXlsString($data, $title, $header, $labels, $fields, $from_date, $to_date, $search_criteria)
    {

       //  print_r($data); die();
        $string = '<html>' . self::CRLF
            . '<head>' . self::CRLF
            . '<meta http-equiv="content-type" content="text/html; charset=utf-8">' . self::CRLF
            //The following line of code is to allow long numbers (such as bank account number )
            . '<style> .text{ mso-number-format:\@; } </style>' . self::CRLF
            . '</head>' . self::CRLF
            . '<body style="text-align:center">' . self::CRLF;

        if ($title)
            $string .= "<b>$title</b><br /><br />" . self::CRLF
                . Yii::t('main', 'Exported Count ') . ': ' . count($data) . '<br />' . self::CRLF
                . Yii::t('main', 'Export date') . ': ' . Yii::app()->dateFormatter->formatDateTime($_SERVER['REQUEST_TIME']) . '<br />' . self::CRLF
                 . '<b><u>Search Criteria</u></b> <br>' . $search_criteria. '<br />' . self::CRLF
                   . '<b>From Date</b>: ' . $from_date. '<br />' . self::CRLF
                    . '<b>To Date</b>: ' . $to_date. '<br /><br />' . self::CRLF;

        if ($data)
        {
            $string .= '<table style="text-align:left" border="1" cellpadding="1" cellspacing="1">' . self::CRLF;

            if (!$labels)
                $labels = array_keys($data[0]->attributes);

            if ($header)
            {
                $string .= '<tr>' . self::CRLF;
                foreach ($labels as $field)
                    $string .= '<th>' . $field . '</th>' . self::CRLF;
                $string .= '</tr>' . self::CRLF;
            }

          
            foreach ($data as $k=> $row)
            {
            
                $string .= '<tr>' . self::CRLF;
              
                // print_r($row); die();    
                foreach ($fields as $dato){   
                    if($dato=='sr_no'){
                         $final = $k+1;                 
                    }else{
                         $final = $row[$dato];                 
                    }
                   
                    $string .= '<td class="text">' . $final . '</td>' . self::CRLF;
                }
                $string .= '</tr>' . self::CRLF;
            }
            $string .= '</table>' . self::CRLF;
        }

        $string .= '</body>' . self::CRLF
            . '</html>';

        return $string;
    }
}