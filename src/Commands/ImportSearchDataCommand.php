<?php

namespace SmileyThane\OxidSiteMap\Commands;

use SmileyThane\OxidSiteMap\SiteMapGenerator;
use OxidEsales\EshopCommunity\Internal\Framework\Console\AbstractShopAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use OxidEsales\Eshop\Core\Registry;

class ImportSearchDataCommand extends AbstractShopAwareCommand
{

    /**
     * SiteMapCommand constructor.
     * @param SiteMapGenerator $siteMapGenerator
     * @param null $name
     */
    public function __construct($name = null)
    {
        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setName('smileythane:search:import')
            ->setDescription('Data importer for custom search');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $xml = file_get_contents($input->getOption('url'));
            $xmlObj = simplexml_load_string($xml, "SimpleXMLElement", LIBXML_NOCDATA);
            $json = json_encode($xmlObj);
            $array = json_decode($json, true);

            if($array["channel"] && $array["channel"]["item"]) {
                $items = $array["channel"]["item"];

                foreach($items as $item) {
                    $itemObj = json_encode($item);

                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => Registry::getConfig()->getConfigParam('customSearchURL'),
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => $itemObj,
                        CURLOPT_HTTPHEADER => [
                            'Content-Type: application/json',
                            'Authorization: ' . Registry::getConfig()->getConfigParam('customSearchAuth')
                        ],
                    ));

                    curl_exec($curl);
                    curl_close($curl);
                }
            }

        } catch (\Throwable $th) {
            var_dump($th);
        }

        return 0;
    }
}
