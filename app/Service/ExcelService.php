<?php

namespace App\Service;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Exception;

class ExcelService
{
    /**
     * 导出下载
     * @param array $head
     * @param $list
     * @param $name
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @author wywk  947036348@qq.com
     * @date 2020/5/13 11:44
     */
    static public function download(array $head, $list, $name)
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setCreator(config('app.name'))->setTitle(config('app.name'))->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.');
        $spreadsheet->setActiveSheetIndex(0);
        //1写入标题
        $i = 1;
        foreach ($head as $k => $v) {
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($i++, 1, $v);
        }
        foreach ($list as $k => $v) {
            $i = 1;
            foreach ($head as $k2 => $v2) {
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($i++, $k + 2, "'".$v->$k2);
            }
        }
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $name . '.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        try {
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        } catch (Exception $e) {
        }
        $writer->save('php://output');
        exit;
    }
}
