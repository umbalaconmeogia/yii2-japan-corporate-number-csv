<?php
namespace umbalaconmeogia\japancorpnum\commands;

use umbalaconmeogia\japancorpnum\models\CorporateNumber;
use yii\console\Controller;

if(0 === strpos(PHP_OS, 'WIN')) {
    setlocale(LC_CTYPE, 'C');
}

class CorporateNumberController extends Controller
{
    const INDEX_SEQUENCE_NUMBER = 0;

    private $csvColumns = [
        'sequenceNumber',
        'corporateNumber',
        'process',
        'correct',
        'updateDate',
        'changeDate',
        'name',
        'nameImageId',
        'kind',
        'prefectureName',
        'cityName',
        'streetNumber',
        'addressImageId',
        'prefectureCode',
        'cityCode',
        'postCode',
        'addressOutside',
        'addressOutsideImageId',
        'closeDate',
        'closeCause',
        'successorCorporateNumber',
        'changeCause',
        'assignmentDate',
        'latest',
        'enName',
        'enPrefectureName',
        'enCityName',
        'enAddressOutside',
        'furigana',
        'hihyoji',
    ];

    private $totalCount;

    /**
     * Syntax
     * ```shell
     *   php yii japancorpnum/corporate-number/import-csv-folder 1
     * ```
     */
    public function actionImportCsvFolder($insertNew = FALSE)
    {
        echo "InsertNew = $insertNew\n";
        $this->totalCount = 0;
        $folder = __DIR__ . '/../data/csv';
        $files = array_diff(scandir($folder), array('.', '..'));
        foreach ($files as $file) {
            $this->importCsv("$folder/$file", $insertNew);
        }
    }

    const RECORD_NUM_TO_PRINT = 1000;

    /**
     * @param string $csvFile
     * @param bool $insertNew
     */
    private function importCsv($csvFile, $insertNew)
    {
        $pathInfo = pathinfo($csvFile);
        $fileName = $pathInfo['filename'];

        $currentCount = 0;

        $handle = fopen($csvFile, 'r');

        while (($row = fgetcsv($handle)) !== FALSE) {

            $corpNum = NULL;

            // If $insertTrue is TRUE, assume that there is no doubled record in the DB
            // so do not find the existing record from DB.
            if (!$insertNew) {
                $sequenceNumber = $row[self::INDEX_SEQUENCE_NUMBER];
                $corpNum = CorporateNumber::findOne(['sequenceNumber' => $sequenceNumber]);
            }
            // Create new object if not found existing one in DB.
            if (!$corpNum) {
                $corpNum = new CorporateNumber();
            }
            foreach ($this->csvColumns as $index => $attribute) {
                $corpNum->$attribute = $row[$index];
            }
            $corpNum->save();

            $currentCount++;
            $this->totalCount++;
            if ($currentCount % self::RECORD_NUM_TO_PRINT == 0) {
                echo "$fileName = $currentCount / {$this->totalCount}\n";
            }
        }

        fclose($handle);
    }
}