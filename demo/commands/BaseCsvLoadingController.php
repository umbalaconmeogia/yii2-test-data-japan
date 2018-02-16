<?php
namespace app\commands;

use yii\console\Controller;

// php7だとこれが必要ぽい
if(0 === strpos(PHP_OS, 'WIN')) {
    setlocale(LC_CTYPE, 'C');
}
class BaseCsvLoadingController extends Controller
{
    /**
     * @var array
     */
    protected $actionOptions = [
        'index' => [
            'csvFile',
        ],
    ];

    /**
     * @var string
     */
    public $csvFile;

    /**
     * {@inheritDoc}
     * @see \yii\console\Controller::options()
     */
    public function options($actionID)
    {
        $result = [];
        if (isset($this->actionOptions[$actionID])) {
            $result = $this->actionOptions[$actionID];
        }
        return $result;
    }
}
