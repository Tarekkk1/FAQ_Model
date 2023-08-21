<?php
namespace Custom\FAQ\Model;

use Custom\FAQ\Model\ResourceModel\Question\CollectionFactory;
use Magento\Framework\App\RequestInterface;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $collection;
    protected $loadedData;
    protected $request;  

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $questionCollectionFactory,
        RequestInterface $request, // Inject the RequestInterface here
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $questionCollectionFactory->create();
        $this->request = $request; 
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

public function getData(): array
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        $this->loadedData=[];
        foreach ($items as $item) {
            $this->loadedData[$item->getId()] = $item->getData();
        }
        // print_r($this->loadedData);
        // exit;
        
        return $this->loadedData;
    }

   }