<?php
namespace umbalaconmeogia\japancorpnum\commands;

use umbalaconmeogia\japancorpnum\models\CorporateNumber;
use Yii;
use yii\console\Controller;

if(0 === strpos(PHP_OS, 'WIN')) {
    setlocale(LC_CTYPE, 'C');
}

class CorporateNumberController extends Controller
{
    const INDEX_SEQUENCE_NUMBER = 0;

    const RECORD_NUM_TO_PRINT = 1000;

    const BATCH_INSERT_SIZE = 500;

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
     *   php yii japancorpnum/corporate-number/insert-csv-folder
     * ```
     */
    public function actionInsertCsvFolder()
    {
        $this->totalCount = 0;
        $folder = __DIR__ . '/../data/csv';
        $files = array_diff(scandir($folder), array('.', '..'));
        foreach ($files as $file) {
            $this->insertCsv("$folder/$file");
        }
    }

    /**
     * @param string $csvFile
     * @param bool $insertNew
     */
    private function insertCsv($csvFile)
    {
        $pathInfo = pathinfo($csvFile);
        $fileName = $pathInfo['filename'];

        $currentCount = 0;
        $insertCount = 0;
        $insertRows = [];

        $handle = fopen($csvFile, 'r');
        $dbCommand = Yii::$app->db->createCommand();

        while (($row = fgetcsv($handle)) !== FALSE) {
            $insertCount++;
            $insertRows[] = $row;

            if ($insertCount == self::BATCH_INSERT_SIZE) {
                $dbCommand->batchInsert('corporate_number', $this->csvColumns, $insertRows)->execute();
                $currentCount += $insertCount;
                $this->totalCount += $insertCount;
                $insertCount = 0;

                if ($currentCount % self::RECORD_NUM_TO_PRINT == 0) {
                    echo "$fileName = $currentCount / {$this->totalCount}\n";
                }
            }

        }

        // Insert left rows.
        if ($insertCount) {
            $dbCommand->batchInsert('corporation_number', $this->csvColumns, $insertRows);
            $currentCount += $insertCount;
            $this->totalCount += $insertCount;
            $insertCount = 0;
        }
        echo "$fileName = $currentCount / {$this->totalCount}\n";

        fclose($handle);
    }

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