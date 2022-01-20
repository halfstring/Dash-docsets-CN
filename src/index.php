<?php


class GenDocsets
{

    private $sourceDir = '';
    private $sqlFile = '';

    public function __construct($sourceDir, $sqlFile)
    {
        $this->sourceDir = trim($sourceDir);
        $this->sqlFile = trim($sqlFile);
    }

    public function run()
    {
        $dir = dir($this->sourceDir);

        $result = [];

        file_put_contents($this->sqlFile, "");

        while ($file = $dir->read()) {

            if ($file === '.' || $file === '..' || stripos($file, '.html') === false) {
                continue;
            }

            $filePath = $this->sourceDir . '/' . $file;

            $key = $this->getKeyword($filePath);
            if (false === $key) {
                continue;
            }

            $sqlTpl = "INSERT INTO `searchIndex`(name, type, path) VALUES ('{KEYWORD}','Keyword','{HTML-TPL}')";
            echo $file, PHP_EOL;

            file_put_contents($this->sqlFile, strtr($sqlTpl, [
                    "{KEYWORD}"  => $key,
                    "{HTML-TPL}" => $file
                ]) . ";\n", FILE_APPEND);
        }

        return true;
    }


    private function getKeyword($file)
    {
        $content = file_get_contents($file);

        preg_match_all("/<h\d.*\>(.*?)<\/h/", $content, $items);

        if (!isset($items[1][0])) {
            //echo $file, PHP_EOL;
            return false;
        }

        return $items[1][0];
    }
}

$baseDir = dirname(__DIR__) . '/PHP.CN.docset/Contents/Resources';
$sourceDir = $baseDir . '/Documents';
$sqlFile = $baseDir . '/docSet.sql';
$genDocsets = new GenDocsets($sourceDir, $sqlFile);
$genDocsets->run();
