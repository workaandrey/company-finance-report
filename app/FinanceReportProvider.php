<?php

namespace App;

use Carbon\Carbon;

/**
 * Class FinanceReportProvider
 * @package App
 */
class FinanceReportProvider implements FinanceReport
{
    private $baseUrl = 'https://finance.google.com/finance/historical?output=csv&q=%s&startdate=%s&enddate=%s';

    /**
     * Generate report by company for date range
     *
     * @param string $symbol
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @return mixed|void
     * @throws \Exception
     */
    public function report(string $symbol, Carbon $startDate, Carbon $endDate)
    {
        $url = sprintf(
            $this->baseUrl,
            urlencode($symbol),
            urlencode($startDate->format('M d, Y')),
            urlencode($endDate->format('M d, Y'))
        );
        $reportFile = $this->downloadReportFile($url);
        return $this->parseReportFile($reportFile);
    }

    /**
     * Download report in csv format
     *
     * @param string $source
     * @return bool|string
     */
    private function downloadReportFile(string $source)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $source);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec ($ch);
        curl_close ($ch);

        $destination = tempnam(sys_get_temp_dir(), 'report');
        $file = fopen($destination, "w+");
        fputs($file, $data);
        fclose($file);

        return $destination;
    }

    /**
     * @param string $reportFile
     * @return array
     * @throws \Exception
     */
    private function parseReportFile(string $reportFile)
    {
        if(!is_readable($reportFile)) {
            throw new \Exception('FinanceReport report file is not readable');
        }
        $rows = [];

        if (($handle = fopen($reportFile, "r")) !== FALSE) {
            $i = 0;
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if($i > 0) {
                    $rows[] = $data;
                }
                $i++;
            }
            fclose($handle);
        }

        unlink($reportFile);

        return array_reverse($rows);
    }
}