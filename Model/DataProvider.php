<?php
namespace Custom\FAQ\Model;

use Custom\FAQ\Model\ResourceModel\Question\CollectionFactory;
use Magento\Framework\App\RequestInterface;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $collection;
    protected $loadedData;
    protected $request;  // Add this line to define the property

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
        $this->request = $request; // Assign the request object to the property
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        $data = [];
        
        $id = $this->request->getParam('id'); // Get the ID from the request
        if ($id) {

            $question = $this->loadedData[$id] = $this->collection->getItemById($id);
            if ($question) {
                $data[$id] = $question->getData();
            }
            // $data[$id] = $question;
        }
        
        return $data;
    }
        // public function getData()
        // {
        //     if (isset($this->loadedData)) {
        //         return $this->loadedData;
        //     }
        //     $question = $this->collection->getItems();
        //     foreach ($question as $questions) {
        //         $this->loadedData[$questions->getId()] = $questions->getData();
        //     }
    
        //     return $this->loadedData;
        // }
//         public function getData()
// {
    // If we already loaded the data, return it
    // if (isset($this->loadedData)) {
    //     return $this->loadedData;
    // }

    // Get the id from the request
   
//     $id = $this->request->getParam('id');

    
//     // If there's an id, load that specific question
//     if ($id) {
//         $question = $this->collection->getItemById($id);
//         if ($question) {
//             $this->loadedData[$id] = $question->getData();
//         }
//        return $id;
       
//     } else {
//         // Else, load all questions (original behavior)
//         $questions = $this->collection->getItems();
//         foreach ($questions as $question) {
//             $this->loadedData[$question->getId()] = $question->getData();
//         }
//     }
    
//     return $this->loadedData;
// }


}