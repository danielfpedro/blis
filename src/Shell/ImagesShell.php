<?php
namespace App\Shell;

use Cake\Console\Shell;

use Cake\ORM\TableRegistry;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * Images shell command.
 */
class ImagesShell extends Shell
{

    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();

        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int Success or error code.
     */
    public function main() 
    {
        $posts = TableRegistry::get('posts');
        $query = $posts
            ->find('all')
            ->select('photo');

        $validImages = [];
        foreach ($query as $key => $value) {
            foreach ($posts->images as $k => $v) {
                $validImages[] = $k . '_' . $value['photo'];
            }
        }

        $folder = new Folder(WWW_ROOT . 'files' . DS . 'images');
        $folderFiles = $folder->find('.*\.jpg', true);

        foreach ($folderFiles as $key => $value) {
            $file = new File($folder->path . DS . $value);
            if (!in_array($value, $validImages)) {
                $file->delete();
            }
        }

        $this->out('OK');
    }
}
