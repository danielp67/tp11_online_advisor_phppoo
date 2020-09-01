<?php

namespace App\Controller;

use App\Model\CommentModel;
use App\Model\Item;
use App\Model\ItemModel;

final class ItemController
{
    private $item;
    private $itemModel;


    public function __construct()
    {
        $this->itemModel = new ItemModel();
    }

    public function listItemPage() :void
    {
        if ($_SESSION['login'] === null) {
            header('Location: http://localhost/TP11_online_advisor_phppoo');
        }
        $listItems = $this->itemModel->getItemsDb();

        require('src/View/listItemsView.php');
    }


    public function getComments() :void
    {
        if ($_SESSION['login'] === null) {
            header('Location: http://localhost/TP11_online_advisor_phppoo');
        }
        $params = explode('/', $_GET['p']);
        $commentModel = new CommentModel();
        $getComments = $commentModel->getComments($params[2]);
        $_SESSION['itemId'] = (int) $params[2];
        $getItem = $this->itemModel->getItemDb($params[2]);
        require('src/View/itemView.php');
    }


    public function addNewItem() :void
    {
        if ($_SESSION['login'] === null) {
            header('Location: http://localhost/TP11_online_advisor_phppoo');
        }

        $this->item = new Item($_POST['itemName']);

        $checkItem = $this->item->checkNewItem($_POST, $_SESSION);

        $newItem = $this->itemModel->createNewItem($checkItem);

        header('Location: http://localhost/TP11_online_advisor_phppoo/items/listItemPage');
    }
}
